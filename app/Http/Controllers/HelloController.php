<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index($name)
    {

        $fruits = [];
        $isAdmin = true;

        $fruits = [
            'Apple',
            'Banana',
            'Orange'
        ];
        
        return view('hello', [
            'name' => $name,
            'fruits' => $fruits,
            'isAdmin' => $isAdmin
        ]);
    }
}
