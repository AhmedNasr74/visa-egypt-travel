<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CurrencyRequest;
use App\DataTables\CurrencyDataTable;

class CurrencyController extends Controller
{

    public function index(CurrencyDataTable $dataTable)
    {
        return $dataTable->render('dashboard.currencies.index');
    }


    public function create()
    {
        return view('dashboard.currencies.create');
    }


    public function store(CurrencyRequest $request)
    {
        $currency = Currency::create($request->getSanitized());
        if ($currency->default) {
            Currency::where('id', '!=' , $currency->id)->update([
                'default' => false
            ]);
        }
        session()->flash('message', 'Currency Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.currencies.edit', $currency);
    }


    public function show(Currency $currency)
    {
        //
    }


    public function edit(Currency $currency)
    {
        return view('dashboard.currencies.edit', compact('currency'));
    }


    public function update(CurrencyRequest $request, Currency $currency)
    {
        $wasDefault = $currency->default;
        $currency->update($request->getSanitized());
        if (!$wasDefault && $currency->default) {
            Currency::where('id', '!=' , $currency->id)->update([
                'default' => false
            ]);
        }
        session()->flash('message', 'Currency Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Currency $currency)
    {
        $currency->delete();
        return response()->json([
            'message' => 'Currency Deleted Successfully!'
        ]);
    }
}
