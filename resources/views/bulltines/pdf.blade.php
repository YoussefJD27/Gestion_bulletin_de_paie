<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulletin de Paie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header, .info-section, .salary-section, .deductions-section, .summary-section, .footer {
            margin-bottom: 20px;
        }
        .header h1, .salary-section h3, .deductions-section h3, .summary-section h3 {
            margin: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="bulletin">;
            <div class="header">
                <h1>Bulletin de Paie</h1>
                <p>Date : {{$bulltine->date}}</p>
            </div>
            <div class="info-section">
                <table>
                <tr>
                <td><strong>Nom :</strong></td>
                <td id="date">{{$bulltine->salarie->nom}}</td>
                <td><strong>Prénom :</strong></td>
                <td id="prenom">{{$bulltine->salarie->prenom}}</td>
                <td><strong>CIN :</strong></td>
                <td id="cin">{{$bulltine->salarie->cin}}</td>
            </tr>
                </table>
            </div>
            <div class="salary-section">
                <h3>Salaire et Primes</h3>
                <table>
                    <tr>
                        <td>Salaire de Base</td>
                        <td>{{number_format($bulltine->salarie->salaire_de_base,2, '.', ' ')}} MAD</td>
                    </tr>
                    @foreach($bulltine->salarie->primes as $prime)
            @if($prime->created_at->format('Y-m') === $bulltine->created_at->format('Y-m'))
            <tr>
                <td>Primes {{ $prime->description }}:</td>
                <td>{{ $prime->montant }} MAD</td>
            </tr>
            @endif
            @endforeach
            @php
                $salaire = $bulltine->salarie->salaire->filter(function($salaire) use ($bulltine) {
                return $salaire->created_at->format('Y-m-d') === $bulltine->created_at->format('Y-m-d');
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
                        <td><strong>Total des Revenus Bruts</strong></td>
                        <td><strong>{{ number_format($bulltine->salaire_brut, 2, '.', ' ') }} MAD</strong></td>
                    </tr>
                </table>
            </div>
            <div class="deductions-section">
                <h3>Déductions</h3>
                <table>
                    <tr>
                        <td>CNSS</td>
                        <td>
                            @if($bulltine->salaire_brut < 6000)
                                {{ number_format($bulltine->salaire_brut * $taux->taux_prestation_sociales_court_et_long_terme_salarie / 100, 2, '.', ' ') }} MAD
                            @else
                                {{ number_format(6000 * $taux->taux_prestation_sociales_court_et_long_terme_salarie / 100, 2, '.', ' ') }} MAD
                            @endif
                        </td>
                        <td>
                            @if($bulltine->salaire_brut < 6000)
                                {{ number_format($bulltine->salaire_brut * $taux->taux_prestation_sociales_court_et_long_terme_patronal / 100, 2, '.', ' ') }} MAD
                            @else
                                {{ number_format(6000 * $taux->taux_prestation_sociales_court_et_long_terme_patronal / 100, 2, '.', ' ') }} MAD
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>AMO</td>
                        <td>{{ number_format(($bulltine->salaire_brut * $taux->taux_amo_salarie) / 100, 2, '.', ' ') }} MAD</td>
                        <td>{{ number_format(($bulltine->salaire_brut * $taux->taux_amo_patronale) / 100, 2, '.', ' ') }} MAD</td>
                    </tr>
                    <tr>
                        <td>Allocations familiales</td>
                        <td>{{ number_format(($bulltine->salaire_brut * $taux->taux_allocation_familiales_salarie) / 100, 2, '.', ' ') }} MAD</td>
                        <td>{{ number_format(($bulltine->salaire_brut * $taux->taux_allocation_familiales_patronale) / 100, 2, '.', ' ') }} MAD</td>
                    </tr>
                    <tr>
                        <td>Taux de formation professionnelle</td>
                        <td>{{ number_format(($bulltine->salaire_brut * $taux->taux_taxe_de_formation_professionnelle_salarie) / 100, 2, '.', ' ') }} MAD</td>
                        <td>{{ number_format(($bulltine->salaire_brut * $taux->taux_taxe_de_formation_professionnelle_patronale) / 100, 2, '.', ' ') }} MAD</td>
                    </tr>
                    <tr>
                        <td>Participation AMO</td>
                        <td>{{ number_format(($bulltine->salaire_brut * $taux->taux_participation_AMO_salarie) / 100, 2, '.', ' ') }} MAD</td>
                        <td>{{ number_format(($bulltine->salaire_brut * $taux->taux_participation_AMO_patronale) / 100, 2, '.', ' ') }} MAD</td>
                    </tr>
                    <tr>
                        <td><strong>Total des Déductions</strong></td>
                        <td><strong>{{ number_format($bulltine->total_deduction, 2, '.', ' ') }} MAD</strong></td>
                        <td>
                            @php
                                $cnss = $bulltine->salaire_brut < 6000 ? $bulltine->salaire_brut * $taux->taux_prestation_sociales_court_et_long_terme_patronal / 100 : 6000 * $taux->taux_prestation_sociales_court_et_long_terme_patronal / 100;
                                $amo = ($bulltine->salaire_brut * $taux->taux_amo_patronale) / 100;
                                $allocations_familiales = ($bulltine->salaire_brut * $taux->taux_allocation_familiales_patronale) / 100;
                                $formation_professionnelle = ($bulltine->salaire_brut * $taux->taux_taxe_de_formation_professionnelle_patronale) / 100;
                                $participation_amo = ($bulltine->salaire_brut * $taux->taux_participation_AMO_patronale) / 100;
                                $total_deduction = $cnss + $amo + $allocations_familiales + $formation_professionnelle + $participation_amo;
                            @endphp
                            <strong>{{ number_format($total_deduction, 2, '.', ' ') }} MAD</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>Impôt sur le Revenu (IR)</td>
                        <td>
                            @php
                                if($bulltine->salaire_brut<=6500){
                                    $frais_prof=$bulltine->salaire_brut*0.35;
                                }else{
                                    $frais_prof=$bulltine->salaire_brut*0.25;
                                }

                            $revenu_net_imposable=($bulltine->salaire_brut-$bulltine->total_deduction-$frais_prof);
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
                                    $ir = $revenu_net_imposable * $tranche[2] - $tranche[3];
                                    break;
                                }
                            }
                            @endphp
                            {{ number_format($ir, 2, '.', ' ') }} MAD
                        </td>
                    </tr>
                </table>
            </div>
            <div class="summary-section">
                <h3>Résumé</h3>
                <table>
                    <tr>
                        <td>Salaire Net</td>
                        <td>{{ number_format($bulltine->salaire_net, 2, '.', ' ') }} MAD</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
