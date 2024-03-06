<?php

session_start();
require_once __DIR__ . '/../conf.php';

cfrs_check();
$from = get_from();

if (post('sort')) {
    $sort = escape(post('sort'));
    if (!($sort === 'ASC' || $sort === 'DESC')) {
        set_message('Ошибка выбора сортировки!', $from);
    }
    session('sort', $sort);
} elseif (post('clear')) {
    session_clear_value('search');
    session_clear_value('category');
    session_clear_value('sort');
} else {
    set_message('Не удается отчистить фильтр!', $from);
}
redirect($from);
