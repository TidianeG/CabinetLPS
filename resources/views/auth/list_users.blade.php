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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_new_user"><i class="menu-icon tf-icons fa fa-user-plus"></i> Nouvel utilisateur</button>
                </div>
                <!-- Hoverable Table rows -->
                <div class="card p-2">
                <h5 class="card-header">Liste des utilisateurs</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                        <th>utilisateur</th>
                        <th>Email</th>
                        <th>Profil</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach( $users as $user)
                            <tr class="cursor-pointer">
                                <td>
                                    <i class="fa-solid fa-user fa-lg text-danger me-3"></i>
                                    <span class="fw-medium">{{$user->prenom}} {{$user->nom}}</span>
                                </td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->profil}}</td>
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
                                            ><i class="bx bx-trash me-1"></i> Disable</a
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

        <!-- modal add user -->
        <div class="modal fade" id="add_new_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    <h5 class="mb-0">Nouvel utilisateur</h5>
                                </div>
                                <div class="card-body">
                                <form action="{{ route('register_user') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Prénom & Nom</label>
                                        <div class="row">
                                            <div class="col input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"
                                                ><i class="bx bx-user"></i
                                                ></span>
                                                <input type="text" name="prenom" required class="form-control" id="prenom" placeholder="Prénom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                            </div>
                                            <div class="col input-group input-group-merge ">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"
                                                ><i class="bx bx-user"></i
                                                ></span>
                                                <input type="text" name="nom" required class="form-control" id="nom" placeholder="Nom"  aria-describedby="basic-icon-default-fullname2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-phone">Username</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"
                                            ><i class="fa-solid fa-user"></i></span>
                                            <input type="text" id="username" required name="username" class="form-control phone-mask" placeholder="username"  aria-describedby="basic-icon-default-phone2" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-phone">Email</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"
                                            ><i class="fa-solid fa-at"></i></span>
                                            <input type="email" id="email" required name="email" class="form-control phone-mask" placeholder="email"  aria-describedby="basic-icon-default-phone2" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Profil</label>
                                        <div class="col input-group input-group-merge ">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa-regular fa-id-badge"></i>
                                            </span>
                                            <select name="profil" id="profil" class="form-control" aria-describedby="basic-icon-default-fullname2" required>
                                                <option value=""></option>
                                                <option value="caissier">Caissier</option>
                                                <option value="medecin">Medecin</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Mot de passe</label>
                                        <div class="row">
                                            <div class="col input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"
                                                ><i class="bx bx-lock"></i
                                                ></span>
                                                <input type="password" name="password" required class="form-control" id="password" placeholder="mot de passe"  aria-describedby="basic-icon-default-fullname2" />
                                            </div>
                                            <div class="col input-group input-group-merge ">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"
                                                ><i class="bx bx-lock"></i
                                                ></span>
                                                <input type="password" required name="password_confirm" class="form-control" id="password_confirm" placeholder="confirmer le mot de passe"  aria-describedby="basic-icon-default-fullname2" />
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

    @endsection