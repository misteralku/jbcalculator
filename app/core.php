<?php

function base_url(): string
{
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    return rtrim($dir, '/');
}

function asset(string $path): string
{
    return base_url() . '/' . ltrim($path, '/');
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function view(string $name, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require BASE_PATH . '/resources/views/' . $name . '.php';
}

class Router
{
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->routes['GET']['/' . trim($path, '/')] = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        $base = base_url();
        if ($base !== '' && str_starts_with($path, $base)) {
            $path = substr($path, strlen($base));
        }
        $path = '/' . trim($path, '/');

        $handler = $this->routes[$method][$path] ?? null;

        if ($handler === null) {
            http_response_code(404);
            echo '404 — Halaman tidak ditemukan';
            return;
        }

        $handler();
    }
}