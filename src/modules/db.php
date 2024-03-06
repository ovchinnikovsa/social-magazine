<?php

function cut_get_query(string $str): string
{
    $get_query = strstr($str, '?') ?: '';
    return str_replace($get_query, '', $str);
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
