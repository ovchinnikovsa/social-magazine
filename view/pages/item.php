<?php require_once ROOT . '/view/blocks/head.php'; ?>
<?php require_once ROOT . '/view/blocks/header.php'; ?>

<?php $item = get_item_info(get('item'), is_admin()) ?: []; ?>
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
                <h5 class="modal-title" id="buyModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 col-6 d-flex justify-content-center">
                        <a href="" class="d-flex flex-column align-items-center">
                            <img class="buy-icon" src="/view/assets/images/mail.png" alt="почта">
                            <p>Почта</p>
                        </a>
                    </div>
                    <div class="col-sm-3 col-6 d-flex justify-content-center">
                        <a href="" class="d-flex flex-column align-items-center">
                            <img class="buy-icon" src="/view/assets/images/telephone.png" alt="телефон">
                            <p>Телефон</p>
                        </a>
                    </div>
                    <div class="col-sm-3 col-6 d-flex justify-content-center">
                        <a href="" class="d-flex flex-column align-items-center">
                            <img class="buy-icon" src="/view/assets/images/telegram.png" alt="телеграмм">
                            <p>Телеграмм</p>
                        </a>
                    </div>
                    <div class="col-sm-3 col-6 d-flex justify-content-center">
                        <a href="" class="d-flex flex-column align-items-center">
                            <img class="buy-icon" src="/view/assets/images/vk.png" alt="вконтакте">
                            <p>ВКонтакте</p>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <p>
                        Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является
                        стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный
                        печатник создал
                        большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem
                        Ipsum не
                        только
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