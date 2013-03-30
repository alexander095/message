<?php

/**
*Клас контролера головної сторінки з повідомленнями
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

?>