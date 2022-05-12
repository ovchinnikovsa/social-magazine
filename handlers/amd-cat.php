<?php

session_start();
require_once __DIR__ . '/../conf.php';

cfrs_check();
$from = get_from();

if (!is_admin()) {
    redirect('/');
}

if (post('add')) {
    if (!(post('precategory') || post('precategory_new'))) {
        set_message('Категория отсутствует!', $from);
    }
    if (!(post('category') || post('category_new'))) {
        set_message('Категория отсутствует!', $from);
    }
    if (!(post('subcategory') || post('subcategory_new'))) {
        set_message('Категория отсутствует!', $from);
    }
    $precategory = post('precategory_new') ?: post('precategory');
    $category = post('category_new') ?: post('category');
    $subcategory = post('subcategory_new') ?: post('subcategory');

    if (get_category($precategory, $category, $subcategory)) {
        set_message('Такая категория уже есть!', $from);
    }

    $res = db_insert_category($precategory, $category, $subcategory);
    if (!$res) {
        set_message('Ошибка добавления категории!', $from);
    }

    set_message('Категория успешно добавлена!', $from, false);

}if (post('delete')) {
    $category_array = escape(post('delete'));
    $category_array = explode(',', $category_array);
    $category_row = get_category($category_array[0], $category_array[1], $category_array[2]);
    if (!$category_row) {
        set_message('Категория не существует!', $from);
    }

    $res = category_delete_by_id($category_row['id']);
    if (!$res) {
        set_message('Ошибка удаления категории', $from);
    }

    set_message('Категория успешно удалена!', $from, false);

} else {
    set_message('Ошибка добавления категории!', $from);
}
