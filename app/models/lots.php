<?php

declare(strict_types=1);

function get_fresh_lots(): array
{
    $sql = "SELECT lots.id, title, image_url, start_price, expiry_date, name AS category_name
        FROM lots
        JOIN categories ON lots.category_id = categories.id
        WHERE expiry_date > ?";

    $stmt = db_get_prepare_stmt(db_get_link(), $sql, [date('Y-m-d H:i:s')]);
    $lots_list = db_get_query_result($stmt);

    mysqli_stmt_close($stmt);

    return $lots_list;
}

function get_lot_by_id(int $id): array | false
{
    $sql = "SELECT title, image_url, start_price, description, expiry_date, name AS category_name
    FROM lots
    JOIN categories ON lots.category_id = categories.id
    WHERE lots.id = ?";

    $stmt = db_get_prepare_stmt(db_get_link(), $sql, [$id]);
    $result = db_get_query_result($stmt);
    $lot = $result[0] ?? false;

    mysqli_stmt_close($stmt);

    return $lot;
}

function add_lot(array $lot_data): int
{
    $link = db_get_link();

    $sql = "INSERT INTO lots (title, description, image_url, start_price, bid_step, expiry_date, category_id, seller_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = db_get_prepare_stmt($link, $sql, [
        $lot_data["title"],
        $lot_data["description"],
        $lot_data["image_url"],
        $lot_data["start_price"],
        $lot_data["bid_step"],
        $lot_data["expiry_date"],
        $lot_data["category_id"],
        $lot_data["seller_id"],
    ]);

    mysqli_stmt_execute($stmt);
    $new_lot_id = (int)mysqli_insert_id($link);

    mysqli_stmt_close($stmt);

    return $new_lot_id;
}
