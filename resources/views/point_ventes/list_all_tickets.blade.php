@extends('layouts.appuser')
    @section('content')
        <div class="card p-2">
            <div class="row">
                <div class="m-2 col-1" >
                    <a href="{{route('espace_caisse')}}" class="btn btn-primary"><i class="fa-solid fa-rotate-left fa-lg text-white me-3"></i>Quitter</a>
                </div>
                <div class="col-11 ">
                    <form action="">
                        <div class="row g-3 align-items-center justify-content-end">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Faire un état des : </label>
                            </div>
                            <div class="col-auto">
                                <select name="etat_select" id="etat_select" class="form-control">
                                    <option value="ticket">Tickets</option>
                                    <option value="consultation">Consultation</option>
                                </select>
                            </div>
                            <div class="col-auto" id="all_consultation" hidden>
                                <select name="etat_select" id="etat_select" class="form-control">
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
                                <input type="date" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Au : </label>
                            </div>
                            <div class="col-auto">
                                <input type="date" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                
                <h5 class="card-header">Liste des tickets</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr >
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Numero</th>
                                    <th class="text-center">Consultation</th>
                                    <th class="text-center">Client</th>
                                    <th class="text-center">IPM</th>
                                    <th class="text-center">Taux IPM %</th>
                                    <th class="text-center">Type paiement</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($tickets as $ticket)
                                    <tr class="clickable-row" data-target="_blank" data-href="{{route('get_print_ticket', ['slug'=>$ticket->id])}}" style="cursor:pointer;">
                                        <td class="text-center">
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$ticket->date_creation}}</span>
                                        </td>
                                        <td class="text-center">{{$ticket->numero}}</td>
                                        <td class="text-center"><span class="badge bg-label-primary me-1">{{$ticket->consultation->nom_consultation}}</span></td>
                                        <td class="text-center"><span class=""></span>{{$ticket->client->prenom_client}} {{$ticket->client->nom_client}}</td>
                                        <td class="text-center"><span class="">{{$ticket->client->ipm->nom_ipm ?? "--"}}</span></td>
                                        <td class="text-center"><span class="">{{$ticket->client->taux_pourcentage ?? "--"}}</span></td>
                                        <td class="text-center">{{$ticket->type_paiement}}</td>
                                        <td class="text-center">{{$ticket->montant_total}} FCFA</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="" class="table-dark">
                                <tr>
                                    <th class="text-white text-left" style="text-align: left !important;" colspan="4">Nombre de tickets : {{$tickets->count()}}</th>
                                    <th class="text-white text-right" style="text-align: right !important;" colspan="4">Total : {{$tickets->sum('montant_total')}} FCFA</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

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