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
                <div class="mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_new_client"><i class="menu-icon tf-icons fa fa-user-plus"></i> Nouveau client</button>
                </div>
                <!-- Hoverable Table rows -->
                <div class="card p-2">
                <h5 class="card-header">Liste des clients</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                            <th>Patient</th>
                            <th>P. Confiance</th>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                            <th>IPM</th>
                            <th>Taux en %</th>
                            <th>Participant</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($clients as $client)
                                <tr class="clickable-row" data-href="{{route('get_client',['slug'=>$client->id])}}" style="cursor:pointer;">
                                    <td>
                                        <i class="fa-solid fa-person-breastfeeding fa-lg text-primary me-3"></i>
                                        <span class="fw-medium">{{$client->prenom_client}} {{$client->nom_client}}</span>
                                    </td>
                                    <td>{{$client->personne_confiance}}</td>
                                    <td>{{$client->adresse_client}}</td>
                                    <td>{{$client->telephone_client}} </td>
                                    <td>{{$client->ipm->nom_ipm ?? "NON"}} </td>
                                    <td>{{$client->taux_pourcentage ?? "NON"}} </td>
                                    <td>{{$client->participant ?? "NON"}} </td>
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
                <!--/ Hoverable Table rows -->

        <!-- modal add client -->
        <div class="modal fade" id="add_new_client" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <nav class="navbar navbar-light ">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">
                                <img src="{{asset('assets/img/favicon/logo_lps_text.png')}}" alt="" width="70%" height="70%" class="d-inline-block align-text-center ">
                            </a>
                        </div>
                    </nav>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding-top:0px !important;">
                    <div class="row">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Nouveau client</h5>
                                
                                </div>
                                <div class="card-body">
                                <form action="{{ route('register_client')}}" method="POST">
                                    @csrf
                                        <div class="">
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-fullname">Patient</label>
                                                <div class="row">
                                                    <div class="col input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                                        ><i class="bx bx-user"></i
                                                        ></span>
                                                        <input type="text" name="prenom_patient" required class="form-control" id="prenom_patient" placeholder="Prénom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                    <div class="col input-group input-group-merge ">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                                        ><i class="bx bx-user"></i
                                                        ></span>
                                                        <input type="text" name="nom_patient" required  class="form-control" id="nom_patient" placeholder="Nom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                        
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-fullname">Contact</label>
                                                <div class="row">
                                                    <div class=" col input-group input-group-merge">
                                                        <span id="basic-icon-default-phone2" class="input-group-text"
                                                        ><i class="bx bx-phone"></i
                                                        ></span>
                                                        <input type="text" id="phone_patient" required name="phone_patient" class="form-control phone-mask" placeholder="Numéro de téléphone" aria-label="78 210 18 57" aria-describedby="basic-icon-default-phone2" />
                                                    </div>
                                                    <div class="col input-group input-group-merge ">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa fa-location-dot"></i>
                                                        </span>
                                                        <input type="text" name="adresse_patient" required class="form-control" id="adresse_patient" placeholder="Adresse"  aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                                    
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label" for="basic-icon-default-phone">Personne de confiance</label>
                                                        <div class=" input-group input-group-merge">
                                                            <span id="basic-icon-default-fullname2" class="input-group-text"
                                                            ><i class="fa fa-person"></i
                                                            ></span>
                                                            <input type="text" name="personne_confiance" required class="form-control" id="personne_confiance" placeholder="Nom complet personne confiance"  aria-describedby="basic-icon-default-fullname2" />
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input recap-disable" type="checkbox" id="check_ipm_client" name="check_ipm_client" value="1">
                                            <label class="form-check-label" for="check_ipm_client">IPM</label>
                                        </div>
                                        <div id="client_ipm" hidden>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-phone">IPM informations</label>
                                                    <div class="row">
                                                        <div class="col input-group input-group-merge">
                                                            <span id="basic-icon-default-phone2" class="input-group-text"
                                                            ><i class="fa-solid fa-hand-holding-dollar"></i></span>
                                                            <select name="ipm_client" id="ipm_client" class="form-control">
                                                                <option value="">Selectionner l'IPM</option>
                                                                @foreach($ipms as $ipm)
                                                                    <option value="{{$ipm->id}}">{{$ipm->nom_ipm}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col input-group input-group-merge">
                                                            <span id="basic-icon-default-phone2" class="input-group-text"
                                                            ><i class="fa fa-percent"></i
                                                            ></span>
                                                            <input type="number" id="taux_pourcentage"  name="taux_pourcentage" class="form-control " placeholder="Taux en pourcentage" aria-label="" aria-describedby="" />
                                                        </div>
                                                        <div class="col input-group input-group-merge">
                                                            <span id="basic-icon-default-phone2" class="input-group-text"
                                                            ><i class="fa fa-person"></i
                                                            ></span>
                                                            <input type="text" id="participant_ipm"  name="participant_ipm" class="form-control " placeholder="Participant" aria-label="" aria-describedby="" />
                                                        </div>
                                                    </div>
                                                    
                                            </div>
                                        </div>
                                    
                                    
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                </div>
            </div>
        </div>
        <!--/ modal add client -->

        <script>
            document.getElementById('check_ipm_client').addEventListener('click', function(){
                if (document.getElementById('check_ipm_client').checked) {
                    document.getElementById('client_ipm').hidden=false;
                    document.getElementById('ipm_client').required=true;
                    document.getElementById('taux_pourcentage').required=true;
                    document.getElementById('participant_ipm').required=true;
                }

                else{
                    document.getElementById('client_ipm').hidden=true;
                    document.getElementById('ipm_client').required=false;
                    document.getElementById('taux_pourcentage').required=false;
                    document.getElementById('participant_ipm').required=false;
                }
            });

                const alerts = document.querySelectorAll('[class*="alert-"]')
                    for (const alert of alerts) {
                        setTimeout( function() {
                            const bootstrapAlert = bootstrap.Alert.getOrCreateInstance(alert);
                            bootstrapAlert.close();
                        }, 5000);
                    }
        </script>

    @endsection