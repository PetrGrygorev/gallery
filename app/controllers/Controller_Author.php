<?php


class Controller_Author extends Controller
{
	
	public function __construct()	{
		$this->model = new Model_DB();				// инициализация объекта модели БД
		$this->view = new View();					// инициализация объекта представления
	}

	public function action_index()								
	{
		$files = $this->model->get_data();			// получение полного массива пользователей: id, login, password, sault 
		
		$data = [								
			'errors' => [],							// массив ошибок
			'messages'=>[],							// массив сообщений
		];

		// обработка кнопки
		if (isset($_POST['submit']) && isset ($_POST['login']) && isset ($_POST['password']))	{

			// Проверяем, есть ли в БД логин, равный логину введенному
			$sault = ''; $passwordBD = '';
			$currentuser = parent::checkLogin($files, $_POST['login']);

			if ($currentuser) {
				$temp = parent::passwordSaultBD($files, $currentuser);		// если пользователь есть, 
				$passwordBD = $temp[0]; 									// то считываем его пароль и соль пароля
				$sault = $temp[1];			
			}

			// проверяем введённый пароль
			if ($passwordBD == md5(md5(trim($_POST['password']), $sault)))	{
				setcookie("login", $currentuser, time()+60*60*24*7, "/");			// куки семь дней 
				header("Location: http:\\");										// переход на главную страницу
			}
			elseif ($currentuser)	{
				$data ['errors'] [] ="Вы ввели неправильный пароль";
			}
			else $data ['errors'] [] ="Такой пользователь не зарегистрирован";
		}

		$this->view->generate('author_view.php','template_view.php', $data);			// генерация изображения
	}

}

