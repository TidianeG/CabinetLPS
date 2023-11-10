@extends('layouts.appuser')
    @section('content')
                
                <div class="mb-2 d-flex justify-content-start">
                    <button type="button" class="btn btn-primary " style="margin-right: 20px;" data-bs-toggle="modal" data-bs-target="#add_new_consultation"><i class=" fa-solid fa-stethoscope menu-icon tf-icons"></i> Faire un etat des tickets par filtre</button>
                </div>
                    <!-- Hoverable Table rows -->
                <div class="card p-2">
                    <h5 class="card-header">Liste des Tickets</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Numero</th>
                                    <th>Date</th>
                                    <th>Consultation</th>
                                    <th>Client</th>
                                    <th>Caissier(e)</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$ticket->numero}}</span>
                                        </td>
                                        <td>{{$ticket->date_creation}} {{$ticket->heure_creation}}</td>
                                        <td>{{$ticket->consultation->nom_consultation}}</td>
                                        <td><span class="badge bg-label-primary me-1">{{$ticket->client->prenom_client}} {{$ticket->client->nom_client}}</span></td>
                                        <td><span class="badge bg-label-primary me-1">{{$ticket->user->prenom}} {{$ticket->user->nom}}</span></td>
                                        <td><span class="badge bg-label-primary me-1">{{$ticket->montant_total}}</span></td>
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


    @endsection