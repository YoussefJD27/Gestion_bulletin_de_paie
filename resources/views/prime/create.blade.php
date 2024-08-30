
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Create des  Primes</h1>
    <form  method="post" action="{{route('R_primes.store')}}">
        @csrf
        <div class="form-group">
            <label for="description">Description :</label>
            <input type="text" class="form-control" name="description" >
            @error('description')
                <div class="form-error text-danger text-danger">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="montant">Montant :</label>
            <input type="number" class="form-control" name="montant">
            @error('montant')
                <div class="form-error text-danger">
                    {{$message}}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="type">Type : </label>
            <select name="type" id="" class="form-control">
                <option value="Variable">Variable</option>           
                <option value="Fixe">Fixe</option>           
                <option value="Bonus">Bonus</option>           
            </select>
            @error('type')
            <div class="form-error text-danger text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="salarie_id">Salarie :</label>
            <select name="salarie_id" id="" class="form-control">

            @foreach($salarie as $sala)
                <option value="{{$sala->id}}">{{$sala->prenom}} {{$sala->nom}}</option>           
            @endforeach

            </select>
            @error('salarie_id')
                <div class="form-error text-danger">
                    {{$message}}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route ('R_primes.index')}}">Back to List </a>
    </form>
</div>

@endsection