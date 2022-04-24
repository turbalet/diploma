<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        dd('Creating category');
    }

    public function showAll()
    {
        return Category::all();
    }
}
