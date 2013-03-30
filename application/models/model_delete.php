<?php

/**
*Клас роботи з отриманими даними POST
*/
class Model_Delete extends Model
{
	public function get_data()
	{	
		/**
		*Підключаємо базу даних
		*/
		include ("db.php");
		
		/**
		*Перевірка змінної на вміст тільки цифр
		*/
		if(isset($_POST['id'])){		
				if(!preg_match("/^[0-9]{1,10}$/",$_POST['id'])){
					die("Неправильний формат числа! Можна використовувати тільки цифри");
				}else{
					$id=$_POST['id'];
				}
		}else{
			die("Повідомлення не знайдено");
		}		

		if(isset($id)){
			$result=mysql_query("DELETE FROM message WHERE id='$id' LIMIT 1");
				if($result) {
					$MessageResult="<p>Повідомлення видалено.</p>";
				}
				else{
					$MessageResult="<p>Виникла помилка.<p>";
				}
		}else{
			echo "<p>Неможливо видалити повідомлення<a href='message.php'>Повернутись назад</a></p>";
		}
		return $MessageResult;
	}
}

?>