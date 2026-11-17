<?php

declare(strict_types=1);

function fresh_lots(): array {
    $sql = "SELECT lots.id, title, image_url, start_price, expiry_date, name AS category_name
        FROM lots
        JOIN categories ON lots.category_id = categories.id
        WHERE expiry_date > ?";

    $stmt = db_get_prepare_stmt(db_get_link(), $sql, [date('Y-m-d H:i:s')]);
    $lots_list = db_get_query_result($stmt);

    mysqli_stmt_close($stmt);

    return $lots_list;
}

function lot_by_id(int $id): array | false {
    $sql = "SELECT title, image_url, start_price, description, expiry_date, name AS category_name
    FROM lots
    JOIN categories ON lots.category_id = categories.id
    WHERE lots.id = ?";

    $stmt = db_get_prepare_stmt(db_get_link(), $sql, [$id]);
    $lot = db_get_query_result($stmt) ? db_get_query_result($stmt)[0] : false;

    mysqli_stmt_close($stmt);

    return $lot;
}
