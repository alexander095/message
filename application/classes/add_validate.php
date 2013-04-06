<?php 

/**
*Клас для перевірки існування змінних
*і чи мають вони значення
*/ 
class Add_Validate
{
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
}
