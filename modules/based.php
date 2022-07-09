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

function redirect(string $path): void
{
    header('Location: http://' . $_SERVER['SERVER_NAME'] . $path);
    die();
}

function escape($value)
{
    return htmlentities($value, ENT_QUOTES, "UTF-8");
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
