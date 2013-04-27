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

    public function generateView($template,$data = null,$MoreData = null){
        $this->CreateView()->generate($template,$data,$MoreData);
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
