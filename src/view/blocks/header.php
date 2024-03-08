<body>

    <nav class="navbar navbar-expand-md navbar-light bg-light header">
        <div class="container-fluid container-md">
            <a class="navbar-brand" href="/">
                Lightning
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <?php if (is_admin()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" style="color: red" href="/adm/">admin</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="mailto:test@test.test">test@test.test</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://t.me/ovchiegram">@ovchiegram</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tel:+79111111111">+79111111111</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>