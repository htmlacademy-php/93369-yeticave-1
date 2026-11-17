<?php

declare(strict_types=1);

require_once __DIR__ . '/app/init.php';

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) ?? "/";

if (str_starts_with($uri, "index.php")) {
    $uri = substr($uri, 10) ?: "/";
}

if ($uri !== "/") {
    $uri = rtrim($uri, "/");
}

if (array_key_exists($uri, ROUTES)) {
    $controller_path = APP_PATH . "/controllers/" . ROUTES[$uri];
    if (file_exists($controller_path)) {
        require_once $controller_path;
        exit;
    }
}

render_404();
