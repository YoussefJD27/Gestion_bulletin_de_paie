@extends('layouts.app')

@section('content')
<div class="bulltine">
@foreach($bulltines as $bull)
    

<div class="container">
    <div class="header">
        <h1>Bulletin de Paie</h1>
        <p>Date : <span id="periode">{{$bull->date}}</span></p>
    </div>

    <div class="info-section">
        <table>
            <tr>
                <td><strong>Nom :</strong></td>
                <td id="date">{{$bull->salarie->nom}}</td>
            </tr>
            <tr>
                <td><strong>Prénom :</strong></td>
                <td id="prenom">{{$bull->salarie->prenom}}</td>
            </tr>
            <tr>
                <td><strong>CIN :</strong></td>
                <td id="cin">{{$bull->salarie->cin}}</td>
            </tr>
        </table>
    </div>

    <div class="salary-section">
        <h3>Salaire et Primes</h3>
        <table>
            <tr>
                <td>Salaire de Base</td>
                <td id="salaire_base">{{number_format($bull->salarie->salaire_de_base,2, '.', ' ')}} MAD</td>
            </tr>
            <tr>
                <td>Heures Supplémentaires</td>
                <td id="heures_sup">
                    @php
                    $montant_h_sup = number_format((($bull->salarie->salaire_de_base / 191) * $bull->salarie->H_sup),2, '.', ' ') ;
                @endphp
                {{$montant_h_sup}} MAD</td>
            </tr>
            
            @foreach($bull->salarie->primes as $prime)
            <tr>
                <td>Primes {{ $prime->description }}:</td>
                <td>{{ $prime->montant }} MAD</td>
            </tr>
            @endforeach
            <tr>
                <td>Total des Revenus Bruts</td>
                <td id="revenus_bruts">{{ number_format($bull->salaire_brut, 2, '.', ' ') }} MAD</td>

            </tr>
        </table>
    </div>

    <div class="deductions-section">
        <h3>Déductions</h3>
        <table>
            <tr>
                <td>CNSS</td>
                <td id="cnss">
                @if($bull->salaire_brut < 6000)
               {{ number_format($bull->salaire_brut*$taux->taux_prestation_sociales_court_et_long_terme_salarie/100,2, '.', ' ')}}
                @else
                    {{6000*$taux->taux_prestation_sociales_court_et_long_terme_salarie/100}}
                
                @endif
                 MAD
            </td>
                <td id="cnss">
                @if($bull->salaire_brut < 6000)
                    {{number_format($bull->salaire_brut*$taux->taux_prestation_sociales_court_et_long_terme_patronal/100,2, '.', ' ')}}
                @else
                    {{number_format(6000*$taux->taux_prestation_sociales_court_et_long_terme_patronal/100,2, '.', ' ')}}
                
                @endif
                 MAD
            </td>
            </tr>
            <tr>
                <td>AMO</td>
                <td id="amo">{{number_format(($bull->salaire_brut*$taux->taux_amo_salarie)/100,2, '.', ' ')}} MAD</td>
                <td id="amo">{{number_format(($bull->salaire_brut*$taux->taux_amo_patronale)/100,2, '.', ' ')}} MAD</td>
            </tr>
            <tr>
                <td>allocations familiales</td>
                <td id="ir">{{number_format(($bull->salaire_brut*$taux->taux_allocation_familiales_salarie)/100,2, '.', ' ')}} MAD</td>
                <td id="ir">{{number_format(($bull->salaire_brut*$taux->taux_allocation_familiales_patronale)/100,2, '.', ' ')}} MAD</td>
            </tr>
            <tr>
                <td>T de formation professionnelle</td>
                <td id="ir">{{number_format(($bull->salaire_brut*$taux->taux_taxe_de_formation_professionnelle_salarie)/100),2, '.', ' '}} MAD</td>
                <td id="ir">{{number_format(($bull->salaire_brut*$taux->taux_taxe_de_formation_professionnelle_patronale)/100),2, '.', ' '}} MAD</td>
            </tr>
            <tr>
                <td>Participation AMO</td>
                <td id="ir">{{number_format(($bull->salaire_brut*$taux->taux_participation_AMO_salarie)/100),2, '.', ' '}} MAD</td>
                <td id="ir">{{number_format(($bull->salaire_brut*$taux->taux_participation_AMO_patronale)/100),2, '.', ' '}} MAD</td>
            </tr>
            <tr>
                <td>Total des Déductions</td>
                <td id="deductions">{{number_format($bull->total_deduction,2, '.', ' ')}} MAD</td>
                
                <td>
                @php
                    $cnss = $bull->salaire_brut < 6000 ? $bull->salaire_brut * $taux->taux_prestation_sociales_court_et_long_terme_patronal / 100 : 6000 * $taux->taux_prestation_sociales_court_et_long_terme_patronal / 100;
                    $amo = ($bull->salaire_brut * $taux->taux_amo_patronale) / 100;
                    $allocations_familiales = ($bull->salaire_brut * $taux->taux_allocation_familiales_patronale) / 100;
                    $formation_professionnelle = ($bull->salaire_brut * $taux->taux_taxe_de_formation_professionnelle_patronale) / 100;
                    $participation_amo = ($bull->salaire_brut * $taux->taux_participation_AMO_patronale) / 100;
                    $total_deduction = $cnss + $amo + $allocations_familiales + $formation_professionnelle + $participation_amo;
                @endphp
                {{ number_format($total_deduction ,2, '.', ' ')}} MAD
                </td>
            </tr>
        </table>
    </div>

    <div class="summary-section">
        <h3>Résumé</h3>
        <table>
            <tr>
                <td>Salaire Net</td>
                <td id="salaire_net">{{ number_format($bull->salaire_net ,2, '.', ' ')}} MAD</td>
            </tr>
        </table>
    </div>
    <div class="footer">
<!--         <p>Entreprise XYZ</p>
        <p>Adresse : Rue de l'Entreprise, Ville, Maroc</p>
 -->    </div>
</div>
@endforeach
@endsection