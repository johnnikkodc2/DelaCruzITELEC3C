<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $deletedCategories = Category::onlyTrashed()->get();
        return view('admin.category.category', compact('categories', 'deletedCategories'));
    }
    public function indexDeleted()
    {
        $categories = Category::withTrashed()->get();

        return view('admin.category.category', compact('categories'));
    }
    public function Edit($id)
    {
        $categories = Category::find($id);
        return view('admin.category.editCategory', compact('categories'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Updated validation rule
        ]);

        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName);

            Category::create([
                'category_name' => $request->input('category_name'),
                'user_id' => auth()->id(),
                'category_image' => $imageName,
            ]);
        }


        return redirect()->route('AllCat');
    }

    public function Update(Request $request, $id)
    {
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName);

            $update = Category::find($id)->update([
                'category_name' => $request->category_name,
                'category_image' => $imageName,
            ]);
        } else {
            // If no new image is provided, update only the category name
            $update = Category::find($id)->update([
                'category_name' => $request->category_name,
            ]);
        }

        return redirect()->route('AllCat')->with('success', 'Updated Successfully');
    }

    public function Delete($id)
    {

        $category = Category::find($id);
        $category->delete();

        return Redirect()->back();

    }
    public function ForceDelete($id)
    {
        $category = Category::withTrashed()->find($id);

        if ($category) {
            $category->forceDelete();
            return redirect()->back()->with('success', 'Category has been force deleted successfully.');
        } else {

            return redirect()->back()->with('error', 'Category not found.');
        }
    }
    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);

        if ($category) {

            $category->restore();
            return redirect()->back()->with('success', 'Category has been restored successfully.');
        } else {

            return redirect()->back()->with('error', 'Category not found.');
        }
    }


}
