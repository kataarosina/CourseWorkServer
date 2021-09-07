<?php
// FRONT CONTROLLER


// 1. Including the system files
define('ROOT', dirname(__FILE__));  // Defining ROOT const
require_once(ROOT.'/components/router.php');
require_once(ROOT.'/components/db.php');


// 2. Router call
$router = new Router();  // Transferring control to the router
$router->run();
