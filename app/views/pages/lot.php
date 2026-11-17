<?php

/** @var string $nav_list */
/** @var string $category_name */
/** @var string $description */
/** @var string $image_url */
/** @var int $current_bid */
/** @var int $start_price */
/** @var string $remaining_time */

echo $nav_list

?>

<section class="lot-item container">
    <h2><?= $title ?></h2>
    <div class="lot-item__content">
    <div class="lot-item__left">
        <div class="lot-item__image">
        <img src="<?= esc($image_url) ?>" width="730" height="548" alt="Сноуборд">
        </div>
        <p class="lot-item__category">Категория: <span><?= esc($category_name) ?></span></p>
        <p class="lot-item__description"><?= esc($description) ?></p>
    </div>
    <div class="lot-item__right">
        <div class="lot-item__state">
        <?= $remaining_time ?>
        <div class="lot-item__cost-state">
            <div class="lot-item__rate">
            <span class="lot-item__amount">Текущая цена</span>
            <span class="lot-item__cost"><?= format_price($current_bid, false) ?></span>
            </div>
            <div class="lot-item__min-cost">
            Мин. ставка <span><?= format_price($start_price) ?></span>
            </div>
        </div>
    </div>
    </div>
</section>
