@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Create des  bulletines de paie</h1>
    <form  method="post" action="{{route('R_bulltines.store')}}">
        @csrf
        <div class="form-group">
            <label for="date">Date :</label>
            <input type="date" class="form-control" name="date" >
            @error('date')
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
        <a href="{{ route ('R_bulltines.index')}}">Back to List </a>
    </form>
</div>
@endsection