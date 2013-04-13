<?php

class Controller {
	
	public $Model;
	public $View;
	
	function __construct()
	{
		$this->View = new View();
	}
	
	/** дія (action), викликається за замовчуванню*/
	function ActionIndex()
	{
		/** todo	*/
	}
}
