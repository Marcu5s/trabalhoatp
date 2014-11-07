<?php
define('WWW_ROOT',dirname(__FILE__)); 
     
$config= WWW_ROOT.'/protected/config/main.php';
$app   = WWW_ROOT.'/core/src/app.php';
require_once $config;
require_once $app;