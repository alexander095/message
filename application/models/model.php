<?php
include('db.php');

class Model_Registration extends Model
{
	/**
	*Функція роботи з базою даних
	*
	*@return $MessageResult Результат добавлення повідомлення
	*/
	public function get_data()
	{ 
		/**
		*Звернення до класу валідатора для занесення в змінні
		*результату функцій по перевірці даних.
		*/
		$RegLogin=Registration_Validate::checkRegLogin();
		$RegPass=Registration_Validate::checkRegPass();
		$RegPassTwo=Registration_Validate::checkRegPassTwo();
		$EncryptPass=Registration_Validate::PassEncryption();
		$RegEmail=Registration_Validate::checkRegEmail();

		/**
		*Занесення дати в змінну
		*
		*@var date $date Поточна дата
		*/
		$RegDate=date("Y-m-d H:i:s");
		
		/**
		*Перевірка на існування в базі введеного логіна і email
		*/
		$ResultLogin=Database::mysqli()->query("SELECT login FROM users WHERE login = '$RegLogin'");
		$ResultEmail=Database::mysqli()->query("SELECT email FROM users WHERE email = '$RegEmail'");
		/**
		*Перевірка рядків за вмістом введеного логіна і email
		*/
		$RowNumLogin = mysqli_num_rows($ResultLogin);
		$RowNumEmail = mysqli_num_rows($ResultEmail);
		if($RowNumLogin <= 0){
			if($RowNumEmail <= 0){
				if(isset($RegLogin) && isset($RegPass) && isset($RegEmail) && isset($RegPassTwo)){
					$result=Database::mysqli()->query("INSERT INTO users (login,pass,email,date) VALUES	('$RegLogin','$EncryptPass','$RegEmail','$RegDate')");
					if($result){
						echo "<p align='center'>Ви успішно зареєстровані</p>";
					}else{
						echo "<p align='center'>Виникла помилка</p>";
					}
				}else{
					echo "<p align='center'>Ви ввели неповну інформацію</p>";
				}
			}else{
				echo "<p align='center'>Такий Email вже існує</p>";
			}
		}else{
			echo "<p align='center'>Такий логін вже існує</p>";
		}
	}
}

/**
*Клас роботи з отриманими даними по добавленню
*нового повідомлення
*/
class Model_Add extends Model
{
	/**
	*Функція роботи з базою даних
	*
	*@return $MessageResult Результат добавлення повідомлення
	*/
	public function get_data()
	{ 
	
		
		/**
		*Звернення до класу валідатора для занесення в змінні
		*результату функцій по перевірці даних.
		*/
		$Title=Add_Validate::checkTitle();
		$DescriptionSmall=Add_Validate::checkDescSmall();
		$DescriptionBig=Add_Validate::checkDescBig();

		/**
		*Занесення дати в змінну
		*
		*@var date $date Поточна дата
		*/
		$Date=date("Y-m-d H:i:s");	

		if(isset($Title) && isset($DescriptionSmall) && isset($DescriptionBig) && isset($Date)){
			$result=Database::mysqli()->query("INSERT INTO message (title,description_small,description_big,date_add) VALUES	('$Title','$DescriptionSmall','$DescriptionBig','$Date')");
				if($result) {
					echo "<p align='center'>Повідомлення успішно додано</p>";
				}else{
					echo "<p align='center'>Виникла помилка</p>";
				}
		}else{
			echo "<p align='center'>Ви ввели неповну інформацію</p>";
		}
	}
}

/**
*Клас роботи з отриманими даними по виведенню
*всіх повідомлень
*/
class Model_Main extends Model
{
	/**
	*Функція роботи з базою даних
	*
	*@return $records Результат вибірки з бази
	*/
	public function get_data()
	{	
		$records = array();
		$result=Database::mysqli()->query("SELECT id,title,description_small,description_big,date_add,date_change FROM message ORDER BY date_add DESC");
		while ($myrow=$result->fetch_assoc()){
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

/**
*Клас роботи з отриманими даними по виведенню
*повного тексту конкретного повідомлення
*/
class Model_Fulltext extends Model
{
	/**
	*Функція роботи з базою даних
	*
	*@return $records Результат вибірки з бази
	*/
	public function get_data()
	{	
		/**
		*Звернення до класу контролера для занесення в змінну
		*результату функції по перевірці ідентифікатора.
		*/
		$id=Controller_Fulltext::checkId();
		
		$records = array();
		$result=Database::mysqli()->query("SELECT id,title,description_big,date_add,date_change FROM message WHERE id='$id'");
		$myrow=$result->fetch_assoc();

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


/**
*Клас роботи з отриманими даними по редагуванні
*конкретного повідомлення
*/
class Model_Edit extends Model
{
	/**
	*Функція роботи з базою даних
	*
	*@return $records Результат вибірки з бази
	*/
	public function get_data()
	{		
		/**
		*Звернення до класу контролера для занесення в змінну
		*результату функції по перевірці ідентифікатора.
		*/
		$id=Controller_Edit::checkId();
	
		$records = array();
		$result=Database::mysqli()->query("SELECT id,title,description_small,description_big,date_change FROM message WHERE id=$id");      
		$myrow=$result->fetch_assoc();
		/**
		*Занесення результатів вибірки в масив
		*
		*@var array $records Результати вибірки з бази
		*/
		$records [] = $myrow;
		return $records;
	}
	
	public function get_data_result()
	{
		
		/**
		*Звернення до класу валідатора для занесення в змінні
		*результату функцій по перевірці даних.
		*/
		$id=Edit_Validate::checkId();
		$Title=Edit_Validate::checkTitle();
		$DescriptionSmall=Edit_Validate::checkDescSmall();
		$DescriptionBig=Edit_Validate::checkDescBig();
		$DateChange=Edit_Validate::checkDate();
		
		
		if (isset($Title) && isset($DescriptionSmall) && isset($DescriptionBig) && isset($DateChange)){
			$result=Database::mysqli()->query("UPDATE message SET title='$Title', description_small='$DescriptionSmall',description_big='$DescriptionBig',date_change='$DateChange' WHERE id='$id' LIMIT 1");
			if($result) {
				echo "<p align='center'>Повідомлення змінено</p>";
			}else{
				echo "<p align='center'>Виникла помилка</p>";
			}
		}else{
			echo "<p align='center'>Ви ввели неповну інформацію</p>";
		}
	}
}

/**
*Клас роботи з отриманими даними по видаленню
*конкретного повідомлення
*/
class Model_Delete extends Model
{
	public function get_data()
	{	

		/**
		*Звернення до класу контролера для занесення в змінну
		*результату функції по перевірці ідентифікатора.
		*/
		$id=Controller_Delete::checkId();

		if(isset($id)){ 
			$result=Database::mysqli()->query("DELETE FROM message WHERE id='$id' LIMIT 1");
				if($result){
					echo "<p align='center'>Повідомлення видалено</p>";
				}else{
					echo "<p align='center'>Виникла помилка</p>";
				}
		}else{
			echo "<p align='center'>Не знайдено ідентифікатор повідомлення</p>";
		}
	}
}
