<?php

class Controller_Register extends Controller
{

	function __construct()	{
		$this->model = new Model_DB();				// инициализация модели работы с БД
		$this->view = new View();
	}
	

	function action_index()	{
		
		$files = $this->model->get_data();	

		$data = [
			'errors' => [],							// массив ошибок
			'messages'=>[],							// массив сообщений
			'auth' => false,						// авторизация
		];

		// обработка кнопки регистрации
		if (isset($_POST['submit']) && isset ($_POST['login']) && isset ($_POST['password']))	{ 			
	
			$reg=true; 															// инициализация

			// проверка длины логина не более 15 символов 
			if (mb_strlen($_POST['login']) > 15)	{
				$data['errors'] [] = "Логин должен быть не больше 15 символов";	
				$reg=false;	
			} 	

			// проверка на допустимые символы: кирилица, латиница, цифры, _,
			//$pattern_name = '/^[а-яА-ЯЁёa-zA-Z0-9_]{1,15}+$/u';			// кирилица, латиница, цифры, _, и макс 15 символов
			$pattern_name = '/^[а-яА-ЯЁёa-zA-Z0-9_]+$/u';
			if (!preg_match($pattern_name, $_POST['login']))	{
				$data['errors'] [] = "Логин может состоять только из букв английского/русского алфавита, цифр и символа \"_\"."; 
				$reg=false;	
			}

			// проверка на существующего пользователя
			$currentuser = parent::checkLogin($files, $_POST['login']);
			if ($currentuser) { 
				$data['errors'] [] = "Такой пользователь уже есть"; 
				$reg=false;
			}

			// запись пользователя в БД
			if ($reg==true) {	

				$login = $_POST['login'];										   
				$sault = parent::generateCode(10);									// генерация случайной 10-значной строки
				$password = md5(md5(trim($_POST['password']), $sault));				// формирование пароля с солью
				$this->model->insert_data($login, $password, $sault);				// запись пользователя в БД

				// проверяем, что пользователь записан
				$files = $this->model->get_data();									
				$currentuser = parent::checkLogin($files, $_POST['login']);
				if ($currentuser) {
					$data['messages'] [] = "Вы успешно зарегистрированы в системе и через несколько секунд 
						будете перенаправлены на главную страницу";	
					$data['auth']=true;
					setcookie("login", $currentuser, time()+60*60*24*30, "/");				// куки семь дней 
				}
					else $data['errors'] [] = "Что-то пошло не так";
			}
		}
		$this->view->generate('register_view.php', 'template_view.php', $data);
	}
}

