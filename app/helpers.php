<?php

use App\Models\Event;
use Illuminate\Support\Str;
function parseUrl($asset){
    return public_path(parse_url($asset, PHP_URL_PATH));
}

function getEventName($eventId = null){
    if($eventId == null){
        return 'Semua Event';
    }
    return Event::select('name')->where('id', $eventId)->first()->name;
}

function descLimit($string){
    return Str::words($string, 30, '...');
}

function day($time){
    return $time->isoFormat('dddd, D MMMM Y');
}

function getPredicate($value){
    switch($value){
        case ($value >= 90 && $value <= 100):
            $predicate = 'A';
            break;
        case($value>=79 && $value <= 89):
            $predicate = 'B';
            break;
        case($value>=67 && $value <=78):
            $predicate = 'C';
            break;
        case($value>=56 && $value <=66):
            $predicate = 'D';
            break;
        case($value>=45 && $value <= 55):
            $predicate = 'E';
            break;
        default:
            $predicate = 'F';
    }

    return $predicate;
}
?>