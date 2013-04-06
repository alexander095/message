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
		/**Контролер і дія за замовчуванням*/
		$ControlerName = 'Main';
		$ActionName = 'index';
	 
		$Routes = explode('/', $_SERVER['REQUEST_URI']);

		/**Отримуємо імя контролера*/
		if ( !empty($Routes[1])){	
			$ControlerName = $Routes[1];
		}
		
		/** Отримуємо імя дії*/
		if ( !empty($Routes[2])){
			$ActionName = $Routes[2];
		}

		/**Добавляємо префікси*/
		$ModelName = 'Model_'.$ControlerName;
		$ControlerName = 'Controller_'.$ControlerName;
		$ActionName = 'action_'.$ActionName;

		/**
		echo "Model: $ModelName <br>";
		echo "Controller: $ControlerName <br>";
		echo "Action: $ActionName <br>";
		*/

		/**Підхоплюємо файл з класом моделі (файла моделі може і не бути)*/
		$ModelFile = 'model.php';
		$ModelPath = "application\\models\\".$ModelFile;
		if(file_exists($ModelPath)){
			include "application\\models\\".$ModelFile;
		}

		/** Підхоплюємо файл з класом контролера*/
		$ControllerFile = 'controller.php';
		$ControllerPath = "application\\controllers\\".$ControllerFile;
		if(file_exists($ControllerPath)){
			include "application\\controllers\\".$ControllerFile;
		}else{
			/**Робимо редірект на сторінку 404*/
			Route::ErrorPage404();
		}
		
		/** Створюємо контролер якщо існує відповідний клас*/
		if (class_exists($ControlerName)){
			$Controller = new $ControlerName;
			$Action = $ActionName;
				if(method_exists($Controller, $Action)){
					/** Викликаємо дію контролера*/
					$Controller->$Action();
				}else{
					Route::ErrorPage404();
				}
		}else{
			Route::ErrorPage404();
		}
	
	}

	function ErrorPage404()
	{
        echo "<script>document.location.replace('/404');</script>";
    }
    
}
