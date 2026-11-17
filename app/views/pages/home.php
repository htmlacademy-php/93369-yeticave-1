<?php

/** @var array $categories  List of categories */
/** @var array $lots_list List of lots */

?>
<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <!--заполните этот список из массива категорий-->
        <?php foreach ($categories as $category): ?>
            <li class="promo__item promo__item--<?= esc($category["code"]) ?>">
                <a class="promo__link" href="pages/all-lots.html"><?= esc($category["name"]) ?></a>
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
        <?php foreach ($lots_list as $lot): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= esc($lot["image_url"]) ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= esc($lot["category_name"]) ?></span>
                    <h3 class="lot__title"><a class="text-link" href="/lot?id=<?= $lot["id"] ?>"><?= esc($lot["title"]) ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost">
                                <?= format_price($lot["start_price"]) ?>
                            </span>
                        </div>
                        <?= include_template("templates/remaining_time.php", $lot) ?>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
