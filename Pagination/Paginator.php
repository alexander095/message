<?php

class Pagination {
    private $total;
    private $CurPage;
    private $NumberPage;
    private  $array = array();

    public function __construct($array) {
        return $this->array = $array;
    }

    /**
     * Функція занесення в змінну кількість записів
     *
     * @return int $total int
     * @internal param $total Кількість записів
     */
    public function getTotal() {
        if(!empty($this->array['total'])){
            return  $this->total = $this->array['total'];
        }else{
            trigger_error('Error:');
        }
    }

    /**
     * Функція занесення в змінну кількості записів на сторінку
     *
     * @return int $NumberPage int
     * @internal param $NumberPage Кількість записів
     */
    public function getNumberPage() {
        if(!empty($this->array['number_page'])){
            return $this->NumberPage = $this->array['number_page'];
        }else{
            return $this->NumberPage = 10;
        }
    }

    /**
     * Функція занесення в змінну поточної сторінки
     *
     * @return int $CurPage Поточна сторінка
     * @internal param $CurPage
     */
    public function getCurPage(){
        if(!empty($this->array['cur_page'])){
            return $this->CurPage = (int) $this->array['cur_page'];
        }else{
            return $this->CurPage = 1;
        }
    }

    /**
     * Оприділення потрібної кількості сторінок
     *
     * @return int
     */
    public function getCountPage() {
        return intval($this->getTotal()/$this->getNumberPage()+1);
    }

    /**
     * Ліміт виведення записів на сторінку
     *
     * @return string
     */
    public function limit() {
        return " LIMIT {$this->start()},{$this->getNumberPage()}";
    }

    /**
     * Вираховуємо з якого повідомлення почати виводити
     *
     * @return int
     */
    public function start() {
        return $this->getCurPage()*$this->getNumberPage()-$this->getNumberPage();
    }
    public function FirstPage(){
        if($this->getCurPage() != 1){
            return '<a href='.$this->array['mask'].'1>Перша</a> | <a href='.$this->array['mask'].($this->getCurPage()-1).'>Попередня</a> | ';
        }
    }
    public function NextPage(){
        if ($this->getCurPage() != $this->getCountPage()){
            return ' | <a href='.$this->array['mask'].($this->getCurPage()+1).'>Наступна</a> | <a href='.$this->array['mask'].$this->getCountPage().'>Остання</a>';
        }
    }
    public function PagesLeft($pages){
        if($this->getCurPage() - $pages > 0){
            return ' <a href='.$this->array['mask'].($this->getCurPage()-$pages).'>'.($this->getCurPage()-$pages).'</a> | ';
        }
    }
    public function PagesRight($pages){
        if($this->getCurPage()+$pages <= $this->getCountPage()){
            return ' | <a href='.$this->array['mask'].($this->getCurPage()+$pages).'>'.($this->getCurPage()+$pages).'</a>';
        }
    }
    public function PageLeft3(){
        return $this->PagesLeft($pages = 3);
    }
    public function PageLeft2(){
        return $this->PagesLeft($pages = 2);
    }
    public function PageLeft1(){
        return $this->PagesLeft($pages = 1);
    }
    public function PageRight3(){
        return $this->PagesRight($pages = 3);
    }
    public function PageRight2(){
        return $this->PagesRight($pages = 2);
    }
    public function PageRight1(){
        return $this->PagesRight($pages = 1);
    }

    /**
     * Виведення на сторінку
     *
     * @return void
     */
    public function display() {
        echo self::FirstPage().self::PageLeft3().self::PageLeft2().self::PageLeft1().'<b><span>'.self::getCurPage().'</span></b>'.self::PageRight1().self::PageRight2().self::PageRight3().self::NextPage();
    }
}