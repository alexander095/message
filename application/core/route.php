<?php

/**
Класс-маршрутизатор для визначення потрібної сторінки.
* підхоплює класи контролерів і моделей;
* створює екземпляри контролерів сторінок і викликає дії цих контролерів.
*/
class Route
{

	static function start()
	{
		/**контролер і дія за замовчуванням*/
		$ControlerName = 'Main';
		$ActionName = 'index';
		
		$Routes = explode('/', $_SERVER['REQUEST_URI']);

		/**отримуємо імя контролера*/
		if ( !empty($Routes[1]) )
		{	
			$ControlerName = $Routes[1];
		}
		
		/** отримуємо імя дії*/
		if ( !empty($Routes[2]) )
		{
			$ActionName = $Routes[2];
		}

		/**добавляємо префікси*/
		$ModelName = 'Model_'.$ControlerName;
		$ControlerName = 'Controller_'.$ControlerName;
		$ActionName = 'action_'.$ActionName;

		/**
		echo "Model: $ModelName <br>";
		echo "Controller: $ControlerName <br>";
		echo "Action: $ActionName <br>";
		*/

		/**підхоплюємо файл з класом моделі (файла моделі може і не бути)*/

		$ModelFile = strtolower($ModelName).'.php';
		$ModelPath = "application/models/".$ModelFile;
		if(file_exists($ModelPath))
		{
			include "application/models/".$ModelFile;
		}

		/** підхоплюємо файл з класом контролера*/
		$ControllerFile = strtolower($ControlerName).'.php';
		$ControllerPath = "application/controllers/".$ControllerFile;
		if(file_exists($ControllerPath))
		{
			include "application/controllers/".$ControllerFile;
		}
		else
		{
			/**робимо редірект на сторінку 404*/
			Route::ErrorPage404();
		}
		
		/** створюємо контролер*/
		$Controller = new $ControlerName;
		$Action = $ActionName;
		
		if(method_exists($Controller, $Action))
		{
			/** викликаємо дію контролера*/
			$Controller->$Action();
		}
		else
		{
			Route::ErrorPage404();
		}
	
	}

	function ErrorPage404()
	{
        echo "<script>document.location.replace('/404');</script>";
    }
    
}

?>