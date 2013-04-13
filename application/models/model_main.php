<?php
include('db'.'.php');

class Model_Main extends Model
{
	/**
	*Функція роботи з базою для головної сторінки
	*
	*@return $records Масив вибірки з бази
	*
	*@var $records array
	*/
	public function GetData()
	{	
		$DataBase = new Database;
		$records = array();
		$result=$DataBase->MySqli()->query("SELECT id,title,description_small,description_big,date_add,date_change FROM message ORDER BY date_add DESC");
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
	
	/**
	*Робота з базою для сторінки
	*додавання повідомлень
	*
	*@return void
	*/
	public function GetDataAdd()
	{
		$DataBase = new Database;
		/**
		*Звернення до класу валідатора для занесення в змінні
		*результату функцій по перевірці даних.
		*/
		$Title = GetTitle();
		$DescriptionSmall=GetDescSmall();
		$DescriptionBig=GetDescBig();

		/**
		*Занесення дати в змінну
		*
		*@var date $date Поточна дата
		*/
		$Date=date("Y-m-d H:i:s");	

		if(isset($Title) && isset($DescriptionSmall) && isset($DescriptionBig) && isset($Date)){
			$result=$DataBase->MySqli()->query("INSERT INTO message (title,description_small,description_big,date_add) VALUES	('$Title','$DescriptionSmall','$DescriptionBig','$Date')");
				if($result) {
					echo "<p align='center'>Повідомлення успішно додано</p>";
				}else{
					echo "<p align='center'>Виникла помилка</p>";
				}
		}else{
			echo "<p align='center'>Ви ввели неповну інформацію</p>";
		}
	}
	
	/**
	*Функція роботи з базою для видалення повідомлень
	*
	*@return void
	*/
	public function GetDataDelete()
	{	
		$DataBase = new Database;
		
		/**
		*занесення в змінну
		*результату функції по перевірці ідентифікатора.
		*/
		$id=GetId();

		if(isset($id)){ 
			$result=$DataBase->MySqli()->query("DELETE FROM message WHERE id='$id' LIMIT 1");
				if($result){
					echo "<p align='center'>Повідомлення видалено</p>";
				}else{
					echo "<p align='center'>Виникла помилка</p>";
				}
		}else{
			echo "<p align='center'>Не знайдено ідентифікатор повідомлення</p>";
		}
	}
	
	/**
	*Функція роботи з базою для редагування повідомлень
	*
	*@return $records Масив вибірки з бази
	*
	*@var $records array
	*/
	public function GetDataEdit()
	{		
		$DataBase = new Database;
		/**
		*Звернення до класу контролера для занесення в змінну
		*результату функції по перевірці ідентифікатора.
		*/
		$id=GetId();
	
		$records = array();
		$result=$DataBase->MySqli()->query("SELECT id,title,description_small,description_big,date_change FROM message WHERE id=$id");      
		$myrow=$result->fetch_assoc();
		/**
		*Занесення результатів вибірки в масив
		*
		*@var array $records Результати вибірки з бази
		*/
		$records [] = $myrow;
		return $records;
	}
	
	/**
	*Функція роботи з базою для внесення
	*змін у повідомленнях
	*
	*@return void
	*/
	public function GetEditResult()
	{
		$DataBase = new Database;
		/**
		*Занесення в змінні результату функцій
		*по перевірці даних.
		*/
		$id=GetId();
		$Title=GetTitle();
		$DescriptionSmall=GetDescSmall();
		$DescriptionBig=GetDescBig();
		$DateChange=date("Y-m-d H:i:s");
		
		if (isset($Title) && isset($DescriptionSmall) && isset($DescriptionBig) && isset($DateChange)){
			$result=$DataBase->MySqli()->query("UPDATE message SET title='$Title', description_small='$DescriptionSmall',description_big='$DescriptionBig',date_change='$DateChange' WHERE id='$id' LIMIT 1");
			if($result) {
				echo "<p align='center'>Повідомлення змінено</p>";
			}else{
				echo "<p align='center'>Виникла помилка</p>";
			}
		}else{
			echo "<p align='center'>Ви ввели неповну інформацію</p>";
		}
	}
	
	/**
	*Функція роботи з базою для виведення повного
	*тексту конкретного повідомлення
	*
	*@return $records Масив вибірки з бази
	*
	*@var $records array
	*/
	public function GetDataFullText()
	{	
		$DataBase = new Database;	
		/**
		*Занесення в змінну
		*результату функції по перевірці ідентифікатора.
		*/
		$id=GetId();
		
		$records = array();
		$result=$DataBase->MySqli()->query("SELECT id,title,description_big,date_add,date_change FROM message WHERE id='$id'");
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
	
	/**
	*Функція роботи з базою для авторизації користувачів
	*
	*@return void
	*/
	public function GetAuthData()
	{	
		$AuthLogin = checkAuthLogin();
		$AuthPass = checkAuthPass();
		
		$DataBase = new Database;
		$result=$DataBase->MySqli()->query("SELECT id,login,pass FROM users WHERE login='$AuthLogin' LIMIT 1");
		if (mysqli_num_rows($result) == 1){
			$myrow=$result->fetch_assoc();
		}else{
			echo "<p align='center'>Введений логін не знайдено</p>";
		}
		if(strcmp(sha1($AuthPass),$myrow['pass']) == 0){
			$_SESSION['user_id'] = $myrow['id'];
			$_SESSION['user_login'] = $myrow['login'];
			echo "<script>document.location.replace('/');</script>";
		}else{
			echo "<p align='center'>Пароль введений не вірно</p>";
		}
		
	}
	
	/**
	*Функція роботи з базою для реєстрації користувачів
	*
	*@return void
	*/
	public function GetRegData()
	{ 
		$DataBase = new Database;
		/**
		*Звернення до класу валідатора для занесення в змінні
		*результату функцій по перевірці даних.
		*/
		$RegLogin=GetRegLogin();
		$RegPass=GetRegPass();
		$RegPassTwo=GetRegPassTwo();
		$EncryptPass=GetPassEncrypt();
		$RegEmail=GetRegEmail();

		/**
		*Занесення дати в змінну
		*
		*@var date $date Поточна дата
		*/
		$RegDate=date("Y-m-d H:i:s");
		
		/**
		*Перевірка на існування в базі введеного логіна і email
		*/
		$ResultLogin=$DataBase->MySqli()->query("SELECT login FROM users WHERE login = '$RegLogin'");
		$ResultEmail=$DataBase->MySqli()->query("SELECT email FROM users WHERE email = '$RegEmail'");
		/**
		*Перевірка рядків за вмістом введеного логіна і email
		*/
		$RowNumLogin = mysqli_num_rows($ResultLogin);
		$RowNumEmail = mysqli_num_rows($ResultEmail);
		if($RowNumLogin <= 0){
			if($RowNumEmail <= 0){
				if(isset($RegLogin) && isset($RegPass) && isset($RegEmail) && isset($RegPassTwo)){
					$result=$DataBase->MySqli()->query("INSERT INTO users (login,pass,email,date) VALUES	('$RegLogin','$EncryptPass','$RegEmail','$RegDate')");
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
