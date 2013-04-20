<?php

class DataBase {

    /**
    *param $db Єдиний екземпляр класу, щоб не створювати безліч підключень
    *param $mysqli Идентифікатор зєднання
    */
    private static $db = null;
    public $mysqli;

    /**
    *Отримання екземпляра класу. Якщо він вже існує, то повертається, якщо його не було, то створюється і повертається
    */
    public static function getDB() {
        if (self::$db == null) self::$db = new DataBase();
        return self::$db;
    }

     /**
     * private конструктор, підключається до бази даних, встановлює локаль і кодування з'єднання
     */
    private function __construct() {
        $this->mysqli = new mysqli("localhost", "user", "12345", "message_db");
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    /**
     * При знищенні об'єкта закривається з'єднання з базою даних
     */
    public function __destruct() {
        if ($this->mysqli) $this->mysqli->close();
    }
}

/**class Database
{
	public function MySqli()
	{
		$mysqli = new mysqli('localhost','user','12345','message_db');
		if (mysqli_connect_errno()){
			print("Підключення до сервера бази даних неможливе");
			exit;
		}
		$mysqli->query("SET NAMES 'utf8'");
        return $mysqli;
	}
}
 * */