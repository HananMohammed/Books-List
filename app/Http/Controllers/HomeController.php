<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Books $model)
    {
//        $created_by = $model->user()->get();
         return view('home') ;
    }

}
