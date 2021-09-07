<?php


class DB
{

    /**
     * @return PDO
     */
    public static function connectToDB(): PDO
    {
        // 1. Getting the DB settings from config file
        $params_path = ROOT.'/config/db_conf.php';
        include_once($params_path);
        $params = getConfDB();

        // 2. Forming PDO object
        $host_db = 'mysql:host='.$params['host'].';dbname='.$params['dbname'];
        return new PDO($host_db, $params['user'], $params['password']);
    }

}
