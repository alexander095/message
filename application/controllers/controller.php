<?php


class Controller_Registration extends Controller
{
	function __construct()
	{
		$this->Model=new Model_Registration();
		$this->View=new View();	
	}

	function action_index()
	{			
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->View->generate('registration_view.php','template_view.php',$Data);
	}
	
	function action_result()
	{
		/**
		*Підключення класу валідатора
		*/
		include_once("application\\classes\\registration_validate.php");
		$this->View->generate('result_view.php','template_view.php',$Data);
		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$this->Model->get_data();
	}
}

/**
*Клас контролера додавання нового повідомлення
*/ 
class Controller_Add extends Controller
{
	function __construct()
	{
		$this->Model=new Model_Add();
		$this->View=new View();	
	}

	function action_index()
	{	
		$this->View->generate('add_view.php','template_view.php');
	}
	function action_result()
	{
		/**
		*Підключення класу валідатора
		*/
		include_once("application\\classes\\add_validate.php");
		
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->View->generate('result_view.php','template_view.php',$Data);
		
		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$this->Model->get_data();			
	}
}

/**
*Клас контролера виведення всіх повідомлень
*/
class Controller_Main extends Controller
{
	
	function __construct()
	{
		$this->Model=new Model_Main();
		$this->View=new View();	
	}
	
	function action_index()
	{	
		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$this->Model->get_data();
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->View->generate('main_view.php', 'template_view.php',$Data);
	}
}

/**
*Клас контролера виведення повного тексту конкретного повідомлення
*/
class Controller_Fulltext extends Controller
{
	
	/**
	*Функція перевірки ідентифікатора повідомлення
	*
	*return $id Ідентифікатор
	*
	*@var int $id Ідентиіфкатор повідомлення
	*/
	public static function checkId()
		{
			if(isset($_POST['id'])){		
				if(!preg_match("/^[0-9]{1,10}$/",$_POST['id'])){
					die("Неправильний формат ідентифікатора повідомлення");
				}else{
					$id=$_POST['id'];
				}
			}else{
				die("Повідомлення не знайдено");
			}		
		return $id;
		}
	
	function __construct()
	{
		$this->Model=new Model_Fulltext();
		$this->View=new View();	
	}
	
	function action_index()
	{	
		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$this->Model->get_data();
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->View->generate('fulltext_view.php', 'template_view.php',$Data);
	}
}

/**
*Клас контролера редагування повідомлень
*/
class Controller_Edit extends Controller
{
	
		/**
		*Функція перевірки ідентифікатора повідомлення
		*
		*return $id Ідентифікатор
		*
		*@var int $id Ідентиіфкатор повідомлення
		*/
		public static function checkId()
		{
			if(isset($_POST['id'])){		
				if(!preg_match("/^[0-9]{1,10}$/",$_POST['id'])){
					die("Неправильний формат ідентифікатора повідомлення");
				}else{
					$id=$_POST['id'];
				}
			}else{
				die("Повідомлення не знайдено");
			}		
		return $id;
		}
		
		function __construct()
		{
			$this->Model=new Model_Edit();
			$this->View=new View();	
		}
		
		function action_index()
		{	
				
			/**
			*Занесення в змінну $Data масиву, що повертається методом get_data
			*/
			$Data=$this->Model->get_data();
			/**
			*В метод generate екземпляра класу View передаються 
			*імена файлів загального шаблону і виду c контентом сторінки.
			*/
			$this->View->generate('edit_view.php', 'template_view.php',$Data);
		}
		function action_result()
		{
			/**
			*Підключення класу валідатора
			*/
			include_once("application\\classes\\edit_validate.php");
			$this->View->generate('result_view.php', 'template_view.php',$Data);
			$Data=$this->Model->get_data_result();
		}
}

/**
*Клас контролера видалення конкретного повідомлення
*/
class Controller_Delete extends Controller
{
	/**
	*Функція перевірки ідентифікатора повідомлення
	*
	*return $id Ідентифікатор
	*
	*@var int $id Ідентиіфкатор повідомлення
	*/
	public static function checkId()
		{
			if(isset($_POST['id'])){		
				if(!preg_match("/^[0-9]{1,10}$/",$_POST['id'])){
					die("Неправильний формат ідентифікатора повідомлення");
				}else{
					$id=$_POST['id'];
				}
			}else{
				die("Повідомлення не знайдено");
			}		
		return $id;
		}
		
	function __construct()
	{
		$this->Model=new Model_Delete();
		$this->View=new View();	
	}
	
	function action_result()
	{
		$this->View->generate('result_view.php', 'template_view.php',$Data);
		/**
		*Занесення в змінну $Data масиву, що повертається методом get_data
		*/
		$Data=$this->Model->get_data();
	}
}

/**
*Клас контролера сторінки помилки 404
*/
class Controller_404 extends Controller
{
	
	function action_index()
	{
		/**
		*В метод generate екземпляра класу View передаються 
		*імена файлів загального шаблону і виду c контентом сторінки.
		*/
		$this->View->generate('result_view.php', '404_view.php');
	}

}
