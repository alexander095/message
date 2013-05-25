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
     * @return bool $id Ідентифікатор
     * @var int $id Ідентиіфкатор повідомлення
     */
	public function checkId($id)
	{
		return (!empty($id) && is_numeric($id) && $id != '');
	}

    /**
     *Функція перевірки назви повідомлення
     *
     * @return bool $Title Назва повідомлення
     * @var string $Title Назва повідомлення
     */
	public function checkTitle($Title)
	{
		return (!empty($Title) && $Title!=='');
	}

    /**
     *Функція перевірки короткого тексту повідомлення
     *
     * @return bool $DescriptionSmall Короткий текст повідомлення
     * @var string $DescriptionSmall Короткий текст повідомлення
     */
	public function checkDescSmall($DescriptionSmall)
	{
        return (!empty($DescriptionSmall) && $DescriptionSmall!=='');
	}

    /**
     *Функція перевірки повного тексту повідомлення
     *
     * @return bool $DescriptionBig Повний текст повідомлення
     * @var string $DescriptionBig Поввний текст повідомлення
     */
	public function checkDescBig($DescriptionBig)
	{
        return (!empty($DescriptionBig) and $DescriptionBig!=='');
	}

    public function checkTags($Tags)
    {
        return (!empty($Tags) and $Tags!=='');
    }
}