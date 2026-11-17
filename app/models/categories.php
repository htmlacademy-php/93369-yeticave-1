<?php

declare(strict_types=1);

function categories(): array {
    $sql = "SELECT * FROM categories";

    $stmt = db_get_prepare_stmt(db_get_link(), $sql);
    $categories = db_get_query_result($stmt);
    mysqli_stmt_close($stmt);

    return $categories;
}
