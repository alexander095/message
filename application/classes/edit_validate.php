<?php 

/**
*Клас для перевірки існування змінних
*і чи мають вони правильне значення
*/ 
class Edit_Validate
{
	/**
	*Функція перевірки ідентифікатора повідомлення
	*
	*@return $id Ідентифікатор
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
	
	/**
	*Функція перевірки назви повідомлення
	*
	*@return $Title Назва повідомлення
	*
	*@var string $Title Назва повідомлення
	*/
	public static function checkTitle()
	{
		if(isset($_POST['Title'])){
			$Title=$_POST['Title'];
				if($Title==''){
					unset($Title);
				}	
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
	public static function checkDescSmall()
	{
		if(isset($_POST['DescriptionSmall'])){
			$DescriptionSmall=$_POST['DescriptionSmall'];
				if($DescriptionSmall==''){
					unset($DescriptionSmall);
				}	
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
	public static function checkDescBig()
	{
		if(isset($_POST['DescriptionBig'])){
			$DescriptionBig=$_POST['DescriptionBig'];
				if($DescriptionBig==''){
					unset($DescriptionBig);
				}
		}
		return $DescriptionBig;
	}
	
	/**
	*Функція перевірки дати редагування повідомлення
	*
	*@return $DateChange Дата редагування повідомлення
	*
	*@var date $DateChange Дата редагування повідомлення
	*/
	public static function checkDate()
	{
		if (isset($_POST['DateChange'])){
			$DateChange=date("Y-m-d H:i:s");
		}
		return $DateChange;
	}
}
