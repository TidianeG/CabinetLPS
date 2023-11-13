@extends('layouts.appuser')
    @section('content')
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
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
                      <form action="{{route('user_update')}}" method="POST">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Prénom</label>
                            <input
                              class="form-control"
                              type="text"
                              id="prenom_user"
                              name="prenom_user"
                              value="{{Auth::user()->prenom}}"
                              autofocus />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Nom</label>
                            <input class="form-control" type="text" name="nom_user" id="nom_user" value="{{Auth::user()->nom}}" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Username</label>
                            <input
                              type="text"
                              class="form-control"
                              id="username_user"
                              name="username_user"
                              value="{{Auth::user()->username}}" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email_user" disabled
                              name="email_user"
                              value="{{Auth::user()->email}}" />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Profil</label>
                            <input type="text" class="form-control" disabled id="profil_user" value="{{Auth::user()->profil}}" name="profil_user" />
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
                      <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input
                              class="form-control"
                              type="hidden"
                              id="email"
                              name="email"
                              value="{{Auth::user()->email}}" />
                        <div class="row">
                          <div class="mb-3 col-md-4 form-group" >
                            <label for="lastName" class="form-label">Ancien mot de passe</label>
                            <div class="col input-group input-group-merge mb-3" id="show_hide_password_old">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input class="form-control" type="password" name="old_password" id="old_password"  />
                                <span id="basic-icon-default-fullname2 " style="cursor: pointer;" class="input-group-text span-eyes"><i class="fa fa-eye-slash i-eyes"></i></span>
                            </div>
                          </div>
                          <div class="mb-3 col-md-4 form-group" >
                            <label for="lastName" class="form-label">Nouveau mot de passe</label>
                            <div class="col input-group input-group-merge mb-3" id="show_hide_password_new">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input class="form-control" type="password" name="password" id="password"  />
                                <span id="basic-icon-default-fullname2 " style="cursor: pointer;" class="input-group-text span-eyes"><i class="fa fa-eye-slash i-eyes"></i></span>
                            </div>
                          </div>
                          <div class="mb-3 col-md-4 form-group" >
                            <label for="lastName" class="form-label">Confirmer le mot de passe</label>
                            <div class="col input-group input-group-merge mb-3" id="show_hide_password_confirm">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"  />
                                <span id="basic-icon-default-fullname2 " style="cursor: pointer;" class="input-group-text span-eyes"><i class="fa fa-eye-slash i-eyes"></i></span>
                            </div>
                          </div>
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
              });
              </script>
    @endsection