<?php


namespace App;


use Illuminate\Support\Carbon;

class FriendlyFormat
{
    static function date(Carbon $date)
    {
        if ($date->year === Carbon::now()->year) {
            return $date->format('j M');
        } else {
            return $date->format('j M \'y');
        }
    }
}
