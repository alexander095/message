<?php

/**
*Клас роботи з отриманими даними POST
*/
class Model_Add extends Model
{
	/**
	*Функція роботи з базою даних
	*
	*return $MessageResult Результат добавлення повідомлення
	*/
	public function get_data()
	{	
		/**
		*Підключаємо базу даних
		*/
		include_once("db.php");
		/**
		*Підключаємо клас валідатора
		*/
		include_once("application/classes/add_validate.php");

		/**
		*Занесення дати в змінну
		*
		*@var date $date Поточна дата
		*/
		$Date=date("Y-m-d H:i:s");	

		if(isset($Title) && isset($DescriptionSmall) && isset($DescriptionBig) && isset($Date)){
			$result=mysql_query("INSERT INTO message (title,description_small,description_big,date_add) VALUES	('$Title','$DescriptionSmall','$DescriptionBig','$Date')");
				if($result) {
					$MessageResult="<p align='center' style='color:blue'>Повідомлення добавлено</p>";
				}else{
					$MessageResult="<p align='center' style='color:red'>Виникла помилка<p>";
				}
		}else{
			$MessageResult="<p align='center' style='color:red'>Ви ввели неповну інформацію</p>";
		}
		return $MessageResult;
	}
}

?>