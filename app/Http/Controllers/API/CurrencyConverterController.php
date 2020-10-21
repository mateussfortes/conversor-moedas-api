<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CurrencyConverter;
use Illuminate\Http\Request;

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;

class CurrencyConverterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $currencyConverter = CurrencyConverter::orderBy('id', 'desc')->get();

        return response()->json([
            'message' => 'success',
            'data' => $currencyConverter
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated_data = $request->validate([
            'currency_from' => 'required|alpha',
            'currency_to' => 'required|alpha',
            'currency_value' => 'required'
        ]);

        $exchangeRates = new ExchangeRate();

        $currency_converter_value = $exchangeRates->convert(
            $validated_data['currency_value'], 
            $validated_data['currency_to'], 
            $validated_data['currency_from'], 
        );

        if($currency_converter_value) 
        {

            $currencyConverter = CurrencyConverter::create([
                'currency_value' => $validated_data['currency_value'],
                'currency_to' => $validated_data['currency_to'],
                'currency_from' => $validated_data['currency_from'],
                'currency_converter_value' => $currency_converter_value,
            ]);

            return response()->json([
                'message' => 'success',
                'data' => $currencyConverter
            ]);

        }

        return response()->json([
            'message'=> 'error', 
            'data' => null
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CurrencyConverter  $currencyConverter
     * @return \Illuminate\Http\Response
     */
    public function show(CurrencyConverter $currencyConverter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CurrencyConverter  $currencyConverter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CurrencyConverter $currencyConverter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CurrencyConverter  $currencyConverter
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurrencyConverter $currencyConverter)
    {
        //
    }
}
