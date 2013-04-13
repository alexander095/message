<?php

class Database
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