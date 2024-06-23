<?php


class Controller_Photopage extends Controller
{

	public function __construct()	 {				
	    $this->model = new Model_Comments();		// инициализация модели чтения комментариев
	 	$this->view = new View();	
	}

	function action_index()	{	

        // так как у нас методом POST обрабатываются две операции: зайти на картинку и удалить комметарий,
        // то надо сохранить имя файла в сессии
        if (!empty($_POST['name'])) {               
            $_SESSION ['name'] =  $_POST['name'];
        }
        $imageFileName = $_SESSION ['name'];
        $commentFilePath = COMMENTS. $imageFileName . '.txt';

		$data = [
			'errors' => [],                         // массив ошибок
			'messages'=>[],                         // массив сообщений
			'auth' => false,                        // авторизация
            'imageFileName' => $imageFileName,      // имя файла
            'commentFilePath' => $commentFilePath,  // имя файла комментариев
		];

        // обработка крестика удаления комментария
        if(isset($_POST['delete'])) {                   
            $key = $_POST['delete'];
            $this->model->delete_commet($key, $commentFilePath);    
            $data['messages'][] = 'Комментарий был удалён';
        };

        // если зашли под логином
        if (isset($_COOKIE['login'])) { 
            $data['auth'] = true; 
            $author = $_COOKIE['login'];
        } else $author='';

        // Если коммент был отправлен
        if(!empty($_POST['comment'])) {

            $comment = trim($_POST['comment']);         // удаляем пробелы

            // Валидация коммента
            if($comment === '') {                   
            $data['errors'][] = 'Вы не ввели текст комментария';
            }

            // Если нет ошибок записываем коммент
            if(empty($data['errors'])) {
                $this->model->get_commets($comment, $author, $commentFilePath);
                $data['messages'][] = 'Комментарий был добавлен';
            }
        }

        // считываем содержимое файла комментариев и помещаем в массив
        $comments = file_exists($commentFilePath)? file($commentFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES): [];
        $data ['comments'] = $comments ;

        // формируем массив автором комментариев для обработки удаления комментария только автором
        $authors = [];
        foreach ($comments as $value)  {
            $temp = explode(" ", $value);                   // делим на слова
            $authors[] = substr($temp [2], 0, -1);          // выбираем только авторов, удаляем у каждого ":"
        }

         $data ['authors'] = $authors ;                     // сохраняем массив авторов 
         $data ['cur_author'] = $author ;                   // текущий автор

		$this->view->generate('photopage_view.php', 'template_view.php', $data);	
	}

}