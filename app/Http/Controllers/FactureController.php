<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use PDF;
class FactureController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function genererFacture(Request $request){
        
        $identifiant_ticket = intval($request->input('identifiant_ticket'));

        $ticket = Ticket::find($identifiant_ticket);
        //$soin = 
        $data = [
            'date' => $ticket->date_creation,
            'consultation' => $ticket->consultation->nom_consultation,
            'numero' => $ticket->numero,
            'type_paiement' => $ticket->type_paiement,
            'total' => $ticket->montant_total,
            'client' => $ticket->client->prenom_client." ".$ticket->client->nom_client,
            'soin' => $ticket->soin,
            'adresse' =>$ticket->client->adresse_client,
            'numero_client' =>$ticket->client->numero_client,
        ];
        $pdf = PDF::loadView('facturations.facture', $data);

        return $pdf->stream("Facture".$ticket->numero.".pdf");
    }
}
