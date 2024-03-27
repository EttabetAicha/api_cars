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
        $voitures = Voiture::all();
        return response()->json($voitures);
    }

    public function estimatePrix(Request $request)
    {
        $request->validate([
            'marque' => 'required|string',
            'modele' => 'required|string',
            'kilometrage' => 'required|numeric',
            'date_mise_en_circulation' => 'required|date',
            'puissance' => 'required|numeric',
            'carburant' => 'required|string',
            'motorisation' => 'required|string',
            'options'=>'required',
        ]);

        $prixEstime = Voiture::where('marque', $request->marque)
            ->where('modele', $request->modele)
            ->avg('prix');

        return response()->json(['prix_estime' => $prixEstime]);
    }
}
