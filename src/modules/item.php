<?php

function get_pagination_products($records_per_page = 9, $status = false, $delete = false)
{
    if (is_admin()) {
        $conditions = [];
        if ($status !== false) {
            $conditions['status'] = $status;
        }

        if ($delete !== false) {
            $conditions['delete'] = $delete;
        }
    } else {
        $conditions = [
            'status' => 1,
            'delete' => 1,
        ];
    }
    $search = session('search') ?: '';
    $sort = session('sort') ?: '';
    $category = json_decode(session('category') ?: '') ?: [];
    $pagination = new Zebra_Pagination();
    $rows = get_paginated_products_list_count($conditions, $search, $category, $sort);
    $pagination->records((int) $rows);
    $pagination->records_per_page((int) $records_per_page);
    $pagination->variable_name('p');
    $offset = ($pagination->get_page() - 1) * $records_per_page;
    return ['pagination' => $pagination, 'list' => get_paginated_products_list($offset, $records_per_page, $conditions, $search, $category, $sort)];
}

function get_paginated_products_list(int $offset, int $limit, array $conditions, string $search = '', array $category = [], string $sort = ''): array
{
    $sql = 'SELECT * FROM `products`';
    $sql .= get_sql_where_for_products($conditions, $search, $category, $sort);
    $sql .= ' LIMIT ' . $offset . ', ' . $limit . '';
    return db_get_list_sql($sql);
}

function get_paginated_products_list_count(array $conditions, string $search = '', array $category = [], string $sort = ''): int
{
    return db_get_value('SELECT COUNT(*) FROM `products` ' . get_sql_where_for_products($conditions, $search, $category, $sort));
}

function get_sql_where_for_products(array $conditions, string $search = '', array $category = [], string $sort = ''): string
{
    $first = true;
    $where = '';
    foreach ($conditions as $key => $con) {
        if ($first) {
            $where .= ' WHERE';
            $first = false;
        } else {
            $where .= ' AND ';
        }
        $where .= ' `' . $key . '` = ';
        $where .= escape_db($con);
    }
    if ($search) {
        $where .= $first ? ' WHERE' : ' AND';
        $where .= ' `title` LIKE ' . escape_db('%' . $search . '%');
    }
    $first_cat = true;
    foreach ($category as $key => $cat) {
        if ($first) {
            $where .= ' WHERE';
            $first = false;
            $first_cat = false;
        } elseif ($first_cat) {
            $where .= ' AND';
            $first = false;
            $first_cat = false;
        } else {
            $where .= ' OR ';
        }
        $where .= ' `category_id` = ';
        $where .= escape_db($cat);
    }
    if ($sort === 'ASC' || $sort === 'DESC') {
        $where .= ' ORDER BY `price` ' . $sort;
    } else {
        $where .= ' ORDER BY `id` DESC';
    }
    return $where;
}

function get_item_info(int $item_id, $for_admin): array
{
    if ($for_admin) {
        $array = ['id' => $item_id];
    } else {
        $array = ['id' => $item_id, 'status' => '1', 'delete' => '1'];
    }
    return db_get_row_by_fields('products', $array) ?: [];
}

function db_insert_item($title, $characteristics, $seo, $description, $text, $image, $price, $status, $delete, $category_id)
{
    $sql = 'INSERT INTO `products`
    (`title`,
    `characteristics`,
    `description`,
    `text`,
    `seo`,
    `image`,
    `price`,
    `status`,
    `delete`,
    `category_id`)
    VALUES (' . escape_db($title) . ',
    ' . escape_db($characteristics) . ',
    ' . escape_db($description) . ',
    ' . escape_db($text) . ',
    ' . escape_db($seo) . ',
    ' . escape_db($image) . ',
    ' . escape_db($price) . ',
    ' . escape_db($status) . ',
    ' . escape_db($delete) . ',
     ' . escape_db($category_id) . ')';
    return db_query($sql);
}

function db_update_item($id, $title, $characteristics, $seo, $description, $text, $image, $price, $status, $delete, $category_id)
{
    $sql = 'UPDATE `products` SET
    `title` = ' . escape_db($title) . ',
    `characteristics` = ' . escape_db($characteristics) . ',
    `seo` = ' . escape_db($seo) . ',
    `description` = ' . escape_db($description) . ',
    `text` = ' . escape_db($text) . ', ';
    if ($image) {
        $sql .= '`image` = ' . escape_db($image) . ', ';
    }
    $sql .= '`price` = ' . escape_db($price) . ',
    `status` = ' . escape_db($status) . ',
    `delete` = ' . escape_db($delete) . ',
    `category_id` = ' . escape_db($category_id) . '
    WHERE `id` = ' . escape_db($id);
    return db_query($sql);
}
