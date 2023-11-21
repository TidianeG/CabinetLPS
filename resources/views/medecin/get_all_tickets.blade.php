@extends('layouts.appuser')
    @section('content')
                
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    <!-- Hoverable Table rows -->
                <div class="card p-2">
                    <h5 class="card-header">Liste des Tickets</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-center">Numero</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Consultation</th>
                                    <th class="text-center">Client</th>
                                    <th class="text-center">Caissier(e)</th>
                                    <th class="text-center">Soins</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($tickets as $ticket)
                                    <tr class="">
                                        <td>
                                            <i class="fa-solid fa-ticket fa-lg text-success me-3"></i>
                                            <span class="fw-medium">{{$ticket->numero}}</span>
                                        </td>
                                        <td class="text-center">{{$ticket->created_at->format('d-m-Y H:i:s')}}</td>
                                        <td class="text-center">{{$ticket->consultation->nom_consultation}}</td>
                                        <td class="text-center"><span class="badge bg-label-primary me-1">{{$ticket->client->prenom_client}} {{$ticket->client->nom_client}}</span></td>
                                        <td class="text-center"><span class="">{{$ticket->user->prenom}} {{$ticket->user->nom}}</span></td>
                                        <td class="text-center"><a class="btn btn-success" type="button" href="#" onclick="showModalSoinNew('{{$ticket->numero}}','{{$ticket->client_id}}')" ><i class="fa-solid fa-plus-circle fa-lg text-white me-3"></i>Ajouter</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                
                <!-- modal add soin -->
                <div class="modal fade" id="add_new_point_vente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <nav class="navbar navbar-light ">
                                                    <div class="container-fluid">
                                                        <a class="navbar-brand" href="#">
                                                            <img src="{{asset('assets/img/favicon/logo_lps_text.png')}}" alt="" width="70%" height="70%" class="d-inline-block align-text-center ">
                                                        </a>
                                                    </div>
                                                </nav>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="padding-top:0px !important;">
                                                <div class="row">
                                                    <div class="col-xl">
                                                        <div class="card mb-4">
                                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h5 class="mb-0">Nouveau(x) Soin(s)</h5>
                                                            
                                                            </div>
                                                            <div class="card-body">
                                                                        <form action="{{route('save_soin_en_attente')}}" method="post" id="create_new_soin">
                                                                            @csrf
                                                                            <div id="">
                                                                                <div class="mb-3" >
                                                                                    <label class="form-label" for="basic-icon-default-fullname">Détais du soin</label>
                                                                                    
                                                                                    <div class="">
                                                                                    <label class="form-label" for="basic-icon-default-fullname">Numéro Ticket</label>
                                                                                        <input type="hidden" name="client_id" id="client_id">
                                                                                        <div class=" input-group input-group-merge mb-3">
                                                                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa-solid fa-ticket"></i>
                                                                                            </span>
                                                                                            <input type="text" name="numero_ticket" required disabled class="form-control" id="numero_ticket" placeholder="Description du soin"  aria-describedby="basic-icon-default-fullname2" />
                                                                                        </div>
                                                                                        <div class=" col input-group input-group-merge mb-3">
                                                                                            
                                                                                            <textarea  cols="30" rows="5" name="description_soin" required class="form-control" id="description_soin" placeholder="Description du soin"  aria-describedby="basic-icon-default-fullname2"></textarea>
                                                                                            
                                                                                        </div>
                                                                                        <div class="col input-group input-group-merge mb-3">
                                                                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa-solid fa-list-ol"></i>
                                                                                            </span>
                                                                                            <input type="number" name="nombre_soin" required class="form-control" id="nombre_soin" placeholder="Nombre de soin"  aria-describedby="basic-icon-default-fullname2" />
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                                                        </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ modal add soin -->
                <!--/ Hoverable Table rows -->

                <script>

                    function showModalSoinNew(numero_ticket,client_id) {
                        $('#add_new_point_vente').modal('show');
                        document.getElementById('numero_ticket').value=numero_ticket;
                        document.getElementById('client_id').value=client_id;
                    }
                    
                    $('#create_new_soin').submit(function(event){
                        event.preventDefault();
                        document.getElementById('numero_ticket').disabled=false;

                        $('#create_new_soin').submit();
                    })
                    // document.getElementById('etat_select').addEventListener('change', function(){
                    //     if (document.getElementById('etat_select').value=='consultation') {
                    //         document.getElementById('all_consultation').hidden=false;
                    //     }
                    //     else{
                    //         document.getElementById('all_consultation').hidden=true;
                    //     }
                    // })
                </script> 
    @endsection