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

        try {
            //$category = Category::where('id', $categoryId)->first(); null a return , ha nincs eredmény
            $category = Category::findOrFail($categoryId);

            return view('admin.category.show')->with('category', $category);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }


    public function edit($categoryId)
    {

        try {
            $category = Category::findOrFail($categoryId);
            return view('admin.category.edit')->with('category', $category);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name_hu' => 'required|max:30|unique:categories,name_hu,' . $id,
        ]);

        try {

            $category = Category::findOrFail($id);

            if (!Category::has('subCategories')->get()) {
                //if($category->subCategories()->count()==0) {

                $category->setAttributes($request->all());

                try {
                    $category->save();
                    session()->flash('success', 'Kategória módosítva');
                } catch (\Exception $e) {
                    session()->flash('error', $e->getMessage());
                }
            } else {
                session()->flash('error', "Módosítás elutasítva: alkategórához rendelés már megtörtént.");
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {

        try {

            $category = Category::findOrFail($id);

            if (!Category::has('subCategories')->get()) {
                try {
                    $category->delete();
                    session()->flash('success', 'Kategória törölve');
                } catch (\Exception $e) {
                    session()->flash('error', $e->getMessage());
                }
            } else {
                session()->flash('error', "Törlés elutasítva: alkategórához rendelve.");
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

}
