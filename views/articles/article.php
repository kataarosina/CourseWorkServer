<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../static/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../static/css/base.css" type="text/css">
    <script rel="script" src="../static/js/base.js" type="application/javascript"></script>
    <title><?php echo $header; ?></title>
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
        <div class="body-content__main" style="font-size: 20px; font-family: 'Candara Light'; ">
            <p style="background: linear-gradient(45deg, #cccccc, #ffffff, #cccccc);
            text-align: center; font-size: 35px; font-family: Candara; border-style: hidden;
            border-bottom-left-radius: 15px; border-bottom-right-radius: 15px">
                <?php
                echo $header;
                ?>
            </p>
            <?php
            echo $text;
            ?>
        </div>
    </div>
</body>
</html>