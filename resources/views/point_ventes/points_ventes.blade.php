@extends('layouts.appuser')
    @section('content')
    <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_new_point_vente"><i class="fa-solid fa-cash-register menu-icon tf-icons"></i> Nouvelle caisse</button>
                </div>
                <!-- Hoverable Table rows -->
                <div class="card p-2">
                <h5 class="card-header">Points de vente</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Gérant</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($points_ventes as $point_vente)
                                <tr>
                                    <td>
                                        <i class="fa-solid fa-cash-register fa-lg text-danger me-3"></i>
                                        <span class="fw-medium">{{$point_vente->nom_point_vente}}</span>
                                    </td>
                                    <td><span class="badge bg-label-primary me-1">{{$point_vente->gerant}}</span></td>
                                    <td>{{$point_vente->description}}</td>
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


            </div>
            <!--/ Content -->
        </div>
        <!--/ Content -->
        <!-- modal add client -->
        <div class="modal fade" id="add_new_point_vente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <h5 class="mb-0">Nouveau Point de vente</h5>
                                
                                </div>
                                <div class="card-body">
                                <form method="POST" action="{{route('register_point_vente')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Nom du point de vente</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"
                                                ><i class="fa-solid fa-cash-register"></i></span>
                                                <input type="text" name="nom_point_vente" required class="form-control" id="nom_point_vente" placeholder="Nom consultation"  aria-describedby="basic-icon-default-fullname2" />
                                            </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Gérant</label>
                                            <div class="col input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"
                                                ><i class="fa-solid fa-user"></i></span>
                                                <select name="gerant" id="gerant" class="form-control" required>
                                                    <option value="">Selectionner un gérant</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->prenom}} {{$user->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-phone">Description</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"
                                            ><i class="fa-solid fa-comment-medical"></i></span>
                                            <input type="text" id="description" name="description" class="form-control phone-mask"  aria-describedby="basic-icon-default-phone2" />
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
            const alerts = document.querySelectorAll('[class*="alert-"]')
                    for (const alert of alerts) {
                        setTimeout( function() {
                            const bootstrapAlert = bootstrap.Alert.getOrCreateInstance(alert);
                            bootstrapAlert.close();
                        }, 5000);
                    }
        </script>
    @endsection