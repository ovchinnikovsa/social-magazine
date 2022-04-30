<?php require_once ROOT . '/view/blocks/head.php'; ?>
<?php require_once ROOT . '/view/blocks/header.php'; ?>

<div class="container-md main main-item">
    <h2 class="item-header">Card title</h2>
    <div class="row item-content">
        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
            <img src="/view/assets/images/razer-toaster_01.jpg" class="item-image" alt="Изображение товара">
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <ul class="item-characters">
                <li>
                    <span>Мощность</span>
                    <span></span>
                    <span>1ВТ</span>
                </li>
                <li>
                    <span>Индуктивность</span>
                    <span></span>
                    <span>146%</span>
                </li>
                <li>
                    <span>Неплохость</span>
                    <span></span>
                    <span>1/2</span>
                </li>
                <li>
                    <span>Мощность</span>
                    <span></span>
                    <span>1ВТ</span>
                </li>
                <li>
                    <span>Индуктивность</span>
                    <span></span>
                    <span>146%</span>
                </li>
                <li>
                    <span>Неплохость</span>
                    <span></span>
                    <span>1/2</span>
                </li>
                <li>
                    <span>Мощность</span>
                    <span></span>
                    <span>1ВТ</span>
                </li>
                <li>
                    <span>Индуктивность</span>
                    <span></span>
                    <span>146%</span>
                </li>
                <li>
                    <span>Неплохость</span>
                    <span></span>
                    <span>1/2</span>
                </li>
                <li>
                    <span>Мощность</span>
                    <span></span>
                    <span>1ВТ</span>
                </li>
                <li>
                    <span>Индуктивность</span>
                    <span></span>
                    <span>146%</span>
                </li>
                <li>
                    <span>Неплохость</span>
                    <span></span>
                    <span>1/2</span>
                </li>
            </ul>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-around p-3 align-items-center">
            <h1 class="item-price">1000 P</h1>
            <button type="button" class="btn-lg btn-light item-button" data-bs-toggle="modal"
                data-bs-target="#buyModal">
                Купить
            </button>
        </div>
    </div>

    <div class="row">
        <p class="item-text">
            Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является
            стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал
            большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не
            только
            успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в
            новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее
            время,
            программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.

            Почему он используется?
            Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum
            используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное
            распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст..
            Здесь
            ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum
            в
            качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много
            веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много
            версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).
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

<?php require_once ROOT . '/view/blocks/footer.php'; ?>