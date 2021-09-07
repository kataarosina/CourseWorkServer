<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../static/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../static/css/base.css" type="text/css">
    <link rel="stylesheet" href="../static/css/new.css" type="text/css">
    <script rel="script" src="../static/js/base.js" type="application/javascript"></script>
    <title>Новая статья</title>
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
        <div class="body-content__main" style="text-align: center">
            <form method="post" action="../articles" id="new_article" enctype="multipart/form-data">
                <input type="text" id="header_text" name="header" maxlength="50" minlength="5" required placeholder="Заголовок статьи">
                <textarea id="description_text" name="description" maxlength="300" minlength="5" required placeholder="Описание"></textarea>
                <textarea class="text-block" name="text_block" required placeholder="Содержимое статьи (шаблон изображения {!!num!!}, num - номер в списке снизу, num начинается с 0)"></textarea>
                <input type="submit" id="add_submit" name="add" value="Создать статью">
            </form>
            <button id="add_field" onclick="add_field(0)" class="button__adding-img">Добавить изображение</button>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'b54f42b0a66bbe1359bf818170216dba03703359f011e27a6af0bfd1e153a783') {
                echo
                '<div style="text-align: center">
                    <p style="font-size: 20px; font-family: \'Candara Light\'; color: #bb1111">
                        Ошибка загрузки изображений.
                    </p>
                </div>';
            }; ?>
            <script>
                function add_field(num) {
                    let form = document.getElementById('new_article');
                    let button = document.getElementById('add_field');
                    // creating new field
                    let wrapper = document.createElement('div');
                    let field = document.createElement('input');
                    let label = document.createElement('label');
                    // setting attributes
                    wrapper.setAttribute('class', 'input__wrapper');
                    label.setAttribute('for', 'image');
                    label.setAttribute('class', 'img-loader');
                    label.innerText = 'Загрузить изображение';
                    label.addEventListener('click', function() {
                        field.click();
                    });
                    field.setAttribute('style', 'display: none');
                    field.setAttribute('type', 'file');
                    field.setAttribute('id', 'image' + num);
                    field.setAttribute('accept', 'image/jpeg');
                    field.setAttribute('name', 'images[]');
                    field.addEventListener('change', function() {
                        label.innerText = 'Изображение загружено';
                        label.classList.remove('img-loader');
                        label.classList.add('img-loaded');
                    });
                    button.setAttribute('onclick', 'add_field(' + (num + 1) + ')');
                    // pos of last elem
                    let sub = document.getElementById('add_submit');
                    form.insertBefore(wrapper, sub);
                    wrapper.insertBefore(label, null);
                    wrapper.insertBefore(field, label);
                }
            </script>
        </div>
    </div>
</body>
</html>