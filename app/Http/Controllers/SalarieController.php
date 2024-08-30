<?php

namespace App\Http\Controllers;

use App\Models\Bulltine;
use App\Models\Salaire;
use App\Models\Salarie;
use App\Models\Taux;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalarieController extends Controller
{
    public function checkDate($id){
        
         $currentMonth = Carbon::now()->month;
         $currentYear = Carbon::now()->year;
       
         $bulletinExists = Bulltine::whereMonth('created_at', $currentMonth)
                                ->whereYear('created_at', $currentYear)
                                ->where('salarie_id', $id)
                                ->exists(); 

            /* $bulletinExists=0;  */

        if($bulletinExists){
            $bulltines=Bulltine::where('salarie_id', $id)->orderBy('id', 'desc')->first();
            $salarie=Salarie::where('id', $id)->get();
               $taux=Taux::first();
            return view('bulletindepaie.index',compact('bulltines','taux','salarie'));
        }else{
            return view('Salaire.create',compact('id'));
        };
    }

    public function index()
    {

        $salarie=Salarie::All();
        return view('salarie.index',compact('salarie'));
    }

    public function create()
    {
        return view('salarie.create');
    }

    public function show($id)
    {   
        $taux=Taux::first();
        $bulltines=Bulltine::where('salaire_id','like',$id)->get();
        return view('salarie.show',compact('bulltines','taux'));
    }

    public function store(Request $request)
    {
        $data=$request->validate(
            [
                'nom'=>'required',
                'prenom'=>'required',
                'ville'=>'required',
                'cin'=>'required',
                'date_embauche'=>'required',
                'tel'=>'required',
                'salaire_de_base' => 'required|numeric',
            ]
            );
            Salarie::create($data);
            return redirect(route('R_salaries.index'))->with('success', 'Salarié créé avec succès.');
    }



    public function edit(Salarie $id)
    {
        return view('salarie.edit',compact('id'));
    }

    public function update(Request $request, Salarie $id)
    {
        $data=$request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'ville'=>'required',
            'cin'=>'required',
            'date_embauche'=>'required',
            'tel'=>'required',
            'salaire_de_base'=>'required',
        ]);
            
        $id->update($data);
        return redirect(route('R_salaries.index'));
    }


    public function destroy(string $id)
    {
        Salarie::destroy($id);
        return redirect(route('R_salaries.index'))->with('success', 'Salarié créé avec succès.');;
    }
}

