<?php

// Including models
include_once ROOT.'/models/Articles.php';
include_once ROOT.'/models/Users.php';

class ArticlesController {

    /**
     *  This function sends a view with articles to the client
     * @return bool
     */
    public function actionList(): bool
    {
        // 1. Checking user's cookie
        if (isset($_COOKIE['login_php']) and isset($_COOKIE['session_cookie']))
        {
            // 2. Checking if the cookies is correct
            if (Users::userCookieValidation($_COOKIE['session_cookie'])) {
                // 3. If so, then checking a POST requests
                if (isset($_POST['add'])) {
                    $header = '';
                    $description = '';
                    $text = '';
                    // 1. Checking and creating header if it's ok
                    if (isset($_POST['header']) && strlen($_POST['header']) <= 50) {
                        $header = $_POST['header'];
                    }
                    else {
                        header('Location: /new');
                        return true;
                    }

                    // 2. Checking and creating description if it's ok
                    if (isset($_POST['description']) && strlen($_POST['description']) <= 300) {
                        $description = $_POST['description'];
                    }
                    else {
                        header('Location: /new');
                        return true;
                    }

                    // 3. Checking the images
                    $is_all_loaded = True;
                    if (isset($_FILES['images']['error'])) {
                        foreach ($_FILES['images']['error'] as $key => $error) {
                            if ($error != UPLOAD_ERR_OK) {
                                $is_all_loaded = False;
                                break;
                            }
                        }
                    }
                    if (!$is_all_loaded) {
                        header('Location: /new?error=b54f42b0a66bbe1359bf818170216dba03703359f011e27a6af0bfd1e153a783');
                        return true;
                    }

                    // 4. Creating text
                    $text = $_POST['text_block'];

                    // 5. Transfer data to DB
                    Articles::createNewArticle($header, $description, $text);
                }
                if (isset($_POST['edit'])) {
                    $fp = fopen(ROOT.'/static/articlesStorage/texts/'.$_POST['file_path'], 'w');
                    fwrite($fp, $_POST['text_block']);
                    fclose($fp);
                    header('Location articles');
                }
                $articlesList = Articles::getAllArticles();
                require_once(ROOT.'/views/articles/articles.php');
                return true;
            }
            // 4. If there was any problem then the user is not authorized, redirect him on authorizing page
            else {
                header('Location: auth');
                return true;
            }
        }
        else {
            header('Location: auth');
        }
        return true;
    }

    /**
     *  This function sends a view with the full article to the client
     *  Logic is the same as in actionList()
     * @param $article_id
     * @return bool
     */
    public function actionArticle($article_id): bool
    {
        if (isset($_COOKIE['login_php']) and isset($_COOKIE['session_cookie']))
        {
            if (Users::userCookieValidation($_COOKIE['session_cookie'])) {
                $article = Articles::getArticleById($article_id);
                if ($article !== false) {
                    $path_to_file = ROOT.'/static/articlesStorage/texts/'.$article['file_name'];
                    $fp = fopen($path_to_file, 'r');
                    $text = fread($fp, 100000000);
                    fclose($fp);
                    $header = $article['header'];
                    require_once(ROOT . '/views/articles/article.php');
                    return true;
                }
                else {
                    header("HTTP/1.0 404 Not Found");
                    return true;
                }
            }
            else {
                header('Location: ../auth');
                return true;
            }
        }
        else {
            header('Location: ../auth');
        }
        return true;
    }

    /**
     *  This function sends a view with the form of adding a new article
     *  Logic is the same as in actionList()
     * @return bool
     */
    public function actionNew(): bool
    {
        if (isset($_COOKIE['login_php']) and isset($_COOKIE['session_cookie']))
        {
            if (Users::userCookieValidation($_COOKIE['session_cookie'])) {
                require_once(ROOT.'/views/articles/new.php');
                return true;
            }
            else {
                header('Location: ../auth');
                return true;
            }
        }
        else {
            header('Location: ../auth');
        }
        return true;
    }

    /**
     *  This function sends a view with the form of editing an existing
     *  Logic is the same as in actionList()
     * @param $article_id
     * @return bool
     */
    public function actionEdit($article_id): bool
    {
        if (isset($_COOKIE['login_php']) and isset($_COOKIE['session_cookie']))
        {
            if (Users::userCookieValidation($_COOKIE['session_cookie'])) {
                $article = Articles::getArticleById($article_id);
                if ($article !== false) {
                    $path_to_file = ROOT.'/static/articlesStorage/texts/'.$article['file_name'];
                    $fp = fopen($path_to_file, 'r');
                    $text = fread($fp, 100000000);
                    fclose($fp);
                    $header = $article['header'];
                    require_once(ROOT . '/views/articles/edit.php');
                    return true;
                }
                else {
                    header("HTTP/1.0 404 Not Found");
                    return true;
                }
            }
            else {
                header('Location: ../../auth');
                return true;
            }
        }
        else {
            header('Location: ../../auth');
        }
        return true;
    }

    /**
     *  This function sends a view with the form of editing an existing
     *  Logic is the same as in actionList()
     * @param $article_id
     * @return bool
     */
    public function actionDelete($article_id): bool
    {
        if (isset($_COOKIE['login_php']) and isset($_COOKIE['session_cookie']))
        {
            if (Users::userCookieValidation($_COOKIE['session_cookie'])) {
                $article = Articles::getArticleById($article_id);
                if ($article !== false) {
                    Articles::deleteArticle($article_id);
                    header('Location: ../../articles?success=cdc172b53e6ab366b411ef70ed0243b385f43edae1d8e06dbc8fe911c46ef993');
                    return true;
                }
                else {
                    header("HTTP/1.0 404 Not Found");
                    return true;
                }
            }
            else {
                header('Location: ../../auth');
                return true;
            }
        }
        else {
            header('Location: ../../auth');
        }
        return true;
    }
}