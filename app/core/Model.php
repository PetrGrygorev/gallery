<?php

class Model							
{

	public function __construct () {
		
		$this->db=DB::link();				// автоматическое подключение к БД
	}

	public function get_data() {}

}