<?php

function dd($var)
{
    var_dump($var);
    die();
}

function post($key, $value = 'not defined')
{
    if ($value === 'not defined') {
        return $_POST[$key] ?? null;
    }
    $_POST[$key] = $value;
}

function get($key, $value = 'not defined')
{
    if ($value === 'not defined') {
        return $_GET[$key] ?? null;
    }
    $_GET[$key] = $value;
}

function cut_get_query(string $str): string
{
    $get_query = strstr($str, '?') ?: '';
    return str_replace($get_query, '', $str);
}

function session($key, $value = 'not defined')
{
    if ($value === 'not defined') {
        return $_SESSION[$key] ?? null;
    }
    $_SESSION[$key] = $value;
}

function session_clear_value($key): void
{
    unset($_SESSION[$key]);
}

function cfrs_set(): string
{
    $hash = time() + CFRS_TIME;
    session('cfrs_time', $hash);
    $hash = md5($hash . SALT);
    session('cfrs', $hash);

    ob_start();
    ?>
<input type="hidden" name="csrf" value="<?php echo $hash; ?>">
<?php
return ob_get_clean();
}

function cfrs_check(): void
{
    $post_csfr_time = session('cfrs_time') ?? 0;
    $post_csfr = session('cfrs') ?? '';

    if ($post_csfr !== session('cfrs') || $post_csfr_time < time()) {
        set_message('Время токена безопасности истекло');
    }

    session_clear_value('cfrs_time');
    session_clear_value('cfrs');
}

function redirect(string $path): void
{
    header('Location: http://' . $_SERVER['SERVER_NAME'] . $path);
    die();
}

function set_message(string $message, string $from = '/', bool $error = true): void
{
    session('post', $_POST);
    session('error', $error);
    session('message', $message);
    session('show_modal', true);
    redirect($from);
}

function show_message()
{
    $_POST = session('post');
    session_clear_value('post');
    $is_error = session('error') ?? false;
    $message = session('message') ?? false;
    session_clear_value('error');
    session_clear_value('message');
    session_clear_value('show_modal');

    if ($message) {
        ob_start();
        ?>
<div class="alert alert-<?php echo $is_error ? 'danger' : 'success'; ?>" role="alert">
<?php echo $message; ?>
</div>
<?php
return ob_get_clean();
    }
}

function escape($value)
{
    return htmlentities($value, ENT_QUOTES, "UTF-8");
}

function escape_db($value)
{
    global $mysqli;
    return "'" . $mysqli->real_escape_string($value) . "'";
}

function db_query(string $sql)
{
    global $mysqli;
    return $mysqli->query($sql);
}

function get_last_inserted_id()
{
    global $mysqli;
    return mysqli_insert_id($mysqli);
}

function db_get_value($sql)
{
    global $mysqli;
    $result = db_query($sql);
    if ($result) {
        $row = $result->fetch_array();
        if ($row && isset($row[0])) {
            return $row[0];
        }
    }
    return 0;
}

function db_get_list($table, $where = "1 = 1", $order = 'id')
{
    global $mysqli;
    $list = [];
    $sql = "SELECT * FROM `{$table}` ";
    $sql .= " WHERE " . $where . " ";
    $sql .= " ORDER BY {$order} ";
    $sql .= " ;";
    $result = db_query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $list[] = $row;
        }
    }
    return $list;
}

function db_get_list_sql($sql)
{
    global $mysqli;
    $list = [];
    $result = db_query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $list[] = $row;
        }
    }
    return $list;
}

function db_get_row_by_fields($table, $arr)
{
    global $mysqli;
    $str = "";
    foreach ($arr as $key => $item) {
        if ($str) {
            $str .= " AND ";
        }

        $str .= "`{$key}` = " . escape_db($item);
    }
    $sql = "SELECT * FROM `{$table}` WHERE {$str} LIMIT 1;";
    $result = db_query($sql);
    if ($result) {
        return $result->fetch_assoc();
    }
    return [];
}

function db_get_value_by_fields($table, $value, $arr)
{
    global $mysqli;
    $str = "";
    foreach ($arr as $key => $item) {
        if ($str) {
            $str .= " AND ";
        }

        $str .= "`{$key}` = " . escape_db($item);
    }
    $sql = "SELECT `{$value}` FROM `{$table}` WHERE {$str} LIMIT 1;";
    $result = db_query($sql);
    if ($result) {
        $row = $result->fetch_array();
        if ($row && isset($row[0])) {
            return $row[0];
        }
    }
    return 0;
}

function is_admin(): bool
{
    return $_SESSION['admin'] ?? false;
}

function set_form_location(): string
{
    $from = $_SERVER['REQUEST_URI'];

    ob_start();
    ?>
<input type="hidden" name="from" value="<?php echo $from; ?>">
<?php
return ob_get_clean();
}

function get_from()
{
    return post('from') ?: '/';
}

function set_form()
{
    echo set_form_location();
    echo cfrs_set();
    echo show_message();
}

function authorization_admin()
{
    session('admin', true);
}

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
    $category = json_decode(session('category') ?: '') ?: [];
    $pagination = new Zebra_Pagination();
    $rows = get_paginated_products_list_count($conditions, $search, $category);
    $pagination->records((int) $rows);
    $pagination->records_per_page((int) $records_per_page);
    $pagination->variable_name('p');
    $offset = ($pagination->get_page() - 1) * $records_per_page;
    return ['pagination' => $pagination, 'list' => get_paginated_products_list($offset, $records_per_page, $conditions, $search, $category)];
}

function get_paginated_products_list(int $offset, int $limit, array $conditions, string $search = '', array $category = []): array
{
    $sql = 'SELECT * FROM `products`';
    $sql .= get_sql_where_for_products($conditions, $search, $category);
    $sql .= ' LIMIT ' . $offset . ', ' . $limit . '';
    return db_get_list_sql($sql);
}

function get_paginated_products_list_count(array $conditions, string $search = '', array $category = []): int
{
    return db_get_value('SELECT COUNT(*) FROM `products` ' . get_sql_where_for_products($conditions, $search, $category));
}

function get_sql_where_for_products(array $conditions, string $search = '', array $category = []): string
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
