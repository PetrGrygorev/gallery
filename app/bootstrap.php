<?php

session_start();

// подключаем файлы ядра
require_once 'core'. DIRECTORY_SEPARATOR . 'Controller.php';
require_once 'core'. DIRECTORY_SEPARATOR . 'DB.php';
require_once 'core'. DIRECTORY_SEPARATOR . 'Model.php';          
require_once 'core'. DIRECTORY_SEPARATOR . 'Route.php';
require_once 'core'. DIRECTORY_SEPARATOR . 'View.php';

require_once 'models'. DIRECTORY_SEPARATOR . 'model_Comments.php';
require_once 'models'. DIRECTORY_SEPARATOR . 'model_DB.php';
require_once 'models'. DIRECTORY_SEPARATOR . 'model_Scan.php';

Route::start();   // запускаем маршрутизатор





