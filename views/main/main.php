<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/static/images/icon.png" type="image/png">
    <link rel="stylesheet" href="/static/css/base.css" type="text/css">
    <link rel="stylesheet" href="/static/css/main.css" type="text/css">
    <script rel="script" src="/static/js/base.js" type="application/javascript"></script>
    <title>ООП в PHP</title>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-content__logo-place">
                <a href="">
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
            <p class="body-content__text"><?php echo "Добро пожаловать, ".$context_data['last_name'].' '.$context_data['first_name']."."; ?></p>
            <p class="body-content__text">
                Вы попали на учебный портал, где сможете узнать подробно об устройстве ООП на PHP.
            </p>
            <p class="body-content__text_end">
                Приятного изучения!
            </p>
        </div>
    </div>
</body>
</html>