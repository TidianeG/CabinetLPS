<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\ConsultationIPM;
use App\Models\IPM;
use Illuminate\Http\Request;

class IpmController extends Controller
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

    public function getIPMS(){
        $consultations = Consultation::all();
        $ipms = IPM::all();
        $ipms_consultations = ConsultationIPM::all();
                                //->join('consultations','consultations.id','=','consultation_i_p_m_s.consultation_id');
        
        return view('ipms.list_ipms', compact('consultations','ipms','ipms_consultations'));
    }

    public function registerIPM(Request $request){
        $validated = $request->validate([
            'nom_ipm' => 'required|string|max:255',
        ]);

        $ipm_exist = IPM::where('nom_ipm', $validated['nom_ipm'])->first();
        if ($ipm_exist) {
            return redirect()->back()->with(['error' => "IPM déja ajouté !!!"]);
        } 
        else 
        {
            $ipm = new IPM();
            $ipm->nom_ipm = $validated['nom_ipm'];
            $ipm->save();
            if (empty($ipm)) {
                
                return redirect()->back()->with(['error' => "Erreur, vérifier les parametres"]);
            }
            else {
                
            return redirect()->back()->with(['success' => "IPM ajouté avec succès"]);
            }
        }
    }

    public function registerIPMConsultation(Request $request){
        $validated = $request->validate([
            'prix_ipm_consultation' => 'required|numeric',
            'select_consultation' => 'required|numeric',
            'select_ipm' => 'required|numeric',
        ]);

        $consultation_ipm_exist = ConsultationIPM::where('consultation_id', $validated['select_consultation']);
        if ($consultation_ipm_exist==null) {
            return redirect()->back()->with(['error' => "Ce prix est déja défini"]);
        } else {
            $consultation_ipm = new ConsultationIPM();
            $consultation_ipm->prix_consultation_ipm = $validated['prix_ipm_consultation'];
            $consultation_ipm->consultation_id = $validated['select_consultation'];
            $consultation_ipm->i_p_m_id = $validated['select_ipm'];
            $consultation_ipm->save();
            if (empty($consultation_ipm)) {
                    return redirect()->back()->with(['error' => "Erreur, vérifier les parametres"]);
            }
            else {
                    
                return redirect()->back()->with(['success' => "Prix ajouté avec succès pour la consultation"]);
            }
        }
    }
}
