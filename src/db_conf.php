<?php

$ini_file = parse_ini_file('db.ini');

$db_host = $ini_file['db_host'];
$db_name = $ini_file['db_name'];
$db_user = $ini_file['db_user'];
$db_pass = $ini_file['db_pass'];

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die('Ошибка подключения к базе данных: ' . $mysqli->connect_error);
}
