<?php 

/**
*Клас для перевірки існування змінних
*і чи мають вони правильне значення
*/ 
class Edit_Validate
{
	public function checkId()
	{
		if(isset($_POST['id'])){		
				if(!preg_match("/^[0-9]{1,10}$/",$_POST['id'])){
					echo "Неправильний формат ідентифікатора повідомлення";
				}else{
					$id=$_POST['id'];
				}
		}else{
			echo "Повідомлення не знайдено";
		}		
		return $id;
	}
	
	public function checkTitle()
	{
		if(isset($_POST['Title'])){
			$Title=$_POST['Title'];
				if($Title==''){
					unset($Title);
				}	
		}
		return $Title;
	}
	
	public function checkDescSmall()
	{
		if(isset($_POST['DescriptionSmall'])){
			$DescriptionSmall=$_POST['DescriptionSmall'];
				if($DescriptionSmall==''){
					unset($DescriptionSmall);
				}	
		}
		return $DescriptionSmall;
	}
	
	public function checkDescBig()
	{
		if(isset($_POST['DescriptionBig'])){
			$DescriptionBig=$_POST['DescriptionBig'];
				if($DescriptionBig==''){
					unset($DescriptionBig);
				}
		}
		return $DescriptionBig;
	}
	public function checkDate()
	{
		if (isset($_POST['DateChange'])){
			$DateChange=date("Y-m-d H:i:s");
		}
		return $DateChange;
	}
}

$object=new Edit_Validate;

/**
*Занесення значень функцій у змінні
*/
$id=$object->checkId();
$Title=$object->checkTitle();
$DescriptionSmall=$object->checkDescSmall();
$DescriptionBig=$object->checkDescBig();
$DateChange=$object->checkDate();

?>