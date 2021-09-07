<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../static/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../static/css/base.css" type="text/css">
    <link rel="stylesheet" href="../static/css/register.css" type="text/css">
    <script rel="script" src="../static/js/base.js" type="application/javascript"></script>
    <title>Регистрация</title>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-content__logo-place">
                <?php echo '<a href="../../'.FOLDER_NAME.'">'; ?>
                    <button class="header-content__button">
                        <b class="header-content__logo-text_b">ООП </b>
                        <i class="header-content__logo-text_i">в PHP</i>
                    </button>
                </a>
            </div>
            <div class="header-content__logo-place">
                <a href="../articles">
                    <button class="header-content__button">
                        <b class="header-content__logo-text_b">Учебные </b>
                        <i class="header-content__logo-text_i">статьи</i>
                    </button>
                </a>
            </div>
            <div class="header-content__logo-place">
                <a href="../auth">
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
            <form id="register" action="" method="post">
                <p id="reg_text">Регистрация</p>
                <input type="text" id="login_text" maxlength="40" minlength="5" name="login" placeholder="Логин (не менее 5 символов)" required>
                <input type="password" id="password_text" minlength="8" name="password" placeholder="Пароль (не менее 8 символов)" required>
                <input type="text" id="first_name_text" minlength="2" maxlength="30" name="first_name" placeholder="Имя" required>
                <input type="text" id="last_name_text" minlength="2" maxlength="30" name="last_name" placeholder="Фамилия" required>
                <input type="submit" id="submit" name="submit" value="Зарегистрироваться">
            </form>
        </div>
    </div>
</body>
</html>