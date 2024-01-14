<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request){
        request()->validate([
            'name'=> ['required','string', 'max:255'],
        ]);
        $category = Category::create([
            'name' =>request('name')
        ]);
        return redirect()->route('admin.index')->with('success', 'Category created successfully');

    }
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.index')->with('status', 'Category successfull deleted');
    }
    public function edit(Category $category)
    {
        // dd($category);
        return view('admin.categoryedit', compact('category'));
    }
    public function update(Category $category, Request $request)
    {
        // dd($request);
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'is_admin' => ['required', 'boolean'],
        ]);

        $category->update([
            'name' => request('name'),
            // 'is_admin' => request('is_admin'),
        ]);

        return redirect()->route('admin.index')->with('success', 'Category updated successfully.');
    }
}
