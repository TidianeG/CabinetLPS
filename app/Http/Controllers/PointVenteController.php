<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use App\Models\Client;
use App\Models\Consultation;
use App\Models\ConsultationIPM;
use App\Models\IPM;
use PDF;
use App\Models\PointVente;
use App\Models\StatutCaisse;
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
        $point_vente_exist = PointVente::where('nom_point_vente', $validated['nom_point_vente'])->first();
        if ($point_vente_exist) {
            return redirect()->back()->with(['error' => "Nom du point de vente existe déja !!!"]);
        }

        else {
            $point_vente = new PointVente();
            $statu_caisse = new StatutCaisse();

            $gerant = User::find($validated['gerant']);
            $point_vente->nom_point_vente = $validated['nom_point_vente'];
            $point_vente->gerant = $gerant->prenom.' '.$gerant->nom;
            $point_vente->user_id = intval($gerant->id);
            $point_vente->description = $validated['description'];
            $point_vente->save();

            //renplissage de la table statut caisse pour le nouveu point vente
            $statu_caisse->statut = 0;
            $statu_caisse->point_vente_id = $point_vente->id;
            $statu_caisse->save();
            if (empty($point_vente)) {
                return redirect()->back()->with(['error' => "Erreur, vérifier les parametres"]);
            }
            else {
                return redirect()->back()->with(['success' => "Point de Vente ajouté avec succès"]);
            }
        }
        
    }

    public function myCaisse(){
        $etat_journalier = Ticket::where('user_id',Auth::user()->id);
        $users_grouped = $etat_journalier->groupBy(function ($item, $key) {
            return $item->created_at->format('d-m-Y');
        });

        $gerant = Auth::user()->prenom.' '.Auth::user()->nom;
        $point_vente = PointVente::where('gerant','=',$gerant)->first();
        //dd($point_vente);
        //dd($etat_journalier->ticket());
        $caisses = Caisse::where('user_id','=',Auth::user()->id)->get();
        $nombre_ticket = 0;
        $somme_total = 0;

        foreach($caisses as $etat){
            $nombre_ticket = count($caisses);
            $somme_total += $etat->solde_ticket;
        }
        $recap_etat_journalier = [
            'date' => date('Y-m-d'),
            'nombre_ticket' => $nombre_ticket,
            'somme_total' => $somme_total
        ];
        //dd($recap_etat_journalier);
        return view('point_ventes.caisse',compact('recap_etat_journalier','users_grouped','point_vente'));
    }

    public function espaceCaisse(){

        $clients = Client::all();
        $consultations = Consultation::all();
        //dd(today());
        $gerant = Auth::user()->prenom.' '.Auth::user()->nom;
        $point_vente = PointVente::where('gerant','=',$gerant)->first();
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
        //changement du statut de caisse
        $statu_caisse = StatutCaisse::where('point_vente_id',$point_vente->id)->first();
        $statu_caisse->statut = 1;
        $statu_caisse->save();

        return view('point_ventes.espace_vente', compact('clients','consultations','ipms','nombre_ticket','somme_total','point_vente'));
    }

    public function getAllTickets(){
        $tickets = Ticket::where('user_id','=',Auth::user()->id)->get();
        $consultations = Consultation::all();
        return view('point_ventes.list_all_tickets', compact('tickets','consultations'));
    }

    public function getAllTicketsCaisse(){
        $caisses = Caisse::where('user_id','=',Auth::user()->id)->get();

        return view('tickets.list_all_tickets_caisse', compact('caisses'));
    }

    public function getIPMClient($paramipmconsult){
        $id_ipm = intval($paramipmconsult[0]);
        $id_consultation = intval($paramipmconsult[2]);

        $prix_ipm_consultation = ConsultationIPM::where('consultation_id','=', $id_consultation)->get();
        $prix_ipm_consultation = $prix_ipm_consultation->where('i_p_m_id','=',$id_ipm)->first();
        return response()->json([
            'nom_ipm' => $prix_ipm_consultation->i_p_m->nom_ipm,
            'nom_consultation' => $prix_ipm_consultation->consultation->nom_consultation,
            'prix_consultation_ipm' => $prix_ipm_consultation->prix_consultation_ipm,
            'status' => 'success',
        ], 200);
    }

    
}
