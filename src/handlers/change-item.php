<?php

session_start();
require_once __DIR__ . '/../conf.php';

cfrs_check();
$from = get_from();

if (!is_admin()) {
    redirect('/');
}
if (!$_POST) {
    set_message('Заполните поля!', $from);
}

if (!post('id')) {
    set_message('Не передан индетификатор!', $from);
}
$id = escape(post('id'));

if (!post('title')) {
    set_message('Введите заголовок!', $from);
}
$title = escape(post('title'));

if (!post('price')) {
    set_message('Введите цену!', $from);
}
$price = (float) str_replace(',', '.', post('price'));
if (!$price) {
    set_message('Укажите цену!', $from);
}

if (isset($_FILES['img']) && $_FILES['img']['tmp_name']) {
    $image = $_FILES['img'];
    if ($image['error']) {
        set_message('Ошибка загрузки изображения!', $from);
    }
    $type = explode('/', $image['type']);
    if ($type[0] !== 'image') {
        set_message('Неверный формат изображения!', $from);
    }
    $name = md5_file($image['tmp_name']);
    $format = $type[1];
    $format = str_replace('jpeg', 'jpg', $format);
    $image_path = __DIR__ . '/../downloads/' . $name . '.' . $format;
    $image_path_db = '/downloads/' . $name . '.' . $format;
    if (!move_uploaded_file($image['tmp_name'], $image_path)) {
        set_message('Неудалось сохранить изображение!', $from);
    }
}

$characteristic_name = post('characteristic_name');
$characteristic_value = post('characteristic_value');
$i = 0;
$characteristics = [];
foreach ($characteristic_name as $item) {
    if (!$item || !$characteristic_value[$i]) {
        continue;
    }
    $characteristics[$item] = $characteristic_value[$i++];
}
$characteristics = json_encode($characteristics);

$seo_name = post('seo_name');
$seo_value = post('seo_value');
$i = 0;
$seo = [];
foreach ($seo_name as $item) {
    if (!$item || !$seo_value[$i]) {
        continue;
    }
    $seo[$item] = $seo_value[$i++];
}
$seo = json_encode($seo);

$text = post('text');
$description = post('description');

if (!post('category')) {
    set_message('Выберите категорию!', $from);
}
$category_id = (int) post('category');

$status = (bool) post('status') ?? false;
$delete = (bool) post('delete') ?? false;
$status = $status ? 1 : 0;
$delete = $delete ? 1 : 0;

$res = db_update_item($id, $title, $characteristics, $seo, $description, $text, $image_path_db ?? false, $price, $status, $delete, $category_id);
if (!$res) {
    set_message('Не удалось изменить продукт!', $from);
}

set_message('Успех!', $from, false);
