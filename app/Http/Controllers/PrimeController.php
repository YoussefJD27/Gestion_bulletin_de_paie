<?php

namespace App\Http\Controllers;

use App\Models\Prime;
use App\Models\Salarie;
use Illuminate\Http\Request;

class PrimeController extends Controller
{
    
    public function index()
    {
        $prime=Prime::All();
        return view('prime.index',compact('prime'));
    }


    public function create()
    {
        $salarie=Salarie::all();
        return view('prime.create',compact('salarie'));
    }


    public function store(Request $request)
    {
        $data=$request->validate(
            [
                'description'=>'required',
                'montant'=>'required',
                'type'=>'required',
                'salarie_id'=>'required',
            ]
            );
            Prime::create($data);
            return redirect(route('R_primes.index'));
    }



    public function edit(Prime $id)
    {
        $salarie=Salarie::all();
        return view('prime.edit',compact('id','salarie'));
    }

    public function update(Request $request, Prime $id)
    {
        $data=$request->validate(
            [
                'description'=>'required',
                'montant'=>'required',
                'type'=>'required',
                'salarie_id'=>'required',
            ]);
            
        $id->update($data);
        return redirect(route('R_primes.index'));
    }


    public function destroy(string $id)
    {
        Prime::destroy($id);
        return redirect(route('R_primes.index'));
    }
}
