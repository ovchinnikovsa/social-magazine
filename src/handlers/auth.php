<?php

session_start();
require_once __DIR__ . '/../conf.php';

cfrs_check();
$from = get_from();

if (!post('login') && !post('password')) {
    set_message('Заполните все данные!', $from);
}

if (!preg_match('/^[a-zA-Z_0-9]{5,30}$/', post('login'))){
    set_message('Введите корректный логин', $from);
}

if (!preg_match('/^[a-zA-Z0-9]{8,30}$/', post('password'))){
    set_message('Введите корректный пароль', $from);
}

$login = post('login');
$password = post('password');

if ($login !== db_get_value_by_fields('conf', 'value', ['name' => 'adm_login'])) {
    set_message('Неверный логин', $from);
}

if ($password !== db_get_value_by_fields('conf', 'value', ['name' => 'adm_password'])) {
    set_message('Неверный пароль', $from);
}

authorization_admin();
set_message('Успешная авторизация', $from, false);
