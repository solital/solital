<?php

namespace Solital\Core\Http;

use Psr\Http\Message\UriInterface;
use Solital\Core\Http\Exceptions\MalformedUrlException;
use Solital\Core\Http\Exceptions\InvalidArgumentException;

class Uri implements \JsonSerializable, UriInterface
{
    private $originalUrl;
    
    /**
     * The URI user info.
     *
     * @var string
     */
    private $userInfo;
    
    /**
     * The URI scheme without "://" suffix.
     *
     * @var string
     */
    private $scheme;
    
    /**
     * The URI host.
     *
     * @var string
     */
    private $host;
    
    /**The URI port.
     *
     * @var int|null
     */
    private $port;

    /**
     * The URI username.
     *
     * @var string
     */
    private $username;

    /**
     * The URI password.
     *
     * @var string
     */
    private $password;
    
    /**
     * The URI path.
     *
     * @var string
     */
    private $path;

    /**
     * Params.
     *
     * @var string
     */
    private $params = [];
    
    /** The URI fragment.
     *
     * @var string
     */
    private $fragment;

    /**
     * The URI query.
     *
     * @var string
     */
    private $query;

    /**
     * Url constructor.
     *
     * @param string $url
     * @throws MalformedUrlException
     */
    public function __construct(string $url = '')
    {
        $this->getUriParts($url);
        $this->originalUrl = $url;

        if ($url !== null && $url !== '/') {
            $data = $this->parseUrl($url);

            $this->scheme = $data['scheme'] ?? null;
            $this->host = $data['host'] ?? null;
            $this->port = $data['port'] ?? null;
            $this->username = $data['user'] ?? null;
            $this->password = $data['pass'] ?? null;

            if (isset($data['path']) === true) {
                $this->setPath($data['path']);
            }

            $this->fragment = $data['fragment'] ?? null;

            if (isset($data['query']) === true) {
                $this->setQueryString($data['query']);
            }
        }
    }

