<?php

class Controller {
    /**
     * Функція створення екземпляра вюшки
     *
     * @return View
     */
    public function CreateView()
    {
        $View = new View();
        return $View;
    }

    /**
     *
     *дія (action), викликається за замовчуванню
     *
     * @param null $param
     */
	public function ActionIndex($param = null)
	{
		/** todo	*/
	}
}
