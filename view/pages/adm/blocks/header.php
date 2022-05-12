<body>

    <nav class="navbar navbar-expand-md navbar-light bg-light header">
        <div class="container-fluid container-md">
            <a class="navbar-brand" href="/">ElStroy35</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
        </div>
    </nav>

    <div class="container-md main-adm">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="/adm/" class="nav-link <?php echo $page === '' ? 'active' : ''; ?>" aria-current="page"
                    href="#">Продукты</a>
            </li>
            <?php if ($page === 'item') { ?>
            <li class="nav-item">
                <a href="/adm/?page=add" class="nav-link active" href="#">Измненение</a>
            </li>
            <?php } else { ?>
            <li class="nav-item">
                <a href="/adm/?page=add" class="nav-link disabled" href="#">Измненение</a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a href="/adm/?page=add" class="nav-link <?php echo $page === 'add' ? 'active' : ''; ?>"
                    href="#">Добавить</a>
            </li>
            <li class="nav-item">
                <a href="/adm/?page=status" class="nav-link <?php echo $page === 'status' ? 'active' : ''; ?>"
                    href="#">Предпросмотр</a>
            </li>
            <li class="nav-item">
                <a href="/adm/?page=deleted" class="nav-link <?php echo $page === 'deleted' ? 'active' : ''; ?>"
                    href="#">Удаленные</a>
            </li>
            <li class="nav-item">
                <a href="/adm/?page=categories" class="nav-link <?php echo $page === 'categories' ? 'active' : ''; ?>"
                    href="#">Категории</a>
            </li>
            <li class="nav-item">
                <a href="/adm/?page=exit" class="nav-link">Выход</a>
            </li>
        </ul>
        <br>