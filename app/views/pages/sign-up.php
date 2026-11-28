<?php

/** @var string $nav_list */
/** @var array $categories */
/** @var array $user */
/** @var array $errors */

echo $nav_list

?>

<form class="form container <?= empty($errors) ? "" : "form--invalid" ?>" action="/sign-up" method="post" autocomplete="off"> <!-- form
--invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?= isset($errors["email"]) ? FORM_ITEM_INVALID_CLASS : "" ?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= esc($user["email"] ?? "") ?>">
        <span class="form__error"><?= $errors["email"] ?? "Введите e-mail" ?></span>
    </div>
    <div class="form__item <?= $errors["password"] ?? "" ?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль">
        <span class="form__error">Введите пароль</span>
    </div>
    <div class="form__item  <?= $errors["name"] ?? "" ?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= esc($user["name"] ?? "") ?>">
        <span class="form__error">Введите имя</span>
    </div>
    <div class="form__item  <?= $errors["contacts"] ?? "" ?>">
        <label for="contacts">Контактные данные <sup>*</sup></label>
        <textarea id="contacts" name="contacts" placeholder="Напишите как с вами связаться"><?= esc($user["contacts"] ?? "") ?></textarea>
        <span class="form__error">Напишите как с вами связаться</span>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="/login">Уже есть аккаунт</a>
</form>