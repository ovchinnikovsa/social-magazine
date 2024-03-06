<?php
session_start();
require_once __DIR__ . '/conf.php';

$uri = cut_get_query($_SERVER['REQUEST_URI']);

switch ($uri) {
    case '/':
        require_once __DIR__ . '/view/pages/index.php';
        break;
    case '/item/':
        require_once __DIR__ . '/view/pages/item.php';
        break;
    case '/adm/':
        require_once __DIR__ . '/view/pages/adm/index.php';
        break;

    default:
        require_once __DIR__ . '/404.html';
        break;
}
