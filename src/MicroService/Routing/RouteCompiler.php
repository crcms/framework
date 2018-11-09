<?php

namespace CrCms\Foundation\MicroService\Routing;

use Symfony\Component\Routing\Route as SymfonyRoute;

class RouteCompiler
{
    /**
     * The route instance.
     *
     * @var \CrCms\Foundation\MicroService\Routing\Route
     */
    protected $route;

    /**
     * Compile the route.
     *
     * @return \Symfony\Component\Routing\CompiledRoute
     */
    public function compile()
    {
        $optionals = $this->getOptionalParameters();

        $uri = preg_replace('/\{(\w+?)\?\}/', '{$1}', $this->route->uri());

        return (
            new SymfonyRoute($uri, $optionals, $this->route->wheres, ['utf8' => true], $this->route->getDomain() ?: '')
        )->compile();
    }

    /**
     * Create a new Route compiler instance.
     *
     * @param  \CrCms\Foundation\MicroService\Routing\Route  $route
     * @return void
     */
    public function __construct($route)
    {
        $this->route = $route;
    }

    /**
     * Get the optional parameters for the route.
     *
     * @return array
     */
    protected function getOptionalParameters()
    {
        preg_match_all('/\{(\w+?)\?\}/', $this->route->uri(), $matches);

        return isset($matches[1]) ? array_fill_keys($matches[1], null) : [];
    }
}
