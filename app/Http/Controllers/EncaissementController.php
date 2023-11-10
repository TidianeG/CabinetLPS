<?php

namespace App\Http\Controllers;

use App\Models\Encaissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EncaissementController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newEncaissement(Request $request){
        //dd($request);
        $validated =  $request->validate([
            'nombre_ticket' => 'required|integer',
            'montant_total' => 'required|numeric',
        ]);
        
        $encaissement = new Encaissement();
        $encaissement->nombre_ticket = $validated['nombre_ticket'];
        $encaissement->montant_versement = $validated['montant_total'];
        $encaissement->user_id = Auth::user()->id;

        $encaissement->save();
        if (empty($encaissement)) {
             return redirect()->back()->with(['error' => "Erreur, vérifier les parametres"]);
        }
        else {
            return redirect()->back()->with(['success' => "Encaissement effectué"]);
       }
    }

    public function getAllEncaissement(){
        $encaissements = Encaissement::all();

        return view('caisses.all_encaissements', compact('encaissements'));
    }

    public function getEncaissement($lug){

    }
}
