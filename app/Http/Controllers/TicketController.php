<?php

namespace App\Http\Controllers;

require 'C:\wamp64\www\CaisseManagement\vendor\autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use App\Models\Caisse;
use App\Models\Client;
use App\Models\Consultation;
use App\Models\ConsultationIPM;
use App\Models\IPM;
use App\Models\PointVente;
use App\Models\Soin;
use App\Models\Ticket;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
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
        //dd($request);
        
        $consultation = Consultation::find($request->input('consultation'));
        $ticket = new Ticket();
    
        $client_id = $request->input('client_exist');
        $client = Client::find($client_id);
        $gerant =  Auth::user()->prenom.' '.Auth::user()->nom; 
        
        $point_vente = PointVente::where('gerant','=',$gerant)->first();
        $test_client_ipm = 0;

        // Si on selectionne un nouveau client
        // Si on selectionne un nouveau client
        if ($request->input('check_new_client')==1) {
            $lastid_client = Client::latest('id')->first();
            
            if ($lastid_client) {
                $lastid_client_id = $lastid_client->id;
            }
            if (!$lastid_client) {
                $lastid_client_id=0;
            }
            $client = new Client();
            $client->numero_client = 'P/000'.$lastid_client_id+1;
            
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

        // Si le client selectionner doit avoir un IPM
        // Si le client selectionner doit avoir un IPM
        if (($request->input('check_new_client')!=1) && ($request->input('ipm_check')==1)) {
            $client->participant = $request->input('participant');
            $client->taux_pourcentage = $request->input('taux_pourcentage');
            $client->ipm_id = intval($request->input('type_ipm'));
            $client->save();
        }

        // Début création du ticket
        // Début création du ticket
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
        
        if (isset($client->ipm_id)) {
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

        
        // $connector = new WindowsPrintConnector("ESPON TM-T88V Receipt");

        // $printer = new Printer($connector);
        // $printer -> text("Hello World!\n");
        // $printer -> cut();
        // //$printer -> close();
        
        if ($pdf) {
            $pdf->download("ticket_caisse".$ticket->numero.".pdf");
            $pdf->save(public_path("storage\documents\Tickets\pdf\Ticket_caisse".$ticket->numero.".pdf"));
            $patch_url = "Ticket_caisse".$ticket->numero;
            $ticket->patch_url = $patch_url;

            $ticket->save();

            return view('point_ventes.result_create_ticket', compact('ticket')); //redirect()->back()->with(['success' => "Ticket créé et imprimé avec succès"]); //$pdf->stream($patch_url.'.pdf');//
        }
        // else {
        //     return redirect()->back()->with(['error' => "Ticket non imprimé"]);
        // }
        
        
    }

    public function getAllTickets(){
        $tickets = Ticket::all();
        $consultations = Consultation::all();
        //dd($tickets->consultations);
        return view('tickets.lists_des_tickets', compact('tickets','consultations'));
    }

    public function etatFinancier(Request $request){

        $etat_select = request('etat_select');
        
        $date_debut = strtotime(request('date_debut'));
        $date_debut = date('Y-m-d',$date_debut);

        $date_fin = $request->input('date_fin');

        $name_consultation = "";
        
        if ($etat_select == 'consultation') {
            if (request('consultation_select')=="all") {
                if (!isset($date_fin) || $date_fin=="") {
                    //dd($consultation_select);
                    $etat_financiers = Ticket::whereDate('created_at', '=', $date_debut)->get();
                    //$etat_financier = $etat_financier->where('consultation_id','=',$consultation_select);
                    
                }
                else {
                    $date_fin = strtotime($date_fin);
                    $date_fin = date('Y-m-d',$date_fin);
                    $etat_financiers = Ticket::whereDate('created_at','>=', $date_debut)->where('created_at','<=', $date_fin)->orderBy('created_at')->get();
                  
                }
                $name_consultation = "Toutes les consultations";
            }
            else {
                $consultation_select = intval(request('consultation_select'));
                //dd($date_fin);
                if (!isset($date_fin) || $date_fin=="") {
                    //dd($consultation_select);
                    $etat_financiers = Ticket::whereDate('created_at', '=', $date_debut)->get();
                    //$etat_financier = $etat_financier->where('consultation_id','=',$consultation_select);
                    
                }
                else {
                    $date_fin = strtotime($date_fin);
                    $date_fin = date('Y-m-d',$date_fin);
                    $etat_financiers = Ticket::whereDate('created_at','>=', $date_debut)->where('created_at','<=', $date_fin)->orderBy('created_at')->get();
                    $etat_financiers= $etat_financiers->where('consultation_id','=',$consultation_select);
                
                }
                $name_consultation = Consultation::find($consultation_select);
            }
            $tab_donnee_consultation_retour = [
                'type_consult' => $name_consultation->nom_consultation,
                'date_debut' => $date_debut,
                'date_fin' => $date_fin,
            ];
            return view('etat_financiers.etatf_financier_ticket_admin', compact('etat_financiers','tab_donnee_consultation_retour'));
        }
        else {
            if (!isset($date_fin) || $date_fin=="") {
                //dd($consultation_select);
                $etat_financiers = Ticket::whereDate('created_at', '=', $date_debut)->get();
                //$etat_financier = $etat_financier->where('consultation_id','=',$consultation_select);
                
            }
            else {
                $date_fin = strtotime($date_fin);
                $date_fin = date('Y-m-d',$date_fin);
                $etat_financiers = Ticket::whereDate('created_at','>=', $date_debut)->where('created_at','<=', $date_fin)->orderBy('created_at')->get();
              
            }
            $tab_donnee_consultation_retour = [
                'type_consult' => "Tickets",
                'date_debut' => $date_debut,
                'date_fin' => $date_fin,
            ];
            return view('etat_financiers.etatf_financier_ticket_admin', compact('etat_financiers','tab_donnee_consultation_retour'));
        }

        
        
        
    }

    public function getTicket($ticket_id){
        $ticket = Ticket::find($ticket_id);
        
        //$url_file = public_path("storage\documents\Tickets\pdf\Ticket_caisse".$ticket->numero.".pdf");
        //header("Content-type: application/pdf");

        //header("Content-Length: ". $url_file);

        //readfile($url_file);
      return view('tickets.ticket', compact('ticket'));
    }
}
