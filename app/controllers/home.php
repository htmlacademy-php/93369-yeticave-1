<?php

declare(strict_types=1);

$categories = categories();
$lots_list = fresh_lots();

$content = include_template("pages/home.php", compact("categories", "lots_list"));
$nav_list = include_template("templates/nav_list.php", compact("categories"));
$title = 'Главная';
$container = "container";

$layout = include_template("layouts/layout.php", compact("container", "title", "content", "categories", "nav_list"));

print($layout);
