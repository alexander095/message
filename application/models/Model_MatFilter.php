<?php

class Model_MatFilter
{
    /**
     * Погані слова в масиві у форматі сумісному з регулярними виразами.
     * Регулярний вираз у відповідності з початком / кінцем.
     *
     * @var array
     */
    static private $badWords = array(
        "/^.*ху(й|и|я|е|л(і|е)).*/u",
        "/^.*пи(з|с)д.*/u",
        "/^бля.*/u",
        "/^.*бля(д|т|ц).*/u",
        "/^(с|сц)ук(а|о|і).*/u",
        "/^єб.*/u",
        "/^.*уєб.*/u",
        "/^заїб.*/u",
        "/^.*єб(а|и)(н|с|щ|ц).*/u",
        "/^.*єбу(ч|щ).*/u",
        "/^.*п(и|і)д(о|е)р.*/u",
        "/^.*хер.*/u",
        "/^г(а|о)ндон/u",
        "/^.*залуп.*/u"
    );

    /**
     * Фільтрація вхідної строки поганих слів
     *
     * @param string $string
     * @return string строка з заміною поганих слів на '*'.
     */
    public function filter($string){

        $cenzur = '[цензура]';

        include_once 'application/classes/Helper.php';
        $objHelper = new Helper();
        $string = $objHelper->TranlitToUkr($string);

        foreach(self::$badWords as $key => $value){
            $Pattern[] = $value;
        }

        $NoMat = preg_replace($Pattern,$cenzur,$string);

        return $NoMat;
    }
}
?>