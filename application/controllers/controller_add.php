<?php

/**
*Контроллер сторінки додавання повідомлення
*Якщо не відправлені дані, показувати форму.
*Коли появляться дані POST показути сторінку результату.
*/
if(!isset($_POST['Title'])){
	class Controller_Add extends Controller
	{	
		function action_index()
		{	
			/**
			*В метод generate екземпляра класу View передаються 
			*імена файлів загального шаблону і виду c контентом сторінки.
			*/
			$this->View->generate('add_view.php', 'template_view.php',$Data);
		}
	}
		
}else {
	
	class Controller_Add extends Controller
	{
	
		function __construct()
		{
			$this->Model=new Model_Add();
			$this->View=new View();	
		}
		
		function action_index()
		{	
			/**
			*Занесення в змінну $Data масиву, що повертається методом get_data
			*/
			$Data=$this->Model->get_data();
			$this->View->generate('result_view.php', 'template_view.php',$Data);
		}
	}

}

?>