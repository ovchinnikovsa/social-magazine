<?php

$ini_file = parse_ini_file(__DIR__ . '/db.ini');

$db_host = $ini_file['DB_HOST'];
$db_name = $ini_file['MARIADB_DATABASE'];
$db_user = $ini_file['MARIADB_USER'];
$db_pass = $ini_file['MARIADB_PASSWORD'];

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die('Ошибка подключения к базе данных: ' . $mysqli->connect_error);
}
