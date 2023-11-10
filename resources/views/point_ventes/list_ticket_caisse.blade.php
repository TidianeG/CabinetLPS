@extends('layouts.appuser')
    @section('content')
        <div class="card">
                <h5 class="card-header">Liste des tickets</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Numero</th>
                                    <th>Consultation</th>
                                    <th>Client</th>
                                    <th>IPM</th>
                                    <th>Type paiement</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($tickets as $tickets)
                                    <tr>
                                        <td>
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$tickets->date_creation}}</span>
                                        </td>
                                        <td>{{$tickets->numero}}</td>
                                        <td><span class="badge bg-label-primary me-1">{{$tickets->nom}}</span></td>
                                        <td><span class=""></span></td>
                                        <td><span class="">IPM</span></td>
                                        <td>{{$tickets->type_paiement}}</td>
                                        <td>{{$tickets->montant_total}}</td>
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