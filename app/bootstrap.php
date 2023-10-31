<?php

session_start();
require_once dirname(__DIR__).'/config/config.php';
require_once dirname(__DIR__).'/vendor/autoload.php'; 
App\Core\Route::start();
