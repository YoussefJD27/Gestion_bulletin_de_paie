<?php

namespace App\Http\Controllers;

use App\Models\Salaire;
use App\Models\Salarie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
{
    $data = $request->validate([
        'nbr_joure_t' => 'required',
        'h_supplementaire_j_ouvrable_6_21[0]' => 'nullable|integer',
        'h_supplementaire_j_ouvrable_21_6[0]' => 'nullable|integer',
        'h_supplementaire_j_ferie_6_21[0]' => 'nullable|integer',
        'h_supplementaire_j_ferie_21_6[0]' => 'nullable|integer',
    ]);
    $data['salarie_id'] = $id;

    $dateActuelle = Carbon::now();
    $salaries=Salarie::where('id',$id)->first();
    $date_embauche = Carbon::parse($salaries->date_embauche);
    $nbr_ans=$date_embauche->diffInYears($dateActuelle);
    
    $tranches = [[2,5,0.05],[5,12,0.10],[12,20,0.15],[20,25,0.20],[25,PHP_INT_MAX,0.25],];

    $anciennete = 0;
    foreach ($tranches as $tranche) {
        if ($tranche[0] <=$nbr_ans && $nbr_ans < $tranche[1]) {
            $anciennete = $salaries->salaire_de_base*$tranche[2];
            break;
        }   
    }
    $data['anciennete'] = $anciennete;
    $montant_1H=$salaries->salaire_de_base/191;
    $montant_h_sup=0;
    if($request->h_supplementaire_j_ouvrable_6_21[0]){
        $montant_h_sup+=$montant_1H*1.25*$request->h_supplementaire_j_ouvrable_6_21[0];
    }
    if($request->h_supplementaire_j_ouvrable_21_6[0]){
        $montant_h_sup+=$montant_1H*1.5*$request->h_supplementaire_j_ouvrable_21_6[0];
    }
    if($request->h_supplementaire_j_ferie_6_21[0]){
        $montant_h_sup+=$montant_1H*1.5*$request->h_supplementaire_j_ferie_6_21[0];
    }
    if($request->h_supplementaire_j_ferie_21_6[0]){
        $montant_h_sup+=$montant_1H*2*$request->h_supplementaire_j_ferie_21_6[0];
    }
    $data['montant_heures_supplementaires'] = $montant_h_sup;
    Salaire::create($data);

    return redirect(route('R_bulltines.store',compact('id')));
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
