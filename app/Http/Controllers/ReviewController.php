<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function getByMasterClass($master_class_id, Request $request){
        $data = DB::table('master_class_reviews')->select([
            'users.id',
            'master_class_reviews.id as review_id',
            'master_class_reviews.created_at as create',
            'master_class_reviews.description as description',
            'master_class_reviews.rate as rate',
            'users.name',
            'users.avatar'
        ])
        ->join('users', 'master_class_reviews.user_id', '=', 'users.id')
        ->where('master_class_reviews.master_class_id', $master_class_id)
        ->orderBy('create', 'desc')
        ->get();

        if($request->ajax()){
            return view('landing_page.components.review-user', compact('data'))->render();
        }
        
        return $data;
    }

    public function store(Request $request, $master_class_id){
        $data = $request->except(['_token']);
        $data['master_class_id'] = $master_class_id;
        $data['user_id'] = Auth::user()->id;

        $review = Review::create($data);

        return $review ? 200 : 500;
    }
}
