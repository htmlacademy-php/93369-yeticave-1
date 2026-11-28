<?php

declare(strict_types=1);

$errors = [];
$user = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST;

    $email = trim($user["email"] ?? "");
    if ($email === "" || mb_strlen($email) > 128 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Введите корректный e-mail";
    } elseif (is_user_email_exists($email)) {
        $errors["email"] = "Пользователь с таким e-mail уже зарегистрирован";
    }

    $password = trim($user["password"] ?? "");
    if ($password === "" || mb_strlen($password) > 255) {
        $errors["password"] = FORM_ITEM_INVALID_CLASS;
    }

    $name = trim($user["name"] ?? "");
    if ($name === "" || mb_strlen($name) > 128) {
        $errors["name"] = FORM_ITEM_INVALID_CLASS;
    }

    $contacts = trim($user["contacts"] ?? "");
    if ($contacts === "") {
        $errors["contacts"] = FORM_ITEM_INVALID_CLASS;
    }

    if (empty($errors)) {
        $user_data = [
            "email" => $email,
            "name" => $name,
            "password_hash" => password_hash($password, PASSWORD_DEFAULT),
            "contacts" => $contacts,
        ];

        $new_user_id = add_user($user_data);

        if ($new_user_id > 0) {
            header("Location: /login");
            exit();
        }
    }
}

$categories = get_categories();

$nav_list = include_template("templates/nav_list.php", compact("categories"));
$title = "Регистрация нового аккаунта";

$content = include_template("pages/sign-up.php", compact("categories", "nav_list", "user", "errors"));

$layout = include_template("layouts/layout.php", compact("title", "content", "categories", "nav_list"));
print($layout);
