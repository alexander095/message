<?php

class Model
{
    public $DB;
    public function __construct()
    {
        include_once 'db.php';
        $db = DataBase::getDB();
        $this->DB = $db->mysqli;
    }
	/** метод вибірки даних*/
	public function GetData()
	{
		/** todo*/
	}
}
