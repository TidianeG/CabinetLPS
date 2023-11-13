@extends('layouts.appuser')
    @section('content')
        <div class="card p-2">
                <div class="m-2" >
                    <a href="{{route('espace_caisse')}}" class="btn btn-primary"><i class="fa-solid fa-rotate-left fa-lg text-white me-3"></i>Quitter</a>
                </div>
                <h5 class="card-header">Liste des tickets de la caisse</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Numero</th>
                                    <th>Consultation</th>
                                    <th>Client</th>
                                    <th>IPM</th>
                                    <th>Taux IPM %</th>
                                    <th>Type paiement</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($caisses as $caisse)
                                    <tr class="clickable-row" data-target="_blank" data-href="{{route('get_print_ticket', ['slug'=>$caisse->ticket->id])}}" style="cursor:pointer;">
                                        <td>
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$caisse->ticket->created_at->format('d-m-Y H:i:s')}}</span>
                                        </td>
                                        <td>{{$caisse->ticket->numero}}</td>
                                        <td><span class="badge bg-label-primary me-1">{{$caisse->ticket->consultation->nom_consultation}}</span></td>
                                        <td><span class=""></span>{{$caisse->ticket->client->prenom_client}} {{$caisse->ticket->client->nom_client}}</td>
                                        <td><span class="">{{$caisse->ticket->client->ipm->nom_ipm ?? "--"}}</span></td>
                                        <td><span class="">{{$caisse->ticket->client->taux_pourcentage ?? "--"}}</span></td>
                                        <td>{{$caisse->ticket->type_paiement}}</td>
                                        <td>{{$caisse->ticket->montant_total}}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="" class="table-dark">
                                <tr>
                                    <th class="text-white text-left" style="text-align: left !important;" colspan="4">Nombre de tickets : {{$caisses->count()}}</th>
                                    <th class="text-white text-right" style="text-align: right !important;" colspan="4">Total : {{$caisses->sum('solde_ticket')}} FCFA</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
    @endsection