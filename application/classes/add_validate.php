<?php 

/**
*Клас для перевірки існування змінних
*і чи мають вони значення
*/ 
class Add_Validate
{
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
}

$object=new Add_Validate;

/**
*Занесення результатів функцій у змінні
*/
$Title=$object->checkTitle();
$DescriptionSmall=$object->checkDescSmall();
$DescriptionBig=$object->checkDescBig();


?>