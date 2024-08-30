@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Créer Le Salaire</h1>
    <form action="{{ route('R_salaire.store', ['id' => $id]) }}" method="POST">
        @csrf
        <div id="form-blocks">
            <!-- Block default -->
            <div class="form-group block">
                <label for="nbr_joure_t">Nombre de jours travaillés :</label>
                <input type="text" class="form-control" name="nbr_joure_t" id="nbr_joure_t">
                @error('nbr_joure_t')
                <div class="form-error text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group block">
                <label>Heures supplémentaires :</label>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="heure_type[0]" id="heure_type_6_21_0" value="6_21" onchange="updateDisplay(0)">
                    <label class="form-check-label" for="heure_type_6_21_0">Entre 6h et 21h</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="heure_type[0]" id="heure_type_21_6_0" value="21_6" onchange="updateDisplay(0)">
                    <label class="form-check-label" for="heure_type_21_6_0">Entre 21h et 6h</label>
                </div>

                <label>Type de jour :</label>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="jour_type[0]" id="jour_type_ouvrable_0" value="ouvrable" onchange="updateDisplay(0)">
                    <label class="form-check-label" for="jour_type_ouvrable_0">J. ouvrable</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="jour_type[0]" id="jour_type_ferie_0" value="ferie" onchange="updateDisplay(0)">
                    <label class="form-check-label" for="jour_type_ferie_0">J. férié</label>
                </div>

                <!-- Input fields for hours -->
                <div class="form-group" id="h_supplementaire_j_ouvrable_6_21_0_container" style="display:none;">
                    <label for="h_supplementaire_j_ouvrable_6_21_0">Heures supplémentaires (ouvrable 6h-21h) :</label>
                    <input type="text" class="form-control mt-2" name="h_supplementaire_j_ouvrable_6_21[0]" id="h_supplementaire_j_ouvrable_6_21_0">
                </div>
                <div class="form-group" id="h_supplementaire_j_ouvrable_21_6_0_container" style="display:none;">
                    <label for="h_supplementaire_j_ouvrable_21_6_0">Heures supplémentaires (ouvrable 21h-6h) :</label>
                    <input type="text" class="form-control mt-2" name="h_supplementaire_j_ouvrable_21_6[0]" id="h_supplementaire_j_ouvrable_21_6_0">
                </div>
                <div class="form-group" id="h_supplementaire_j_ferie_6_21_0_container" style="display:none;">
                    <label for="h_supplementaire_j_ferie_6_21_0">Heures supplémentaires (ferie 6h-21h) :</label>
                    <input type="text" class="form-control mt-2" name="h_supplementaire_j_ferie_6_21[0]" id="h_supplementaire_j_ferie_6_21_0">
                </div>
                <div class="form-group" id="h_supplementaire_j_ferie_21_6_0_container" style="display:none;">
                    <label for="h_supplementaire_j_ferie_21_6_0">Heures supplémentaires (ferie 21h-6h) :</label>
                    <input type="text" class="form-control mt-2" name="h_supplementaire_j_ferie_21_6[0]" id="h_supplementaire_j_ferie_21_6_0">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('R_salaries.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </form>
</div>

<script>
    function updateDisplay(index) {
        const heureType = document.querySelector(`input[name="heure_type[${index}]"]:checked`);
        const jourType = document.querySelector(`input[name="jour_type[${index}]"]:checked`);

        // Hide all containers
        document.querySelectorAll(`#form-blocks .form-group[id$="_${index}_container"]`).forEach(container => {
            container.style.display = 'none';
        });

        if (heureType && jourType) {
            const heureValue = heureType.value;
            const jourValue = jourType.value;

            // Show the relevant input fields
            const containerToShow = document.getElementById(`h_supplementaire_j_${jourValue}_${heureValue}_${index}_container`);
            if (containerToShow) {
                containerToShow.style.display = 'block';
            }
        }
    }
</script>

@endsection
