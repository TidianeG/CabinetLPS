<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use App\Models\Client;
use App\Models\Consultation;
use App\Models\ConsultationIPM;
use App\Models\IPM;
use App\Models\PointVente;
use App\Models\Ticket;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;

class TicketController extends Controller
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


    public function createTicket(Request $request){

        
        $consultation = Consultation::find($request->input('consultation'));
        $ticket = new Ticket();
    
        $client_id = $request->input('client_exist');
        $client = Client::find($client_id);
        $gerant =  Auth::user()->prenom.' '.Auth::user()->nom; 
        
        $point_vente = PointVente::where('gerant','=',$gerant)->first();
        $test_client_ipm = 0;
        if ($request->input('check_new_client')==1) {
            $client = new Client();
            $client->prenom_client = $request->input('prenom_patient');
            $client->nom_client = $request->input('nom_patient');
            $client->adresse_client = $request->input('adresse');
            $client->personne_confiance = $request->input('personne_confiance');
            $client->telephone_client = $request->input('telephone');
            if ($request->input('ipm_check')==1) {
                $client->participant = $request->input('participant');
                $client->taux_pourcentage = $request->input('taux_pourcentage');
                $client->ipm_id = intval($request->input('type_ipm'));
                
            }
            
            $client->user_id = Auth::user()->id;
            $client->save();
            
            $client_id = $client->id;
        }

        $lastid = Ticket::latest('id')->first();
        
        if ($lastid) {
            $lastid_id = $lastid->id;
        }
        if (!$lastid) {
            $lastid_id=0;
        }
        $ticket->numero = 'TI0000'.$lastid_id+1;
        $ticket->type_paiement = $request->input('type_paiement');
        $ticket->user_id = Auth::user()->id;
        $ticket->client_id = $client_id;
        $ticket->consultation_id = $consultation->id;
        $ticket->point_vente_id = $point_vente->id;

        $prix_consultation_ipm = 0;
        $taux_IPM = 0;
        
        if ($client->ipm_id) {
            $tarif_consult_ipm = ConsultationIPM::where('consultation_id','=',$consultation->id)->first();
            //
            //dd($tarif_consult_ipm->prix_consultation_ipm);
        }

        if (!empty($tarif_consult_ipm)) {
            $ticket->montant_total = ($tarif_consult_ipm->prix_consultation_ipm - ($tarif_consult_ipm->prix_consultation_ipm * $client->taux_pourcentage / 100));
            //dd($ticket->montant_total);
            $prix_consultation_ipm = $tarif_consult_ipm->prix_consultation_ipm;
            $taux_IPM = $client->taux_pourcentage;
        }
        if (empty($tarif_consult_ipm)) {
            $ticket->montant_total = $consultation->prix_consultation;
        }

        $ticket->date_creation = date('Y/m/d');
        $ticket->heure_creation = date('H:i:s');
        $ticket->consultation_id = $consultation->id;
        $ticket->save();

        $caisse_ticket = new Caisse();
        $caisse_ticket->ticket_id = $ticket->id;
        $caisse_ticket->solde_ticket= $ticket->montant_total;
        $caisse_ticket->user_id = $ticket->user_id;
        $caisse_ticket->save();
        
        $data = [
            'date' => $ticket->date_creation,
            'time' => $ticket->heure_creation,
            'numero' => $ticket->numero,
            'type_paiement' => $ticket->type_paiement,
            'consultation' => $consultation->nom_consultation,
            'prix' => $consultation->prix_consultation,
            'total' => $ticket->montant_total,
            'client' => $client->prenom_client." ".$client->nom_client,
            'prix_consultation_ipm' => $prix_consultation_ipm,
            'taux_IPM' => $taux_IPM,
        ];

        $pdf = PDF::loadView('point_ventes.magecompPDF', $data);

        return $pdf->download('ticket_caisse.pdf');

        // if ($genere_pdf) {
        //     return redirect()->back()->with(['success' => "Ticket généré avec succès"]);
            
        // }
        // return redirect()->back()->with(['error' => "Erreur d'impression du ticket"]);
        
      
    }

    public function getAllTickets(){
        $tickets = Ticket::all();
        //dd($tickets->consultations);
        return view('tickets.lists_des_tickets', compact('tickets'));
    }
}