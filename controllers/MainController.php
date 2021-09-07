<?php

include_once(ROOT.'/models/Users.php');

class MainController {

    /**
     *  This function sends a view of the main page to the client
     *  Logic the same as in actionList() in ArticlesController
     * @return bool
     */
    public function actionIndex(): bool
    {
        if (isset($_COOKIE['login_php']) and isset($_COOKIE['session_cookie']))
        {
            if (Users::userCookieValidation($_COOKIE['session_cookie'])) {
                $context_data = Users::getUserName($_COOKIE['login_php']);
                include_once(ROOT . '/views/main/main.php');
            }
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

}
