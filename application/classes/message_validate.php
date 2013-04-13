<?php 

/**
*Клас для перевірки існування змінних
*і чи мають вони правильне значення
*/ 
class Message_Validate
{
	/**
	*Функція перевірки ідентифікатора повідомлення
	*
	*@return $id Ідентифікатор
	*
	*@var int $id Ідентиіфкатор повідомлення
	*/
	public function checkId($id)
	{
		try{
			if(isset($id)){
					if(!is_numeric($id)){
						throw new Exception("Неправильний формат ідентифікатора повідомлення");
					}else{
						$id=$id;
					}
			}else{
				throw new Exception("Повідомлення не знайдено");
			}
		}catch (Exception $e){
			echo $e->getMessage();
		}
		return $id;
	}
	
	/**
	*Функція перевірки назви повідомлення
	*
	*@return $Title Назва повідомлення
	*
	*@var string $Title Назва повідомлення
	*/
	public function checkTitle($Title)
	{
		try{
			if(!isset($Title) or $Title==''){
				unset($Title);
				throw new Exception("<p align='center'>Введіть назву повідомлення</p>");
			}	
		}catch (Exception $e){
			echo $e->getMessage();
		}
		return $Title;
	}
	
	/**
	*Функція перевірки короткого тексту повідомлення
	*
	*@return $DescriptionSmall Короткий текст повідомлення
	*
	*@var string $DescriptionSmall Короткий текст повідомлення
	*/
	public function checkDescSmall($DescriptionSmall)
	{
		try{
			if(!isset($DescriptionSmall) or $DescriptionSmall==''){
				unset($DescriptionSmall);
				throw new Exception("<p align='center'>Введіть короткий текст повідомлення</p>");
			}	
		}catch (Exception $e){
			echo $e->getMessage();
		}
		return $DescriptionSmall;
	}
	
	/**
	*Функція перевірки повного тексту повідомлення
	*
	*@return $DescriptionBig Повний текст повідомлення
	*
	*@var string $DescriptionBig Поввний текст повідомлення
	*/
	public function checkDescBig($DescriptionBig)
	{
		try{
			if(!isset($DescriptionBig) or $DescriptionBig==''){
				unset($DescriptionBig);
				throw new Exception("<p align='center'>Введіть короткий текст повідомлення</p>");
			}
		}catch (Exception $e){
			echo $e->getMessage();
		}
		return $DescriptionBig;
	}
}
