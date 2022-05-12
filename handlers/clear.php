<?php

session_start();
require_once __DIR__ . '/../conf.php';

cfrs_check();
$from = get_from();

if (!post('clear')) {
    set_message('Введите корректный поисковый запрос!', $from);
}

session_clear_value('search');
session_clear_value('category');
redirect($from);
