<?php

class TestBootManager implements \Solital\Course\IRouterBootManager
{

    protected $routes;
    protected $aliasUrl;

    public function __construct(array $routes, string $aliasUrl)
    {
        $this->routes = $routes;
        $this->aliasUrl = $aliasUrl;
    }

    /**
     * Called when router loads it's routes
     *
     * @param \Solital\Course\Router $router
     * @param \Solital\Http\Request $request
     */
    public function boot(\Solital\Course\Router $router, \Solital\Http\Request $request): void
    {
        foreach ($this->routes as $url) {
            // If the current url matches the rewrite url, we use our custom route

            if ($request->getUrl()->contains($url) === true) {
                $request->setRewriteUrl($this->aliasUrl);
            }

        }
    }
}