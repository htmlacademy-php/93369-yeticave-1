<?php

declare(strict_types=1);

function is_user_email_exists(string $email): bool
{
    $sql = 'SELECT id FROM users WHERE email = ?';
    $stmt = db_get_prepare_stmt(db_get_link(), $sql, [$email]);
    $rows = db_get_query_result($stmt);

    mysqli_stmt_close($stmt);

    return count($rows) > 0;
}

function add_user(array $user_data): int
{
    $link = db_get_link();

    $sql = "INSERT INTO users (email, name, password_hash, contacts)
            VALUES (?, ?, ?, ?)";

    $stmt = db_get_prepare_stmt($link, $sql, [
        $user_data["email"],
        $user_data["name"],
        $user_data["password_hash"],
        $user_data["contacts"],
    ]);

    mysqli_stmt_execute($stmt);
    $new_user_id = (int)mysqli_insert_id($link);

    mysqli_stmt_close($stmt);

    return $new_user_id;
}
