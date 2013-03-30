<?php
/**
*Клас виведення всіх повідомлень
*/
class Model_Main extends Model
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
		$records = array();
		$result=mysql_query("SELECT id,title,description_small,description_big,date_add,date_change FROM message ORDER BY date_add DESC",$db);
		while ($myrow=mysql_fetch_array($result)){
			/**
			*Якщо повідомлення не редагувалось, присвоїти значення
			*дати створення, як дату редагування
			*/
			if($myrow["date_change"]=="0000-00-00 00:00:00"){
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
		}
	return $records;
	}
}

?>