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
    // guardar imagen
    $path = $request->file('image')->store('books','public');

    Book::create([
        'name' => $request->nombre,
        'author' => $request->autor,
        'editorial' => $request->editorial,
        'edition' => $request->edicion,
        'release_date' => $request->fecha_lanzamiento,
        'category_id' => $request->categoria_id,
        'image' => $path
    ]);

    return response()->json(['message'=>'Libro creado correctamente']);
  }
}
