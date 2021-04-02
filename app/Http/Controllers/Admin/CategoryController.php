<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index(Request $request)
    {

        $categories = Category::all();

        return view('admin.category.index')
            ->with('categories', $categories);

    }

    public function create()
    {

        $category = new Category();

        return view('admin.category.create')->with('category', $category);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_hu' => 'required|max:30|unique:categories,name_hu',
        ]);

        $category = new Category();

        $category->setAttributes($request->all());

        try {
            $category->save();
            session()->flash('success', 'Kategória elmentve');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function show($categoryId)
    {

        $category = Category::find($categoryId);
        //$category = Category::where('id', $categoryId)->first(); null a return , ha nincs eredmény

        return view('admin.category.show')->with('category', $category);
    }


    public function edit($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        return view('admin.category.edit')->with('category', $category);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name_hu' => 'required|max:30|unique:categories,name_hu,' . $id,
        ]);

        $category = Category::findOrFail($id);

        $category->setAttributes($request->all());

        try {
            $category->save();
            session()->flash('success', 'Kategória módosítva');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {

        $category = Category::find($id);

        try {
            $category->delete();
            session()->flash('success', 'Kategória törölve');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

}
