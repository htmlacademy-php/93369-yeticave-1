<?php

declare(strict_types=1);

$errors = [];
$lot = [];

$categories = get_categories();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lot = $_POST;

    $lot_title = trim($lot["title"] ?? "");
    if ($lot_title === "" || mb_strlen($lot_title) > 255) {
        $errors["title"] = FORM_ITEM_INVALID_CLASS;
    }

    $category_id = (int)($lot["category"] ?? 0);
    if (!in_array($category_id, array_column($categories, "id"))) {
        $errors["category"] = FORM_ITEM_INVALID_CLASS;
    }

    if (!trim($lot["description"] ?? "")) {
        $errors["description"] = FORM_ITEM_INVALID_CLASS;
    }

    $tmp_file_name = "";
    $file_type = "";
    if (!isset($_FILES["lot_img"]) || $_FILES["lot_img"]["error"] !== UPLOAD_ERR_OK) {
        $errors["lot_img"] = FORM_ITEM_INVALID_CLASS;
    } else {
        $tmp_file_name = $_FILES["lot_img"]["tmp_name"];
        $file_type = mime_content_type($tmp_file_name);
        if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
            $errors["lot_img"] = FORM_ITEM_INVALID_CLASS;
        }
    }

    $start_price = filter_var($lot["start_price"] ?? "", FILTER_VALIDATE_INT);
    if ($start_price === false || $start_price <= 0) {
        $errors["start_price"] = FORM_ITEM_INVALID_CLASS;
        $lot["start_price"] = "";
    }

    $bid_step = filter_var($lot["bid_step"] ?? "", FILTER_VALIDATE_INT);
    if ($bid_step === false || $bid_step <= 0) {
        $errors["bid_step"] = FORM_ITEM_INVALID_CLASS;
        $lot["bid_step"] = "";
    }

    $expiry_date = trim($lot["expiry_date"] ?? "");
    if ($expiry_date === "" || !is_date_valid($expiry_date) || strtotime($expiry_date) < strtotime("tomorrow")) {
        $errors["expiry_date"] = FORM_ITEM_INVALID_CLASS;
        $lot["expiry_date"] = "";
    }

    if (empty($errors)) {
        $ext = ($file_type === "image/png" ? ".png" : ".jpeg");
        $file_name = uniqid("lot_" . $lot["category"] . "_", true) . $ext;

        $file_path = "uploads/" . $file_name;

        $upload_dir = __DIR__ . "/../../uploads/";
        move_uploaded_file($tmp_file_name, $upload_dir . $file_name);

        $new_lot_id = add_lot([
            "title" => $lot_title,
            "description" => trim($lot["description"]),
            "image_url" => $file_path,
            "start_price" => $start_price,
            "bid_step" => $bid_step,
            "expiry_date" => $expiry_date,
            "category_id" => $category_id,
            "seller_id" => 1,
        ]);

        header("Location: /lot?id=" . $new_lot_id);
        exit();
    }
}

$nav_list = include_template("templates/nav_list.php", compact("categories"));
$title = "Добавление лота";

$content = include_template("pages/add.php", compact("categories", "nav_list", "lot", "errors"));
$styles = ["/css/flatpickr.min.css"];
$scripts = ["/flatpickr.js", "/script.js"];

$layout = include_template("layouts/layout.php", compact("title", "content", "categories", "nav_list", "styles", "scripts"));
print($layout);
