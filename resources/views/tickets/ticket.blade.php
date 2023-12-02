@extends('layouts.appuser')
    @section('content')
                <div class="card p-2">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" onclick="window.history.back();" ><i class="fa-solid fa-rotate-left fa-lg text-white me-3"></i>Retour</button>
                        
                        <div class="m-2" >
                            <form action="{{route('generer_facture')}}" method="post">
                                @csrf
                                <input type="hidden" name="identifiant_ticket" value="{{$ticket->id}}">
                                <input type="hidden" name="numero_ticket" value="{{$ticket->numero}}">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-file-invoice fa-lg text-white me-3"></i>Générer une facture</button>
                            </form>
                            
                            
                        </div>
                    </div>
                    <h5 class="card-header">Détails du ticket</h5>
                    <div class="row">
                        <div class="col-7">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Numero ticket</th>
                                            <th>Client</th>
                                            <th>Description soin</th>
                                            <th>Nombre Soin</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach($ticket->soin as $soin)
                                            <tr>
                                                <td>{{$soin->created_at}}</td>
                                                <td>{{$ticket->numero}}</td>
                                                <td>{{$ticket->client->prenom_client}} {{$ticket->client->nom_client}}</td>
                                                <td>{{$soin->description_soin}}</td>
                                                <td>{{$soin->nombre_soin}}</td>
                                                <td>{{$soin->montant_total_soin}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-5">
                            <iframe id="frame" src="{{asset('storage\documents\Tickets\pdf\Ticket_caisse'.$ticket->numero.'.pdf')}}" frameborder="0" width="300" height="550"></iframe>
                        </div>
                    </div>
                    
                    
                </div>
                
    @endsection