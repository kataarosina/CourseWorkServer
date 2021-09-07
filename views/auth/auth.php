<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/static/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="/static/css/base.css" type="text/css">
    <link rel="stylesheet" href="/static/css/auth.css" type="text/css">
    <script rel="script" src="/static/js/base.js" type="application/javascript"></script>
    <title><?php if (!$is_auth) echo 'Авторизация'; else echo 'Личный кабинет'?></title>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-content__logo-place">
                <?php echo '<a href="../'.FOLDER_NAME.'">' ?>
                    <button class="header-content__button">
                        <b class="header-content__logo-text_b">ООП </b>
                        <i class="header-content__logo-text_i">в PHP</i>
                    </button>
                </a>
            </div>
            <div class="header-content__logo-place">
                <a href="articles">
                    <button class="header-content__button">
                        <b class="header-content__logo-text_b">Учебные </b>
                        <i class="header-content__logo-text_i">статьи</i>
                    </button>
                </a>
            </div>
            <div class="header-content__logo-place">
                <a href="auth">
                    <button class="header-content__button">
                        <b class="header-content__logo-text_b">Личный </b>
                        <i class="header-content__logo-text_i">кабинет</i>
                    </button>
                </a>
            </div>
        </div>
    </header>
    <div id="main" class="body-content">
        <button id="scrollUp" class="body__scroll-up-button" onclick="scrollUp()">
            Наверх
        </button>
        <div class="body-content__main">
            <form id="login" method="post" action="">
                <?php
                if (!$is_auth) echo '<p id="welcome_text">Авторизация</p>
                <input id="login_text" type="text" name="login" minlength="5" maxlength="40" placeholder="Логин" required><br>
                <input id="password" type="password" name="password" minlength="8" placeholder="Пароль" required><br>
                <input id="login_submit" type="submit" name="login_submit" value="Авторизоваться">';
                else echo '<p id="welcome_text">Добро пожаловать, '.$_COOKIE["login_php"].'!</p>
                <input id="logout" type="submit" name="logout" value="Выйти">'; ?>
            </form>
            <?php
            if (!$is_auth) echo '<p id="tr_reg">
                <a href="auth/register">Еще не зарегестрированы?</a>
            </p>'; ?>
            <?php
            if (isset($_GET['error']) and $_GET['error'] === 'f0f95d9f94b3e93ab076013a380330e5d8a5cea77e2786ed8079c4dab84a8969') echo '<p class="alert-text">Неверный логин или пароль</p>';
            if (isset($_GET['error']) and $_GET['error'] === 'be1f869bcedfb66f5b8fa37ce4d65747bdf3c2c0c59b75d5786997ad193ce925') echo '<p class="alert-text">Непредвиденная ошибка регистрации</p>';
            ?>
        </div>
    </div>
</body>
</html>