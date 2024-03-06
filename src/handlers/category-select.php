<?php

session_start();
require_once __DIR__ . '/../conf.php';

cfrs_check();
$from = get_from();

if (!preg_match('/^[а-яёa-z0-9 ]{1,30}$/iu', post('category'))) {
    set_message('Введите корректный поисковый запрос!', $from);
}
$category = escape(post('category'));

$sql = 'SELECT `id` FROM `categories`
WHERE `category_ru` = ' . escape_db($category) . '
OR `subcategory_ru` = ' . escape_db($category) . '
OR `precategory_ru` = ' . escape_db($category) . '
AND `delete` = 1';
$categories_id = db_get_list_sql($sql);
if (!$categories_id) {
    set_message('Категория не найдена!', $from);
}
$ids = [];
foreach($categories_id as $item){
    $ids[] = $item['id'];
}
$ids = json_encode($ids);

session('category', $ids);
redirect($from);
