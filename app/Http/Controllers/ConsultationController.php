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
        
        $consultation_exist = Consultation::where('nom_consultation',$validated['nom_type_consultation'])->first();
        
        if ($consultation_exist) {
            return redirect()->back()->with(['error' => "Cette consultation existe déja !!!"]);
        }
        else {
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

    public function updateConsultation(Request $request){
        
        $id_consult = intval($request->input('identifiant_consultation'));
        $nom_consult = $request->input('nom_type_consultation_update');
        $prix_consult = $request->input('prix_type_consultation_update');
        $description_consult = $request->input('description_type_consultation_update');

        $update_consultation = Consultation::find($id_consult)
                            ->update(['nom_consultation'=>$nom_consult,'prix_consultation'=>$prix_consult, 'description'=>$description_consult]);
        if (empty($update_consultation)) {
                
            return redirect()->back()->with(['error' => "Erreur, vérifier les parametres"]);
        }
        else {
            
            return redirect()->back()->with(['success' => "Consultation modifiée avec succès"]);
        }
    }
}
