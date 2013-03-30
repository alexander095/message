<?php
$db=mysql_connect("localhost","user","12345") or die("Неможливо підключитись до бази даних"); 
mysql_select_db("message_db",$db) or die("Неможливо підключитись до бази даних");
mysql_query('SET NAMES "utf8"');
?>