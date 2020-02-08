<?php

session_start();

if (empty($_SESSION['pseudo']) AND empty($_SESSION['password']) AND empty($_SESSION['connected']) AND empty($_SESSION['permission'])) {
    $_SESSION['pseudo'] = '';
    $_SESSION['password'] = '';
    $_SESSION['connected'] = '';
    $_SESSION['permission'] = 0;
}

require_once('controllers/Router.php');
$router = new Router();
$router->routeReq();
