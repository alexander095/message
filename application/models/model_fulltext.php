<?php

/**
*Клас роботи з виведенням повного тексту повідомлень
*/
class Model_Fulltext extends Model
{
	/**
	*Функція роботи з базою даних
	*
	*return $records Результат вибірки з бази
	*/
	public function get_data()
	{	
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
		
		if (isset($id)){
		/**
		*Підключаємо базу даних
		*/
		include_once("db.php");

		$records = array();
		$result=mysql_query("SELECT id,title,description_big,date_add,date_change FROM message WHERE id='$id'",$db);
		$myrow=mysql_fetch_array($result);

		/**
		*Якщо повідомлення не редагувалось, присвоїти значення
		*дати створення, як дату редагування
		*/
		if ($myrow["date_change"]=="0000-00-00 00:00:00"){
			$myrow["date_change"]=$myrow["date_add"];
		}else{
			$myrow["date_change"]=$myrow["date_change"];
		}
		/**
		*Занесення результатів вибірки в масив
		*
		*@var array $records Результати вибірки з бази
		*/
		$records [] = $myrow;
		return $records;
		}

	}
}

?>