<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

define("APP_PATH", __DIR__);

if (file_exists(APP_PATH . "/config/db.php")) {
    $db_conf = require APP_PATH . "/config/db.php";
    define("DB_CONFIG", $db_conf);
} else {
    die("Critical error: Configuration db file not found");
}

if (file_exists(APP_PATH . "/config/constants.php")) {
    require_once APP_PATH . "/config/constants.php";
} else {
    die("Critical error: Global const file not found");
}

if (file_exists(APP_PATH . "/config/routes.php")) {
    define("ROUTES", require APP_PATH . "/config/routes.php");
} else {
    die("Critical error: Routes configuration file not found");
}

$helpersDir = APP_PATH . "/helpers/";
if (is_dir($helpersDir)) {
    foreach (glob($helpersDir . "*.php") as $helperFile) {
        require_once $helperFile;
    }
}

$modelsDir = APP_PATH . '/models/';
if (is_dir($modelsDir)) {
    foreach (glob($modelsDir . '*.php') as $modelFile) {
        require_once $modelFile;
    }
}



