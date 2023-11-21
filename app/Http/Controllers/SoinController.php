<?php

namespace App\Http\Controllers;

use App\Models\Soin;
use App\Models\SoinEnAttente;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoinController extends Controller
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

    public function addNewSoin($slug){
        
        return view('medecin.new_soin');
    }

    public function saveSoin($slug_id_soin_attente){

            $slug_id_soin_attente = intval($slug_id_soin_attente);
            
            $soin_attente = SoinEnAttente::find($slug_id_soin_attente);
            
            $soin = new Soin();
            $soin->description_soin= $soin_attente->description_soin;
            $soin->nombre_soin = $soin_attente->nombre_soin;
            $soin->montant_total_soin = $soin_attente->montant_total_soin;
            $soin->user_id= $soin_attente->user_id;
            $soin->client_id = $soin_attente->client_id;
            $soin->ticket_id = $soin_attente->ticket_id;
            
            $soin->save();

            $soin_attente_delete = SoinEnAttente::find($slug_id_soin_attente)->delete();

            if ($soin_attente_delete) {
                return redirect()->route('my_caisse')->with(['success' => "Validation éffectuée !!!"]);
            }
            else{
                return redirect()->back()->with(['error' => "Erreur,"]);
            }
    }
}
