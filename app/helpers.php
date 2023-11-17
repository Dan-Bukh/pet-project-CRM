<?php

use Carbon\Carbon;

if (! function_exists('validate_fio')) {
    function validate_fio(string $fio):bool
    {   
        if (count(explode(" ", $fio)) == 3) {
            return false;
        }
        return true;
    }
}

if (! function_exists('year_now')) {
    function year_now()
    {   
        return Carbon::now()->format('Y');
    }
}


