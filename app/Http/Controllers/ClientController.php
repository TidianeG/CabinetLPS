<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\IPM;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
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

    public function getClients(){
        $clients = Client::all();
        $ipms = IPM::all();
        
        return view('clients.clients',compact('clients','ipms'));
    }

    public function getClientsCaissier(){
        $clients = Client::all();
        $ipms = IPM::all();
        
        return view('clients.clients_caissier',compact('clients','ipms'));
    }

    public function getClient($slug){
        $client = Client::find($slug);
        return view('clients.get_client',compact('client'));
    }
    
    public function getUsers(){
        $users = User::where('profil','!=','admin')->get();
        return view('auth.list_users', compact('users'));
    }

    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create_user(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'profil' => 'required|string|max:255',
        ]);
        //dd($validated);
        $user = new User();
        $user->prenom = $validated['prenom'];
        $user->nom = $validated['nom'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->profil = $validated['profil'];
        $user->save();
        if (empty($user)) {
             
             return redirect()->back()->with(['error' => "Erreur, vérifier les parametres"]);
        }
        else {
             
            return redirect()->back()->with(['success' => "Utilisateur ajouté avec succès"]);
       }
    }

    public function register_client(Request $request):RedirectResponse
    {
        $validated =  $request->validate([
            'prenom_patient' => 'required|string|max:255',
            'nom_patient' => 'required|string|max:255',
            'personne_confiance' => 'required|string|max:255',
            'phone_patient' => 'string|max:255',
            'adresse_patient' => 'required|string|max:255',
            'personne_confiance' => 'required|string|max:255',
        ]);
        
        $client = new Client();
        $client->participant = null;
        $client->taux_pourcentage = null;
        $client->ipm_id = null;
        if ($request->input('check_ipm_client')==1) {
            $client->participant = $request->input('participant_ipm');
            $client->taux_pourcentage = $request->input('taux_pourcentage');
            $client->ipm_id = $request->input('ipm_client');
        }

        $lastid = Client::latest('id')->first();
        
        if ($lastid) {
            $lastid_id = $lastid->id;
        }
        if (!$lastid) {
            $lastid_id=0;
        }
        $client->numero_client = 'P/000'.$lastid_id+1;
        $client->prenom_client = $validated['prenom_patient'];
        $client->nom_client = $validated['nom_patient'];
        $client->personne_confiance = $validated['personne_confiance'];
        $client->telephone_client = $validated['phone_patient'];
        $client->adresse_client = $validated['adresse_patient'];
        
        $client->user_id = Auth::user()->id;
        $client->save();
        if (empty($client)) {
             
             return redirect()->back()->with(['error' => "Erreur, vérifier les parametres"]);
        }
        else {
             
            return redirect()->back()->with(['success' => "Client ajouté avec succès"]);
       }
    }

    public function getClientIPM($slug){
        $client = Client::find($slug);

        if ($client) {
            return response()->json([
                'ipm_id' => $client->ipm_id,
                'status' => 'success'
            ], 200);
        }
        else{
            return response()->json(['status' => 'error']);
        }
    }
}
