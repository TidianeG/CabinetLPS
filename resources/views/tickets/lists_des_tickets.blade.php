@extends('layouts.appuser')
    @section('content')
                
                <div class="mb-3 mt-3">
                    <form action="{{route('get_all_tickets_etat_financier')}}" method="POST">
                        @csrf
                        <div class="row g-3 align-items-center justify-content-end">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Faire un état des : </label>
                            </div>
                            <div class="col-auto">
                                <select name="etat_select" id="etat_select" class="form-control" required>
                                    <option value="ticket">Tickets</option>
                                    <option value="consultation">Consultation</option>
                                </select>
                            </div>
                            <div class="col-auto" id="all_consultation" hidden>
                                <select name="consultation_select" id="consultation_select" class="form-control">
                                    <option value="all">Toutes</option>
                                    @foreach($consultations as $consultation)
                                        <option value="{{$consultation->id}}">{{$consultation->nom_consultation}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Du : </label>
                            </div>
                            <div class="col-auto">
                                <input type="date" id="date_debut" name="date_debut" required class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Au : </label>
                            </div>
                            <div class="col-auto">
                                <input type="date" id="date_fin" name="date_fin" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </div>
                    </form>
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
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($tickets as $ticket)
                                    <tr class="clickable-row" data-target="_blank" data-href="{{route('get_print_ticket', ['slug'=>$ticket->id])}}" style="cursor:pointer;">
                                        <td>
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$ticket->numero}}</span>
                                        </td>
                                        <td>{{$ticket->created_at->format('d-m-Y H:i:s')}}</td>
                                        <td>{{$ticket->consultation->nom_consultation}}</td>
                                        <td><span class="badge bg-label-primary me-1">{{$ticket->client->prenom_client}} {{$ticket->client->nom_client}}</span></td>
                                        <td><span class="badge bg-label-primary me-1">{{$ticket->user->prenom}} {{$ticket->user->nom}}</span></td>
                                        <td><span class="badge bg-label-primary me-1">{{$ticket->montant_total}} FCFA</span></td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="" class="table-dark">
                                <tr>
                                    <th class="text-white text-left" style="text-align: left;" colspan="3">Nombre de tickets : {{$tickets->count()}}</th>
                                    <th class="text-white text-right" style="text-align: right !important;" colspan="3">Total : {{$tickets->sum('montant_total')}} FCFA</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!--/ Hoverable Table rows -->

                <script>
                    document.getElementById('etat_select').addEventListener('change', function(){
                        if (document.getElementById('etat_select').value=='consultation') {
                            document.getElementById('all_consultation').hidden=false;
                        }
                        else{
                            document.getElementById('all_consultation').hidden=true;
                        }
                    })
                </script>
    @endsection