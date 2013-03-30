<?php

/**
*Модель сторінки редагування повідомлення
*Якщо дані не відправлені, показувати форму.
*Коли появляться дані POST показути сторінку результату.
*/
if(!isset($_POST["DateChange"])){
	/**
	*Клас роботи з формою редагування повідомлень
	*/
	class Model_Edit extends Model
	{
		/**
		*Функція роботи з базою даних
		*
		*return $records Результат вибірки з бази
		*/
		public function get_data()
		{	
			/**
			*Підключаємо базу даних
			*/
			include_once("db.php");
			
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

			$records = array();
			$result=mysql_query("SELECT id,title,description_small,description_big,date_change FROM message WHERE id=$id");      
			$myrow=mysql_fetch_array($result);
			/**
			*Занесення результатів вибірки в масив
			*
			*@var array $records Результати вибірки з бази
			*/
			$records [] = $myrow;
			return $records;
	}
}
	
}else{
	/**
	*Клас внесення змін в базу
	*/
	class Model_Edit extends Model
	{
		/**
		*Функція роботи з базою даних
		*
		*return $MessageResult Результат редагування
		*/
		public function get_data()
		{
			include_once("db.php");
			/**
			*Підключаємо клас валідатора
			*/
			include_once("application/classes/edit_validate.php");

			if (isset($Title) && isset($DescriptionSmall) && isset($DescriptionBig) && isset($DateChange)){
				$result=mysql_query("UPDATE message SET title='$Title', description_small='$DescriptionSmall',description_big='$DescriptionBig',date_change='$DateChange' WHERE id='$id' LIMIT 1");
	
				if ($result){
					$MessageResult = "<p align='center' style='color:blue'>Повідомлення змінено</p>";
				}else{
					$MessageResult = "<p align='center' style='color:red'>Виникла помилка<p>";
				}
			}else{
				$MessageResult = "<p align='center' style='color:red'>Ви ввели неповну інформацію</p>";
			}
			return $MessageResult;
		}
	}	
}

?>