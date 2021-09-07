<?php

include_once(ROOT.'/components/randHashGen.php');
include_once(ROOT.'/models/Users.php');

class AuthController
{

    public function actionAuth(): bool
    {
        // POST login
        if (isset($_POST['login_submit'])) {
            // 1. Getting the user info from DB using his login
            $user_info = Users::getUserByLogin($_POST['login']);

            // 2. If login not found redirect the client on auth page with GET-parameter error=1
            if ($user_info === false) {
                header('Location: auth?error=f0f95d9f94b3e93ab076013a380330e5d8a5cea77e2786ed8079c4dab84a8969');
                return true;
            }

            // 3. If password does not match with password ib DB then redirect the client on auth page with GET-parameter error=1
            else if (hash('sha256', $_POST['password']) !== $user_info['password_encr']) {
                header('Location: auth?error=f0f95d9f94b3e93ab076013a380330e5d8a5cea77e2786ed8079c4dab84a8969');
                return true;
            }

            // 4. If it's all ok then send the cookies to the client and save the hashed session cookie in DB, then redirect th client on auth page
            else {
                /* If there was an error in hash generating function then redirect the client on auth page with GET-parameter error=2 */
                $res = generateRandomHash();
                if ($res === false) header('Location: auth?error=be1f869bcedfb66f5b8fa37ce4d65747bdf3c2c0c59b75d5786997ad193ce925');
                else {
                    setcookie('login_php', $_POST['login'], time() + 7200, '/');
                    setcookie('session_cookie', $res, time() + 7200, '/');
                    Users::setCookieDB($_POST['login'], hash('sha256', $res));
                    header('Location: auth');
                    return true;
                }
            }
        }

        // POST logout
        if (isset($_POST['logout'])) {
            // Deleting cookies and redirect the client on auth page
            setcookie('login_php', '', time() - 66666666, '/');
            setcookie('session_cookie', '', time() - 66666666, '/');
            header('Location: auth');
            return true;
        }

        // AUTHORIZED check
        // If this variable is false then there will be authorize page, else there will be personal account page
        $is_auth = false;
        if (isset($_COOKIE['login_php']) and isset($_COOKIE['session_cookie']))
        {
            $is_auth = Users::userCookieValidation($_COOKIE['session_cookie']);
        }
        require_once(ROOT.'/views/auth/auth.php');
        return true;
    }

    public function actionRegister(): bool
    {
        // POST register
        if (isset($_POST['submit'])) {
            $errors = array();

            // 1. Checking the entered login
            if (!Users::checkRegisterLogin($_POST['login'])) {
                $errors[] = 'Такой логин недоступен';
            }

            // 2. Checking the entered password
            if (strlen($_POST['password']) < 8) {
                $errors[] = 'Слишком короткий пароль';
            }

            // 3. Checking the entered first name
            if (strlen($_POST['first_name']) < 2) {
                $errors[] = 'Слишком короткое имя';
            }

            // 4. Checking the entered last name
            if (strlen($_POST['last_name']) < 2) {
                $errors[] = 'Слишком короткая фамилия';
            }

            // 5. If there is no errors then register and redirect to auth page
            if (count($errors) === 0) {
                $cook = generateRandomHash();
                if ($cook === false) header('Location: ../auth?error=be1f869bcedfb66f5b8fa37ce4d65747bdf3c2c0c59b75d5786997ad193ce925');
                else {
                    Users::registerUser($_POST['login'], hash('sha256', $_POST['password']),
                        $_POST['first_name'], $_POST['last_name'], $cook);
                    setcookie('login_php', $_POST['login'], time() + 7200, '/');
                    setcookie('session_cookie', $cook, time() + 7200, '/');
                    Users::setCookieDB($_POST['login'], hash('sha256', $cook));
                    header('Location: ../auth');
                    return true;
                }

            }

            // 6. Else open register page and display the errors
            else {
                include_once(ROOT.'/views/auth/register.php');
                return true;
            }
        }

        //AUTHORIZED check
        if (isset($_COOKIE['login_php']) and isset($_COOKIE['session_cookie']))
        {
            if (Users::userCookieValidation($_COOKIE['session_cookie'])) header('Location: ../auth');
        }
        include_once(ROOT.'/views/auth/register.php');
        return true;
    }

}