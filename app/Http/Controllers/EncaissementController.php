<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use App\Models\Encaissement;
use App\Models\PointVente;
use App\Models\StatutCaisse;
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

        //changement du statut de caisse
        $gerant = Auth::user()->prenom.' '.Auth::user()->nom;
        $point_vente = PointVente::where('gerant','=',$gerant)->first();
       
        if (empty($encaissement)) {
             return redirect()->back    ()->with(['error' => "Erreur, vérifier les parametres"]);
        }
        else {
            $statu_caisse = StatutCaisse::where('point_vente_id',$point_vente->id)->first();
            $statu_caisse->statut = 0;
            $statu_caisse->save();
            $caisse_deleted = Caisse::where('user_id','=',Auth::user()->id)->delete();
            if ($caisse_deleted) {
                return redirect()->route('my_caisse')->with(['success' => "Encaissement effectué"]);
            }
            else{
                return redirect()->back()->with(['error' => "Erreur,"]);
            }
            
       }
    }

    public function getAllEncaissement(){
        $encaissements = Encaissement::all();

        return view('caisses.all_encaissements', compact('encaissements'));
    }

    public function getEncaissement($lug){

    }
}
