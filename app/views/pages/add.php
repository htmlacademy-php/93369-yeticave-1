<?php

/** @var string $nav_list */
/** @var array $categories */
/** @var array $lot */
/** @var array $errors */

echo $nav_list

?>

<form class="form form--add-lot container <?= empty($errors) ? "" : "form--invalid" ?>" action="/add" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
    <div class="form__item <?= $errors["title"] ?? "" ?>"> <!-- form__item--invalid -->
        <label for="title">Наименование <sup>*</sup></label>
        <input id="title" type="text" name="title" placeholder="Введите наименование лота" value="<?= esc($lot["title"] ?? "") ?>">
        <span class="form__error">Введите наименование лота</span>
    </div>
    <div class="form__item  <?= $errors["category"] ?? "" ?>">
        <label for="category">Категория <sup>*</sup></label>
        <select id="category" name="category">
        <option value="">Выберите категорию</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category["id"] ?>" <?= (int)($lot["category"] ?? 0) === (int)$category["id"] ? "selected" : "" ?>>
                <?= esc($category["name"]) ?>
            </option>
        <?php endforeach; ?>
        </select>
        <span class="form__error">Выберите категорию</span>
    </div>
    </div>
    <div class="form__item form__item--wide <?= $errors["description"] ?? "" ?>">
        <label for="description">Описание <sup>*</sup></label>
        <textarea id="description" name="description" placeholder="Напишите описание лота"><?= esc($lot["description"] ?? "") ?></textarea>
        <span class="form__error">Напишите описание лота</span>
    </div>
    <div class="form__item form__item--file <?= $errors["lot_img"] ?? "" ?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="lot_img" name="lot_img" value="">
            <label for="lot_img">
            Добавить
            </label>
        </div>
        <span class="form__error">Добавьте файл с изображением (jpeg, jpg, png)</span>
    </div>
    <div class="form__container-three">
    <div class="form__item form__item--small <?= $errors["start_price"] ?? "" ?>">
        <label for="start_price">Начальная цена <sup>*</sup></label>
        <input id="start_price" type="text" name="start_price" placeholder="0" value="<?= esc($lot["start_price"] ?? "") ?>">
        <span class="form__error">Введите начальную цену</span>
    </div>
    <div class="form__item form__item--small <?= $errors["bid_step"] ?? "" ?>">
        <label for="bid_step">Шаг ставки <sup>*</sup></label>
        <input id="bid_step" type="text" name="bid_step" placeholder="0" value="<?= esc($lot["bid_step"] ?? "") ?>">
        <span class="form__error">Введите шаг ставки</span>
    </div>
    <div class="form__item <?= $errors["expiry_date"] ?? "" ?>">
        <label for="expiry_date">Дата окончания торгов <sup>*</sup></label>
        <input class="form__input-date" id="expiry_date" type="text" name="expiry_date" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?= esc($lot["expiry_date"] ?? "") ?>">
        <span class="form__error">Введите дату завершения торгов</span>
    </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
