<?php

define('URL', __DIR__ . DIRECTORY_SEPARATOR); 
define ('APP', URL . 'app' . DIRECTORY_SEPARATOR);                 //    директория   \app\
define ('VIEWS', APP . 'views' . DIRECTORY_SEPARATOR);             //    директория   \app\views\
define ('CONTROLLERS', APP . 'controllers' . DIRECTORY_SEPARATOR); //    директория   \app\controllers\
define ('MODELS', APP . 'models' . DIRECTORY_SEPARATOR);           //    директория   \app\models\
define ('IMAGES', 'images' . DIRECTORY_SEPARATOR);                  //   директория   \images\
define ('COMMENTS', 'comments' . DIRECTORY_SEPARATOR);              //   директория   \comments\


define('UPLOAD_MAX_SIZE', 1000000); // 1mb
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);

define ('HOST', 'localhost');                                       // определите  наименование хоста
define ('USER', 'root');                                            // определите имя пользователя БД
define ('PASSWORD', '');                                            // определите пароль к БД
define ('DB_NAME', 'test');                                         // определите наименование БД