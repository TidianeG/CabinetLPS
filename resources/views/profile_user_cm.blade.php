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
                        <a href="{{route('list_users')}}" class="btn btn-primary"><i class="fa-solid fa-rotate-left fa-lg text-white me-3"></i>Retour</a>
                    </div>
                    <h5 class="card-header">Details Profil</h5>
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
                      
                      <form action="{{route('update_user_cm')}}" method="POST">
                        @csrf
                        @method('PUT')
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="firstName" class="form-label">Prénom</label>
                              <input
                                class="form-control"
                                type="text"
                                id="prenom_user"
                                name="prenom_user"
                                value="{{$user->prenom}}"
                                autofocus />
                            </div>
                            <input type="hidden" id="identifiant_user" name="identifiant_user" value="{{$user->id}}">
                            <div class="mb-3 col-md-6">
                              <label for="lastName" class="form-label">Nom</label>
                              <input class="form-control" type="text"  name="nom_user" id="nom_user" value="{{$user->nom}}" />
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="organization" class="form-label">Username</label>
                              <input
                                type="text"
                                class="form-control"
                                id="username_user"
                                name="username_user"
                                value="{{$user->username}}" />
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">E-mail</label>
                              <input
                                class="form-control"
                                type="text"
                                id="email_user" 
                                name="email_user"
                                value="{{$user->email}}" />
                            </div>
                            
                            <div class="mb-3 col-md-6">
                              <label for="address" class="form-label">Profil</label>
                              <input type="text" class="form-control" disabled id="profil" value="{{$user->profil}}" name="profil_user" />
                            </div>
                          </div>
                          <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changements</button>
                            </div>
                        </form>
                        
                    </div>
                    <!-- /Account -->
                  </div>
                  <div class="card">
                    <h5 class="card-header">Changement mot de passe</h5>
                    <div class="card-body">
                      <form action="{{ route('update_password_user_cm') }}" method="POST" id="update_password_user">
                        @csrf
                        @method('PUT')
                        <input
                              class="form-control"
                              type="hidden"
                              id="email"
                              name="email"
                              value="{{$user->email}}" />
                        <div class="row">
                          <div class="mb-3 col-md-4 form-group" >
                            <label for="lastName" class="form-label">Nouveau mot de passe</label>
                            <div class="col input-group input-group-merge mb-3" id="show_hide_password_new">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input class="form-control" required minlength="5" type="password" name="password" id="password"  />
                                <span id="basic-icon-default-fullname2 " style="cursor: pointer;" class="input-group-text span-eyes"><i class="fa fa-eye-slash i-eyes"></i></span>
                            </div>
                          </div>
                          <div class="mb-3 col-md-4 form-group" >
                            <label for="lastName" class="form-label">Confirmer le mot de passe</label>
                            <div class="col input-group input-group-merge mb-3" id="show_hide_password_confirm">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input class="form-control" required minlength="5" type="password" name="password_confirmation" id="password_confirmation"  />
                                <span id="basic-icon-default-fullname2 " style="cursor: pointer;" class="input-group-text span-eyes"><i class="fa fa-eye-slash i-eyes"></i></span>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-danger alert-dismissible fade show"  role="alert" hidden id="alert_error_password">
                          <strong id="error_password"></strong> 
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <button type="submit" class="btn btn-primary">Changer</button>
                      </form>
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


                $(document).ready(function() {
                    $("#show_hide_password_old .span-eyes").on('click', function(event) {
                        event.preventDefault();
                        if($('#show_hide_password_old input').attr("type") == "text"){
                            $('#show_hide_password_old input').attr('type', 'password');
                            $('#show_hide_password_old .i-eyes').addClass( "fa-eye-slash" );
                            $('#show_hide_password_old .i-eyes').removeClass( "fa-eye" );
                        }else if($('#show_hide_password_old input').attr("type") == "password"){
                            $('#show_hide_password_old input').attr('type', 'text');
                            $('#show_hide_password_old .i-eyes').removeClass( "fa-eye-slash" );
                            $('#show_hide_password_old .i-eyes').addClass( "fa-eye" );
                        }
                    });
                    $("#show_hide_password_new .span-eyes").on('click', function(event) {
                        event.preventDefault();
                        if($('#show_hide_password_new input').attr("type") == "text"){
                            $('#show_hide_password_new input').attr('type', 'password');
                            $('#show_hide_password_new .i-eyes').addClass( "fa-eye-slash" );
                            $('#show_hide_password_new .i-eyes').removeClass( "fa-eye" );
                        }else if($('#show_hide_password_new input').attr("type") == "password"){
                            $('#show_hide_password_new input').attr('type', 'text');
                            $('#show_hide_password_new .i-eyes').removeClass( "fa-eye-slash" );
                            $('#show_hide_password_new .i-eyes').addClass( "fa-eye" );
                        }
                    });
                    $("#show_hide_password_confirm .span-eyes").on('click', function(event) {
                        event.preventDefault();
                        if($('#show_hide_password_confirm input').attr("type") == "text"){
                            $('#show_hide_password_confirm input').attr('type', 'password');
                            $('#show_hide_password_confirm .i-eyes').addClass( "fa-eye-slash" );
                            $('#show_hide_password_confirm .i-eyes').removeClass( "fa-eye" );
                        }else if($('#show_hide_password_confirm input').attr("type") == "password"){
                            $('#show_hide_password_confirm input').attr('type', 'text');
                            $('#show_hide_password_confirm .i-eyes').removeClass( "fa-eye-slash" );
                            $('#show_hide_password_confirm .i-eyes').addClass( "fa-eye" );
                        }
                    });

                    $("#update_password_user").on('submit', function(even){
                        even.preventDefault();
                        if (document.getElementById("password").value != document.getElementById("password_confirmation").value) {
                            document.getElementById('error_password').innerText="Mot de passe et confirmation non identique!!!";
                            document.getElementById('alert_error_password').hidden=false;
                        }

                        else{
                            document.getElementById('update_password_user').submit();
                        }
                    })


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