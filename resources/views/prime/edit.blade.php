
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Update des  Primes</h1>

    <form action="{{route('R_primes.update',['id'=>$id])}}" method="post">
        @csrf
        @method('put')

    <div class="form-group">
    <label for="description">Description :</label>
    <input type="text" class="form-control" name="description" value="{{$id->description}}" placeholder="Description">
    </div>
    <div class="form-group">
    <label for="montant">Montant :</label>
    <input type="text" class="form-control" name="montant" value="{{$id->montant}}" placeholder="Montant">
    </div>


    <div class="form-group">
            <label for="type">Type :</label>
            <select name="type" class="form-control">
                <option value="variable" {{ $id->type === 'variable' ? 'selected' : '' }}>Variable</option>
                <option value="fixed" {{ $id->type === 'fixed' ? 'selected' : '' }}>Fixe</option>
                <option value="bonus" {{ $id->type === 'bonus' ? 'selected' : '' }}>Bonus</option>
            </select>
            @error('type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    <div class="form-group">
            <label for="salarie_id">Salarie :</label>
            <select name="salarie_id" id="" class="form-control">

            @foreach($salarie as $sala)
                <option value="{{$sala->id}}">{{$sala->prenom}} {{$sala->nom}}</option>           
            @endforeach
            </select>
        </div>

    <div >
    <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route ('R_primes.index')}}">Back to List </a>
    </div>

    </form>
</div>



@endsection