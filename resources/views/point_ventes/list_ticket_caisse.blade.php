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
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($tickets as $ticket)
                                    <tr class="clickable-row" data-target="_blank" data-href="{{route('get_print_ticket', ['slug'=>$ticket->id])}}" style="cursor:pointer;">
                                        <td>
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$ticket->date_creation}}</span>
                                        </td>
                                        <td>{{$ticket->numero}}</td>
                                        <td><span class="badge bg-label-primary me-1">{{$ticket->nom}}</span></td>
                                        <td><span class=""></span></td>
                                        <td><span class="">IPM</span></td>
                                        <td>{{$ticket->type_paiement}}</td>
                                        <td>{{$ticket->montant_total}}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="" class="table-dark">
                                <tr>
                                    <th class="text-white text-left" style="text-align: left;" colspan="3">Nombre de tickets : {{$tickets->count()}}</th>
                                    <th class="text-white text-right" style="text-align: right !important;" colspan="4">Total : {{$tickets->sum('montant_total')}} FCFA</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
    @endsection