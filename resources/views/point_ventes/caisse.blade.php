@extends('layouts.appuser')
    @section('content')
                        <!--/ Hoverable Table rows -->
                        @if($caisse!=null)
                            <h5 class="pb-1 mb-4">Point vente</h5>
                            <div class="row mb-5">
                                <div class="col-md-4 col-lg-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="card-title">{{$caisse->nom}}</h5>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="card-title">{{$recap_etat_journalier['date']}}</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-7">
                                                    <p class="card-text">Tickets vendu</p>
                                                </div>
                                                <div class="col-5 text-right" style="text-align: right;">
                                                    <h6 class="card-title badge bg-success ">{{$recap_etat_journalier['nombre_ticket']}}</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-7">
                                                    <p class="card-text">Montant total</p>
                                                </div>
                                                <div class="col-5 text-right" style="text-align: right;">
                                                    <h6 class="card-title badge bg-success">{{$recap_etat_journalier['somme_total']}} FCFA</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    <p class="card-text">Gérant</p>
                                                </div>
                                                <div class="col-7 text-right" style="text-align: right;">
                                                    <p class="card-title" style="font-weight: bold;">{{$caisse->gerant}}</p>
                                                </div>
                                            </div>
                                            @if($recap_etat_journalier['nombre_ticket'])
                                                <a href="{{route('espace_caisse')}}"  class="btn btn-primary">Continuer</a>
                                            @endif
                                            @if(!$recap_etat_journalier['nombre_ticket'])
                                                <a href="{{route('espace_caisse')}}"  class="btn btn-primary">Commencer</a>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card p-3">
                                        <h5 class="card-header">Etat journalier</h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Gerant</th>
                                                        <th>Tickets vendu</th>
                                                        <th>Montant total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <tr class="cursor-pointer">
                                                        <td>
                                                            <i class="fa-solid fa-calendar fa-lg text-danger me-3"></i>
                                                            <span class="fw-medium"></span>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
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
                                                                    ><i class="bx bx-trash me-1"></i> Disable</a
                                                                    >
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($caisse==null)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-cash-register fa-xl"></i>    
                                <strong>Point de vente non disponible</strong> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> 
                        @endif
           
    @endsection