<?php

class Model
{
    public $DB;
    public function __construct()
    {
        include 'db.php';
        $db = DataBase::getDB();
        $this->DB = $db->mysqli;
    }
	/** метод вибірки даних*/
	public function GetData($params)
	{
		/** todo*/
	}
}
