<?php 

/**
*Клас для перевірки існування змінних
*і чи мають вони правильне значення
*/ 
class MessageValidate
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
		if(isset($id) and is_numeric($id)){
            return true;
        }else{
            return false;
        }
	}

    /**
     *Функція перевірки назви повідомлення
     *
     * @return bool $Title Назва повідомлення
     * @var string $Title Назва повідомлення
     */
	public function checkTitle($Title)
	{
		if(isset($Title) and $Title!==''){
            htmlspecialchars(stripslashes($Title));
            return true;
		}else{
		    return false;
        }
	}

    /**
     *Функція перевірки короткого тексту повідомлення
     *
     * @return bool $DescriptionSmall Короткий текст повідомлення
     * @var string $DescriptionSmall Короткий текст повідомлення
     */
	public function checkDescSmall($DescriptionSmall)
	{
        if(isset($DescriptionSmall) and $DescriptionSmall!==''){
            htmlspecialchars(stripslashes($DescriptionSmall));
            return true;
        }else{
            return false;
        }
	}

    /**
     *Функція перевірки повного тексту повідомлення
     *
     * @return bool $DescriptionBig Повний текст повідомлення
     * @var string $DescriptionBig Поввний текст повідомлення
     */
	public function checkDescBig($DescriptionBig)
	{
        if(isset($DescriptionBig) and $DescriptionBig!==''){
            htmlspecialchars(stripslashes($DescriptionBig));
            return true;
        }else{
            return false;
        }
	}
}
