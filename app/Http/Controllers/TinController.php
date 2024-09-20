<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinController extends Controller
{
    function index(){
        echo 'This is Home Page';
        return view('tin-index');
    }

    function contact(){
        echo 'This is Contact Page';
        return view('tin-contact');
    }

    function infor($id){
        $name =' Nguyễn Phú AN';
        $class ='WD18408';
        $description ='Nguyễn Phú An là một người rất chi là';

        $data = [   'id' => $id,
                    'name' => $name,
                    'class' => $class,
                    'description' => $description];
        return view('tin-infor', $data);
    }
}
