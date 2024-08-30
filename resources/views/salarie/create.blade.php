
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Create des  Salaries</h1>
    <form  method="post" action="{{route('R_salaries.store')}}">
        @csrf
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" name="nom" >
            @error('nom')
                <div class="form-error text-danger text-danger">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="prenom">Prenom :</label>
            <input type="text" class="form-control" name="prenom">
            @error('prenom')
                <div class="form-error text-danger">
                    {{$message}}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="ville">Ville :</label>
            <input type="text" class="form-control" name="ville">
            @error('ville')
            <div class="form-error text-danger text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="cin">CIN :</label>
            <input type="text" class="form-control" name="cin">
            @error('cin')
            <div class="form-error text-danger text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="date_embauche">Date Embauche :</label>
            <input type="date" class="form-control" name="date_embauche">
            @error('date_embauche')
            <div class="form-error text-danger text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="tel">Telephone :</label>
            <input type="text" class="form-control" name="tel">
            @error('tel')
            <div class="form-error text-danger text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="salaire_de_base">Salaire de Base :</label>
            <input type="number" class="form-control" name="salaire_de_base" step="0.01">
            @error('salaire_de_base')
            <div class="form-error text-danger text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route ('R_salaries.index')}}">Back to List </a>
    </form>
</div>

@endsection