<?php

include_once(ROOT.'/components/db.php');

class Users
{

    /**
     *  This function sends a request to database and if login is right returns a user info
     * @param $login
     * @return mixed
     */
    public static function getUserByLogin($login) {
        // 1. Getting connection with DB
        $db = DB::connectToDB();

        // 2. Forming MySQL request
        $result = $db->prepare('SELECT login, password_encr FROM users WHERE login = :login');
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // 3. Return user info if found
        return $result->fetch();
    }

    /**
     *  This function sends a cookie to previously authorized user into DB
     * @param $login
     * @param $cookie
     * @return bool
     */
    public static function setCookieDB($login, $cookie): bool
    {
        // 1. Getting connection with DB
        $db = DB::connectToDB();

        // 2. Forming MySQL request
        $result = $db->prepare('UPDATE users SET cookie = :cookie WHERE login = :login');
        $result->bindParam(':cookie', $cookie, PDO::PARAM_STR);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // 3. Return true
        return true;
    }

    /**
     *  This function sends a request to database and if login is right returns a current cookie for user
     * @param $login
     * @return mixed
     */
    public static function getCookie($login)
    {
        // 1. Getting connection with DB
        $db = DB::connectToDB();

        // 2. Forming MySQL request
        $result = $db->prepare('SELECT cookie FROM users WHERE login = :login');
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // 3. Return cookie if user found
        return $result->fetch();
    }

    /**
     *  This function checks is requested cookie is valid
     * @param $hashed_cookie
     * @param $requested_cookie
     * @return bool
     */
    public static function userCookieValidation($requested_cookie): bool
    {
        // 1. Getting cookie from DB using login in cookie
        $cookie_db = Users::getCookie($_COOKIE['login_php'])['cookie'];

        // 2. If there is no cookie or cookies does not match then return false
        if ($cookie_db === false)
        {
            return false;
        }
        else if ($cookie_db !== hash('sha256', $requested_cookie)) {
            return false;
        }

        // 3. If it's ok then return true
        else {
            return true;
        }
    }

    /**
     *  This function checks is registration login is valid
     * @param $login
     * @return bool
     */
    public static function checkRegisterLogin($login): bool
    {
        // 1. Checking the length of entered login
        if (strlen($login) < 5) return false;

        // 2. Getting connection with DB
        $db = DB::connectToDB();

        // 3. Forming MySQL request
        $result = $db->prepare('SELECT * FROM users WHERE login = :login');
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // 4. Return true if user with entered login is not found
        if ($result->fetch() === false) {
            return true;
        }
        else return false;
    }

    /**
     *  This function sends a request to database to register a new user
     * @param $login
     * @param $password_encr
     * @param $first_name
     * @param $last_name
     * @param $cookie
     * @return bool
     */
    public static function registerUser($login, $password_encr, $first_name, $last_name, $cookie): bool
    {
        // 1. Getting connection with DB
        $db = DB::connectToDB();

        // 2. Forming MySQL request
        $result = $db->prepare('INSERT INTO users (login, password_encr, first_name, last_name, cookie) 
        VALUES (:login, :password_encr, :first_name, :last_name, :cookie)');
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password_encr', $password_encr, PDO::PARAM_STR);
        $result->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $result->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $result->bindParam(':cookie', $cookie, PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // 3. Return true
        return true;
    }

    public static function getUserName($login)
    {
        // 1. Getting connect with DB
        $db = DB::connectToDB();

        // 2. Forming MySQL request
        $result = $db->prepare('SELECT first_name, last_name FROM users WHERE login = :login');
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // 3. Return data
        return $result->fetch();
    }
}