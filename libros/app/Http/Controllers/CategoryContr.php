<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryContr extends Controller
{
    public function index()
    {
        return Category::all(); // devolver JSON
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return response()->json(['message'=>'Categoria creada']);
    }
}
