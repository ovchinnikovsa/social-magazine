<?php

session_start();
require_once __DIR__ . '/../conf.php';

cfrs_check();
$from = get_from();

if (!preg_match('/^[а-яёa-z0-9 ]{1,30}$/iu', post('search'))) {
    set_message('Введите корректный поисковый запрос!', $from);
}
$search = escape(post('search'));

session('search', $search);
redirect($from);
