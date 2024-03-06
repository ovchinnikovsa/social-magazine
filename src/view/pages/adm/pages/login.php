<?php require_once ROOT . '/view/blocks/head.php';?>
<?php require_once ROOT . '/view/blocks/header.php';?>

<div class="container main">
    <form method="post" action="/handlers/auth.php" style="width: 30%">
        <?php echo set_form(); ?>
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" name="login" class="form-control" id="login" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php require_once ROOT . '/view/blocks/footer.php';?>