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
     * @param array $values
     *
     * @return array
     */
    private function getParameters(string $slug, array $values): array
    {
        $parameters = [];

        array_shift($values[0]);

        preg_match_all('/(?<=\<)'.self::REGEX.'(?=\>)/', $slug, $matches, PREG_PATTERN_ORDER );

        foreach ($values[0] as $key => $value) {
            $parameters[$matches[0][$key]] = $value;
        }

        return $parameters;
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

        preg_match_all('/^'.$pattern.'$/', $slug, $matches, PREG_SET_ORDER);

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
    public function add(string $slug, string $method, \Closure $function): void
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
                $parameters = $this->getParameters($route['slug'], $matches);
                break;
            }
        }

        if (isset($route['slug']) && $method === $route['method'] && is_callable($route['function'])) {
            $route['function']($parameters);
        }
    }
}
