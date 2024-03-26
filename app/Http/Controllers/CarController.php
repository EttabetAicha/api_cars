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
