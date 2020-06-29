<?php

declare(strict_types=1);

namespace Solital\Core\Http;

use Solital\Core\Http\Exceptions\InvalidArgumentException;
use Solital\Core\Http\Exceptions\RuntimeException;
use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{

    /**
     * The HTTP stream resource.
     *
     * @var resource
     */
    private $stream;

    /**
     * @param string|resource $stream
     * @param string          $mode
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($stream = 'php://memory', string $mode = 'r')
    {
        if (is_string($stream)) {
            $stream = fopen($stream, $mode);
        }

        if (! is_resource($stream) || get_resource_type($stream) !== 'stream') {
            InvalidArgumentException::alertMessage(400, 
                'The stream must be a string stream identifier or stream resource, received ' .
                (is_object($stream) ? get_class($stream) : gettype($stream))
            );
        }

        $this->stream = $stream;
    }

    /**
     * @return string
     *
     * @throws \RuntimeException
     */
    public function __toString()
    {
        try {
            $this->rewind();

            return $this->getContents();
        } catch (RuntimeException $e) {
            return '';
        }
    }

    /**
     * Closes the stream and any underlying resources.
     */
    public function close()
    {
        $this->stream && fclose($this->stream);
        $this->detach();
    }

    /**
     * @return resource|null
     */
    public function detach()
    {
        if ($this->stream === null) {
            return null;
        }

        $resource = $this->stream;
        $this->stream = null;

        return $resource;
    }

    /**
     * @return int|null
     */
    public function getSize()
    {
        if ($this->stream === null) {
            return null;
        }

        $stats = fstat($this->stream);

        return $stats['size'] ?? null;
    }

    /**
     * @return int
     * @throws \RuntimeException
     */
    public function tell() : int
    {
        if (! $this->stream || is_int($position = ftell($this->stream)) === false) {
            RuntimeException::alertMessage('Unable to determine stream position');
        }

        return $position;
    }

    /**
     * @return bool
     */
    public function eof() : bool
    {
        return ! $this->stream || feof($this->stream);
    }

    /**
     * @return bool
     */
    public function isSeekable() : bool
    {
        return $this->stream && $this->getMetadata('seekable') === true;
    }

    /**
     * @throws \RuntimeException
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        if (! $this->isSeekable() || fseek($this->stream, $offset, $whence) === -1) {
            RuntimeException::alertMessage('Unable tho seek stream position');
        }
    }

    /**
     * @throws \RuntimeException
     */
    public function rewind()
    {
        $this->seek(0);
    }

    /**
     * @return bool
     */
    public function isWritable() : bool
    {
        return $this->stream && is_writable($this->getMetadata('uri'));
    }

    /**
     * @param string
     * @return int
     * @throws \RuntimeException
     */
    public function write($string) : int
    {
        $write = fwrite($this->stream, $string);

        /*if (! $this->isWritable() || ($write = fwrite($this->stream, $string)) === false) {
            throw new RuntimeException('Unable to write to stream');
        }*/

        return $write;
    }

    /**
     * @return bool
     */
    public function isReadable() : bool
    {
        if ($this->stream) {
            $mode = $this->getMetadata('mode');

            return strpos($mode, 'r') !== false || strpos($mode, '+') !== false;
        }

        return false;
    }


    /**
     * @return string
     * @throws \RuntimeException
     */
    public function read($length) : string
    {
        if (! $this->isReadable() || ($read = fread($this->stream, $length)) === false) {
            RuntimeException::alertMessage('Unable to read stream');
        }

        return $read;
    }

    /**
     * @return string
     * @throws \RuntimeException
     */
    public function getContents() : string
    {
        if (! $this->isReadable() || ($contents = stream_get_contents($this->stream)) === false) {
            RuntimeException::alertMessage('Unable to read stream contents');
        }

        return $contents;
    }

    /**
     * @param string
     * @return array|mixed|null 
     */
    public function getMetadata($key = null)
    {
        $meta = stream_get_meta_data($this->stream);

        if ($key === null) {
            return $meta;
        }

        return $meta[$key] ?? null;
    }
}
