<?php

class Pagination {
    private $total;
    private $CurPage;
    private $NumberPage;
    private $array = array();

    /**
    $array = array(
    'total' => $count,                              // загальна кількість елементів
    'cur_page' => $page,                            // номер елемнта поточної сторінки
    'number_page' => 3,                             // кількість записів для показу
    'mask'=>'?page=',                               // маска url
    'partition' => '|',                              //перегородка між посиланнями
    'first_page' => 'Перша',
    'previous_page' => 'Попередня',
    'next_page' => 'Наступна',
    'last_page' => 'Остання');
    */

    public function __construct($array) {
        return $this->array = $array;
    }

    /**
     * Функція занесення в змінну кількість записів
     *
     * @throws Exception
     * @return int $total int
     * @internal param $total Кількість записів
     */
    public function getTotal() {
        if(!empty($this->array['total'])){
            return  $this->total = $this->array['total'];
        }else{
            throw new Exception('Немає даних для відображення');
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

    /**
     * Формуємо посилання на першу і попередню сторінку, якщо потрібно
     *
     * @return string
     */
    public function FirstPage(){
        if($this->getCurPage() != 1){
            return '<a href='.$this->array['mask'].'1>'.$this->array['first_page'].'</a> '.
                $this->array['partition'].' <a href='.$this->array['mask'].
                ($this->getCurPage()-1).'>'.$this->array['previous_page'].'</a> '.
                $this->array['partition'];
        }
    }

    /**
     * Формуємо посилання на останню і наступну сторінку, якщо потрібно
     *
     * @return string
     */
    public function NextPage(){
        if ($this->getCurPage() != $this->getCountPage()){
            return ' '.$this->array['partition'].' <a href='.$this->array['mask'].($this->getCurPage()+1).'>'.
                $this->array['next_page'].'</a> '.$this->array['partition'].
                ' <a href='.$this->array['mask'].$this->getCountPage().'>'.
                $this->array['last_page'].'</a>';
        }
    }

    /**
     * Виводимо сторінки назад
     *
     * @param $page
     * @return string
     */
    public function PageLeft($page){
        if($this->getCurPage() - $page > 0){
            return ' <a href='.$this->array['mask'].($this->getCurPage()-$page).'>'.
                ($this->getCurPage()-$page).'</a> '.$this->array['partition'].' ';
        }
    }

    /**
     * Виводимо сторінки вперед
     *
     * @param $page
     * @return string
     */
    public function PageRight($page){
        if($this->getCurPage()+$page <= $this->getCountPage()){
            return ' '.$this->array['partition'].' <a href='.$this->array['mask'].
                ($this->getCurPage()+$page).'>'.($this->getCurPage()+$page).'</a>';
        }
    }

    /**
     * Виведення на сторінку
     *
     * @param bool $return
     * @return string
     */
    public function display($return = false) {
        $result = self::FirstPage().self::PageLeft(3).self::PageLeft(2).self::PageLeft(1).
            '<b><span>'.self::getCurPage().'</span></b>'.
            self::PageRight(1).self::PageRight(2).self::PageRight(3).self::NextPage();
        if ($return){
            return $result;
        }
    }
}