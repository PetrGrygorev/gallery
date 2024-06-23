<?php


class Model_DB extends Model
{
	
	//метод получает массив данных пользователей
	public function get_data()	{	
		
		$result = $this->db->query('SELECT * FROM users');
        $data = $result->FetchAll(PDO::FETCH_ASSOC);
        return $data;

	}

	// метод вставляет в БД строку с логином, паролью и солью
	public function insert_data( $login, $password, $sault)	{	
		
		// первый способ - прямая вставка
		//$sql = "INSERT INTO users SET login='".$login."', password='".$password."', sault='".$sault."'";
		//$this->db -> exec($sql);

		// второй способ - подготовленные запросы. Предпочтительней.
		$sql = "INSERT INTO users (login, password, sault) VALUES (:login, :password, :sault)";
		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':login', $login);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':sault', $sault);
		$stmt->execute();

	}
	
}