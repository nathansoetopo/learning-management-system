<?php

use App\Models\Event;
use Illuminate\Support\Str;
function parseUrl($asset){
    return public_path(parse_url($asset, PHP_URL_PATH));
}

function getEventName($eventId){
    return Event::select('name')->where('id', $eventId)->first()->name;
}

function descLimit($string){
    return Str::words($string, 30, '...');
}

function day($time){
    return $time->isoFormat('dddd, D MMMM Y');
}
?>