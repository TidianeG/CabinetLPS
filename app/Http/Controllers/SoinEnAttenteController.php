<?php

namespace App\Http\Controllers;

use App\Models\SoinEnAttente;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoinEnAttenteController extends Controller
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

    public function saveSoinEnAttente(Request $request){
            
        $ticket = Ticket::where('numero', $request->input('numero_ticket'))->first();
        
        $soin = new SoinEnAttente();
        $soin->description_soin= $request->input('description_soin');
        $soin->nombre_soin = $request->input('nombre_soin');
        $soin->montant_total_soin = intval($request->input('nombre_soin')) * 5000;
        $soin->user_id= Auth::user()->id;
        $soin->client_id = $ticket->client_id;
        $soin->ticket_id = $ticket->id;
        //dd($soin);
        $soin->save();

        if ($soin) {
            return redirect()->back()->with(['success' => "Soin ajouté et en attente de paiement pour validation"]); //$pdf->stream($patch_url.'.pdf');//
        }
        else {
            return redirect()->back()->with(['error' => "Soin non ajouté"]);
        }
    }

    public function getSoinsAllAttenteValidation(){
        $soin_en_attente_validations = SoinEnAttente::all();

        return view('soin.soin_en_attente', compact('soin_en_attente_validations'));
    }
}
