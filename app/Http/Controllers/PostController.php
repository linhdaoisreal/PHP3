<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    function index(){
        $query = DB::table('posts')
        ->select('id','title','name','category_id','description','created_at','updated_at')
        ->orderBy('created_at', 'desc')->get();

        return view('client/home', data: ['data'=>$query]);
    }

    function post_detail($id){
        $query = DB::table('posts')
        ->select('id','title','name','category_id','description','created_at','updated_at')
        ->where('id', '=', $id)
        ->first();

        return view('client/post-detail', ['data'=>$query]);
    }

    function post_by_cate($id){
        $cate = DB::table(table: 'categories')
        ->where('id', '=', $id)
        ->select('id','name')->first();

        $query = DB::table('posts')
        ->select('id','title','name','category_id','description','created_at','updated_at')
        ->where('category_id', '=', $id)
        ->orderBy('created_at', 'desc')->get();

        // dd($query);

        return view('client/home', ['data'=>$query, 'cate'=>$cate]);
    }
}
