<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function galery($id){
        $data = Galery::where('event_id', $id)->get();

        return $data;
    }

    public function detailGalery($id){
        $data = Galery::find($id);

        return $data;
    }
}
