<?php require_once ROOT . '/view/blocks/head.php'; ?>
<?php require_once ROOT . '/view/blocks/header.php'; ?>

<?php if ($item) { ?>
<div class="container-md main main-item">
    <h2 class="item-header"><?php echo escape($item['title']); ?></h2>
    <div class="row item-content">
        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
            <img src="<?php echo escape($item['image']); ?>" class="item-image"
                alt="<?php echo escape($item['title']); ?>">
        </div>
        <?php 
        $characteristics = json_decode($item['characteristics'], true);
        if (is_array($characteristics)) {
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <ul class="item-characters">
                <?php foreach ($characteristics as $key => $value) { ?>
                <li>
                    <span><?php echo escape($key); ?></span>
                    <span></span>
                    <span><?php echo escape($value); ?></span>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>

        <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-around p-3 align-items-center">
            <h1 class="item-price"><?php echo (float)escape($item['price']); ?>&#8381;</h1>
            <button type="button" class="btn-lg btn-light item-button" data-bs-toggle="modal"
                data-bs-target="#buyModal">
                Купить
            </button>
        </div>
    </div>

    <div class="row">
        <p class="item-text">
            <?php echo escape(str_replace('\\', '', $item['text'])); ?>
        </p>
    </div>
</div>

<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyModalLabel">Заглушка</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4 col-4 d-flex justify-content-center">
                        <a href="https://t.me/ovchiegram" target="_blank" class="d-flex flex-column align-items-center">
                            <img class="buy-icon" src="/view/assets/images/telegram.png" alt="телеграмм">
                            <p>Телеграмм</p>
                        </a>
                    </div>
                    
                </div>
                <div class="row">
                    <p>
                        Для продолжения покупки свяжитесь с нашим менеджером по контактам, указанным выше.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else { 
    redirect('/404/');
 } ?>

<?php require_once ROOT . '/view/blocks/footer.php'; ?>