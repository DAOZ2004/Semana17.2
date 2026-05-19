<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookContr extends Controller
{
    
    public function index()
    {
        return Book::with('category')->get();
    }

    
    public function store(Request $request)
    {
        $path = $request->file('image')->store('books','public');

        return Book::create([
            'name'=>$request->name,
            'author'=>$request->author,
            'editorial'=>$request->editorial,
            'edition'=>$request->edition,
            'release_date'=>$request->release_date,
            'category_id'=>$request->category_id,
            'image'=>$path
        ]);
    }

    
    public function categories()
    {
        return Category::all();
    }
}
