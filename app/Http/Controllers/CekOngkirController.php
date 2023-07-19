<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\Provincy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CekOngkirController extends Controller
{
    public function getCity(Request $request)
    {

        $id_province = $request->province_id;

        if ($id_province == null) {
            return response()->json([
                'status' => 400,
                'message' => 'Province ID is required',
                'data' => null
            ]);
        } else {
            $cities = City::where('province_id', $id_province)->get();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Success get data city list',
            'data' => $cities
        ]);
    }

    public function getDetailCity(City $city)
    {
        return response()->json([
            'status' => 200,
            'message' => 'Success get data city detail',
            'data' => $city
        ]);
    }

    public function getProvincy()
    {
        $provinces = Provincy::all();

        return response()->json([
            'status' => 200,
            'message' => 'Success get data provincy list',
            'data' => $provinces
        ]);
    }

    public function getProvincyWithCities()
    {
        $provinces = Provincy::with('cities')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Success get data provincy with cities list',
            'data' => $provinces
        ]);
    }


    public function cekOngkir(Request $request)
    {

        $request->validate([
            'city_id' => 'required',
        ]);

        $carts = Cart::with(['variant', 'product'])->where('user_id', auth()->user()->id)->get();

        // get total weight
        $weight = 0;
        foreach ($carts as $cart) {
            $weight += $cart->variant ? $cart->variant->weight :  $cart->product->weight * $cart->quantity;
        }

        $city_origin = 399; // 399 is semarang kota
        $city_destination = $request->city_id;



        $couriers = ['jne', 'pos', 'tiki'];

        $results = [];

        foreach ($couriers as $courier) {
            $response = Http::withHeaders([
                'key' => env('RAJAONGKIR_API_KEY'),
                "content-type: application/x-www-form-urlencoded",
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $city_origin,
                'destination' => $city_destination,
                'weight' => $weight,
                'courier' => $courier
            ]);

            if ($response['rajaongkir']['status']['code'] === 400) {
                return response()->json([
                    'status' => 400,
                    'message' => $response['rajaongkir']['status']['description']
                ], 400);
            }

            $results[$courier] = $response['rajaongkir']['results'][0];
        }

        return response()->json([
            'status' => 200,
            'message' => 'Success get data ongkir',
            'data' => $results
        ], 200);
    }
}
