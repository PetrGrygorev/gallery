<?php

class Model_Comments extends Model									
{
	
    // метод записывает комметарий, время, автора в файл
	public function get_commets ($comment, $author, $commentFilePath)   {	
            // Чистим текст, земеняем переносы строк на <br/>, дописываем дату
            $comment = strip_tags($comment);
            $temp = array("\r\n","\r","\n","\\r","\\n","\\r\\n");
            $comment = str_replace( $temp,"<br/>", $comment);
            $comment = date('d.m.y H:i ') . $author. ': '.  $comment;

            // Дописываем текст в файл (будет создан, если еще не существует)
            file_put_contents($commentFilePath,  $comment . "\n", FILE_APPEND);
	}

    // метод удаляет комметарий по ключу
    public function delete_commet($key, $commentFilePath) {

        $array = file($commentFilePath);
        unset ($array[$key]);
        $array = array_values($array);

        // записываем массив обратно в файл
        file_put_contents($commentFilePath, $array);
    }
}