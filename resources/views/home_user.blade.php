@extends('layouts.appuser')
    @section('content')
      
                  @if(Auth::user()->profil == 'admin')
                    <div class="alert alert-primary d-flex justify-content-start" style="size:20px !important;">
                        <h4 class="mr-3" >Etat du jour : </h4><h4 id="date_jour" class="" style="margin-left:10px;"></h4>
                    </div>
                    <div class="row">
                      <div class="col-lg-7 mb-4 order-0">
                        <div class="card">
                          <div class="d-flex align-items-end row">
                              <div class="card-header">
                                <h5 class="card-title m-0 me-2 pb-3">Type de consultation</h5>
                              </div>
                              <div class="card-body">
                                <div class="row">
                                  @foreach($consultations as $consultation)
                                    <div class="col-lg-4 col-md-12 col-4 mb-4">
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
                                                <a class="dropdown-item" href="javascript:void(0);">Modifier</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Supprimer</a>
                                              </div>
                                            </div>
                                          </div>
                                          <h6 class="fw-medium d-block mb-1">{{$consultation->nom_consultation}}</h6>
                                          <h4 class="card-title mb-2">{{$consultation->prix_consultation}} FCFA</h4>
                                        </div>
                                      </div>
                                    </div>
                                  @endforeach
                              </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-5 mb-4 order-1">
                          <div class="card">
                            <div class="d-flex align-items-end row">
                                <div class="card-header bg-blue">
                                  <h5 class="card-title text-primary">Points de vente</h5>
                                </div>
                                <div class="card-body">
                                  <div class="row">
                                    @foreach($point_ventes as $point_vente)
                                      <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                          <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                              <div class="avatar flex-shrink-0">
                                                <span class="badge bg-success text-center"><i class="fa-solid fa-cash-register  text-white menu-icon tf-icons"></i></span>
                                                
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
                                                  <a class="dropdown-item" href="javascript:void(0);">Modifier</a>
                                                  <a class="dropdown-item" href="javascript:void(0);">Supprimer</a>
                                                </div>
                                              </div>
                                            </div>
                                            <h6 class="fw-medium d-block mb-1">{{$point_vente->nom}}</h6>
                                            <span class="card-title mb-2">{{$point_vente->gerant}}</span>
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
                      <div class="col-12 col-lg-7 order-2 order-md-3 order-lg-2 mb-4">
                        <div class="card">
                          <div class="row row-bordered g-0">
                            <div class="">
                              <h5 class="card-header m-0 me-2 pb-3">Clients</h5>
                            </div>
                            <div class="">
                              <div class="card-body">
                              <div class="table-responsive text-nowrap">
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                      <th>Client</th>
                                      <th>Adresse</th>
                                      <th>Personne confiance</th>
                                      <th>Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      @foreach($clients as $client)
                                          <tr>
                                              <td>
                                                  <i class="fa-solid fa-person fa-lg text-danger me-3"></i>
                                                  <span class="fw-medium">{{$client->prenom}} {{$client->nom}}</span>
                                              </td>
                                              <td>{{$client->adresse}}</td>
                                              <td><span class="badge bg-label-primary me-1">{{$client->personne_confiance}}</span></td>
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