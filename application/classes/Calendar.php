<?php

function draw_calendar($month,$year){

    /* будуємо таблицю */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

    /* заголовки таблиці */
    $headings = array('Пн','Вт','Ср','Чт','Пт','Сб','Нд');
    $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.
    implode('&nbsp</td><td class="calendar-day-head">',$headings).'</td></tr>';

    /* змінні місяців і днів */
    $running_day = date('w',mktime(0,0,0,$month,0,$year));
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* рядок для одного тижня */
    $calendar.= '<tr class="calendar-row">';

    /* не друкувати порожні дні до початку тижня */
    for($x = 0; $x < $running_day; $x++){
        $calendar.= '<td class="calendar-day-np"></td>';
        $days_in_this_week++;
    }

    /* побудова по днях */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++){
        $calendar.= '<td class="calendar-day">';
        $calendar.= '<a class="day-number" href="main/datesearch">'.$list_day.'</a>';
        /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
        $calendar.= str_repeat('<p> </p>',2);
        $calendar.= '</td>';
        if($running_day == 6){
            $calendar.= '</tr>';
            if(($day_counter+1) != $days_in_month){
                $calendar.= '<tr class="calendar-row">';
            }
            $running_day = -1;
            $days_in_this_week = 0;
        }
        $days_in_this_week++; $running_day++; $day_counter++;
    }
    /* finish the rest of the days in the week */
    if($days_in_this_week < 8){
        for($x = 1; $x <= (8 - $days_in_this_week); $x++){
            $calendar.= '<td class="calendar-day-np"> </td>';
        }
    }
    /* final row */
    $calendar.= '</tr>';
    /* end the table */
    $calendar.= '</table>';

    /* all done, return result */
    return $calendar;
}
