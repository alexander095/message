<?php 

/**
*підключаєм файли ядра
*/
require_once 'core/Model.php';
require_once 'core/View.php';
require_once 'core/Controller.php';

require_once 'core/Route.php';
/**
*запускаємо маршрутизатор
*/
Route::Start();