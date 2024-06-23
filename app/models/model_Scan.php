<?php

class Model_Scan extends Model									
{

	// метод сканирует каталог с фото "IMAGES" и возвращает массив файлов
	public function get_data()	{	
		$files = scandir(IMAGES);
		$files = array_filter($files, function ($file) {

			return !in_array($file, ['.', '..', '.gitkeep']);

		});
		
		return $files;
	}
}
