<?php

declare(strict_types=1);

namespace Solital\Core\Http\Traits;

use Solital\Core\Http\Stream;
use Solital\Core\Http\Exceptions\InvalidArgumentException;
use Psr\Http\Message\StreamInterface;

trait MessageTrait
{

    /**
     * The HTTP protocol version.
     *
     * @var string
     */
    private $protocolVersion = '1.1';

    /**
     * Available valid HTTP protocol versions.
     *
     * @var array
     */
    private static $validProtocolVersions = [
        '1.0',
        '1.1',
        '2.0',
    ];

    /**
     * The registered HTTP headers, as key => array of values.
     *
     * @var array
     */
    private $headers = [];

    /**
     * The normalized HTTP header names.
     *
     * @var array
     */
    private $headerNames = [];

    /**
     * The stream instance.
     *
     * @var \Psr\Http\Message\StreamInterface
     */
    private $stream;

    /**
     * Disable magic setter to ensure immutability.
     *
     * @param mixed $name
     * @param mixed $value
     *
     * @throws \InvalidArgumentException When a property was set to an instance from outside.
     */
    public function __set($name, $value)
    {
        InvalidArgumentException::alertMessage(400, 'Cannot add new property $' . $name . ' to instance of ' . __CLASS__);
    }

    /**
     * Retrieves the HTTP protocol version as a string.
     *
     * The string MUST contain only the HTTP version number (e.g., "1.1", "1.0").
     *
     * @return string HTTP protocol version.
     */
    public function getProtocolVersion() : string
    {
        return $this->protocolVersion;
    }

    /**
     * Return an instance with the specified HTTP protocol version.
     *
     * The version string MUST contain only the HTTP version number (e.g.,
     * "1.1", "1.0").
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * new protocol version.
     *
     * @param string $version HTTP protocol version
     *
     * @return static
     *
     * @throws \InvalidArgumentException If the HTTP protocol version is invalid.
     */
    public function withProtocolVersion($version)
    {
        $this->validateProtocolVersion($version);

        return $this->cloneWithProperty('protocolVersion', $version);
    }

    /**
     * Validate the HTTP protocol version.
     *
     * @param mixed $version
     *
     * @throws \InvalidArgumentException If the HTTP protocol version is invalid.
     */
    private function validateProtocolVersion($version)
    {
        if (! is_string($version) || ! in_array($version, self::$validProtocolVersions, true)) {
            InvalidArgumentException::alertMessage(400, 
                'Invalid HTTP protocol version. Must be ' .
                implode(', ', self::$validProtocolVersions)
            );
        }
    }

    /**
     * Set HTTP headers in the correct internal format.
     *
     * @param array $originalHeaders
     *
     * @throws \InvalidArgumentException for invalid header values.
     */
    private function setHeaders(array $originalHeaders)
    {
        $headerNames = $headers = [];

        foreach ($originalHeaders as $header => $value) {
            $value = $this->sanitizeHeaderValue($value);
            $this->validateHeaderName($header);
            $headerNames[strtolower($header)] = $header;
            $headers[$header] = $value;
        }

        $this->headerNames = $headerNames;
        $this->headers = $headers;
    }

    /**
     * Sanitize the HTTP header value.
     *
     * @param mixed $value
     *
     * @return array
     *
     * @throws \InvalidArgumentException for invalid header values.
     */
    private function sanitizeHeaderValue($value) : array
    {
        if (! is_array($value)) {
            $value = [$value];
        }

        $value = array_map(function ($value) {
            if (! is_string($value) && ! is_numeric($value)) {
                InvalidArgumentException::alertMessage(400, 
                    'Invalid header value type. Must be a string or numeric, received ' .
                    (is_object($value) ? get_class($value) : gettype($value))
                );
            }

            $value = (string) $value;

            if (preg_match("#(?:(?:(?<!\r)\n)|(?:\r(?!\n))|(?:\r\n(?![ \t])))#", $value) ||
                preg_match('/[^\x09\x0a\x0d\x20-\x7E\x80-\xFE]/', $value)
            ) {
                InvalidArgumentException::alertMessage(400, $value . ' is not a valid header name');
            }

            return $value;
        }, $value);

        return $value;
    }

    /**
     * Determine if a HTTP header name is valid.
     *
     * @param mixed $name
     *
     * @throws \InvalidArgumentException for invalid header names.
     */
    private function validateHeaderName($name)
    {
        if (! is_string($name)) {
            InvalidArgumentException::alertMessage(400, 
                'Invalid header name type. Must be a string, received ' .
                (is_object($name) ? get_class($name) : gettype($name))
            );
        }

        if (! preg_match('/^[a-zA-Z0-9\'`#$%&*+.^_|~!-]+$/', $name)) {
            InvalidArgumentException::alertMessage(400, $name . ' is not a valid header name');
        }
    }

    /**
     * Retrieves all message header values.
     *
     * The keys represent the header name as it will be sent over the wire, and
     * each value is an array of strings associated with the header.
     *
     *     // Represent the headers as a string
     *     foreach ($message->getHeaders() as $name => $values) {
     *         echo $name . ": " . implode(", ", $values);
     *     }
     *
     *     // Emit headers iteratively:
     *     foreach ($message->getHeaders() as $name => $values) {
     *         foreach ($values as $value) {
     *             header(sprintf('%s: %s', $name, $value), false);
     *         }
     *     }
     *
     * While header names are not case-sensitive, getHeaders() will preserve the
     * exact case in which headers were originally specified.
     *
     * @return string[][] Returns an associative array of the message's headers. Each
     *     key MUST be a header name, and each value MUST be an array of strings
     *     for that header.
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }

    /**
     * Checks if a header exists by the given case-insensitive name.
     *
     * @param string $name Case-insensitive header field name.
     *
     * @return bool Returns true if any header names match the given header
     *     name using a case-insensitive string comparison. Returns false if
     *     no matching header name is found in the message.
     */
    public function hasHeader($name) : bool
    {
        return isset($this->headerNames[strtolower($name)]);
    }

