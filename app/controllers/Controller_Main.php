<?php


class Controller_Main extends Controller
{

	public function __construct()	{				
		$this->model = new Model_Scan();			// инициализация модели сканирования каталога
	 	$this->view = new View();	
	}

	function action_index()	{	

		$data = [								
			'errors' => [],							// массив ошибок
			'messages'=>[],							// массив сообщений
			'auth' => false,						// авторизация
		];

		// обработка кнопки добавления файла
		if (!empty($_FILES)) {                       

			for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

				$fileName = $_FILES['files']['name'][$i];

				// Проверяем размер
				if ($_FILES['files']['size'][$i] > UPLOAD_MAX_SIZE) {
					$data ['errors'] [] = 'Недопустимый размер файла ' . $fileName;
					continue;																// выходим из for
				}
		
				// Проверяем формат
				if (!in_array($_FILES['files']['type'][$i], ALLOWED_TYPES)) {
					$data ['errors'][] = 'Недопустимый формат файла ' . $fileName;
					continue;
				}
	
				// Проверяем наличие файла с таким именем
				$data['files'] = $this->model->get_data();					// извлекаем данные из модели сканирования диска model_Scan
				foreach ($data['files'] as $value)	{
					if ($_FILES['files']['name'][$i] == $value)  {
						$data ['errors'][] = 'Такой файл уже есть ' . $fileName;
						continue;															// выходим из for
					}
				}
				
				$filePath = IMAGES . basename($fileName);									// задаём путь хранения файла
		
				// Пытаемся загрузить файл
				if (!move_uploaded_file($_FILES['files']['tmp_name'][$i], $filePath)) {
					$data['errors'] [] = 'Ошибка загрузки файла ' . $fileName;
					continue;
				}
			}		//end for
		
			if (empty($data['errors'])) {
				$data['messages'][] = 'Файл(ы) были загружены';
			}
		}
		
		// обработка кнопки удаления файла
		if (!empty($_POST['name'])) {                                                             
		
			$filePath = IMAGES . DIRECTORY_SEPARATOR . $_POST['name'];
			$commentPath = COMMENTS. $_POST['name'] . '.txt';
		
			// Удаляем изображение
			unlink($filePath);
		
			// Удаляем файл комментариев, если он существует
			if(file_exists($commentPath)) {
				unlink($commentPath);
			}
			$data['messages'][] = 'Файл был удален';
		}
		

		$data['files'] = $this->model->get_data();							// извлекаем данные из модели сканирования диска model_Scan

		if (isset($_COOKIE['login'])) { 									// проверяем куки
			$data['auth'] = true;
		};				

		$this->view->generate('main_view.php', 'template_view.php', $data);	// генерация изображения
	}

}


