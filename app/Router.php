<?php declare(strict_types=1);

namespace Bloganza;

class Router
{
    private const REGEX = '([a-zA-Z0-9_-]+)';
    private array $routes = [];

    /**
     * Get parameters from slug
     *
     * @param string $slug
     * @param string $routeSlug
     *
     * @return array
     */
    private function getParameters(string $slug, string $routeSlug): array
    {
        preg_match_all('/(?<=\<)'.self::REGEX.'(?=\>)/', $routeSlug, $matches);

        return [...$matches[0]];
    }

    /**
     * Match slug against a route
     *
     * @param string $slug
     * @param string $route
     *
     * @return array
     */
    private function match(string $slug, string $route): array
    {
        $search = ['/<'.self::REGEX.'>/', '/\//'];
        $replace = [self::REGEX, '\/'];

        $pattern = preg_replace($search, $replace, $route);

        preg_match_all('/^'.$pattern.'$/', $slug, $matches);

        return $matches;
    }

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
            'slug' => rtrim($slug, '/'),
            'method' => mb_strtoupper($method),
            'function' => $function,
        ];
    }

    /**
     * Check added routes against current slug
     *
     * @return void
     */
    public function resolve(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $slug = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        foreach ($this->routes as $route) {
            $matches = $this->match($slug, $route['slug']);

            if (!empty($matches[0])) {
                $match = $route;
                break;
            }
        }

        if (isset($match['slug']) && $method === $match['method'] && is_callable($match['function'])) {
            $match['function']();
        }
    }
}
