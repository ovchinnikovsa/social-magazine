<?php

if (is_admin()) {
    $page = get('page') ?: '';

    switch ($page) {
        case '':
            require_once __DIR__ . '/pages/main.php';
            break;
        case 'item':
            require_once __DIR__ . '/pages/item.php';
            break;
        case 'add':
            require_once __DIR__ . '/pages/add.php';
            break;
        case 'status':
            require_once __DIR__ . '/pages/status.php';
            break;
        case 'deleted':
            require_once __DIR__ . '/pages/deleted.php';
            break;
        case 'categories':
            require_once __DIR__ . '/pages/categories.php';
            break;
        case 'exit':
            require_once __DIR__ . '/pages/exit.php';
            break;
        default:
            require_once __DIR__ . '/pages/main.php';
            break;
    }
} else {
    require_once __DIR__ . '/pages/login.php';
}
