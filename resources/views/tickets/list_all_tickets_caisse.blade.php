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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($caisses as $caisse)
                                    <tr>
                                        <td>
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$caisse->ticket->date_creation}}</span>
                                        </td>
                                        <td>{{$caisse->ticket->numero}}</td>
                                        <td><span class="badge bg-label-primary me-1">{{$caisse->ticket->consultation->nom_consultation}}</span></td>
                                        <td><span class=""></span>{{$caisse->ticket->client->prenom_client}} {{$caisse->ticket->client->nom_client}}</td>
                                        <td><span class="">{{$caisse->ticket->client->ipm->nom_ipm}}</span></td>
                                        <td><span class="">{{$caisse->ticket->client->taux_pourcentage}} %</span></td>
                                        <td>{{$caisse->ticket->type_paiement}}</td>
                                        <td>{{$caisse->ticket->montant_total}}</td>
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
                        </table>
                    </div>
                </div>
    @endsection