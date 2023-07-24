<?php

use App\Models\Event;
use App\Models\Predicate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

function parseUrl($asset)
{
    return public_path(parse_url($asset, PHP_URL_PATH));
}

function getEventName($eventId = null)
{
    if ($eventId == null) {
        return 'Semua Event';
    }
    return Event::select('name')->where('id', $eventId)->first()->name;
}

function descLimit($string)
{
    return Str::words($string, 30, '...');
}

function day($time)
{
    return $time->isoFormat('dddd, D MMMM Y');
}

function rupiah($req)
{
    return number_format($req, 2, ",", ".");
}

function getPredicate($value)
{
    $predicate = Predicate::with('predicate_score')->where('status', 'active')->latest()->first();

    $predicates = $predicate->predicate_score;

    $step_1 = null;

    for ($x = 0; $x < $predicates->count(); $x++) {
        if ($value >= $predicates[$x]->score) {
            $step_1 = $predicates[$x]->predicate;
            break;
        }
    }

    return $step_1;
    // switch($value){
    //     case ($value >= 90 && $value <= 100):
    //         $predicate = 'A';
    //         break;
    //     case($value>=79 && $value <= 89):
    //         $predicate = 'B';
    //         break;
    //     case($value>=67 && $value <=78):
    //         $predicate = 'C';
    //         break;
    //     case($value>=56 && $value <=66):
    //         $predicate = 'D';
    //         break;
    //     case($value>=45 && $value <= 55):
    //         $predicate = 'E';
    //         break;
    //     default:
    //         $predicate = 'F';
    // }

    // return $predicate;
}

function getStarRate($value)
{
    switch ($value) {
        case ($value > 0 && $value <= 0.5):
            $width = '10%';
            break;
        case ($value > 0.5 && $value <= 1):
            $width = '20%';
            break;
        case ($value > 1 && $value <= 1.5):
            $width = '30%';
            break;
        case ($value > 1.5 && $value <= 2):
            $width = '40%';
            break;
        case ($value > 2 && $value <= 2.5):
            $width = '50%';
            break;
        case ($value > 2.5 && $value <= 3):
            $width = '60%';
            break;
        case ($value > 3 && $value <= 3.5):
            $width = '70%';
            break;
        case ($value > 3.5 && $value <= 4):
            $width = '80%';
            break;
        case ($value > 4 && $value <= 4.5):
            $width = '90%';
            break;
        case ($value > 4.5 && $value <= 5):
            $width = '100%';
            break;
        default:
            $width = '0%';
    }

    return $width;
}
