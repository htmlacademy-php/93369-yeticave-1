<?php

/** @var array $categories  List of categories */
/** @var array $lots_list List of goods */

?>
<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <!--заполните этот список из массива категорий-->
        <?php foreach ($categories as $category): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html"><?= esc($category) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <!--заполните этот список из массива с товарами-->
        <?php foreach ($lots_list as $good): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= esc($good["imgUrl"]) ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= esc($categories[$good["category"]]) ?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?= esc($good["name"]) ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost">
                                <?= format_price($good["price"]) ?>
                            </span>
                        </div>
                        <?php $remaining_time = get_time_remiaining($good["expiry_date"]); ?>
                        <div class="lot__timer timer <?= $remaining_time[HOURS] < 1 ? "timer--finishing" : "" ?>">
                            <?= get_view_time($remaining_time) ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>