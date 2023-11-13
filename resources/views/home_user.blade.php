@extends('layouts.appuser')
    @section('content')
      
                  @if(Auth::user()->profil == 'admin')
                    <div class="alert alert-primary d-flex justify-content-start" style="size:20px !important;">
                        <h4 class="mr-3" >Etat du jour : </h4><h4 id="date_jour" class="" style="margin-left:10px;"></h4>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 mb-4 order-0">
                        <div class="card">
                          <div class="d-flex align-items-end row">
                              <div class="card-header">
                                <h5 class="card-title m-0 me-2 pb-3">Type de consultation</h5>
                              </div>
                              <div class="card-body">
                                <div class="row">
                                  @foreach($consultations as $consultation)
                                    <div class="col-lg-4 col-xl-6 col-md-12  mb-4">
                                      <div class="card">
                                        <div class="card-body">
                                          <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                              <span class="badge bg-primary text-center"><i class="fa-solid fa-stethoscope text-white menu-icon tf-icons"></i></span>
                                              
                                            </div>
                                            <div class="dropdown">
                                              <button
                                                class="btn p-0"
                                                type="button"
                                                id="cardOpt3"
                                                data-bs-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                              </button>
                                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                <a class="dropdown-item" href="javascript:void(0);">Afficher</a>
                                              </div>
                                            </div>
                                          </div>
                                          <h6 class="fw-medium d-block mb-1">{{$consultation->nom_consultation}}</h6>
                                          <div class="d-flex justify-content-beetwen"><span class="mr-1" style="margin-right: 5px;">Tickets</span><span class="card-title mb-2 badge bg-success text-white" style="text-align: right;">{{$consultation->ticket->where('date_creation','=',date('Y-m-d'))->count()}}</span></div>
                                          <div class="d-flex justify-content-beetwen"><span class="mr-1" style="margin-right: 5px;">Total</span><span class="card-title mb-2 badge bg-success text-white" style="text-align: right;">{{$consultation->ticket->where('date_creation','=',date('Y-m-d'))->sum('montant_total')}} FCFA</span></div>
                                        </div>
                                      </div>
                                    </div>
                                  @endforeach
                              </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 mb-4 order-1">
                          <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="card-header bg-blue">
                                  <h5 class="card-title text-primary">Points de vente</h5>
                                </div>
                                <div class="card-body">
                                  <div class="row">
                                    @foreach($point_ventes as $point_vente)
                                      <div class="col-lg-4 col-xl-6 mb-4">
                                        <div class="card">
                                          <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                              <div class="avatar flex-shrink-0">
                                                <span class="badge bg-primary text-center"><i class="fa-solid fa-cash-register  text-white menu-icon tf-icons"></i></span>
                                                
                                              </div>
                                              <div class="dropdown">
                                                <button
                                                  class="btn p-0"
                                                  type="button"
                                                  id="cardOpt3"
                                                  data-bs-toggle="dropdown"
                                                  aria-haspopup="true"
                                                  aria-expanded="false">
                                                  <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                  <a class="dropdown-item" href="javascript:void(0);">Afficher</a>
                                                </div>
                                              </div>
                                            </div>

                                            <h6 class="fw-medium d-block mb-1">{{$point_vente->nom_point_vente}}</h6>
                                            <div><span class="mr-1" style="margin-right: 5px;">Solde caisse</span><span class="card-title mb-2 text-white badge bg-success">{{$point_vente->user->caisse->sum('solde_ticket')}} FCFA</span></div>
                                            @if($point_vente->statut_caisse->statut == 1)
                                              <span class="mr-1" style="margin-right: 5px;">Status</span><span class="card-title mb-2 text-success">Ouvert</span>
                                            @else
                                            <span class="mr-1" style="margin-right: 5px;">Status</span><span class="card-title mb-2 text-danger">Fermé</span>
                                            @endif
                                            
                                          </div>
                                        </div>
                                      </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                          </div>
                      </div>
                      <!-- Total Revenue -->
                      <div class="col-12  order-2 order-md-3 order-lg-2 mb-4">
                        <div class="card">
                          <div class="row row-bordered g-0">
                            <div class="">
                              <h5 class="card-header m-0 me-2 pb-3">Tickets</h5>
                            </div>
                            <div class="">
                              <div class="card-body">
                              <div class="table-responsive text-nowrap">
                              <table class="table table-hover" id="myTable">
                            <thead>
                                <tr >
                                    <th class="text-center">Heure</th>
                                    <th class="text-center">Numero</th>
                                    <th class="text-center">Consultation</th>
                                    <th class="text-center">Client</th>
                                    <th class="text-center">IPM</th>
                                    <th class="text-center">Taux IPM %</th>
                                    <th class="text-center">Type paiement</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($tickets as $ticket)
                                    <tr class="clickable-row" data-target="_blank" data-href="{{route('get_print_ticket', ['slug'=>$ticket->id])}}" style="cursor:pointer;">
                                        <td class="text-center">
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$ticket->heure_creation}}</span>
                                        </td>
                                        <td class="text-center">{{$ticket->numero}}</td>
                                        <td class="text-center"><span class="badge bg-label-primary me-1">{{$ticket->consultation->nom_consultation}}</span></td>
                                        <td class="text-center"><span class=""></span>{{$ticket->client->prenom_client}} {{$ticket->client->nom_client}}</td>
                                        <td class="text-center"><span class="">{{$ticket->client->ipm->nom_ipm ?? "--"}}</span></td>
                                        <td class="text-center"><span class="">{{$ticket->client->taux_pourcentage ?? "--"}}</span></td>
                                        <td class="text-center">{{$ticket->type_paiement}}</td>
                                        <td class="text-center">{{$ticket->montant_total}}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                          </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif

                  @if(Auth::user()->profil != 'admin')
                      <div class="row">
                        <div class="col-12 col-lg-8  order-md-3 order-lg-2 mb-4">
                          <div class="card">
                            <div class="row row-bordered g-0">
                              <div class="">
                                <h5 class="card-header m-0 me-2 pb-3">Etat des consultations</h5>
                              </div>
                              <div class="">
                                <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                          <th>Consultation</th>
                                          <th>Date</th>
                                          <th>Nombre</th>
                                          <th>Montant Total</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                      @foreach($consultations as $consultation)
                                          <tr>
                                              <td>
                                                  <i class="fa-solid fa-person fa-lg text-danger me-3"></i>
                                                  <span class="fw-medium">{{$consultation->nom}}</span>
                                              </td>
                                              <td></td>
                                              <?php $montant_total = 0;
                                                    $nombre = 0; 
                                              ?> 
                                              @foreach($consultation->ticket as $ticket)
                                                <?php 
                                                    $montant_total +=  $ticket->montant_total;
                                                    $nombre = count($consultation->ticket);
                                                ?>
                                              @endforeach
                                              <td>{{$nombre}}</td>
                                              <td>{{$montant_total}}</td>
                                              <td>
                                                <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                  ><i class="bx bx-edit-alt me-1"></i> Afficher</a
                                                    >
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                    ><i class="bx bx-trash me-1"></i> Imprimer</a
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
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-lg-4  order-md-3 order-lg-2 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    
                                </div>
                                <div class="card-body"></div>
                            </div>
                        </div>
                      </div>
                  @endif
    

                  <script>
                      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                      var today  = new Date();
                      document.getElementById('date_jour').innerText = today.toLocaleDateString("fr-FR", options);
                  </script>
    @endsection