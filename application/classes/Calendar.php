<?php

function DrawCalendar($month,$year){

    /* будуємо таблицю */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

    /* заголовки таблиці */
    $headings = array('Пн','Вт','Ср','Чт','Пт','Сб','Нд');
    $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.
    implode('&nbsp</td><td class="calendar-day-head">',$headings).'</td></tr>';

    /* змінні місяців і днів */
    $RunningDay = date('w',mktime(0,0,0,$month,0,$year));
    $DaysInMonth = date('t',mktime(0,0,0,$month,1,$year));
    $DaysInThisWeek = 1;
    $DayCounter = 0;
    $DatesArray = array();

    /* рядок для одного тижня */
    $calendar.= '<tr class="calendar-row">';

    /* не друкувати порожні дні до початку тижня */
    for($x = 0; $x < $RunningDay; $x++){
        $calendar.= '<td class="calendar-day-np"></td>';
        $DaysInThisWeek++;
    }

    /* побудова по днях */
    for($ListDay = 1; $ListDay <= $DaysInMonth; $ListDay++){
        $calendar.= '<td class="calendar-day">';
        $calendar.= '<a class="day-number" href="main/datesearch">'.$ListDay.'</a>';
        $calendar.= str_repeat('<p> </p>',2);
        $calendar.= '</td>';
        if($RunningDay == 6){
            $calendar.= '</tr>';
            if(($DayCounter+1) != $DaysInMonth){
                $calendar.= '<tr class="calendar-row">';
            }
            $RunningDay = -1;
            $DaysInThisWeek = 0;
        }
        $DaysInThisWeek++; $RunningDay++; $DayCounter++;
    }
    /* останні дні тижня */
    if($DaysInThisWeek < 8){
        for($x = 1; $x <= (8 - $DaysInThisWeek); $x++){
            $calendar.= '<td class="calendar-day-np"> </td>';
        }
    }
    /* останній рядок */
    $calendar.= '</tr>';
    /* кінець таблиці */
    $calendar.= '</table>';

    return $calendar;
}
