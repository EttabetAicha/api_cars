<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function index()
    {
        $voitures =Voiture::all();
        return response()->json($voitures);

    }

    public function estimateprix(Request $request)
    {//
    }
}
