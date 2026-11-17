<?php

declare(strict_types=1);

/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
 */
function include_template(string $name, array $data = []): string {
    $name = APP_PATH . '/views/' . ltrim($name, '/');
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

function render_404() {
    http_response_code(404);
    $categories = categories();
    $nav_list = include_template("templates/nav_list.php", compact("categories"));
    $content = include_template("errors/404.php", compact("nav_list"));
    $layout = include_template("layouts/layout.php", compact("content", "categories", "nav_list"));

    print($layout);
    exit;
}
