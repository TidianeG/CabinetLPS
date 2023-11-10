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
                    <button type="button" class="btn btn-primary " style="margin-right: 20px;" data-bs-toggle="modal" data-bs-target="#add_new_ipm"><i class=" fa-solid fa-hand-holding-dollar menu-icon tf-icons"></i> Nouvele IPM</button>
                    <button type="button" class="btn btn-primary ml-2" style="margin-left: 20px;" data-bs-toggle="modal" data-bs-target="#add_new_ipm_consultation"><i class=" fa-solid fa-stethoscope menu-icon tf-icons"></i> Ajouter prix consultation IPM</button>
                    <button type="button" class="btn btn-primary ml-2" style="margin-left: 20px;" data-bs-toggle="modal" data-bs-target="#list_all_ipm"><i class=" fa-solid fa-stethoscope menu-icon tf-icons"></i> Afficher les IPMs</button>
                </div>
                <!-- Hoverable Table rows -->
                <div class="card p-2">
                    <h5 class="card-header">Listes des IPMS avec tarifs consultations</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Nom IPM</th>
                                    <th>Nom consultation</th>
                                    <th>Tarif</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($ipms_consultations as $ipm)
                                    <tr>
                                        <td>
                                            <i class="fa-solid fa-hand-holding-dollar fa-lg text-danger me-3"></i>
                                            <span class="fw-medium">{{$ipm->i_p_m->nom_ipm}}</span>
                                        </td>
                                        <td>{{$ipm->consultation->nom_consultation}}</td>
                                        <td><span class="badge bg-secondary">{{$ipm->prix_consultation_ipm}} FCFA</span></td>
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

        <!-- modal add consultation -->
        <div class="modal fade" id="add_new_ipm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <h5 class="mb-0">Nouvelle IPM</h5>
                                
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{route('register_ipm')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname">Nom IPM </label>
                                                <div class="input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"
                                                    ><i class="fa-solid fa-stethoscope"></i></span>
                                                    <input type="text" name="nom_ipm" required class="form-control" id="nom_ipm" placeholder="Nom de l'IPM"  aria-describedby="basic-icon-default-fullname2" />
                                                </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-icon-default-fullname">Description</label>
                                            
                                                <div class="col input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"
                                                    ><i class="fa-solid fa-comment-medical"></i></span>
                                                    <input type="text" name="description_ipm" class="form-control" id="description_ipm" placeholder="Description IPM"  aria-describedby="basic-icon-default-fullname2" />
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

        <!-- modal add consultation -->
        <div class="modal fade" id="list_all_ipm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <div class="card p-2">
                    <h5 class="card-header">Listes des IPMS</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Nom IPM</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($ipms as $ipm)
                                    <tr>
                                        <td>
                                            <i class="fa-solid fa-hand-holding-dollar fa-lg text-danger me-3"></i>
                                            <span class="fw-medium">{{$ipm->nom_ipm}}</span>
                                        </td>
                                        <td></td>
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
        <!--/ modal add consultation -->

    @endsection