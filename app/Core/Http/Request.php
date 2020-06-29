<?php

declare(strict_types=1);

namespace Solital\Core\Http;

use Solital\Core\Course\Course;
use Solital\Core\Course\Route\RouteUrl;
use Solital\Core\Course\Route\LoadableRouteInterface;
use Solital\Core\Http\Uri;
use Solital\Core\Http\RequestBody;
use Solital\Core\Http\Input\InputHandler;
use Solital\Core\Http\Traits\RequestTrait;
use Solital\Core\Http\Exceptions\MalformedUrlException;
use Psr\Http\Message\RequestInterface;

class Request implements RequestInterface
{
    use RequestTrait;
    
    /**
     * Additional data
     *
     * @var array
     */
    private $data = [];

    /**
     * Server headers
     * @var array
     */
    private $headers = [];

    /**
     * Request host
     * @var string
     */
    protected $host;

    /**
     * Current request url
     * @var Uri
     */
    protected $url;

    /**
     * Current request url
     * @var Uri
     */
    protected $scheme;

    /**
     * Request method
     * @var string
     */
    #protected $method = '';

    /**
     * Input handler
     * @var InputHandler
     */
    protected $inputHandler;

    /**
     * Defines if request has pending rewrite
     * @var bool
     */
    protected $hasPendingRewrite = false;

    /**
     * @var LoadableRouteInterface|null
     */
    protected $rewriteRoute;

    /**
     * Rewrite url
     * @var string|null
     */
    protected $rewriteUrl;

    /**
     * @var array
     */
    protected $loadedRoutes = [];

    /**
     * @var string
     */
    private $server;

    /**
     * List of request body parsers (e.g., url-encoded, JSON, XML, multipart)
     *
     * @var callable[]
     */
    protected $bodyParsers = [];

    /**
     * Request constructor.
     * @throws MalformedUrlException
     */
    public function __construct(string $method = null, $uri = null, $body = 'php://memory', array $headers = [])
    {
        $this->initialize($method, $uri, $body, $headers);

        foreach ($_SERVER as $key => $value) {
            $this->headers[strtolower($key)] = $value;
            $this->headers[strtolower(str_replace('_', '-', $key))] = $value;
        }

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $this->scheme = 'https://';
        } else {
            $this->scheme = 'http://';
        }

        $this->setHost($this->scheme.$this->getHeader('http-host'));

        // Check if special IIS header exist, otherwise use default.
        $this->setUrl(new Uri($this->getHeader('unencoded-url', $this->getHeader('request-uri'))));
        
