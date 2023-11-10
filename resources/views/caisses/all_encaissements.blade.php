@extends('layouts.appuser')
    @section('content')
        <div class="card p-2">
                
                <h5 class="card-header">Les encaissements</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Nombre consultation</th>
                                    <th>Gérant caisse</th>
                                    <th>Montant total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($encaissements as $encaissement)
                                    <tr>
                                        <td>
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$encaissement->nombre_ticket}}</span>
                                        </td>
                                        <td>{{$encaissement->user->prenom}} {{$encaissement->user->nom}}</td>
                                        <td><span class="badge bg-label-primary me-1">{{$encaissement->montant_total}}</span></td>
                                        
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
    @endsection