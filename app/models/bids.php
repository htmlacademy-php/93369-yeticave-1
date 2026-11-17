<?php

declare(strict_types=1);

function bids_by_lot_id(int $id): array {
    $sql = "SELECT name, amount, bids.created_at
    FROM bids
    JOIN users ON  bids.user_id = users.id
    WHERE lot_id = ?";

    $stmt = db_get_prepare_stmt(db_get_link(), $sql, [$id]);
    $bids = db_get_query_result($stmt);

    mysqli_stmt_close($stmt);

    return $bids;
}

function max_bid_by_lot_id(int $id): int {
    $sql = "SELECT amount
    FROM bids
    JOIN users ON  bids.user_id = users.id
    WHERE lot_id = ?
    ORDER BY bids.amount DESC, bids.created_at ASC
    LIMIT 1";

    $stmt = db_get_prepare_stmt(db_get_link(), $sql, [$id]);
    $bids = db_get_query_result($stmt) ? db_get_query_result($stmt)[0]["amount"] : 0;

    mysqli_stmt_close($stmt);

    return $bids;
}
