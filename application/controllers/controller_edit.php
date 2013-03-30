<?php

/**
*Контроллер сторінки редагування повідомлення
*Якщо дані не відправлені, показувати форму.
*Коли появляться дані POST показути сторінку результату.
*/
if (!isset($_POST['DateChange'])){
	class Controller_Edit extends Controller
	{
	
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
	}
	
}else{
	class Controller_Edit extends Controller
	{
		function __construct()
		{
			$this->Model=new Model_Edit();
			$this->View=new View();	
		}
		
		function action_index()
		{	
			$Data=$this->Model->get_data();
			$this->View->generate('result_view.php', 'template_view.php',$Data);
		}
	}
}
	
?>