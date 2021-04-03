<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Mode_of_transport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransportController extends Controller
{

    public function index(Request $request)
    {

        $transports = Mode_of_transport::all();

        return view('admin.transport.index')
            ->with('transports', $transports);

    }

    public function create()
    {

        $transport = new Mode_of_transport();

        return view('admin.transport.create')->with('transport', $transport);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'mode_hu' => 'required|max:50|unique:mode_of_transports,mode_hu',
        ]);

        $transport = new Mode_of_transport();
        $transport->setAttributes($request->all());

        try {
            $transport->save();
            session()->flash('success', 'Szállítási mód elmentve');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function show($transportId)
    {

        try {
            //$category = Transport::where('id', $categoryId)->first(); null a return , ha nincs eredmény
            $transport = Mode_of_transport::findOrFail($transportId);

            return view('admin.transport.show')->with('transport', $transport);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }


    public function edit($transportId)
    {

        try {
            $transport = Mode_of_transport::findOrFail($transportId);
            return view('admin.transport.edit')->with('transport', $transport);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'mode_hu' => 'required|max:50|unique:mode_of_transports,mode_hu,' . $id,
        ]);

        try {

            $transport = Mode_of_transport::findOrFail($id);

            if (Mode_of_transport::whereHas('product', function ($q) use ($id) {
                    $q->where('mode_of_transport_id', '=', $id);
                })->first() == null &&
                $transport->products()->pluck('name_hu')->count() == 0
            ) {

                $transport->setAttributes($request->all());

                try {
                    $transport->save();
                    session()->flash('success', 'Szállítási mód módosítva');
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

            $transport = Mode_of_transport::findOrFail($id);

            if (Mode_of_transport::whereHas('product', function ($q) use ($id) {
                    $q->where('mode_of_transport_id', '=', $id);
                })->first() == null &&
                $transport->products()->pluck('name_hu')->count() == 0) {
                try {
                    $transport->delete();
                    session()->flash('success', 'Szállítási mód törölve');
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
