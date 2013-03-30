<?php

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

?>