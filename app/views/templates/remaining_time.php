<?php

/** @var int $expiry_date */
$remaining_time = get_time_remiaining($expiry_date);

?>

<div class="lot-item__timer timer <?= $remaining_time[HOURS] < 1 ? "timer--finishing" : "" ?>">
    <?= get_view_time($remaining_time) ?>
</div>
