@extends('layouts.appuser')
    @section('content')
        <div class="card p-2">
                <div class="m-2" >
                    <a href="{{route('get_all_tickets')}}" class="btn btn-primary"><i class="fa-solid fa-rotate-left fa-lg text-white me-3"></i>Retour</a>
                </div>
                <h5 class="card-header">{{$tab_donnee_consultation_retour['type_consult']}} du {{$tab_donnee_consultation_retour['date_debut']}} au {{$tab_donnee_consultation_retour['date_fin']}}</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Numero</th>
                                    <th>Client</th>
                                    <th>IPM</th>
                                    <th>Taux IPM %</th>
                                    <th>Type paiement</th>
                                    <th>Généré par</th>
                                    <th>Montant</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($etat_financiers as $etat_financier)
                                    <tr>
                                        <td>
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$etat_financier->date_creation}}</span>
                                        </td>
                                        <td>{{$etat_financier->numero}}</td>
                                        
                                        <td><span class=""></span>{{$etat_financier->client->prenom_client}} {{$etat_financier->client->nom_client}}</td>
                                        <td><span class="">{{$etat_financier->client->ipm->nom_ipm ?? "--"}}</span></td>
                                        <td><span class="">{{$etat_financier->client->taux_pourcentage ?? "--"}} </span></td>
                                        <td>{{$etat_financier->type_paiement}}</td>
                                        <td>{{$etat_financier->user->prenom}} {{$etat_financier->user->nom}}</td>
                                        <td>{{$etat_financier->montant_total}}</td>
                                        <td>
                                            <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                                >
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                ><i class="bx bx-trash me-1"></i> Delete</a
                                                >
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="" class="table-dark">
                                <tr>
                                    <th class="text-white text-left" style="text-align: left !important;" colspan="4">Nombre de tickets : {{$etat_financiers->count()}}</th>
                                    <th class="text-white text-right" style="text-align: right !important;" colspan="4">Total : {{$etat_financiers->sum('montant_total')}} FCFA</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
    @endsection