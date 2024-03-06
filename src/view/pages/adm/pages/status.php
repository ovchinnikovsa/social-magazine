<?php require_once ROOT . '/view/pages/adm/blocks/head.php'; ?>
<?php require_once ROOT . '/view/pages/adm/blocks/header.php'; ?>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
        $pagination = get_pagination_products(9, 0);
        foreach ($pagination['list'] as $item){ ?>
    <div class="col">
        <div class="card">
            <img src="<?php echo escape($item['image']) ?>" class="card-img-top" alt="card image">
            <div class="card-body">
                <div class="row flex-wrap d-flex flex-row justify-content-between item-title">
                    <a href="/adm/?page=item&item=<?php echo escape($item['id']); ?>" class="d-flex flex-row">
                        <h5 class="card-title">
                            <?php echo escape($item['title']); ?>
                        </h5>
                        <img width="27px" height="27px" src="/view/assets/images/change.png">
                    </a>
                    <a href="/item/?item=<?php echo escape($item['id']); ?>" style="width: 10% !important;">
                    <img width="27px" height="27px" src="/view/assets/images/eye.png"></a>
                    <h4><?php echo (float)$item['price']; ?>&#8381;</h4>
                </div>
                <p class="card-text"><?php echo escape($item['description']); ?></p>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php $pagination['pagination']->render(); ?>
</div>

<?php require_once ROOT . '/view/pages/adm/blocks/footer.php'; ?>