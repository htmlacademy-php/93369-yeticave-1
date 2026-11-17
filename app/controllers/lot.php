<?php

declare(strict_types=1);

$lot_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if(!$lot_id || $lot_id <= 0 || !$lot = lot_by_id($lot_id)) {
    render_404();
}

$lot["current_bid"] = max_bid_by_lot_id($lot_id);
$categories = categories();
$lot["nav_list"] = $nav_list = include_template("templates/nav_list.php", compact("categories"));
$lot["remaining_time"] = include_template("templates/remaining_time.php", $lot);

$content = include_template("pages/lot.php", $lot);
$title = $lot["title"];

$layout = include_template("layouts/layout.php", compact("title", "content", "categories", "nav_list"));
print($layout);
