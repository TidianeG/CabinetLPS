<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use App\Models\Client;
use App\Models\Consultation;
use App\Models\IPM;
use PDF;
use App\Models\PointVente;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointVenteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function getPointsVentes(){
        $points_ventes = PointVente::all();
        $users = User::where('profil','=','caissier')->get();
        return view('point_ventes.points_ventes', compact('points_ventes','users'));
    }

    public function registerPointVente(Request $request):RedirectResponse{
        $validated =  $request->validate([
            'nom_point_vente' => 'required|string|max:255',
            'gerant' => 'required|integer',
            'description' => 'required|string|max:255',
        ]);
        
        $point_vente = new PointVente();
        $gerant = User::find($validated['gerant'])  ;
        $point_vente->nom_point_vente = $validated['nom_point_vente'];
        $point_vente->gerant = $gerant->prenom.' '.$gerant->nom;
        $point_vente->description = $validated['description'];
        
        $point_vente->user_id = Auth::user()->id;

        $point_vente->save();
        if (empty($point_vente)) {
             return redirect()->back()->with(['error' => "Erreur, vérifier les parametres"]);
        }
        else {
            return redirect()->back()->with(['success' => "Point de Vente ajouté avec succès"]);
       }
    }

    public function myCaisse(){
        $gerant = Auth::user()->prenom.' '.Auth::user()->nom;
        $caisse = PointVente::where('gerant','=',$gerant)->first();

        $etat_journalier = Ticket::where('date_creation','=',date('Y-m-d'))->get();
        $etat_journalier_alls = Ticket::where('user_id','=',Auth::user()->id)->get();
        //dd($etat_journalier->ticket());
        $etat_journalier = $etat_journalier->where('user_id','=',Auth::user()->id);
        $nombre_ticket = 0;
        $somme_total = 0;

        $tableau_etat_ticket_date = [];
        foreach($etat_journalier_alls as $etat_journalier_all){
            $tableau_etat_ticket_date = [
                'date' => $etat_journalier_all->date_creation,
                'nombre_ticket' => $nombre_ticket,
                'somme_total' => $somme_total
            ];
        }

        foreach($etat_journalier as $etat){
            $nombre_ticket = count($etat_journalier);
            $somme_total += $etat->montant_total;

        }
        $recap_etat_journalier = [
            'date' => date('Y-m-d'),
            'nombre_ticket' => $nombre_ticket,
            'somme_total' => $somme_total
        ];
        //dd($recap_etat_journalier);
        return view('point_ventes.caisse',compact('caisse','recap_etat_journalier'));
    }

    public function espaceCaisse(){

        $clients = Client::all();
        $consultations = Consultation::all();
        //dd(today());
        $tickets = Ticket::where('tickets.user_id','=',Auth::user()->id)->orWhere('date_creation','=',date('Y-m-d'))->join('consultations','consultations.id','=','tickets.consultation_id')->get();
        // $tickets1 = $tickets->toArray();
         //dd($tickets);
        $ipms = IPM::all();
        $etat_journalier = Caisse::whereDate('created_at','=',date('Y-m-d'))->get();
        
        $etat_journalier = $etat_journalier->where('user_id','=',Auth::user()->id);
        $nombre_ticket = 0;
        $somme_total = 0;
        foreach($etat_journalier as $etat){
            $nombre_ticket = count($etat_journalier);
            $somme_total += $etat->solde_ticket;

        }
        return view('point_ventes.espace_vente', compact('clients','consultations','ipms','nombre_ticket','somme_total'));
    }

    public function getAllTickets(){
        $tickets = Ticket::where('tickets.user_id','=',Auth::user()->id)
                            ->join('consultations','consultations.id','=','tickets.consultation_id')
                            ->join('clients','clients.id','=','tickets.client_id')
                            ->get();

        return view('point_ventes.list_all_tickets', compact('tickets'));
    }

    public function getAllTicketsCaisse(){
        $caisses = Caisse::where('user_id','=',Auth::user()->id)->get();

        return view('tickets.list_all_tickets_caisse', compact('caisses'));
    }

    
}
