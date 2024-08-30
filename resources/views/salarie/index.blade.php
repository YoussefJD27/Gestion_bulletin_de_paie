

<!-- resources/views/Prime/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">La Liste Des Salaries </h1>
    <a class="btn btn-primary mb-3" href="{{ route('R_salaries.create') }}">Create New</a>
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom </th>
                    <th>Prenom</th>
                    <th>Ville</th>
                    <th>CIN</th>
                    <th>Embauche</th>
                    <th>Tel</th>
                    <th>Salaire</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($salarie as $sala)
                <tr>
                    <td>{{$sala->nom}}</td>
                    <td>{{$sala->prenom}}</td>
                    <td>{{$sala->ville}}</td>
                    <td>{{$sala->cin}}</td>
                    <td>{{$sala->date_embauche}}</td>
                    <td>{{$sala->tel}}</td>
                    <td>{{$sala->salaire_de_base}}</td>
                    <td class="action-buttons">
                        <a  class="btn btn-primary" href="{{ route('R_salaries.edit',$sala->id)}}" role="button">Edite</a>
                        <a  class="btn btn-primary" href="{{ route('R_salaries.destroy',$sala->id)}}" role="button">Delete</a>
                        <a  class="btn btn-primary" href="{{ route('R_salaire.checkDate',$sala->id)}}" role="button">Bulletin</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
                
</table>
        </div>
</div>

@endsection



