@extends('layouts.app')

@section('content')
<div class="containe">
    <h1 class="my-4">Liste des bulltines de Paie</h1>
<div class="bulltine">
    

<div class="container">
    <div class="header">
        <h1>Bulletin de Paie</h1>
        <p>Date : <span id="periode">{{$bulltines->date}}</span></p>
    </div>

    <div class="info-section">
        <table>
            <tr>
                <td><strong>Nom :</strong></td>
                <td id="date">{{$bulltines->salarie->nom}}</td>
                <td><strong>Prénom :</strong></td>
                <td id="prenom">{{$bulltines->salarie->prenom}}</td>
                <td><strong>CIN :</strong></td>
                <td id="cin">{{$bulltines->salarie->cin}}</td>
            </tr>
        </table>
    </div>

    <div class="salary-section">
        <h3>Salaire et Primes</h3>
        <table>
            <tr>
                <td>Salaire de Base</td>
                <td id="salaire_base">{{number_format($bulltines->salarie->salaire_de_base,2, '.', ' ')}} MAD</td>
            </tr>
            @foreach($bulltines->salarie->primes as $prime)
            @if($prime->created_at->format('Y-m') === $bulltines->created_at->format('Y-m'))
            <tr>
                <td>Primes {{ $prime->description }}:</td>
                <td>{{ $prime->montant }} MAD</td>
            </tr>
            @endif
            @endforeach
            @php
                $salaire = $bulltines->salarie->salaire->filter(function($salaire) use ($bulltines) {
                return $salaire->created_at->format('Y-m-d') === $bulltines->created_at->format('Y-m-d');
                })->first();
            @endphp 
            
            @if($salaire->anciennete)
            
            <tr>
                <td>Anciènneté</td>
                <td>{{$salaire->anciennete}}</td>
            </tr>
            @endif
            
            <tr>
                
                <td>Heures Supplémentaires</td>
                <td id="heures_sup">
                        
                        @php
                        $montant_h_sup = 0;

                        if ($salaire) {
                            $montant_h_sup = ($salaire->montant_heures_supplementaires);
                        }

                        $montant_h_sup = number_format($montant_h_sup, 2, '.', ' ');
                        @endphp
                        {{ $montant_h_sup }} MAD
                    </td>
            
            
            <tr>
                <td><strong> des Revenus Bruts</strong></td>
                <td id="revenus_bruts"><strong>{{ number_format($bulltines->salaire_brut, 2, '.', ' ') }} MAD</strong></td>

            </tr>
        </table>
    </div>

    <div class="deductions-section">
        <h3>Déductions</h3>
        <table>
            <tr>
                <td>CNSS</td>
                <td id="cnss">
                @if($bulltines->salaire_brut < 6000)
               {{ number_format($bulltines->salaire_brut*$taux->taux_prestation_sociales_court_et_long_terme_salarie/100,2, '.', ' ')}}
                @else
                    {{6000*$taux->taux_prestation_sociales_court_et_long_terme_salarie/100}}
                
                @endif
                 MAD
            </td>
                <td id="cnss">
                @if($bulltines->salaire_brut < 6000)
                    {{number_format($bulltines->salaire_brut*$taux->taux_prestation_sociales_court_et_long_terme_patronal/100,2, '.', ' ')}}
                @else
                    {{number_format(6000*$taux->taux_prestation_sociales_court_et_long_terme_patronal/100,2, '.', ' ')}}
                
                @endif
                 MAD
            </td>
            </tr>
            <tr>
                <td>AMO</td>
                <td id="amo">{{number_format(($bulltines->salaire_brut*$taux->taux_amo_salarie)/100,2, '.', ' ')}} MAD</td>
                <td id="amo">{{number_format(($bulltines->salaire_brut*$taux->taux_amo_patronale)/100,2, '.', ' ')}} MAD</td>
            </tr>
            <tr>
                <td>allocations familiales</td>
                <td id="ir">{{number_format(($bulltines->salaire_brut*$taux->taux_allocation_familiales_salarie)/100,2, '.', ' ')}} MAD</td>
                <td id="ir">{{number_format(($bulltines->salaire_brut*$taux->taux_allocation_familiales_patronale)/100,2, '.', ' ')}} MAD</td>
            </tr>
            <tr>
                <td>T de formation professionnelle</td>
                <td id="ir">{{number_format(($bulltines->salaire_brut*$taux->taux_taxe_de_formation_professionnelle_salarie)/100,2, '.', ' ')}} MAD</td>
                <td id="ir">{{number_format(($bulltines->salaire_brut*$taux->taux_taxe_de_formation_professionnelle_patronale)/100,2, '.', ' ')}} MAD</td>
            </tr>
            <tr>
                <td>Participation AMO</td>
                <td id="ir">{{number_format(($bulltines->salaire_brut*$taux->taux_participation_AMO_salarie)/100),2, '.', ' '}} MAD</td>
                <td id="ir">{{number_format(($bulltines->salaire_brut*$taux->taux_participation_AMO_patronale)/100),2, '.', ' '}} MAD</td>
            </tr>
            <tr>
                <td><strong>Total des Déductions</strong></td>
                <td id="deductions"><strong>{{number_format($bulltines->total_deduction,2, '.', ' ')}} MAD</strong></td>
                
                <td>
                @php
                    $cnss = $bulltines->salaire_brut < 6000 ? $bulltines->salaire_brut * $taux->taux_prestation_sociales_court_et_long_terme_patronal / 100 : 6000 * $taux->taux_prestation_sociales_court_et_long_terme_patronal / 100;
                    $amo = ($bulltines->salaire_brut * $taux->taux_amo_patronale) / 100;
                    $allocations_familiales = ($bulltines->salaire_brut * $taux->taux_allocation_familiales_patronale) / 100;
                    $formation_professionnelle = ($bulltines->salaire_brut * $taux->taux_taxe_de_formation_professionnelle_patronale) / 100;
                    $participation_amo = ($bulltines->salaire_brut * $taux->taux_participation_AMO_patronale) / 100;
                    $total_deduction = $cnss + $amo + $allocations_familiales + $formation_professionnelle + $participation_amo;
                @endphp
                <strong>{{ number_format($total_deduction ,2, '.', ' ')}} MAD</strong>
                </td>
            </tr>
        </table>
            
        <table>   
            <tr>
                <td><strong>Impôt sur le Revenu (IR)</strong></td>
                <td id="ir"><strong>
                    @php
                    
                        if($bulltines->salaire_brut<=6500){
                            $frais_prof=$bulltines->salaire_brut*0.35;
                        }else{
                            $frais_prof=$bulltines->salaire_brut*0.25;
                        }

                    $revenu_net_imposable=($bulltines->salaire_brut-$bulltines->total_deduction-$frais_prof);
                    $tranches = [
                        [0,2500, 0.0, 0],
                        [2501,4166.67, 0.1, 250],
                        [4166.68,5000, 0.2, 666.67],
                        [5001,6666.67, 0.3, 1166.67],
                        [6666.68,15000, 0.34, 1433.33],
                        [15001,PHP_INT_MAX, 0.38, 2033.33] 
                    ];

                    $ir = 0;
                    foreach ($tranches as $tranche) {
                        if ($tranche[0] <= $revenu_net_imposable && $revenu_net_imposable <= $tranche[1]) {
                            $ir = $revenu_net_imposable*$tranche[2]- $tranche[3];
                            break;
                        }
                    }
                    @endphp
                    {{ number_format($ir, 2, '.', ' ') }} MAD
                </strong></td>
            </tr>
        </table>
    </div>

    <div class="summary-section">
        <h3>Résumé</h3>
        <table>
            <tr>
                <td>Salaire Net</td>
                <td id="salaire_net">{{ number_format($bulltines->salaire_net ,2, '.', ' ')}} MAD</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <a href="{{ route('R_bulltines.download', $bulltines->id) }}" class="btn btn-secondary">Télécharger</a>
        <a href="{{ route('R_bulltines.destroy', $bulltines->id) }}" class="btn btn-secondary">Supprimé</a>
<!--         <p>Entreprise XYZ</p>
        <p>Adresse : Rue de l'Entreprise, Ville, Maroc</p>
 -->    </div>
</div>
@endsection

</div>
