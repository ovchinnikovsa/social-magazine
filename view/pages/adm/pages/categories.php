<?php require_once ROOT . '/view/pages/adm/blocks/head.php';?>
<?php require_once ROOT . '/view/pages/adm/blocks/header.php';?>

<form action="/handlers/amd-cat.php" method="post">
    <?php echo set_form(); ?>

    <div class="row row-cols-1 row-cols-md-3 g-4 border rounded m-2">
        <div class="col">
            <select class="form-select" name="precategory" aria-label="Default select example">
                <?php foreach(get_distinct_precategories() as $item) { ?>
                <option value="<?php echo escape($item['precategory_ru']); ?>">
                    <?php echo escape($item['precategory_ru']); ?></option>
                <?php } ?>
            </select>
            <br>
            <div class="input-group mb-3">
                <input class="form-control show-input" name="precategory_new" type="text" placeholder="Категория"
                    style="display: none;">
                <button type="button" class="btn btn-primary btn-sm show-button">Добавить
                    категорию</button>
            </div>
        </div>
        <div class="col">
            <select class="form-select" name="category" aria-label="Default select example">
                <?php foreach(get_distinct_categories() as $item) { ?>
                <option value="<?php echo escape($item['category_ru']); ?>"><?php echo escape($item['category_ru']); ?>
                </option>
                <?php } ?>
            </select>
            <br>
            <div class="input-group mb-3">
                <input class="form-control show-input" name="category_new" type="text" placeholder="Категория"
                    style="display: none;">
                <button type="button" class="btn btn-primary btn-sm show-button">Добавить
                    категорию</button>
            </div>
        </div>
        <div class="col">
            <select class="form-select" name="subcategory" aria-label="Default select example">
                <?php foreach(get_distinct_subcategories() as $item) { ?>
                <option value="<?php echo escape($item['subcategory_ru']); ?>">
                    <?php echo escape($item['subcategory_ru']); ?></option>
                <?php } ?>
            </select>
            <br>
            <div class="input-group mb-3">
                <input class="form-control show-input" name="subcategory_new" type="text" placeholder="Категория"
                    style="display: none;">
                <button type="button" class="btn btn-primary btn-sm show-button">Добавить
                    категорию</button>
            </div>
        </div>
        <div class="input-group mb-3">
            <button type="submit" name="add" value="1" class="btn btn-primary w-100 show-button">Добавить</button>
        </div>
    </div>

    <?php foreach (get_categories() as $precategory => $categories) {?>
    <?php foreach ($categories as $category => $subcategories) {?>
    <div class="row row-cols-1 row-cols-md-3 g-4 border rounded m-2">
        <div class="col">
            <h1><?php echo escape($precategory); ?> > </h1>
        </div>
        <div class="col">
            <h4><?php echo escape($category); ?> > </h4>
        </div>
        <div class="col">
            <?php foreach ($subcategories as $subcategory) {?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="<?php echo escape($subcategory); ?>" disabled
                    aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" name="delete"
                    value="<?php echo escape($precategory . ',' .$category . ',' .$subcategory); ?>" type="submit"
                    id="button-addon2">Удалить</button>
            </div>
            <?php }?>
        </div>
    </div>
    <?php }?>
    <?php }?>

</form>

<?php require_once ROOT . '/view/pages/adm/blocks/footer.php';?>
<script>
$('.show-button').on('click', function() {
    $(this).closest('.input-group').find('.show-input').show()
    $(this).hide();
})
</script>