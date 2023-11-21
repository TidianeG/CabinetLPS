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
                                    <th>Numero ticket</th>
                                    <th>Client</th>
                                    <th>Description soin</th>
                                    <th>Nombre Soin</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($soin_en_attente_validations as $soin_en_attente_validation)
                                    <tr >
                                        <td>{{$soin_en_attente_validation->created_at}}</td>
                                        <td>{{$soin_en_attente_validation->ticket->numero}}</td>
                                        <td><span class="badge bg-label-primary me-1">{{$soin_en_attente_validation->client->prenom_client}} {{$soin_en_attente_validation->client->nom_client}}</span></td>
                                        <td><span class=""></span>{{$soin_en_attente_validation->description_soin}}</td>
                                        <td><span class="">{{$soin_en_attente_validation->nombre_soin}}</span></td>
                                        <td><span class="">{{$soin_en_attente_validation->montant_total_soin}}</span></td>
                                        <td><a href="{{route('save_soin', ['slug' => $soin_en_attente_validation->id])}}" class="btn btn-success">valider</a></td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    @endsection