<?php

require_once __DIR__ . '/modules/index.php';
require_once __DIR__ . '/db_conf.php';
require_once __DIR__ . '/vendor/autoload.php';

$ini_file = parse_ini_file('conf.ini');

define('SALT', $ini_file['SALT']);
define('CFRS_TIME', $ini_file['CFRS_TIME']);
define('ROOT', $_SERVER['DOCUMENT_ROOT']);