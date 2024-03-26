<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::select('id', 'brand', 'model', 'registration_date')->get();
        return response()->json($cars);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required|string',
            'model' => 'required|string',
            'mileage' => 'required|integer',
            'registration_date' => 'required|date',
            'power' => 'required|integer',
            'fuel' => 'required|string',
            'engine' => 'required|string',
            'options' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $car = Car::create($request->all());

        return response()->json($car, 201);
    }

    public function show($id)
    {
        $car = Car::select('id', 'brand', 'model', 'mileage', 'registration_date', 'power', 'fuel', 'engine', 'options')
            ->findOrFail($id);

        return response()->json($car);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required|string',
            'model' => 'required|string',
            'mileage' => 'required|integer',
            'registration_date' => 'required|date',
            'power' => 'required|integer',
            'fuel' => 'required|string',
            'engine' => 'required|string',
            'options' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $car = Car::findOrFail($id);
        $car->update($request->all());

        return response()->json($car, 200);
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return response()->json(null, 204);
    }

    public function estimatePrice(Request $request)
    {
        //
    }
}
