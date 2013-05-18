<?php

class Model_MatFilter
{
    /**
     * Таблиця транслітерації eng
     *
     * @var array
     */
    static private $translitTableFrom = array(
        'a', 'b', 'v', 'g', 'd', 'e', 'g', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
        'r', 's', 't', 'u', 'f', 'i', 'e', 'A', 'B', 'V', 'G', 'D', 'E', 'G', 'Z', 'I',
        'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'I', 'E', 'h',
        'ts', 'ch', 'sh', 'shch', 'yu', 'ya', 'H', 'TS', 'CH', 'SH', 'SHCH', 'YU', 'YA'
    );

    /**
     * Таблиця транслітерації укр
     *
     * @var array
     */
    static private $translitTableTo = array(
        'а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
        'р', 'с', 'т', 'у', 'ф', 'і', 'є', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И',
        'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'І', 'Є', 'х',
        'ц', 'ч', 'ш', 'щ', 'ю', 'я', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ю', 'Я'
    );

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
     * Фільтрація вхідної строки поганих слів. Після філтрації
     * всі погані слова заміняються на '*'.
     *
     * @param string $string
     * @return string строка з заміною поганих слів на '*'.
     */
    public function filter($string)
    {
        $swearingFound = false;
        //розкладаємо строку на слова
        $elems = explode (" ", $string);
        $CountElems = count($elems);

        for ($i = 0; $i < $CountElems; $i++) {
            $StrRep = str_replace(self::$translitTableFrom,self::$translitTableTo,
                preg_replace('/[^a-zA-Zа-яА-Яё]/u', '', mb_strtolower($elems[$i], 'UTF8'))
            );

            //намагаємося знайти відповідності поганих слів у спеціальному масиві
            $countBadWords = count(self::$badWords);
            for ($k = 0; $k < $countBadWords; $k++) {
                if (preg_match(self::$badWords[$k], $StrRep)) {
                    $elems[$i] = str_repeat('*', mb_strlen($elems[$i], 'UTF8') - 1);
                    $swearingFound = true;
                    break;
                }
            }
        }

        //обєднання слів у цілий рядок
        if ($swearingFound) {
            $string = implode (" ", $elems);
        }

        return $string;
    }
}
?>