    /**
     * Parse the full URI string.
     *
     * @param string $uri
     *
     * @throws \InvalidArgumentException for invalid or unsupported schemes.
     */
    private function getUriParts(string $uri)
    {
        $parts = parse_url($uri);

        $this->scheme = isset($parts['scheme']) ? $this->sanitizeScheme($parts['scheme']) : '';

        $user = $parts['user'] ?? '';
        $pass = isset($parts['pass']) ? ':' . $parts['pass'] : '';
        $this->userInfo = $user . $pass;

        $this->host = $parts['host'] ?? '';

        $this->port = null;

        if (isset($parts['port'])) {
            $this->port = $parts['port'];
        } elseif ($this->scheme === 'http') {
            $this->port = 80;
        } elseif ($this->scheme === 'https') {
            $this->port = 433;
        }

        $this->path = $parts['path'] ?? '';
        $this->query = $parts['query'] ?? '';
        $this->fragment = $parts['fragment'] ?? '';
    }

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
        throw new InvalidArgumentException('Cannot add new property "$' . $name . '" to instance of ' . __CLASS__);
    }

    /**
     * Check if url is using a secure protocol like https
     *
     * @return bool
     */
    public function isSecure(): bool
    {
        return (strtolower($this->getScheme()) === 'https');
    }

    /**
     * Checks if url is relative
     *
     * @return bool
     */
    public function isRelative(): bool
    {
        return ($this->getHost() === null);
    }

    /**
     * Get url scheme
     *
     * @return string|null
     */
    public function getScheme(): ?string
    {
        return $this->scheme;
    }

    /**
     * Set the scheme of the url
     *
     * @param string $scheme
     * @return static
     */
    public function setScheme(string $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * Get url host
     *
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * Set the host of the url
     *
     * @param string $host
     * @return static
     */
    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get url port
     *
     * @return int|null
     */
    public function getPort(): ?int
    {
        return ($this->port !== null) ? (int)$this->port : null;
    }

    /**
     * Set the port of the url
     *
     * @param int $port
     * @return static
     */
    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Parse username from url
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the username of the url
     *
     * @param string $username
     * @return static
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Parse password from url
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the url password
     *
     * @param string $password
     * @return static
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get path from url
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path ?? '/';
    }

    /**
     * Set the url path
     *
     * @param string $path
     * @return static
     */
    public function setPath(string $path): self
    {
        $this->path = rtrim($path, '/') . '/';

        return $this;
    }

    /**
     * Get query-string from url
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Merge parameters array
     *
     * @param array $params
     * @return static
     */
    public function mergeParams(array $params): self
    {
        return $this->setParams(array_merge($this->getParams(), $params));
    }

    /**
     * Set the url params
     *
     * @param array $params
     * @return static
     */
    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Set raw query-string parameters as string
     *
     * @param string $queryString
     * @return static
     */
    public function setQueryString(string $queryString): self
    {
        $params = [];

        if(parse_str($queryString, $params) !== false) {
            return $this->setParams($params);
        }

        return $this;
    }

    /**
     * Get query-string params as string
     *
     * @return string
     */
    public function getQueryString(): string
    {
        return static::arrayToParams($this->getParams());
    }

    /**
     * Get fragment from url (everything after #)
     *
     * @return string|null
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Set url fragment
     *
     * @param string $fragment
     * @return static
     */
    public function setFragment(string $fragment): self
    {
        $this->fragment = $fragment;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalUrl(): string
    {
        return $this->originalUrl;
    }

    /**
     * @param string $value
     * @return int
     */
    public function indexOf(string $value): int
    {
        $index = stripos($this->getOriginalUrl(), $value);

        return ($index === false) ? -1 : $index;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function contains(string $value): bool
    {
        return (stripos($this->getOriginalUrl(), $value) !== false);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasParam(string $name): bool
    {
        return array_key_exists($name, $this->getParams());
    }

    /**
     * @param array ...$names
     * @return static
     */
    public function removeParams(...$names): self
    {
        $params = array_diff_key($this->getParams(), array_flip($names));
        $this->setParams($params);

        return $this;
    }

    /**
     * @param string $name
     * @return static
     */
    public function removeParam(string $name): self
    {
        $params = $this->getParams();
        unset($params[$name]);
        $this->setParams($params);

        return $this;
    }

    /**
     * @param string $name
     * @param string|null $defaultValue
     * @return string|null
     */
    public function getParam(string $name, ?string $defaultValue = null): ?string
    {
        return isset($this->getParams()[$name]) ?? $defaultValue;
    }

    /**
     * UTF-8 aware parse_url() replacement.
     * @param string $url
     * @param int $component
     * @return array
     * @throws MalformedUrlException
     */
    public function parseUrl(string $url, int $component = -1): array
    {
        $encodedUrl = preg_replace_callback(
            '/[^:\/@?&=#]+/u',
            function ($matches) {
                return urlencode($matches[0]);
            },
            $url
        );

        $parts = parse_url($encodedUrl, $component);

        if ($parts === false) {
            throw new MalformedUrlException(sprintf('Failed to parse url: "%s"', $url));
        }

        return array_map('urldecode', $parts);
    }

    /**
     * @param array $getParams
     * @param bool $includeEmpty
     * @return string
     */
    public static function arrayToParams(array $getParams = [], bool $includeEmpty = true): string
    {
        if (\count($getParams) !== 0) {

            if ($includeEmpty === false) {
                $getParams = array_filter($getParams, function ($item) {
                    return (trim($item) !== '');
                });
            }

            return http_build_query($getParams);
        }

        return '';
    }

    /**
     * @return string
     */
    public function getRelativeUrl(): string
    {
        $params = $this->getQueryString();

        $path = $this->path ?? '';
        $query = $params !== '' ? '?' . $params : '';
        $fragment = $this->fragment !== null ? '#' . $this->fragment : '';

        return $path . $query . $fragment;
    }

    /**
     * @return string
     */
    public function getAbsoluteUrl(): string
    {
        $scheme = $this->scheme !== null ? $this->scheme . '://' : '';
        $host = $this->host ?? '';
        $port = $this->port !== null ? ':' . $this->port : '';
        $user = $this->username ?? '';
        $pass = $this->password !== null ? ':' . $this->password : '';
        $pass = ($user || $pass) ? $pass . '@' : '';

        return $scheme . $user . $pass . $host . $port . $this->getRelativeUrl();
    }

    /**
     * @param string $scheme The scheme to use with the new instance.
     * @return static A new instance with the specified scheme.
     * @throws \InvalidArgumentException for invalid or unsupported schemes.
     */
    public function withScheme($scheme) : Uri
    {
        $scheme = $this->sanitizeScheme($scheme);

        return $this->cloneWithProperty('scheme', $scheme);
    }

    /**
     * @param $scheme
     * @return string
     * @throws \InvalidArgumentException for invalid or unsupported schemes.
     */
    private function sanitizeScheme($scheme) : string
    {
        if (! is_string($scheme)) {
            InvalidArgumentException::alertMessage(400, 
                'The URI scheme must be a string, received' .
                (is_object($scheme) ? get_class($scheme) : gettype($scheme))
            );
        }

        $scheme = strtolower($scheme);
        $scheme = rtrim($scheme, '://');

        if (! in_array($scheme, ['', 'http', 'https'], true)) {
            InvalidArgumentException::alertMessage(400, 'The URI scheme must be \'\', http or https');
        }

        return $scheme;
    }

    /**
     * @return string The URI user information, in "username[:password]" format.
     */
    public function getUserInfo() : string
    {
        return $this->userInfo;
    }

    /**
     * @param string      $user     The user name to use for authority.
     * @param null|string $password The password associated with $user.
     * @return static A new instance with the specified user information.
     */
    public function withUserInfo($user, $password = null) : Uri
    {
        $userInfo = $user;

        if ($password !== null) {
            $userInfo .= ':' . $password;
        }

        return $this->cloneWithProperty('userInfo', $userInfo);
    }

    /**
     * @param string $host The hostname to use with the new instance.
     * @return static A new instance with the specified host.
     * @throws \InvalidArgumentException for invalid hostnames.
     */
    public function withHost($host) : Uri
    {
        if (! is_string($host)) {
            InvalidArgumentException::alertMessage(400, 
                'The URI host must be a string, received ' .
                (is_object($host) ? get_class($host) : gettype($host))
            );
        }

        return $this->cloneWithProperty('host', $host);
    }

    /**
     * @param null|int $port The port to use with the new instance; a null value removes the port information.
     * @return static A new instance with the specified port.
     * @throws \InvalidArgumentException for invalid ports.
     */
    public function withPort($port) : Uri
    {
        if ($port === null || $port === '') {
            return $this->cloneWithProperty('port', null);
        }

        $port = $this->sanitizePort($port);

        return $this->cloneWithProperty('port', $port);
    }

    /**
     * @return bool
     */
    private function hasStandardPort() : bool
    {
        return ($this->scheme === 'https' && $this->port === 433) || ($this->scheme === 'http' && $this->port === 80);
    }

    /**
     * @param mixed $port
     * @return int
     * @throws \InvalidArgumentException for invalid ports.
     */
    private function sanitizePort($port) : int
    {
        if (is_bool($port) || is_array($port) || is_object($port) || (string) (int) $port !== (string) $port) {
            InvalidArgumentException::alertMessage(400, 
                'The URI port must be null or an integer, received ' .
                (is_object($port) ? get_class($port) : gettype($port))
            );
        }

        $port = (int) $port;

        if ($port < 1 || $port > 65535) {
            throw new InvalidArgumentException('The URI port must be a valid TCP/UDP port');
        }

        return $port;
    }

    /**
     * @return string The URI authority, in "[user-info@]host[:port]" format.
     */
    public function getAuthority() : string
    {
        $user = $this->getUserInfo();
        $host = $this->getHost();
        $port = $this->getPort();

        return ($user ? $user . '@' : '') . $host . ($port !== null ? ':' . $port : '');
    }

    /**
     * @param string $path The path to use with the new instance.
     * @return static A new instance with the specified path.
     * @throws \InvalidArgumentException for invalid paths.
     */
    public function withPath($path) : Uri
    {
        $path = $this->sanitizePath($path);

        return $this->cloneWithProperty('path', $path);
    }

    /**
     * @param mixed $path
     * @return string
     * @throws \InvalidArgumentException for invalid paths.
     */
    private function sanitizePath($path) : string
    {
        if (! is_string($path)) {
            InvalidArgumentException::alertMessage(400, 
                'The URI path must be a string, received ' .
                (is_object($path) ? get_class($path) : gettype($path))
            );
        }

        if (strpos($path, '?') !== false) {
            InvalidArgumentException::alertMessage(400, 'The URI path must not contain a query string');
        }

        if (strpos($path, '#') !== false) {
            InvalidArgumentException::alertMessage(400, 'The URI path must not contain a URI fragment');
        }

        return preg_replace_callback(
            '/(?:[^a-zA-Z0-9_\-\.~:@&=\+\$,\/;%]+|%(?![A-Fa-f0-9]{2}))/',
            function ($match) {
                return rawurlencode($match[0]);
            },
            $path
        );
    }

    /**
     * @return string The URI query string.
     */
    public function getQuery() : string
    {
        return $this->query;
    }

    /**
     * @param string $query The query string to use with the new instance.
     * @return static A new instance with the specified query string.
     * @throws \InvalidArgumentException for invalid query strings.
     */
    public function withQuery($query) : Uri
    {
        $query = $this->sanitizeQuery($query);

        return $this->cloneWithProperty('query', $query);
    }

    /**
     * @param $query
     * @return string
     * @throws \InvalidArgumentException for invalid query strings.
     */
    private function sanitizeQuery($query) : string
    {
        if (! is_string($query)) {
            InvalidArgumentException::alertMessage(400, 
                'The URI query must be a string, received ' .
                (is_object($query) ? get_class($query) : gettype($query))
            );
        }

        if (strpos($query, '#') !== false) {
            InvalidArgumentException::alertMessage(400, 'The URI query must not contain a URI fragment');
        }

        $query = ltrim($query, '?');
        $parts = explode('&', $query);

        foreach ($parts as $index => $part) {
            $data = explode('=', $part, 2);

            if (count($data) === 1) {
                $data[] = null;
            }

            list($key, $value) = $data;

            if ($value === null) {
                $parts[$index] = $this->sanitizeQueryOrFragment($key);
                continue;
            }

            $parts[$index] = $this->sanitizeQueryOrFragment($key) . '=' . $this->sanitizeQueryOrFragment($value);
        }

        return implode('&', $parts);
    }

    /**
     * @param string $fragment The fragment to use with the new instance.
     * @return static A new instance with the specified fragment.
     * @throws \InvalidArgumentException for invalid fragment strings.
     */
    public function withFragment($fragment)
    {
        $fragment = $this->sanitizeFragment($fragment);

        return $this->cloneWithProperty('fragment', $fragment);
    }

    /**
     * @param mixed $fragment
     * @return string
     * @throws \InvalidArgumentException for invalid fragment strings.
     */
    private function sanitizeFragment($fragment) : string
    {
        if (! is_string($fragment)) {
            InvalidArgumentException::alertMessage(400, 
                'The URI query must be a string, received ' .
                (is_object($fragment) ? get_class($fragment) : gettype($fragment))
            );
        }

        $fragment = ltrim($fragment, '#');
        $fragment = $this->sanitizeQueryOrFragment($fragment);

        return $fragment;
    }

    /**
     * @param string $value
     * @return string
     */
    private function sanitizeQueryOrFragment(string $value) : string
    {
        return preg_replace_callback(
            '/(?:[^a-zA-Z0-9_\-\.~!\$&\'\(\)\*\+,;=%:@\/\?]+|%(?![A-Fa-f0-9]{2}))/',
            function ($matches) {
                return rawurlencode($matches[0]);
            },
            $value
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $uri = '';
        $uri .= $this->scheme ? $this->scheme . '://' : '';
        $uri .= $this->getAuthority() ?: '';
        $uri .= '/' . ltrim($this->getPath(), '/');
        $uri .= $this->getQuery() ? '?' . $this->getQuery() : '';
        $uri .= $this->getFragment() ? '#' . $this->getFragment() : '';

        return $uri;
    }

    /**
     * @param string $property
     * @param mixed  $value
     * @return static
     */
    private function cloneWithProperty(string $property, $value)
    {
        $clone = clone $this;
        $clone->$property = $value;

        return $clone;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize(): string
    {
        return $this->getRelativeUrl();
    }

}