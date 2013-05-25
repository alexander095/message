<?php
class Helper{

    /**
     * Таблиця транслітерації eng
     *
     * @var array
     */
    static private $translitTableEng = array(
        'a', 'b', 'v', 'g', 'd', 'e', 'g', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
        'r', 's', 't', 'u', 'f', 'i', 'e', 'A', 'B', 'V', 'G', 'D', 'E', 'G', 'Z', 'I',
        'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'I', 'E', 'h',
        'ts', 'ch', 'sh', 'shch', 'yu', 'ya', 'H', 'TS', 'CH', 'SH', 'SHCH', 'YU', 'YA','`'
    );

    /**
     * Таблиця транслітерації укр
     *
     * @var array
     */
    static private $translitTableUkr = array(
        'а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
        'р', 'с', 'т', 'у', 'ф', 'і', 'є', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И',
        'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'І', 'Є', 'х',
        'ц', 'ч', 'ш', 'щ', 'ю', 'я', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ю', 'Я', 'ь'
    );


    /**
     * Функція трансліту укр в eng
     *
     * @param $string
     * @return mixed
     */
    public function TranlitToEng($string){
        $StrRep = str_replace(self::$translitTableUkr,self::$translitTableEng,$string);
        return $StrRep;
    }

    /**
     * Функція трансліту eng в укр
     *
     * @param $string
     * @return mixed
     */
    public function TranlitToUkr($string){
        $StrRep = str_replace(self::$translitTableEng,self::$translitTableUkr,$string);
        return $StrRep;
    }

}