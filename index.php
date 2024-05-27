<?php

session_start();

include_once('Configuration.php');
$configuration = new Configuration();
$router = $configuration->getRouter();

$module = isset($_GET['module']) ? $_GET['module'] : 'login';
$method = isset($_GET['action']) ? $_GET['action'] : 'list';

$router->route($module, $method);