        $this->method = strtolower($this->getHeader('request-method'));
        $this->inputHandler = new InputHandler($this);
        $this->method = strtolower($this->inputHandler->value('_method', $this->getHeader('request-method')));
        $this->server = $_SERVER;
    }

    public function isSecure(): bool
    {
        return $this->getHeader('http-x-forwarded-proto') === 'https' || $this->getHeader('https') !== null || $this->getHeader('server-port') === 443;
    }

    /**
     * @return Uri
     */
    public function getUri(): Uri
    {
        return $this->url;
    }

    /**
     * @param Uri $url
     */
    public function setUrl(Uri $url): void
    {
        $this->url = $url;

        if ($this->url->getHost() === null) {
            if ($this->url->getScheme() !== null) {
                $this->url->setHost($this->getUrlScheme().(string)$this->getHost());    
            }
            
            $this->url->setHost((string)$this->getHost());
        }
    }

    /**
     * Copy url object
     *
     * @return Uri
     */
    /*public function getUrlScheme(): ?string
    {
        return $this->scheme;
    }*/
    
    /**
     * Copy url object
     *
     * @return Uri
     */
    public function getUrlCopy(): Uri
    {
        return clone $this->url;
    }

    /**
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * Get http basic auth user
     * @return string|null
     */
    public function getUser(): ?string
    {
        return $this->getHeader('php-auth-user');
    }

    /**
     * Get http basic auth password
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->getHeader('php-auth-pw');
    }

    /**
     * Get all headers
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Get id address
     * @return string|null
     */
    public function getIp(): ?string
    {
        if ($this->getHeader('http-cf-connecting-ip') !== null) {
            return $this->getHeader('http-cf-connecting-ip');
        }

        if ($this->getHeader('http-x-forwarded-for') !== null) {
            return $this->getHeader('http-x-forwarded_for');
        }

        return $this->getHeader('remote-addr');
    }

    /**
     * Get remote address/ip
     *
     * @alias static::getIp
     * @return string|null
     */
    public function getRemoteAddr(): ?string
    {
        return $this->getIp();
    }

    /**
     * Get referer
     * @return string|null
     */
    public function getReferer(): ?string
    {
        return $this->getHeader('http-referer');
    }

    /**
     * Get user agent
     * @return string|null
     */
    public function getUserAgent(): ?string
    {
        return $this->getHeader('http-user-agent');
    }

    /**
     * Get header value by name
     *
     * @param string $name
     * @param string|null $defaultValue
     *
     * @return string|null
     */
    public function getHeader($name, $defaultValue = null): ?string
    {
        return $this->headers[strtolower($name)] ?? $defaultValue;
    }

    /**
     * Get input class
     * @return InputHandler
     */
    public function getInputHandler(): InputHandler
    {
        return $this->inputHandler;
    }

    /**
     * Is format accepted
     *
     * @param string $format
     *
     * @return bool
     */
    public function isFormatAccepted($format): bool
    {
        return ($this->getHeader('http-accept') !== null && stripos($this->getHeader('http-accept'), $format) !== false);
    }

    /**
     * Returns true if the request is made through Ajax
     *
     * @return bool
     */
    public function isAjax(): bool
    {
        return (strtolower($this->getHeader('http-x-requested-with')) === 'xmlhttprequest');
    }

    /**
     * Get accept formats
     * @return array
     */
    public function getAcceptFormats(): array
    {
        return explode(',', $this->getHeader('http-accept'));
    }

    /**
     * @param string|null $host
     */
    public function setHost(?string $host): void
    {
        $this->host = $host;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = strtolower($method);
    }

    /**
     * Set rewrite route
     *
     * @param LoadableRouteInterface $route
     * @return static
     */
    public function setRewriteRoute(LoadableRouteInterface $route): self
    {
        $this->hasPendingRewrite = true;
        $this->rewriteRoute = Course::addDefaultNamespace($route);

        return $this;
    }

    /**
     * Get rewrite route
     *
     * @return LoadableRouteInterface|null
     */
    public function getRewriteRoute(): ?LoadableRouteInterface
    {
        return $this->rewriteRoute;
    }

    /**
     * Get rewrite url
     *
     * @return string|null
     */
    public function getRewriteUrl(): ?string
    {
        return $this->rewriteUrl;
    }

    /**
     * Set rewrite url
     *
     * @param string $rewriteUrl
     * @return static
     */
    public function setRewriteUrl(string $rewriteUrl): self
    {
        $this->hasPendingRewrite = true;
        $this->rewriteUrl = rtrim($rewriteUrl, '/') . '/';

        return $this;
    }

    /**
     * Set rewrite callback
     * @param string|\Closure $callback
     * @return static
     */
    public function setRewriteCallback($callback): self
    {
        $this->hasPendingRewrite = true;

        return $this->setRewriteRoute(new RouteUrl($this->getUrl()->getPath(), $callback));
    }

    /**
     * Get loaded route
     * @return LoadableRouteInterface|null
     */
    public function getLoadedRoute(): ?LoadableRouteInterface
    {
        return (\count($this->loadedRoutes) > 0) ? end($this->loadedRoutes) : null;
    }

    /**
     * Get all loaded routes
     *
     * @return array
     */
    public function getLoadedRoutes(): array
    {
        return $this->loadedRoutes;
    }

    /**
     * Set loaded routes
     *
     * @param array $routes
     * @return static
     */
    public function setLoadedRoutes(array $routes): self
    {
        $this->loadedRoutes = $routes;

        return $this;
    }

    /**
     * Added loaded route
     *
     * @param LoadableRouteInterface $route
     * @return static
     */
    public function addLoadedRoute(LoadableRouteInterface $route): self
    {
        $this->loadedRoutes[] = $route;

        return $this;
    }

    /**
     * Returns true if the request contains a rewrite
     *
     * @return bool
     */
    public function hasPendingRewrite(): bool
    {
        return $this->hasPendingRewrite;
    }

    /**
     * Defines if the current request contains a rewrite.
     *
     * @param bool $boolean
     * @return Request
     */
    public function setHasPendingRewrite(bool $boolean): self
    {
        $this->hasPendingRewrite = $boolean;

        return $this;
    }

    public function getParamsInput(): ?array
    {
        $body = file_get_contents('php://input');
        $json = json_decode($body, true);
        return $json;
    }

    public function getParamInput(string $param)
    {
        $body = file_get_contents('php://input');
        $json = json_decode($body);
    
        return $json->$param;
    }

    public function __isset($name)
    {
        return array_key_exists($name, $this->data) === true;
    }

    public function __set($name, $value = null)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
}
