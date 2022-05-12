<?php require_once ROOT . '/view/pages/adm/blocks/head.php';?>
<?php require_once ROOT . '/view/pages/adm/blocks/header.php';?>

<?php
if (get('item')) {
    $item = get_item_info(get('item'), true);?>

<div class="container-md main main-adm">
    <form method="post" action="/handlers/change-item.php" enctype="multipart/form-data">
        <?php echo set_form(); ?>
        <input type="hidden" name="id" value="<?php echo escape(get('item')); ?>">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Заголовок</span>
            <input name="title" type="text" class="form-control"
                value="<?php echo post('title') ?? $item['title'] ?: ''; ?>" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Цена</span>
            <input type="text" name="price" value="<?php echo post('price') ?? $item['price'] ?: ''; ?>"
                class="form-control" aria-label="Amount">
            <span class="input-group-text">&#8381;</span>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Картинка</label>
            <input name="img" class="form-control" type="file" id="formFile">
        </div>
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">Описание</span>
                <textarea name="description" class="form-control" placeholder="Текст на карточке товара"
                    aria-label="With textarea"><?php echo post('description') ?? $item['description'] ?: ''; ?></textarea>
            </div>
        </div>

        <p>Категория:</p>
        <div class="mb-3">
            <div class="input-group">
                <select class="form-select" name="category" aria-label="Default select example">
                    <option selected>Выберите категорию</option>
                    <?php 
                    foreach (get_category_list() as $category) { ?>
                    <option <?php echo $category['id'] === $item['category_id'] ? 'selected' : ''; ?>
                    value="<?php echo $category['id']; ?>">
                        <?php echo escape($category['precategory_ru']) . ' > ' . escape($category['category_ru']) . ' > ' .escape($category['subcategory_ru']); ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <p>Характеристики:</p>
        <div id="characteristic_place">
            <?php
        $characteristics = json_decode($item['characteristics'], true);
        if ($characteristics) {
        foreach (json_decode($item['characteristics'], true) as $key => $characteristic) {?>
            <div class="input-group mb-3">
                <input type="text" value="<?php echo escape($key); ?>" name="characteristic_name[]" class="form-control"
                    placeholder="имя" aria-label="имя">
                <span class="input-group-text"> &#8594;</span>
                <input type="text" value="<?php echo escape($characteristic); ?>" name="characteristic_value[]"
                    class="form-control" placeholder="характеристика" aria-label="характеристика">
                <button type="button" class="btn btn-danger btn-sm delete_characteristic">Удалить</button>
            </div>
            <?php } 
        } else {?>
            <div class="input-group mb-3">
                <input type="text" value="" name="characteristic_name[]" class="form-control" placeholder="имя"
                    aria-label="имя">
                <span class="input-group-text"> &#8594;</span>
                <input type="text" value="" name="characteristic_value[]" class="form-control"
                    placeholder="характеристика" aria-label="характеристика">
            </div>
            <?php } ?>
        </div>
        <div class="input-group mb-3">
            <button type="button" class="btn btn-primary btn-sm" id="add_characteristic">Добавить
                характеристику</button>
        </div>

        <p>SEO теги:</p>
        <div id="seo_place">
            <?php
        $seo = json_decode($item['seo'], true);
        if ($seo) {
        foreach (json_decode($item['seo'], true) as $key => $seo_item) {?>
            <div class="input-group mb-3">
                <input type="text" value="<?php echo escape($key); ?>" name="seo_name[]" class="form-control"
                    placeholder="имя" aria-label="имя">
                <span class="input-group-text"> &#8594;</span>
                <textarea type="text" name="seo_value[]" class="form-control" placeholder="характеристика"
                    aria-label="характеристика"><?php echo escape($seo_item); ?></textarea>
                <button type="button" class="btn btn-danger btn-sm delete_seo">Удалить</button>
            </div>
            <?php } 
        } else {?>
            <div class="input-group mb-3">
                <input type="text" value="" name="seo_name[]" class="form-control" placeholder="имя" aria-label="имя">
                <span class="input-group-text"> &#8594;</span>
                <textarea type="text" value="" name="seo_value[]" class="form-control" placeholder="значение"
                    aria-label="значение"></textarea>
            </div>
            <?php } ?>
        </div>
        <div class="input-group mb-3">
            <button type="button" class="btn btn-primary btn-sm" id="add_seo">Добавить
                seo тег</button>
        </div>

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">Текст</span>
                <textarea name="text" class="form-control" rows="10" cols="45" placeholder="Текст на странице товара"
                    aria-label="With textarea"><?php echo post('text') ?: str_replace('\\', '', $item['text']) ?: ''; ?> </textarea>
            </div>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" name="status" type="checkbox" role="switch" id="status"
                <?php echo (post('status') ?? $item['status']) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="status">Видимость</label>
        </div>
        <br>
        <div class="form-check form-switch">
            <input class="form-check-input" name="delete" type="checkbox" role="switch" id="delete"
                <?php echo (post('delete') ?? $item['delete']) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="delete">Не удалена</label>
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>

<?php } else { ?>
<div class="container-md main main-adm">
    <h1>Ошибка получения продукта</h1>
</div>
<?php } ?>

<div id="characteristic_example" style="display: none">
    <div class="input-group mb-3">
        <input type="text" name="characteristic_name[]" class="form-control" placeholder="имя" aria-label="имя">
        <span class="input-group-text"> &#8594;</span>
        <input type="text" name="characteristic_value[]" class="form-control" placeholder="характеристика"
            aria-label="характеристика">
    </div>
</div>

<div id="seo_example" style="display: none">
    <div class="input-group mb-3">
        <input type="text" name="seo_name[]" class="form-control" placeholder="имя" aria-label="имя">
        <span class="input-group-text"> &#8594;</span>
        <textarea type="text" name="seo_value[]" class="form-control" placeholder="значение"
            aria-label="значение"></textarea>
    </div>
</div>

<?php require_once ROOT . '/view/pages/adm/blocks/footer.php';?>

<script>
const input_tags = $('#characteristic_example').html();
$('#add_characteristic').on('click', function() {
    let characteristic_place = $('#characteristic_place');
    characteristic_place.append(input_tags)
})
$('.delete_characteristic').click(function() {
    $(this).closest('.input-group ').remove();
})
const seo_tags = $('#seo_example').html();
$('#add_seo').on('click', function() {
    let seo_place = $('#seo_place');
    seo_place.append(seo_tags)
})
$('.delete_seo').click(function() {
    $(this).closest('.input-group ').remove();
})
</script>