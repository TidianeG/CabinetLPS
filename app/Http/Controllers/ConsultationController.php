<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\IPM;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
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

    public function getConsultations(){
        $consultations = Consultation::all();
        $ipms = IPM::all();
        return view('consultations.list_consultation_type', compact('consultations','ipms'));
    }

    public function registerConsultation(Request $request):RedirectResponse{
        $validated =  $request->validate([
            'nom_type_consultation' => 'required|string|max:255',
            'description_type_consultation' => 'required|string|max:255',
            'prix_type_consultation' => 'required|integer',
        ]);
        
        $consultation = new Consultation();
        $consultation->nom_consultation = $validated['nom_type_consultation'];
        $consultation->description = $validated['description_type_consultation'];
        $consultation->prix_consultation = $validated['prix_type_consultation'];
        
        $consultation->user_id = Auth::user()->id;
        $consultation->save();
        if (empty($consultation)) {
             
             return redirect()->back()->with(['error' => "Erreur, vérifier les parametres"]);
        }
        else {
             
            return redirect()->back()->with(['success' => "Consultation ajouté avec succès"]);
       }
    }

    public function getConsultation($slug){
        $consultation = Consultation::find($slug);

        if ($consultation) {
            return response()->json([
                'id' => $consultation->id,
                'nom' => $consultation->nom_consultation,
                'description' => $consultation->description,
                'prix' => $consultation->prix_consultation,
                'status' => 'success'
            ], 200);
        }
        else{
            return response()->json(['status' => 'error']);
        }
    }
}
