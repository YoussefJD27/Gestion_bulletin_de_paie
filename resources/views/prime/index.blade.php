<!-- resources/views/Prime/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">La List Des Primes </h1>
    <a class="btn btn-primary mb-3" href="{{ route('R_primes.create') }}">Create New</a>
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Description </th>
                    <th>Montant</th>
                    <th>Type</th>
                    <th>Salarie</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($prime as $prim)
                <tr>
                    <td>{{$prim->description}}</td>
                    <td>{{$prim->montant}}</td>
                    <td>{{$prim->type}}</td>
                    <td>{{$prim->salaries->nom}} {{$prim->salaries->prenom}}</td>
                    <td>
                        <a  class="btn btn-primary" href="{{ route('R_primes.edit',$prim->id)}}" role="button">Edite</a>
                        <a  class="btn btn-primary" href="{{ route('R_primes.destroy',$prim->id)}}" role="button">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
                
</table>
        </div>
</div>

@endsection


