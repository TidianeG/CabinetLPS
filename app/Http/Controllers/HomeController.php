<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Consultation;
use App\Models\PointVente;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home_user()
    {
        $clients = Client::all();
        $tickets = Ticket::whereDate('created_at','=',date('Y-m-d'))->get();
        $consultations = Consultation::where('user_id','=',Auth::user()->id)->with('Ticket')->get();
        // //dd($consultations);
        // foreach($consultations as $consultation){
        //     dd($consultation->ticket);
        // }
        //dd($consultations->each(static fn(Consultation $consultation) => dump($consultation->tickets)));
        $point_ventes = PointVente::all();
        
        return view('home_user', compact('clients','consultations','point_ventes','tickets'));
    }

    public function getAccount(){
        return view('profile');
    }
}
