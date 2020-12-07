<?php declare(strict_types=1);

namespace Bloganza;

class Router
{
    private const REGEX = '[a-zA-Z0-9_-]+';
    private array $routes = [];

    /**
     * Add route
     *
     * @param string $slug
     * @param string $method
     * @param callable $function
     *
     * @return void
     */
    public function add(string $slug, string $method, callable $function): void
    {
        $this->routes[] = [
            'slug' => $slug,
            'method' => mb_strtoupper($method),
            'function' => $function,
        ];
    }

    /**
     * Get parameters from slug
     *
     * @param string $slug
     * @param string $routeSlug
     *
     * @return array
     */
    public function getParameters(string $slug, string $routeSlug): array
    {
        preg_match_all('/(?<=\<)'.self::REGEX.'(?=\>)/', $routeSlug, $matches);

        return [...$matches[0]];
    }

    /**
     * Match slug with a route if possible
     *
     * @param string $slug
     *
     * @return array
     */
    public function matchRoute(string $slug): array
    {
        $match = [];

        foreach ($this->routes as $route) {
            $pattern = preg_replace('/<'.self::REGEX.'>/', self::REGEX, $route['slug']);
            $pattern = '/^'.str_replace('/', '\/', $pattern).'$/';

            preg_match_all($pattern, $slug, $matches);

            if (!empty($matches[0])) {
                $match = $route;
                break;
            }
        }

        return $match;
    }

    /**
     * Check routes against current slug
     *
     * @return void
     */
    public function checkRoutes(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $slug = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $match = $this->matchRoute($slug);

        if (isset($match['slug']) && $method === $match['method'] && is_callable($match['function'])) {
            $parameters = $this->getParameters($slug, $match['slug']);
            $match['function']($parameters);
        }
    }
}
