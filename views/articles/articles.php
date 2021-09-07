<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/static/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="/static/css/base.css" type="text/css">
    <link rel="stylesheet" href="/static/css/articles.css" type="text/css">
    <script rel="script" src="/static/js/base.js" type="application/javascript"></script>
    <title>Список учебных статей</title>
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
            <p class="body-content__adding-article">
                <?php
                if (isset($_GET['success']) && $_GET['success'] === 'cdc172b53e6ab366b411ef70ed0243b385f43edae1d8e06dbc8fe911c46ef993') {
                    echo 'Статья удалена';
                }
                ?>
                <a href="articles/new">
                    <button class="body-content__adding-article-button">
                        Новая статья
                    </button>
                </a>
            </p>
            <?php
            for ($i = 0; $i < count($articlesList); $i++) {
            echo
            '<div class="body-content__article">
                <p class="article__interact">
                    <b class="article__interact-action">
                        <a href="articles/delete/'.$articlesList[$i]["id"].'">
                            <u class="article__interact-action">
                                Удалить
                            </u>
                        </a>
                          |  
                        <a href="articles/edit/'.$articlesList[$i]["id"].'">
                            <u class="article__interact-action">
                                Править
                            </u>  
                        </a>
                    </b>
                </p>
                <a href = "articles/'.$articlesList[$i]["id"].'">    
                    <h3 class="article__name">
                        '.$articlesList[$i]["header"].'
                    </h3>
                </a>
                <p class="article__description">
                    '.$articlesList[$i]["description"].'
                </p>
            </div>';
            }
            ?>
        </div>
    </div>
</body>
</html>