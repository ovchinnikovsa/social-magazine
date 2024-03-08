<?php require_once ROOT . '/view/blocks/head.php'; ?>
<?php require_once ROOT . '/view/blocks/header.php'; ?>

<div class="container-md main">
    <?php echo show_message(); ?>
    <div class="row row-cols-1 row-cols-md-3" style="border-bottom: 1px solid white; margin-bottom: 1rem;">
        <div class="col cat-desktop">
            <div class="input-group mb-3">
                <button class="btn btn-light w-100" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseCat" aria-expanded="false" aria-controls="collapseCat">
                    Категории
                </button>
            </div>
        </div>
        <div class="col cat-mobile">
            <div class="input-group mb-3">
                <button class="btn btn-light w-100" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasCat" aria-controls="offcanvasCat">
                    Категории
                </button>
            </div>
        </div>
        <div class="col">
            <form action="/handlers/search.php" method="post">
                <div class="input-group mb-3">
                    <?php echo set_form(); ?>
                    <input type="text" class="form-control rounded-start" placeholder="Найти" name="search"
                        value="<?php echo session('search') ?: ''; ?>" aria-label="Example text with button addon"
                        aria-describedby="button-addon1">
                    <button class="btn btn-outline-light" type="submit" id="button-addon1">&#128269;</button>
                </div>
            </form>
        </div>
        <div class="col">
            <form action="/handlers/clear.php" method="post">
                <div class="input-group mb-3 dropdown">
                    <?php echo set_form(); ?>
                    <input type="submit" class="form-control btn-light rounded-start" name="clear" value="Сбросить">
                    <button type="button" class="btn  btn-outline-light dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/view/assets/images/funnel.svg" alt="">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown">
                        <li>
                            <h6 class="dropdown-header">Цена</h6>
                        </li>
                        <li><button class="dropdown-item <?php echo session('sort') === 'ASC' ? 'active' : ''; ?>"
                                name="sort" value="ASC" type="submit">По убыванию</button></li>
                        <li><button class="dropdown-item <?php echo session('sort') === 'DESC' ? 'active' : ''; ?>"
                                name="sort" value="DESC" type="submit">По возрастанию</button></li>
                    </ul>
                </div>
            </form>
        </div>

        <div class="collapse w-300" id="collapseCat">
            <form action="/handlers/category-select.php" method="post">
                <?php
                    echo set_form();
                    $precategories = get_categories();
                ?>
                <div class="d-flex flex-wrap flex-column p-3 mb-3 border border-white rounded bg-white text-dark">
                    <?php foreach ($precategories as $precategory => $categories) { ?>
                    <div class="cat-expand-hover">
                        <button type="submit" name="category" value="<?php echo escape($precategory); ?>"
                            class="active bg-white pt-1 pb-1 mb-1 lh-lg w-100">
                            <?php echo escape($precategory); ?></button>
                        <div class="expand-panel bg-white text-dark">
                            <div class="row row-cols-1 row-cols-sm-3 list-row m-1">
                                <?php foreach ($categories as $category => $subcategories) { ?>
                                <ul class="col list-cat">
                                    <li><button class="list-cat-header" type="submit" name="category"
                                            value="<?php echo escape($category); ?>">
                                            <?php echo escape($category); ?>
                                        </button>
                                    </li>
                                    <ul>
                                        <?php foreach ($subcategories as $subcategory) {?>
                                        <li>
                                            <button type="submit" name="category"
                                                value="<?php echo escape($subcategory); ?>">
                                                <?php echo escape($subcategory); ?>
                                            </button>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $pagination = get_pagination_products(3, 1, 1);
        if ($pagination['list']) {
        foreach ($pagination['list'] as $item){
            $style = $item['status'] == 0 ? 'style="background-color: #8080806e;"' : false;
            ?>
        <div class="col">
            <div class="card" <?php echo $style ?: ''; ?>>
                <img src="<?php echo escape($item['image']) ?>" class="card-img-top" alt="card image">
                <div class="card-body">
                    <div class="row d-flex flex-row justify-content-between item-title">
                        <a href="/item/?item=<?php echo escape($item['id']); ?>" class="stretched-link">
                            <h5 class="card-title">
                                <?php echo escape($item['title']); ?>
                            </h5>
                        </a>
                        <h4><?php echo (float)$item['price']; ?>&#8381;</h4>
                    </div>
                    <p class="card-text"><?php echo escape(str_replace('\\', '', $item['description'])); ?></p>
                </div>
            </div>
        </div>
        <?php } } else { ?>
        <div class="w100">
            <h1>По вашему запросу ничего нет</h1>
        </div>
        <?php } ?>
    </div>

    <?php if ($pagination['list']) $pagination['pagination']->render(); ?>

</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCat" aria-labelledby="offcanvasCatLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCatLabel">ЭлектроСтрой</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <h3>Категории</h3>
        </div>
        <div class="accordion accordion-flush" id="accordionFlushCat">
            <?php
                $i = 1;
                foreach ($precategories as $precategory => $categories) { ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading<?php echo $i; ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse<?php echo $i; ?>" aria-expanded="false"
                        aria-controls="flush-collapse<?php echo $i; ?>">
                        <?php echo escape($precategory); ?>
                    </button>
                </h2>
                <div id="flush-collapse<?php echo $i; ?>" class="accordion-collapse collapse"
                    aria-labelledby="flush-heading<?php echo $i; ?>" data-bs-parent="#accordionFlushCat">
                        <div class="list-row">
                            <?php foreach ($categories as $category => $subcategories) { ?>
                            <ul class="list-cat">
                                <li><button class="list-cat-header" type="submit" name="category"
                                        value="<?php echo escape($category); ?>">
                                        <?php echo escape($category); ?>
                                    </button>
                                </li>
                                <ul>
                                    <?php foreach ($subcategories as $subcategory) {?>
                                    <li>
                                        <button type="submit" name="category"
                                            value="<?php echo escape($subcategory); ?>">
                                            <?php echo escape($subcategory); ?>
                                        </button>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </ul>
                            <?php } ?>
                        </div>
                </div>
            </div>
            <?php 
            $i++;
        } ?>
        </div>
    </div>
</div>

<?php require_once ROOT . '/view/blocks/footer.php'; ?>