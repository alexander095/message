<?php

class View
{
	/**
	*$content_file - види що відображають контент сторінки;
	*$template_file - загальний для всіх сторінок шаблон;
	*$data - массив, який містить елементи контента сторінок.
	*/
	function generate($content_view, $template_view, $Data = null)
	{
		
		/*
		if(is_array($data)) {
			extract($data);
		}
		*/
		
		/**
		*Динамічно підключаємо загальний шаблон
		*/
		include 'application/views/'.$template_view;
	}
}

?>