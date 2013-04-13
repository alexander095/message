<?php

class Controller_Main extends Controller
{
	function __construct()
	{
		include_once('application/classes/message_validate'.'.php');
		$this->Model=new Model_Main();
		$this->View=new View();	
	}
	
	/**
	*Формування головної сторнки з потрібними даними 
	*/
	public function ActionIndex()
	{	
		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$this->Model->GetData();
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->View->generate('main_view'.'.php',$Data);
	}
	
	/**
	*Формування сторінки з формою для додавання повідомлень
	*/
	public function ActionAdd()
	{	
		$this->View->generate('add_view'.'.php');
	}
	
	/**
	*Результат додавання нового повідомлення
	*/
	public function ActionAddResult()
	{
		function GetTitle()
		{
		$object = new Message_Validate;
		$Title = $object->checkTitle($_POST['Title']);
		return $Title;
		}
		
		/**
		*Відправлення даних пост у валідатор
		*
		*@return $DescriptionSmall Короткий текст
		*
		*@var string $DescriptionSmall Короткий текст
		*/
		function GetDescSmall()
		{
		$object = new Message_Validate;
		$DescriptionSmall = $object->checkDescSmall($_POST['DescriptionSmall']);
		return $DescriptionSmall;
		}
		
		function GetDescBig()
		{
		$object = new Message_Validate;
		$DescriptionBig = $object->checkDescBig($_POST['DescriptionBig']);
		return $DescriptionBig;
		}
		
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->View->generate('result_view'.'.php',$Data);
		
		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$this->Model->GetDataAdd();			
	}
	
	/**
	*Видалення повідомлення за ідентифікатором
	*/
	public function ActionDelete()
	{
		/**
		*Відправлення отриманого ідентифікатора у валідатор
		*
		*@return $id Ідентифікатор повідомлення 
		*
		*@var int $id Ідентифікатор
		*/
		function GetId()
		{
		$object = new Message_Validate;
		$id = $object->checkId($_POST['id']);
		return $id;
		}
		
		$this->View->generate('result_view'.'.php',$Data);
		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$this->Model->GetDataDelete();
	}
	
	/**
	*Редагування конкретного повідомлення
	*/
	public function ActionEdit()
	{		
		function GetId()
		{
		$object = new Message_Validate;
		$id = $object->checkId($_POST['id']);
		return $id;
		}

		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$this->Model->GetDataEdit();
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->View->generate('edit_view'.'.php',$Data);
	}
	
	/**
	*Результат внесення змін в конкретне повідомлення
	*/
	public function ActionEditResult()
	{
		/**
		*Відправлення отриманого ідентифікатора у валідатор
		*
		*@return $id Ідентифікатор повідомлення 
		*
		*@var int $id Ідентифікатор
		*/
		function GetId()
		{
		$object = new Message_Validate;
		$id = $object->checkId($_POST['id']);
		return $id;
		}
		
		/**
		*Відправлення даних пост у валідатор
		*
		*@return $Title Назва повідомлення
		*
		*@var string $Title Назва повідомлення
		*/
		function GetTitle()
		{
		$object = new Message_Validate;
		$Title = $object->checkTitle($_POST['Title']);
		return $Title;
		}
		
		function GetDescSmall()
		{
		$object = new Message_Validate;
		$DescriptionSmall = $object->checkDescSmall($_POST['DescriptionSmall']);
		return $DescriptionSmall;
		}
		
		function GetDescBig()
		{
		$object = new Message_Validate;
		$DescriptionBig = $object->checkDescBig($_POST['DescriptionBig']);
		return $DescriptionBig;
		}

		$this->View->generate('result_view'.'.php',$Data);
		/**
		*Занесення в змінну $Data масиву, що повертається методом GetEditResult
		*/
		$Data=$this->Model->GetEditResult();
	}
	
	/**
	*Передача даних для виведення повного
	*тексту повідомлення повідомлення
	*/
	public function ActionFulltext()
	{	
		function GetId()
		{
		$object = new Message_Validate;
		$id = $object->checkId($_POST['id']);
		return $id;
		}
		/**
		*Занесення в змінну $Data масиву, що повертається
		*методом GetDataFulltext
		*/
		$Data=$this->Model->GetDataFulltext();
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->View->generate('fulltext_view'.'.php',$Data);
	}
	
	/**
	*Генерація сторінки з формою реєстрації
	*/
	public function ActionRegistration()
	{			
		$this->View->generate('registration_view'.'.php');
	}
	
	/**
	*Обробка даних реєстрації користувача 
	*/
	public function ActionRegResult()
	{
		function GetRegLogin()
		{
		$object = new Registration_Validate;
		$RegLogin = $object->checkRegLogin($_POST['login']);
		return $RegLogin;
		}
		
		/**
		*Відправлення даних пост у валідатор
		*
		*@return $RegPass Реєстраційний пароль
		*
		*@var string $RegPass Пароль 
		*/
		function GetRegPass()
		{
		$object = new Registration_Validate;
		$RegPass = $object->checkRegPass($_POST['pass']);
		return $RegPass;
		}
		
		function GetRegPassTwo()
		{
		$object = new Registration_Validate;
		$RegPassTwo = $object->checkRegPassTwo($_POST['pass_two']);
		return $RegPassTwo;
		}
		
		/**
		*Отримання зашифрованого пароля
		*
		*@return $EncryptPass Зашифрований пароль
		*
		*@var string $EncryptPass Зашифрований пароль 
		*/
		function GetPassEncrypt()
		{
		$object = new Registration_Validate;
		$EncryptPass = $object->PassEncryption();
		return $EncryptPass;
		}
		
		function GetRegEmail()
		{
		$object = new Registration_Validate;
		$RegEmail = $object->checkRegEmail($_POST['email']);
		return $RegEmail;
		}
		
		/**
		*Підключення класу валідатора
		*/
		include_once('application/classes/registration_validate'.'.php');
		$this->View->generate('result_view'.'.php',$Data);
		/**
		*Занесення в змінну $Data масиву, що повертається методом GetRegData
		*/
		$Data=$this->Model->GetRegData();
	}
	
	/**
	*Обробка даних авторизації користувача 
	*/
	public function ActionAuthorization()
	{		
			/**
			*Захист поля логіна від інєкцій
			*
			*return $AuthLogin Логін авторизації
			*/
			function checkAuthLogin()
			{
				if (isset($_POST['AuthLogin'])){
					$AuthLogin = mysql_real_escape_string($_POST['AuthLogin']);
				}
			return $AuthLogin;
			}
			
			/**
			*Співставляння введеного пароля з секретним словом
			*
			*return $AuthPass Пароль авторизації
			*/
			function checkAuthPass()
			{
				if (isset($_POST['AuthPass'])){
					$AuthPass = $_POST['AuthPass'];
					$SecretString = "aswjrk889";
					$AuthPass = $AuthPass.$SecretString;
				}
			return $AuthPass;
			}
			
		$Data=$this->Model->GetAuthData();
		$this->View->generate('result_view'.'.php',$Data);
		
	}
	
	/**
	*Функція виходу користувача
	*
	*return void
	*/
	public function ActionLogOut()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_login']);
		$Data=$this->Model->GetData();
		$this->View->generate('main_view'.'.php',$Data);
	}
	
	public function ActionError404()
	{
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->View->generate('404_view'.'.php');
	}
}