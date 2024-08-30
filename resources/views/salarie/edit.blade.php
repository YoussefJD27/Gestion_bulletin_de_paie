
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Update Un  Salarie</h1>

    <form action="{{route('R_salaries.update',['id'=>$id])}}" method="post">
        @csrf
        @method('put')

    <div class="form-group">
    <label for="nom">Nom :</label>
    <input type="text" class="form-control" name="nom" value="{{$id->nom}}" placeholder="Nom">
    </div>
    <div class="form-group">
    <label for="prenom">Prenom :</label>
    <input type="text" class="form-control" name="prenom" value="{{$id->prenom}}" placeholder="Prenom">
    </div>


    <div class="form-group">
    <label for="ville">Ville :</label>
    <input type="text" class="form-control" name="ville" value="{{$id->ville}}" placeholder="Ville">
    </div>
    
    <div class="form-group">
    <label for="cin">CIN :</label>
    <input type="text" class="form-control" name="cin" value="{{$id->cin}}" placeholder="CIN">
    </div>
    <div class="form-group">
    <label for="date_embauche">Date Embauche :</label>
    <input type="date" class="form-control" name="date_embauche" value="{{$id->date_embauche}}" placeholder="date_embauche">
    </div>
    <div class="form-group">
    <label for="tel">Telephone :</label>
    <input type="text" class="form-control" name="tel" value="{{$id->tel}}" placeholder="Telephone">
    </div>
    <div class="form-group">
    <label for="salaire_de_base">Salaire de base :</label>
    <input type="text" class="form-control" name="salaire_de_base" value="{{$id->salaire_de_base}}" placeholder="Salaire de base">
    </div>



    <div >
    <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route ('R_salaries.index')}}">Back to List </a>
    </div>

    </form>
</div>



@endsection