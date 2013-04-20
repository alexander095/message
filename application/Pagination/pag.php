<?php
// Провіряємо чи потрібні стрілки назад
if ($page != 1) $PervPage = '<a href=?page=1>Перша</a> | <a href=?page='. ($page - 1) .'>Попередня</a> | ';
// Перевіряємо чи потрібні стрілки вперед
if ($page != $Pages) $NextPage = ' | <a href=?page='. ($page + 1) .'>Наступна</a> | <a href=?page=' .$Pages. '>Остання</a>';

// Знаходнимо дві ближні сторінки з двох боків, якщо вони є

if($page - 3 > 0) $PageLeft3 = ' <a href=?page='. ($page - 3) .'>'. ($page - 3) .'</a> | ';
if($page - 2 > 0) $PageLeft2 = ' <a href=?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
if($page - 1 > 0) $PageLeft1 = '<a href=?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';

if($page + 3 <= $total) $PageRight3 = ' | <a href=?page='. ($page + 3) .'>'. ($page + 3) .'</a>';
if($page + 2 <= $total) $PageRight2 = ' | <a href=?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total) $PageRight1 = ' | <a href=?page='. ($page + 1) .'>'. ($page + 1) .'</a>';

if ($total > 1)
{
    echo "<div>";
    echo $PervPage.$PageLeft3.$PageLeft2.$PageLeft1.'<b><span>'.$page.'</span></b>'.$PageRight1.$PageRight2.$PageRight3.$NextPage;
    echo "</div>";
}
?>