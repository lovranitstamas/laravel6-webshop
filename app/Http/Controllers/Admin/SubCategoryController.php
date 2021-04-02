<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Sub_category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{

    public function index(Request $request)
    {

        $subCategories = Sub_category::all();

        return view('admin.sub_category.index')
            ->with('subCategories', $subCategories);

    }


    public function create()
    {

        try {
            $subCategory = new Sub_category();
            $categories = Category::all();

            return view('admin.sub_category.create')
                ->with('subCategory', $subCategory)
                ->with('categories', $categories);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_hu' => 'required|max:30|unique:sub_categories,name_hu',
            'category_id' => 'required|not_in:0'
        ]);

        $subCategory = new Sub_category();
        $subCategory->setAttributes($request->all());

        try {
            $subCategory->save();
            session()->flash('success', 'Alkategória elmentve');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function show($subCategoryId)
    {

        try {
            $subCategory = Sub_category::findOrFail($subCategoryId);
            $categories = Category::all();
            //$category = Category::where('id', $categoryId)->first(); null a return , ha nincs eredmény

            return view('admin.sub_category.show')
                ->with('subCategory', $subCategory)
                ->with('categories', $categories);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }


    public function edit($subCategoryId)
    {
        try {
            $subCategory = Sub_category::findOrFail($subCategoryId);
            $categories = Category::all();

            return view('admin.sub_category.edit')
                ->with('subCategory', $subCategory)
                ->with('categories', $categories);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name_hu' => 'required|max:30|unique:sub_categories,name_hu,' . $id,
            'category_id' => 'required|not_in:0'
        ]);

        try {
            $subCategory = Sub_category::findOrFail($id);

            if (Sub_category::whereHas('products', function ($q) use ($id) {
                    $q->where('sub_category_id', '=', $id);
                })->first() == null) {
                $subCategory->setAttributes($request->all());
                try {
                    $subCategory->save();
                    session()->flash('success', 'Alkategória módosítva');

                } catch (\Exception $e) {
                    session()->flash('error', $e->getMessage());
                }
            } else {
                session()->flash('error', "Módosítás elutasítva: termékhez rendelve.");
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {

        try {
            $category = Sub_category::findOrFail($id);

            if (Sub_category::whereHas('products', function ($q) use ($id) {
                    $q->where('sub_category_id', '=', $id);
                })->first() == null) {
                try {
                    $category->delete();
                    session()->flash('success', 'Alkategória törölve');
                } catch (\Exception $e) {
                    session()->flash('error', $e->getMessage());
                }
            } else {
                session()->flash('error', "Törlés elutasítva: termékhez rendelve.");
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

}