    /**
     * Retrieves a message header value by the given case-insensitive name.
     *
     * This method returns an array of all the header values of the given
     * case-insensitive header name.
     *
     * If the header does not appear in the message, this method MUST return an
     * empty array.
     *
     * @param string $name Case-insensitive header field name.
     *
     * @return string[] An array of string values as provided for the given
     *    header. If the header does not appear in the message, this method MUST
     *    return an empty array.
     */
    public function getHeader($name) : array
    {
        if (! $this->hasHeader($name)) {
            return [];
        }

        $name = $this->headerNames[strtolower($name)];

        return $this->headers[$name];
    }

    /**
     * Retrieves a comma-separated string of the values for a single header.
     *
     * This method returns all of the header values of the given
     * case-insensitive header name as a string concatenated together using
     * a comma.
     *
     * NOTE: Not all header values may be appropriately represented using
     * comma concatenation. For such headers, use getHeader() instead
     * and supply your own delimiter when concatenating.
     *
     * If the header does not appear in the message, this method MUST return
     * an empty string.
     *
     * @param string $name Case-insensitive header field name.
     *
     * @return string A string of values as provided for the given header
     *    concatenated together using a comma. If the header does not appear in
     *    the message, this method MUST return an empty string.
     */
    public function getHeaderLine($name) : string
    {
        return implode(', ', $this->getHeader($name));
    }

    /**
     * Return an instance with the provided value replacing the specified header.
     *
     * While header names are case-insensitive, the casing of the header will
     * be preserved by this function, and returned from getHeaders().
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * new and/or updated header and value.
     *
     * @param string          $name  Case-insensitive header field name.
     * @param string|string[] $value Header value(s).
     *
     * @return static
     *
     * @throws \InvalidArgumentException for invalid header names or values.
     */
    public function withHeader($name, $value)
    {
        $this->validateHeaderName($name);

        $value = $this->sanitizeHeaderValue($value);
        $lowerName = strtolower($name);

        $clone = clone $this;

        if ($clone->hasHeader($name)) {
            unset($clone->headers[$clone->headerNames[$lowerName]]);
        }

        $clone->headers[$name] = $value;
        $clone->headerNames[$lowerName] = $name;

        return $clone;
    }

    /**
     * Return an instance with the specified header appended with the given value.
     *
     * Existing values for the specified header will be maintained. The new
     * value(s) will be appended to the existing list. If the header did not
     * exist previously, it will be added.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * new header and/or value.
     *
     * @param string          $name  Case-insensitive header field name to add.
     * @param string|string[] $value Header value(s).
     *
     * @return static
     *
     * @throws \InvalidArgumentException for invalid header names or values.
     */
    public function withAddedHeader($name, $value)
    {
        $this->validateHeaderName($name);

        if (! $this->hasHeader($name)) {
            return $this->withHeader($name, $value);
        }

        $value = $this->sanitizeHeaderValue($value);
        $name = $this->headerNames[strtolower($name)];

        $clone = clone $this;
        $clone->headers[$name] = array_merge($this->headers[$name], $value);

        return $clone;
    }

    /**
     * Return an instance without the specified header.
     *
     * Header resolution MUST be done without case-sensitivity.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that removes
     * the named header.
     *
     * @param string $name Case-insensitive header field name to remove.
     *
     * @return static
     */
    public function withoutHeader($name)
    {
        if (! $this->hasHeader($name)) {
            return clone $this;
        }

        $lowerName = strtolower($name);
        $name = $this->headerNames[$lowerName];

        $clone = clone $this;

        unset($clone->headers[$name], $clone->headerNames[$lowerName]);

        return $clone;
    }

    /**
     * Set a new stream instance.
     *
     * @param string|resource|\Psr\Http\Message\StreamInterface $stream
     *
     * @throws \InvalidArgumentException When the stream is not valid.
     */
    private function setStreamInstance($stream)
    {
        if (is_string($stream) || is_resource($stream)) {
            $stream = new Stream($stream, 'wb+');
        }

        if (! $stream instanceof StreamInterface && $stream !== null) {
            InvalidArgumentException::alertMessage(400, 
                'The stream must be a string stream identifier, ' .
                'stream resource or a Psr\Http\Message\StreamInterface implementation'
            );
        }

        $this->stream = $stream;
    }

    /**
     * Gets the body of the message.
     *
     * @return StreamInterface Returns the body as a stream.
     */
    public function getBody() : StreamInterface
    {
        return $this->stream;
    }

    /**
     * Return an instance with the specified message body.
     *
     * The body MUST be a StreamInterface object.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return a new instance that has the
     * new body stream.
     *
     * @param \Psr\Http\Message\StreamInterface $body Body.
     *
     * @return static
     *
     * @throws \InvalidArgumentException When the body is not valid.
     */
    public function withBody(StreamInterface $body)
    {
        return $this->cloneWithProperty('stream', $body);
    }

    /**
     * Clone an instance with given property.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return static
     */
    private function cloneWithProperty(string $property, $value)
    {
        $clone = clone $this;
        $clone->$property = $value;

        return $clone;
    }
}
