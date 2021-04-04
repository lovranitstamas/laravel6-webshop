<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attachment;
use App\Models\Mode_of_transport;
use App\Models\Product;
use App\Models\Sub_category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{

    public function avatarDownload($path, $name)
    {
        return \Storage::disk('dev')->download($path);
    }

    public function index(Request $request)
    {

        $products = Product::all();
        return view('admin.product.index')
            ->with('products', $products);

    }

    public function create()
    {

        $transports = Mode_of_transport::orderBy('mode_hu')->get();
        $subCategories = Sub_category::orderBy('name_hu')->get();
        $product = new Product();

        return view('admin.product.create')
            ->with('product', $product)
            ->with('transports', $transports)
            ->with('subCategories', $subCategories);
    }

    public function store(Request $request)
    {

        //https://laravel.com/docs/5.2/validation#validating-arrays
        //https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types

        //count the other attachments
        if ($request->hasfile('other_attachments') && count($request->file('other_attachments')) > 5) {
            throw ValidationException::withMessages(['other_attachments.*' => 'Too many files']);
        } else {
            $this->validate($request, [
                'name_hu' => 'required|max:50|unique:products,name_hu',
                'sub_category_id' => 'required|not_in:0',
                'state' => 'required|in:0,1',
                'inventory' => 'required|min:1|max:32767|integer',
                'price_hu' => 'required|min:1|max:2147483647|integer',
                'payment_unit' => 'required|max:10',
                'transports' => 'required|array|min:1',
                ///kb-s
                'avatar' => 'required|file|max: 3072|mimetypes:image/*',
                'other_attachments.*' => 'max: 3072|mimetypes:image/*'
            ]);

            $product = new Product();
            $product->setAttributes($request->all());

            try {
                $product->save();
                $product->modeOfTransports()->attach($request->input('transports'));

                //avatar file handle
                $avatar = $request->file('avatar');

                if (isset($avatar) && $avatar && is_file($avatar)) {
                    $product->avatar = Carbon::now()->timestamp . uniqid() . "." . $avatar->getClientOriginalExtension();
                    $product->avatar_path = \Storage::disk('dev')->put('/', $avatar, ['name' => $product->avatar]);

                    $product->save();
                }

                //other attachments
                if ($request->hasfile('other_attachments')) {
                    try {
                        $files = $request->file('other_attachments');
                        foreach ($files as $file) {
                            if (isset($file) && $file && is_file($file)) {
                                $attachment = new Attachment;
                                $attachment->addFile($file);

                                $attachment->attachable()->associate($product);

                                $attachment->save();
                            }
                        }
                    } catch (\Exception $e) {
                        session()->flash('error', $e->getMessage());
                    }
                }

                //TODO - Commit/Rollback
                session()->flash('success', 'Termék feltöltve');
            } catch (\Exception $e) {
                session()->flash('error', $e->getMessage());
            }
        }

        return redirect()->back();
    }

    public function show($productId)
    {

        try {

            $product = Product::findOrFail($productId);
            $transports = Mode_of_transport::orderBy('mode_hu')->get();
            $subCategories = Sub_category::orderBy('name_hu')->get();

            return view('admin.product.show')
                ->with('product', $product)
                ->with('transports', $transports)
                ->with('subCategories', $subCategories);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }


    public function edit($productId)
    {

        try {

            $product = Product::findOrFail($productId);
            $transports = Mode_of_transport::orderBy('mode_hu')->get();
            $subCategories = Sub_category::orderBy('name_hu')->get();

            return view('admin.product.edit')
                ->with('product', $product)
                ->with('transports', $transports)
                ->with('subCategories', $subCategories);

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        if (Product::whereHas('orders', function ($q) use ($id) {
                $q->where('product_id', '=', $id);
            })->first() == null) {

            if ($request->hasfile('other_attachments') && count($request->file('other_attachments')) > 5) {
                throw ValidationException::withMessages(['other_attachments.*' => 'Too many files']);
            } else {
                $this->validate($request, [
                    'name_hu' => 'required|max:50|unique:products,name_hu,' . $id,
                    'sub_category_id' => 'required|not_in:0',
                    'state' => 'required|in:0,1',
                    'inventory' => 'required|min:1|max:32767|integer',
                    'price_hu' => 'required|min:1|max:2147483647|integer',
                    'payment_unit' => 'required|max:10',
                    'transports' => 'required|array|min:1',
                    ///kb-s
                    'avatar' => 'file|max: 3072|mimetypes:image/*',
                    'other_attachments.*' => 'max: 3072|mimetypes:image/*'
                ]);

                $product = Product::findOrFail($id);


                $product->setAttributes($request->all());

                try {
                    $product->save();
                    $product->modeOfTransports()->sync($request->input('transports'));

                    //avatar file handle
                    if ($request->hasfile('avatar')) {
                        $avatar = $request->file('avatar');

                        if (isset($avatar) && $avatar && is_file($avatar)) {
                            //delete the existing avatar file
                            \Storage::disk('dev')->delete($product->avatar_path);

                            //update the avatar file
                            $product->avatar = Carbon::now()->timestamp . uniqid() . "." . $avatar->getClientOriginalExtension();
                            $product->avatar_path = \Storage::disk('dev')->put('/', $avatar, ['name' => $product->avatar]);

                            $product->save();
                        }
                    }

                    //other attachments
                    if ($request->hasfile('other_attachments')) {
                        try {
                            $files = $request->file('other_attachments');
                            foreach ($files as $file) {
                                if (isset($file) && $file && is_file($file)) {
                                    $attachment = new Attachment;
                                    $attachment->addFile($file);

                                    $attachment->attachable()->associate($product);

                                    $attachment->save();
                                }
                            }
                        } catch (\Exception $e) {
                            session()->flash('error', $e->getMessage());
                        }
                    }

                    //TODO - Commit/Rollback
                    session()->flash('success', 'Termék feltöltve');
                } catch (\Exception $e) {
                    session()->flash('error', $e->getMessage());
                }

            }
        } else {
            session()->flash('error', "Módosítás elutasítva: termékhez rendelve.");
        }

        return redirect()->back();

    }

    public function destroy(Request $request, $id)
    {

        try {

            $product = Product::findOrFail($id);

            if (Product::whereHas('orders', function ($q) use ($id) {
                    $q->where('product_id', '=', $id);
                })->first() == null) {
                try {

                    $attachments = $product->attachments;
                    $avatarPath = $product->avatar_path;
                    //remove transports entries
                    $product->modeOfTransports()->detach();

                    //delete the existing avatar file
                    \Storage::disk('dev')->delete($avatarPath);

                    //delete the attachments with entries
                    foreach ($attachments as $attachment) {
                        Attachment::where('path', '=', $attachment->path)->delete();
                        \Storage::disk('dev')->delete($attachment->path);
                    }

                    $product->delete();

                    //TODO - Commit/Rollback
                    session()->flash('success', 'Termék törölve');
                } catch (\Exception $e) {
                    session()->flash('error', $e->getMessage());
                }
            } else {
                session()->flash('error', "Törlés elutasítva: rendeléshez kötve.");
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

}
