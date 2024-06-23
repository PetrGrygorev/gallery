<?php


class Controller {
	
	public $model;
	public $view;

	function __construct()		{						

		$this->view = new View();				
	}
	
	public function action_index()	{}				//определим в дочерних классах

	// метод генерации строки из случайных символов
	public function generateCode ($length=10) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;
		while (strlen($code) < $length) {
				$code .= $chars[mt_rand(0,$clen)];
		}
		return $code;                                          
	} 

	// метод проверки наличия текущего пользователя в массиве
	public function checkLogin ($array, $login) {
		foreach ($array as $key => $value) {
			if ($array[$key]['login'] == $login) {
				return $array[$key]['login'];
			}
			elseif ($key == count ($array)) {return false;};
		}
	}

	// метод возвращает пароль и соль по логину
	public function passwordSaultBD ($array, $login) {
		$key = array_search($login , array_column($array, 'login'));
		return [$array[$key]['password'],  $array[$key]['sault']];
	}

}






