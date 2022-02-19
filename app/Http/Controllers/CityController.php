<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\City;

class CityController extends Controller
{
    public function list()
    {
        return response()->json(City::all());
    }

    public function show($id)
    {
        $city = City::where('id', $id)->with('weather')->first();

        return response()->json($city);
    }

    public function save(Request $request)
    {
        $data = $request->json()->all();

        $validator = Validator::make($data, [
            'id' => 'required|integer',
            'name' => 'required|string',
            'country' => 'required|string',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'weather' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $city = City::updateOrCreate(
            ['id' =>  $data['id']],
            [
                'name' => $data['name'],
                'country' => $data['country'],
                'lat' => $data['lat'],
                'lon' => $data['lon'],
            ]
        );

        foreach ($data['weather'] as $weather) {

            $city->weather()->updateOrCreate(
                ['timestamp' =>  $weather['timestamp']],
                [
                    'temp' => $weather['temp'],
                    'pressure' => $weather['pressure'],
                    'humidity' => $weather['humidity'],
                ]
            );
        }

        return response()->json(true);
    }
}
