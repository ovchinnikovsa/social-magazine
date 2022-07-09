<?php

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

function authorization_admin()
{
    session('admin', true);
}
