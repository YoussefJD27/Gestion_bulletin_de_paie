<?php

namespace App\Http\Controllers;

use App\Models\Bulltine;
use App\Models\Prime;
use App\Models\Salaire;
use App\Models\Salarie;
use App\Models\Taux;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BulletineController extends Controller
{
    public function All_bulletin()
    {
        $bulltines = Bulltine::orderBy('id', 'desc')->get();
        $taux=Taux::first();
        return view('bulletindepaie.All_bulletin',compact('bulltines','taux'));
    }
    public function index($id)
    {
        $bulltines=Bulltine::where('salarie_id', $id)->orderBy('id', 'desc')->first();
        $salarie=Salarie::where('id', $id)->get();
        $taux=Taux::first();
        return view('bulletindepaie.index',compact('bulltines','taux','salarie'));
    }
    
    public function create()
    {
        $salarie=Salarie::all();
        
        return view('bulletindepaie.create',compact('salarie'));
    }

    public function show(Request $request)
    {
        $request->validate([
            'month' => 'nullable|integer|between:1,12',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);
    
        $month = $request->input('month');
        $year = $request->input('year');
    
        $query = Bulltine::query();
    
        if ($month) {
            $query->whereMonth('date', $month);
        }
    
        $query->whereYear('date', $year);
    
        $bulltines = $query->orderBy('id', 'desc')->get();
        $taux = Taux::first();
        
        return view('bulletindepaie.All_bulletin', compact('bulltines', 'taux'));
    }
    
 
    public function store(Request $request,$id)
    {
        
            $data= new Bulltine();
            
            $data->salarie_id=$id;
            
            $E_salarie = Salarie::findOrFail($id);
            $salaire = Salaire::where('salarie_id', $id)->orderBy('created_at', 'desc')->first();
            
            $taux=Taux::first();
            if($salaire->nbr_joure_t<26){
                $salaire_brut=$salaire->nbr_joure_t*($E_salarie->salaire_de_base/26);
            }else{
                $salaire_brut=$E_salarie->salaire_de_base;
            };
            $salaire_brut+=$salaire->montant_heures_supplementaires;
            $salaire_brut+=$salaire->anciennete;
            
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
           
            
            $bonus = Prime::whereMonth('created_at', $currentMonth)
                                    ->whereYear('created_at', $currentYear)
                                    ->where('salarie_id', $id)
                                    ->where('type','Bonus')->sum('montant'); 
            $salaire_brut += Prime::whereMonth('created_at', $currentMonth)
                                    ->whereYear('created_at', $currentYear)
                                    ->where('salarie_id', $id)
                                    ->where('type','Variable')->sum('montant'); 
            
            $salaire_brut += Prime::where('salarie_id', $id)
                                ->where('type','Fixe')->sum('montant'); 
            
            $data->salaire_brut=$salaire_brut;
            if($salaire_brut<6000){
                $cnss=($salaire_brut*$taux->taux_prestation_sociales_court_et_long_terme_salarie)/100;
            }else{
               $cnss=(6000*$taux->taux_prestation_sociales_court_et_long_terme_salarie)/100;
            };

            $amo=($salaire_brut*$taux->taux_amo_salarie)/100;
            $data->total_deduction=( $cnss+$amo);  

            
            if($salaire_brut<=6500){
                $frais_prof=$salaire_brut*0.35;
            }else{
                $frais_prof=$salaire_brut*0.25;
            }
            
            $revenu_net_imposable=($salaire_brut-$data->total_deduction-$frais_prof);

                    $tranches = [
                        [0,2500, 0.0, 0],
                        [2501,4166.67, 0.1, 250],
                        [4166.68,5000, 0.2, 666.67],
                        [5001,6666.67, 0.3, 1166.67],
                        [6666.68,15000, 0.34, 1433.33],
                        [PHP_INT_MAX, 0.38, 2033.33] 
                    ];

                    $ir = 0;
                    foreach ($tranches as $tranche) {
                        if ($tranche[0] <= $revenu_net_imposable && $revenu_net_imposable <= $tranche[1]) {
                            $ir = $revenu_net_imposable*$tranche[2]- $tranche[3];
                            break;
                        }   
                    }
           
             $data->salaire_net=$salaire_brut-$data->total_deduction-$ir+$bonus;
            $data->save();
            
            return redirect(route('R_bulltines.index',['id' => $id]));

    }



    public function edit(Bulltine $id)
    {
        return view('bulletindepaie.edit',compact('id'));
    }

    public function update(Request $request, Bulltine $id)
    {
        $data=$request->validate([
            [
                'date'=>'required',
                'salarie_id'=>'required',
            ]
        ]);
            
        $id->update($data);
        return redirect(route('R_bulltines.index'));
    }


    public function destroy(string $id)
    {       
         $salarie_id = Bulltine::where('id', $id)->value('salarie_id');

        Bulltine::destroy($id);
        
        $id=$salarie_id;
        
        return view('Salaire.create',compact('id'));
        
    }
   
    public function downloadBulletin($id)
    {
        $bulltine = Bulltine::with('salarie', 'salarie.salaire', 'salarie.primes')->findOrFail($id);
        $taux = Taux::first(); // Assurez-vous d'obtenir les taux nécessaires

        // Formate la date pour le nom du fichier
        $formattedDate = $bulltine->date; 

        $pdf = PDF::loadView('bulltines.pdf', compact('bulltine', 'taux'));

        return $pdf->download('bulletin_paie_' . $bulltine->salarie->nom . '_' . $formattedDate . '.pdf');
    }
    
}

