<?php

namespace App\Http\Controllers;

use App\Books;
use App\Http\Requests\BookReq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Books $model)
    {    $data=$model->where('created_by',Auth::user()->id)->get();
         return view('books')->with('data' ,$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Books::where('created_by',Auth::user()->id)->orderBy('title')->get();
        return view('books')->with('data' ,$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookReq $request, Books $model)
    {
       // $model->create($request->all());
        Auth::user();
        $model->title =$request->input('title');
        $model->subtitle =$request->input('subtitle');
        $model->author =$request->input('author');
        $model->published_at =$request->input('published_at');
        $model->publisher =$request->input('publisher');
        $model->pages =$request->input('pages');
        $model->description =$request->input('description');
        $model->website =$request->input('website');
        $model->created_by =Auth::user()->id;
        $getRequestImag=$request->file('file');
        $photo = 'image'.time().'.'.$getRequestImag->getClientOriginalExtension();
        $getRequestImag->move(public_path('images'),$photo);
         $model->file='image'.time().'.'.$getRequestImag->getClientOriginalExtension();
        $model->save();
        return  redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function show(Books $model)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function edit(Books $books)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(BookReq $request, Books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(Books $books ,$id)
    {    $deleted_books =$books->find($id);
         $deleted_books->delete();
         return  redirect()->back();
    }
}
