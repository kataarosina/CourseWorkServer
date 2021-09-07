<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../static/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../static/css/base.css" type="text/css">
    <link rel="stylesheet" href="../../static/css/new.css" type="text/css">
    <script rel="script" src="../../static/js/base.js" type="application/javascript"></script>
    <title>Редактирование "<?php echo $header; ?>"</title>
</head>
<body>
<header>
    <div class="header-content">
        <div class="header-content__logo-place">
            <?php echo '<a href="../../../'.FOLDER_NAME.'">'; ?>
                <button class="header-content__button">
                    <b class="header-content__logo-text_b">ООП </b>
                    <i class="header-content__logo-text_i">в PHP</i>
                </button>
            </a>
        </div>
        <div class="header-content__logo-place">
            <a href="../../articles">
                <button class="header-content__button">
                    <b class="header-content__logo-text_b">Учебные </b>
                    <i class="header-content__logo-text_i">статьи</i>
                </button>
            </a>
        </div>
        <div class="header-content__logo-place">
            <a href="../../auth">
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
    <div class="body-content__main" style="text-align: center">
        <form method="post" action=".." id="new_article" enctype="multipart/form-data">
            <b style="font-size: 30px; font-family: Arial; color: #992222">Не удалять тэги, если этого не требуется!</b>
            <input type="hidden" name="file_path" value="<?php echo $article['file_name']; ?>">
            <textarea class="text-block" name="text_block" required><?php echo $text; ?></textarea>
            <input type="submit" id="add_submit" name="edit" value="Править текст статьи">
        </form>
    </div>
</div>
</body>
</html>