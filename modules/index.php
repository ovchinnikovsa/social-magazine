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

function cut_get_query(string $str): string{
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
    session('error', $error);
    session('message', $message);
    session('show_modal', true);
    redirect($from);
}

function show_message()
{
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

function db_insert_model($name, $telegram, $phone)
{
    $sql = 'INSERT INTO `models` (`name`, `telegram`, `phone`)
    VALUES (' . escape_db($name) . ', ' . escape_db($telegram) . ', ' . escape_db($phone) . ')';
    return db_query($sql);
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
