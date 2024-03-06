<body>

    <nav class="navbar navbar-expand-md navbar-light bg-light header">
        <div class="container-fluid container-md">
            <a class="navbar-brand" href="/">
              ЭлектроСтрой
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <?php if (is_admin()) {?>
                    <li class="nav-item">
                        <a class="nav-link" style="color: red" href="/adm/">admin</a>
                    </li>
                    <?php }?>
                    <li class="nav-item">
                        <a class="nav-link" href="mailto:Estr35@mail.ru">Estr35@mail.ru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://t.me/Elstroy35">@Elstroy35</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tel:+79115383331">+79115383331</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>