<?php
function antimat($msg) {
    if(file_exists("antimat/antimat.dat")) {
        $mat = file_get_contents("antimat/antimat.dat");
        $ArrMat = explode("|",$mat);
        foreach($ArrMat as $value) {
            if($value != "") {
                $msg = preg_replace("|$value|iu","***",$msg);
            }}}
    return $msg;
}