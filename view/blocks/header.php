<body>

    <nav class="navbar navbar-expand-md navbar-light bg-light header">
        <div class="container-fluid container-md">
            <a class="navbar-brand" href="/">Social market</a>
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
                    <li class="nav-item">
                        <a class="nav-link" style="color: red" href="/adm/?page=exit">exit</a>
                    </li>
                    <?php }?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">email@mail.com</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">@telegramm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">+79876543211</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">vk-link</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>