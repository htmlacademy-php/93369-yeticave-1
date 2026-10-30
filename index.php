<?php

declare(strict_types=1);

require_once 'helpers.php';
require_once 'functions/index.php';
require_once 'const.php';

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$lots_list = [
    ["name" => "2014 Rossignol District Snowboard", "category" => 0, "price" => 10999, "imgUrl" => "img/lot-1.jpg", "expiry_date" => "2026-10-26 06:38"],
    ["name" => "DC Ply Mens 2016/2017 Snowboard", "category" => 0, "price" => 159999, "imgUrl" => "img/lot-2.jpg", "expiry_date" => "2026-10-29"],
    ["name" => "Крепления Union Contact Pro 2015 года размер L/XL", "category" => 1, "price" => 8000, "imgUrl" => "img/lot-3.jpg", "expiry_date" => "2026-10-30"],
    ["name" => "Ботинки для сноуборда DC Mutiny Charcoal", "category" => 2, "price" => 10999, "imgUrl" => "img/lot-4.jpg", "expiry_date" => "2026-10-31"],
    ["name" => "Куртка для сноуборда DC Mutiny Charcoal", "category" => 3, "price" => 7500, "imgUrl" => "img/lot-5.jpg", "expiry_date" => "2026-11-01"],
    ["name" => "Маска Oakley Canopy", "category" => 5, "price" => 5400, "imgUrl" => "img/lot-6.jpg", "expiry_date" => "2026-11-02"],
];

$title = 'Главная';
$content = include_template('main.php', compact('categories', 'lots_list'));

$layout = include_template('layout.php', compact('title', 'content'));

print($layout);
