<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Books $model, Request $req){
      $search =  $req->get('search');
      $books = $model->where('title','like','%'.$search.'%')
                     ->orwhere('subtitle','like','%'.$search.'%')
                     ->orwhere('description','like','%'.$search.'%')
                     ->orwhere('author','like','%'.$search.'%')->paginate(5);
      return view('books',['data'=>$books]);
    }
}
