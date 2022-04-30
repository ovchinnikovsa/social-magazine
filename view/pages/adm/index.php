<?php

if (is_admin()) {
    $page = get('page') ?: '';

    switch ($page) {
        case '':
            require_once __DIR__ . '/main.php';
            break;
        case 'item':
            require_once __DIR__ . '/item.php';
            break;
        case 'exit':
            require_once __DIR__ . '/exit.php';
            break;
        default:
            require_once __DIR__ . '/main.php';
            break;
    }
} else {
    require_once __DIR__ . '/login.php';
}
