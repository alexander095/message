<?php

/**
Класс-маршрутизатор для визначення потрібної сторінки.
* підхоплює класи контролерів і моделей;
* створює екземпляри контролерів сторінок і викликає дії цих контролерів.
*/
class Route
{
	static function Start()
	{
		/**Контролер і дія за замовчуванням*/
		$ControlerName = 'Main';
		$ActionName = 'index';

        $DefaultControlerName = 'Main';
        $DefaultActionName = 'index';

		$Routes = explode('/', $_SERVER['REQUEST_URI']);

		/**Отримуємо імя контролера*/
		if ( !empty($Routes[1])){
			$ControlerName = $Routes[1];
            $str=strpos($ActionName, "?");
            if ($str){
                $ActionName=substr($ActionName, 0, $str);
            }
		}

		/** Отримуємо імя дії*/
		if ( !empty($Routes[2])){
			$ActionName = $Routes[2];
            $str=strpos($ActionName, "?");
            if ($str){
            $ActionName=substr($ActionName, 0, $str);
            }
		}

		/**Добавляємо префікси*/
		$ControlerName = 'Controller_'.$ControlerName;
		$ActionName = 'Action'.$ActionName;

		/**
		echo "Controller: $ControlerName <br>";
		echo "Action: $ActionName <br>";
		*/

		/** Підхоплюємо файл з класом контролера*/
		$ControllerFile = strtolower($ControlerName).'.php';
		$ControllerPath = "application/controllers/".$ControllerFile;
		if(file_exists($ControllerPath)){
			include "application/controllers/".$ControllerFile;
		}else{
            /**Якщо контролера немає даємо файл контролера за замовчуванням*/
            $ControllerFile = 'Controller_'.strtolower($DefaultControlerName).'.php';
            $ControllerPath = "application/controllers/".$ControllerFile;
            include "application/controllers/".$ControllerFile;
		}

		/** Створюємо контролер якщо існує відповідний клас*/
		if (class_exists($ControlerName)){
			$Controller = new $ControlerName;
			$Action = $ActionName;
        }
        if (method_exists($Controller, $Action)){
            try{
            $Controller->$Action();
            }catch (Exception $err){
                $Controller = $DefaultControlerName;
                $Controller->ActionError404;
            }
        }else{
            /**Якщо класу заданого контролера немає даємо дефолтний клас*/
            $DefaultControlerName = 'Controller_'.$DefaultControlerName;
            $Controller = new $DefaultControlerName;
            $Action = 'Action'.$DefaultActionName;
            $Controller->$Action();
        }
	}

}
