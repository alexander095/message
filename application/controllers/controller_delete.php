<?php

/**
*Клас контролера сторінки видалення повідомлень
*/
class Controller_Delete extends Controller
{
	
	function __construct()
	{
		$this->Model=new Model_Delete();
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
		$this->View->generate('delete_view.php', 'template_view.php',$Data);
	}
}

?>