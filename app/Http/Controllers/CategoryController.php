<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.category', compact('categories'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);


        Category::create([
            'category_name' => $request->input('category_name'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('AllCat');
    }

}
