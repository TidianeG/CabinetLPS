@extends('layouts.appuser')
    @section('content')
    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <div class="m-2" >
                        <a href="{{route('list_clients')}}" class="btn btn-primary"><i class="fa-solid fa-rotate-left fa-lg text-white me-3"></i>Retour</a>
                    </div>
                    <h5 class="card-header">Informations du client</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                            src="{{asset('assets/img/avatars/user-avatar.png')}}"
                            alt="user-avatar"
                            class="d-block rounded"
                            height="60"
                            width="60"
                            id="uploadedAvatar" />
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      
                        <form action="{{route('update_client')}}" method="POST">
                            @csrf
                            @method('PUT')
                          <div class="row">
                            <div class="mb-3 col-md-3">
                              <label for="firstName" class="form-label">Numéro</label>
                              <input
                                class="form-control"
                                type="text"
                                disabled
                                id="numero_client"
                                name="numero_client"
                                value="{{$client->numero_client}}"
                                autofocus />
                            </div>
                            <input type="hidden" id="identifiant_client" name="identifiant_client" value="{{$client->id}}">
                            <div class="mb-3 col-md-6">
                              <label for="firstName" class="form-label">Prénom</label>
                              <input
                                class="form-control"
                                type="text"
                                
                                id="prenom_client"
                                name="prenom_client"
                                value="{{$client->prenom_client}}"
                                autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="firstName" class="form-label">Nom</label>
                              <input
                                class="form-control"
                                type="text"
                                
                                id="nom_client"
                                name="nom_client"
                                value="{{$client->nom_client}}"
                                autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="firstName" class="form-label">Personne Confiance</label>
                              <input
                                class="form-control"
                                type="text"
                                
                                id="personne_confiance"
                                name="personne_confiance"
                                value="{{$client->personne_confiance}}"
                                autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="firstName" class="form-label">Téléphone</label>
                              <input
                                class="form-control"
                                type="text"
                                
                                id="telephone_client"
                                name="telephone_client"
                                value="{{$client->telephone_client}}"
                                autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="firstName" class="form-label">Adresse</label>
                              <input
                                class="form-control"
                                type="text"
                                
                                id="adresse_client"
                                name="adresse_client"
                                value="{{$client->adresse_client}}"
                                autofocus />
                            </div>
                            <div class="mb-3 col-md-4">
                              <label for="firstName" class="form-label">IPM</label>
                              <input
                                class="form-control"
                                type="text"
                                disabled
                                id="nom_ipm"
                                name="nom_ipm"
                                value="{{$client->ipm->nom_ipm}}"
                                autofocus />
                            </div>
                            <div class="mb-3 col-md-4">
                              <label for="firstName" class="form-label">Participant</label>
                              <input
                                class="form-control"
                                type="text"
                                disabled
                                id="participant"
                                name="participant"
                                value="{{$client->participant}}"
                                autofocus />
                            </div>
                            <div class="mb-3 col-md-4">
                              <label for="firstName" class="form-label">Taux Pourcentage %</label>
                              <input
                                class="form-control"
                                type="text"
                                disabled
                                id="taux_pourcentage"
                                name="taux_pourcentage"
                                value="{{$client->taux_pourcentage}}"
                                autofocus />
                            </div>
                          </div>
                          <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changements</button>
                          </div>
                        </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
                <div class="col-md-12">
                    <div class="card p-2">
                        <h5 class="card-header">Liste des Tickets</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Date</th>
                                        <th>Consultation</th>
                                        <th>Client</th>
                                        <th>Caissier(e)</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach($tickets as $ticket)
                                        <tr class="clickable-row" data-target="_blank" data-href="{{route('get_print_ticket', ['slug'=>$ticket->id])}}" style="cursor:pointer;">
                                            <td>
                                                <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                                <span class="fw-medium">{{$ticket->numero}}</span>
                                            </td>
                                            <td>{{$ticket->created_at->format('d-m-Y H:i:s')}}</td>
                                            <td>{{$ticket->consultation->nom_consultation}}</td>
                                            <td><span class="badge bg-label-primary me-1">{{$ticket->client->prenom_client}} {{$ticket->client->nom_client}}</span></td>
                                            <td><span class="badge bg-label-primary me-1">{{$ticket->user->prenom}} {{$ticket->user->nom}}</span></td>
                                            <td><span class="badge bg-label-primary me-1">{{$ticket->montant_total}} FCFA</span></td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot style="" class="table-dark">
                                    <tr>
                                        <th class="text-white text-left" style="text-align: left;" colspan="3">Nombre de tickets : {{$tickets->count()}}</th>
                                        <th class="text-white text-right" style="text-align: right !important;" colspan="3">Total : {{$tickets->sum('montant_total')}} FCFA</th>
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
                  <style>
                    a, a:hover{
                      color:#333
                    }
                  </style>
              <script>

              </script>
    @endsection