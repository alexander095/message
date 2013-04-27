<?php

class View
{
    /**
     * @param $ContentView
     * @param null $Data
     * @param null $MoreData
     * @internal param null $ExError
     * @internal param $content_file - види що відображають контент сторінки;
     * @internal param $template_file - загальний для всіх сторінок шаблон;
     * @internal param $data - массив, який містить елементи контента сторінок.
     */
	public function generate($ContentView, $Data = null, $MoreData = null)
	{
		
		/*
		if(is_array($data)) {
			extract($data);
		}
		*/
		
		/**
		*Динамічно підключаємо загальний шаблон
		*/
		include 'application/views/template_view.php';
	}
}
