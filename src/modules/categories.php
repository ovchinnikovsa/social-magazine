<?php

function get_categories(): array
{
    $list = get_category_list();
    if (!$list) {
        return [];
    }

    $result = [];
    foreach ($list as $item) {
        $result[$item['precategory_ru']][$item['category_ru']][] = $item['subcategory_ru'];
        // $result[$item['precategory_ru']][$item['category_ru']][$item['id']][] = $item['subcategory_ru'];
    }

    return $result;
}

function get_distinct_precategories(): array
{
    $sql = 'SELECT DISTINCT `precategory_ru` FROM `categories` WHERE `delete` = 1';
    return db_get_list_sql($sql);
}

function get_distinct_categories(): array
{
    $sql = 'SELECT DISTINCT `category_ru` FROM `categories` WHERE `delete` = 1';
    return db_get_list_sql($sql);
}

function get_distinct_subcategories(): array
{
    $sql = 'SELECT DISTINCT `subcategory_ru` FROM `categories` WHERE `delete` = 1';
    return db_get_list_sql($sql);
}

function get_category(string $precategory, string $category, string $subcategory, int $delete = 1): array
{
    return db_get_row_by_fields('categories',
        [
            'precategory_ru' => $precategory,
            'category_ru' => $category,
            'subcategory_ru' => $subcategory,
            'delete' => $delete,
        ]) ?: [];
}

function db_insert_category(string $precategory, string $category, string $subcategory, int $delete = 1)
{
    $sql = 'INSERT INTO `categories`
    (`precategory_ru`,
    `category_ru`,
    `subcategory_ru`,
    `delete`)
    VALUES (' . escape_db($precategory) . ',
    ' . escape_db($category) . ',
    ' . escape_db($subcategory) . ',
     ' . escape_db($delete) . ')';
    return db_query($sql);
}

function category_delete_by_id(int $category_id): bool
{
    $sql = 'UPDATE `categories` SET
    `delete` = ' . escape_db(0) . '
    WHERE `id` = ' . escape_db($category_id);
    return db_query($sql);
}

function get_category_list(): array
{
    return db_get_list('categories', '`delete` = 1', 'precategory_ru');
}
