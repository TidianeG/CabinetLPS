@extends('layouts.appuser')
    @section('content')
              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Details Profil</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                            src="{{asset('assets/img/avatars/user-avatar.png')}}"
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                            id="uploadedAvatar" />
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Prénom</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="firstName"
                              value="{{Auth::user()->prenom}}"
                              autofocus />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Nom</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="{{Auth::user()->nom}}" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Username</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                              name="organization"
                              value="{{Auth::user()->username}}" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="{{Auth::user()->email}}" />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Profil</label>
                            <input type="text" class="form-control" disabled id="address" value="{{Auth::user()->profil}}" name="address" placeholder="Address" />
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changements</button>
                          <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                      <form id="formAccountDeactivation" onsubmit="return false">
                        <div class="form-check mb-3">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            name="accountActivation"
                            id="accountActivation" />
                          <label class="form-check-label" for="accountActivation"
                            >I confirm my account deactivation</label
                          >
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
    @endsection