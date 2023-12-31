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
                <div class="mb-2 d-flex justify-content-start">
                    <button type="button" class="btn btn-primary " style="margin-right: 20px;" data-bs-toggle="modal" data-bs-target="#add_new_consultation"><i class=" fa-solid fa-stethoscope menu-icon tf-icons"></i> Nouveau type consultation</button>
                    <button type="button" class="btn btn-primary ml-2" style="margin-left: 20px;" data-bs-toggle="modal" data-bs-target="#add_new_ipm_consultation"><i class=" fa-solid fa-stethoscope menu-icon tf-icons"></i> Ajouter une IPM</button>
                </div>
                <!-- Hoverable Table rows -->
                <div class="card p-2">
                    <h5 class="card-header">Types de consultations</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($consultations as $consultation)
                                    <tr>
                                        <td>
                                            <i class="fa-solid fa-stethoscope fa-lg text-danger me-3"></i>
                                            <span class="fw-medium">{{$consultation->nom_consultation}}</span>
                                        </td>
                                        <td>{{$consultation->description}}</td>
                                        <td><span class="badge bg-label-primary me-1">{{$consultation->prix_consultation}} FCFA</span></td>
                                        <td>
                                            <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item " href="#" onclick="updateConsultation('{{$consultation->id}}','{{$consultation->nom_consultation}}','{{$consultation->prix_consultation}}','{{$consultation->description}}')"
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

        <!-- modal add consultation -->
        <div class="modal fade" id="add_new_consultation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
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
                                <h5 class="mb-0">Nouveau type de consultation</h5>
                                
                                </div>
                                <div class="card-body">
                                <form method="POST" action="{{route('register_consultation')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"
                                                ><i class="fa-solid fa-stethoscope"></i></span>
                                                <input type="text" name="nom_type_consultation" class="form-control" id="nom_type_consultation" placeholder="Nom consultation"  aria-describedby="basic-icon-default-fullname2" />
                                            </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Description</label>
                                        
                                            <div class="col input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"
                                                ><i class="fa-solid fa-comment-medical"></i></span>
                                                <input type="text" name="description_type_consultation" class="form-control" id="description_type_consultation" placeholder="Description"  aria-describedby="basic-icon-default-fullname2" />
                                            </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-phone">Prix consultation</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"
                                            ><i class="fa-solid fa-hand-holding-dollar"></i></span>
                                            <input type="number" id="prix_type_consultation" name="prix_type_consultation" class="form-control phone-mask"  aria-describedby="basic-icon-default-phone2" />
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
        <!--/ modal add consultation -->

        <!-- modal add consultation -->
        <div class="modal fade" id="add_new_ipm_consultation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
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
                                    <h5 class="mb-0">Prix consultation IPM</h5>
                                
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{route('register_ipm_consultation')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname">Nom IPM </label>
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"
                                                    ><i class="fa-solid fa-file-invoice-dollar"></i></span>
                                                    <select name="select_ipm" id="select_ipm" required class="form-control">
                                                        <option value="">Sélectionner l'IPM</option>
                                                        @foreach($ipms as $ipm)
                                                            <option value="{{$ipm->id}}">{{$ipm->nom_ipm}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname">Type de consultation</label>
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"
                                                    ><i class="fa-solid fa-stethoscope"></i></span>
                                                    <select name="select_consultation" id="select_consultation" required class="form-control">
                                                        <option value="">Sélectionner le type de consultation</option>
                                                        @foreach($consultations as $consultation)
                                                            <option value="{{$consultation->id}}">{{$consultation->nom_consultation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname">Prix</label>
                                            
                                                <div class="col input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"
                                                    ><i class="fa-solid fa-dollar"></i></span>
                                                    <input type="number" name="prix_ipm_consultation" class="form-control" id="prix_ipm_consultation"   aria-describedby="basic-icon-default-fullname2" />
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
        <!--/ modal add consultation -->

        <!-- modal update consultation -->
        <div class="modal fade" id="update_consultation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
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
                                <h5 class="mb-0">Update consultation</h5>
                                
                                </div>
                                <div class="card-body">
                                <form method="POST" action="{{route('update_consultation')}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"
                                                ><i class="fa-solid fa-stethoscope"></i></span>
                                                <input type="hidden" name="identifiant_consultation" class="form-control" id="identifiant_consultation"  />
                                                <input type="text" name="nom_type_consultation_update" class="form-control" id="nom_type_consultation_update" placeholder="Nom consultation"  aria-describedby="basic-icon-default-fullname2" />
                                            </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Description</label>
                                        
                                            <div class="col input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"
                                                ><i class="fa-solid fa-comment-medical"></i></span>
                                                <input type="text" name="description_type_consultation_update" class="form-control" id="description_type_consultation_update" placeholder="Description"  aria-describedby="basic-icon-default-fullname2" />
                                            </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-phone">Prix consultation</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"
                                            ><i class="fa-solid fa-hand-holding-dollar"></i></span>
                                            <input type="number" id="prix_type_consultation_update" name="prix_type_consultation_update" class="form-control phone-mask"  aria-describedby="basic-icon-default-phone2" />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                </div>
            </div>
        </div>
        <!--/ modal update consultation -->
        <script>

            function updateConsultation(identifiant, nom, prix, description) {
                $('#identifiant_consultation').val(identifiant);
                $('#nom_type_consultation_update').val(nom);
                $('#description_type_consultation_update').val(description);
                $('#prix_type_consultation_update').val(prix);

                $('#update_consultation').modal('show');

            }
            const alerts = document.querySelectorAll('[class*="alert-"]')
                    for (const alert of alerts) {
                        setTimeout( function() {
                            const bootstrapAlert = bootstrap.Alert.getOrCreateInstance(alert);
                            bootstrapAlert.close();
                        }, 5000);
                    }
        </script>
    @endsection