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
                <h4 class=" mb-2"><span class="text-muted fw-light">Espace caisse</h4>
                <div class="row mb-3">
                    <div class="col-9 d-flex justify-content-beetwen">
                        <div class="m-2" >
                            <a href="{{route('my_caisse')}}" class="btn btn-primary"><i class="fa-solid fa-rotate-left fa-lg text-white me-3"></i>Quitter</a>
                        </div>
                        <div class="m-2">
                            <a href="{{route('list_all_tickets_caisse')}}" class="btn btn-primary"><i class="fa-solid fa-table-list fa-lg text-white me-3"></i>Tickets de la caisse</a>
                        </div>
                        <div class="m-2">
                            <a href="{{route('list_all_tickets')}}" class="btn btn-primary"><i class="fa-solid fa-table-list fa-lg text-white me-3"></i>Tous les tickets</a>
                        </div>
                        <div class="m-2">
                            <form action="{{route('register_encaissement_new')}}" method="POST">
                                @csrf
                                <input type="hidden" name="nombre_ticket" value="{{$nombre_ticket}}">
                                <input type="hidden" name="montant_total" value="{{$somme_total}}">
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-circle-xmark fa-lg text-white me-3"></i>Cloturer</button>
                            </form>
                            
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="d-flex justify-content-end">
                            <div class="text-center" style="margin-right: 30px; text-size:16px; font-weight: bold;">
                                <span>Tickets </span><span class="badge bg-success text-center" style="text-size:20px !important; font-weight: bold;">{{$nombre_ticket}}</span>
                            </div>
                            <div class="text-center" style="margin-right: 30px; text-size:16px; font-weight: bold;">
                                <span>Total </span><span class="badge bg-success text-center" style="text-size:20px !important; font-weight: bold;">{{$somme_total}} FCFA</span>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Basic -->
                    <div class="" id="formulaire_ticket_create_ticket">
                        <div class="card mb-4">
                            <h5 class="card-header">Nouveau Ticket</h5>
                            <div class="card-body demo-vertical-spacing demo-only-element">
                                <form method="POST" action="{{route('create_ticket')}}" id="nouveau_ticket">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class=" mb-3">
                                                    <label class="form-label" for="basic-icon-default-fullname">Type de consultation</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                                        ><i class="fa-solid fa-stethoscope"></i></span>
                                                        <select name="consultation" id="consultation" required class="form-control recap-disable" aria-describedby="basic-icon-default-fullname2">
                                                            <option value="">Sélectionner une consultation</option>
                                                            @foreach($consultations as $consultation)
                                                                <option value="{{$consultation->id}}">{{$consultation->nom_consultation}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-icon-default-fullname">Paiement</label>
                                            
                                                <div class="col input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"
                                                    ><i class="fa-solid fa-hand-holding-dollar"></i></span>
                                                    <select name="type_paiement" id="type_paiement" required class="form-control recap-disable" aria-describedby="basic-icon-default-fullname2">
                                                        <option value="">Sélectionner un type de paiement</option>
                                                        <option value="Espece">Espèce</option>
                                                        <option value="Cheque">Chèque</option>
                                                        <option value="Carte">Carte</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3" id="client_select">
                                                <label class="form-label" for="basic-icon-default-fullname">Client</label>
                                                
                                                    <div class="col input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                                        ><i class="fa-solid fa-user"></i></span>
                                                        <select name="client_exist" id="client_exist" required class="form-control recap-disable" aria-describedby="basic-icon-default-fullname2">
                                                            <option value="">Sélectionner un client</option>
                                                            @foreach($clients as $client)
                                                                <option value="{{$client->id}}">{{$client->prenom_client}} {{$client->nom_client}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input recap-disable" type="checkbox" id="check_new_client" name="check_new_client" value="1">
                                                <label class="form-check-label" for="check_new_client">Nouveau client</label>
                                            </div>
                                            <div class="mb-3" id="new_client" hidden>
                                                <label class="form-label" for="basic-icon-default-fullname">Patient</label>
                                                <div class="row mb-3">
                                                    <div class="col input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                                        ><i class="fa-solid fa-user"></i
                                                        ></span>
                                                        <input type="text" name="prenom_patient"  class="form-control recap-disable" id="prenom_patient" placeholder="Prénom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                    <div class="col input-group input-group-merge ">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                                        ><i class="fa-solid fa-user"></i
                                                        ></span>
                                                        <input type="text" name="nom_patient"   class="form-control recap-disable" id="nom_patient" placeholder="Nom" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                                        ><i class="fa-solid fa-person"></i
                                                        ></span>
                                                        <input type="text" name="adresse"  class="form-control recap-disable" id="adresse" placeholder="Personne de confiance" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                    <div class="col input-group input-group-merge ">
                                                        <span id="basic-icon-default-fullname2" class="input-group-text"
                                                        ><i class="fa-solid fa-location-dot"></i
                                                        ></span>
                                                        <input type="text" name="personne_confiance"   class="form-control recap-disable" id="personne_confiance" placeholder="Adresse patient" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>
                                        <div id="client_new_ip">
                                            <div class="form-check form-switch mb-2" >
                                                <input class="form-check-input recap-disable" type="checkbox" name="ipm_check" id="ipm_check" value="1">
                                                <label class="form-check-label" for="ipm_check">IPM</label>
                                            </div>
                                            <div class="mb-3" id="ipm_details" hidden>
                                                <label class="form-label" for="basic-icon-default-fullname">IPM détails</label>
                                                    <div class="row mb-3">
                                                        <div class="col  mb-3">
                                                            <select name="type_ipm" id="type_ipm" class="form-control recap-disable" >
                                                                <option value="" class="form-control">Sélectionner L'IPM</option>
                                                                @foreach($ipms as $ipm)
                                                                    <option value="{{$ipm->id}}" class="form-control">{{$ipm->nom_ipm}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col input-group input-group-merge mb-3">
                                                            <span id="basic-icon-default-fullname2" class="input-group-text"
                                                            ><i class="fa-solid fa-person"></i
                                                            ></span>
                                                            <input type="text" name="participant"  class="form-control recap-disable" id="participant" placeholder="Nom Participant" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                                        </div>
                                                        <div class="col input-group input-group-merge mb-3">
                                                            <span id="basic-icon-default-fullname2" class="input-group-text"
                                                            ><i class="fa-solid fa-percent"></i></span>
                                                            <input type="number" name="taux_pourcentage"  class="form-control recap-disable" id="taux_pourcentage" placeholder="Taux en %"  aria-describedby="basic-icon-default-fullname2" />
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary" id="valider">Valider</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Merged -->
                    <div class="" id="recapitulatif_ticket" hidden>
                        <div class="card mb-4">
                            <h5 class="card-header">Récapitulatif ticket</h5>
                            <div >
                                <div class="l-col-right ticket-wrap" aria-label="A fake boat ticket demonstrating mixing font weights and widths">
                                    <div class="ticket p-1" aria-hidden="true">
                                        <div class="ticket__header" style="border-bottom:1px dashed #424f5e;">
                                            <nav class="navbar navbar-light" style="">
                                                <div class="">
                                                    <a class="navbar-brand" href="#">
                                                        <img src="{{asset('assets/img/favicon/logo.png')}}" alt="" width="30%" height="30%" class="d-inline-block align-text-center ">
                                                    </a>
                                                    <h6 class="mb-1">Cabinet Medical Peditrique</h6>
                                                    <h6>Le Pediatre du Soir</h6>
                                                </div>
                                            </nav>
                                            <span class="text-center">Sacré coeur 3, rue XXXXX, villa XXX</span>
                                            <span class="text-center">33 XXX XX XX</span>
                                        </div>
                                        <div class="ticket__body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <span class="text-left">N° </span>
                                                </div>
                                                <div class="col-6">
                                                    <span id="date_ticket" style="text-align: right;"></span>
                                                </div>
                                            </div>
                                            <div class="ticket__timing">
                                                <table class="table  w-100 mb-2">
                                                    <thead style="border-bottom: 1px solid #000;">
                                                        <tr class="" style="">
                                                            <th>Consultation</th>
                                                            <th class="text-right" style="text-align: right;">Prix</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="" >
                                                            <td id="td_consultation"></td>
                                                            <td id="td_prix" style="text-align: right;"></td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                </table>
                                            </div>
                                            <div class="ticket__timing-total">
                                                <table class=" table-borderless w-100">
                                                    <thead>
                                                        <tr class="" style="padding-bottom: 2px !important;">
                                                            <th style="font-size:16px">Total</th>
                                                            <th style="font-size:16px; text-align: right;" id="th_total"></th>
                                                        </tr>
                                                        <tr>
                                                            <th style="font-size:12px" >Paiement</th>
                                                            <th style="font-size:12px; text-align: right;" id="td_paiement"></th>
                                                        </tr>
                                                        <tr>
                                                            <th style="font-size:12px" >Nombre CS</th>
                                                            <th style="font-size:12px; text-align: right;" id="td_paiement">1</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            
                                        </div>
                                        <div class="ticket__footer" style="border-top:1px dashed #424f5e;">
                                            <p class="text-center">Merci et prompt rétablissement</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center p-4">
                                    <a href="#"  id="generer_ticket" class="btn btn-primary" style="width: 150px !important;">Générer</a>
                                    <button type="submit" id="rejeter_ticket" class="btn btn-danger" style="" >Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <script>
            // Selection du button autre client
                document.getElementById("check_new_client").addEventListener('click',function() {
                    if (document.getElementById('check_new_client').checked) {
                        document.getElementById('new_client').hidden=false;
                        document.getElementById('client_select').hidden=true;

                        document.getElementById('prenom_patient').required=true;
                        document.getElementById('nom_patient').required=true;

                        document.getElementById('adresse').required=true;
                        document.getElementById('personne_confiance').required=true;

                        document.getElementById('adresse').required=true;
                        document.getElementById('personne_confiance').required=true;

                        document.getElementById('client_exist').required=false;
                    }
                    else{
                        document.getElementById('new_client').hidden=true;
                        document.getElementById('client_select').hidden=false;

                        document.getElementById('prenom_patient').required=false;
                        document.getElementById('nom_patient').required=false;

                        document.getElementById('adresse').required=false;
                        document.getElementById('personne_confiance').required=false;

                        document.getElementById('client_exist').required=true;
                    }
                    
                });

                // Selection de l'IPM
                document.getElementById("ipm_check").addEventListener('click',function() {
                    if (document.getElementById('ipm_check').checked) {
                        document.getElementById('ipm_details').hidden=false;

                        document.getElementById('type_ipm').required=true;
                        document.getElementById('participant').required=true;
                        
                    }
                    else{
                        document.getElementById('ipm_details').hidden=true;
                        document.getElementById('type_ipm').required=false;
                        document.getElementById('participant').required=false;
                    }
                    
                });

                document.getElementById('client_exist').addEventListener('change', function(){
                    //alert('response');    
                    let slug_id = document.getElementById('client_exist').value;
                    //alert(slug_id);
                            $.ajax({
                                type: "GET",
                                url: '/get-client-ipm/'+slug_id,
                                dataType : "json",
                            })
                            .done(function(response){
                                    //let data = JSON.stringify(response);
                                    console.log(response);
                                    if (response['ipm_id']) {
                                        document.getElementById('ipm_check').checked=false;
                                        document.getElementById('client_new_ip').hidden=true;
                                    }
                                    else{
                                        document.getElementById('client_new_ip').hidden=false;
                                    }
                            })
                            .fail(function(error){
                                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                            });
                });
                document.getElementById('nouveau_ticket').addEventListener('submit', function(e){
                        e.preventDefault();
                        // document.getElementById('consultation').disabled=true;
                        // document.getElementById('check_new_client').disabled=true;
                        // document.getElementById('prenom_patient').disabled=true;
                        // document.getElementById('nom_patient').disabled=true;
                        // document.getElementById('adresse').disabled=true;
                        // document.getElementById('personne_confiance').disabled=true;
                        // document.getElementById('client_exist').disabled=true;
                        // document.getElementById('ipm_check').disabled=true;
                        // document.getElementById('type_ipm').disabled=true;
                        // document.ge²&ée"r'tyhj,k;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      juyt-('"é&tElementById('participant').disabled=true;
                        // document.getElementById('type_paiement').disabled=true;
                        
                        document.getElementById('recapitulatif_ticket').hidden=false;
                        document.getElementById('formulaire_ticket_create_ticket').hidden=true;
                        //document.getElementById('valider').disabled=true;
                        let slug = document.getElementById('consultation').value;
                            $.ajax({
                                type: "GET",
                                url: '/point_de_vente/my_caisse/espace_caisse/get_consultation/'+slug,
                                dataType : "json",
                            })
                            .done(function(response){
                                    //let data = JSON.stringify(response);
                                    //alert(data);
                                    document.getElementById('td_consultation').innerText= response['nom'];
                                    document.getElementById('td_prix').innerText= response['prix'] +'FFCA';
                                    document.getElementById('th_total').innerText= response['prix'] +'FCFA';
                                    document.getElementById('td_paiement').innerText = document.getElementById('type_paiement').value;
                                    document.getElementById('date_ticket').innerText= 'le'+' '+new Date().toLocaleDateString("fr-FR");
                            })
                            .fail(function(error){
                                alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                            });
                            //document.getElementById('nouveau_ticket').submit();
                    });


                    document.getElementById('rejeter_ticket').addEventListener('click',function(e){
                        e.preventDefault();
                        document.getElementById('recapitulatif_ticket').hidden=true;
                        document.getElementById('formulaire_ticket_create_ticket').hidden=false;

                        document.getElementById('consultation').disabled=false;
                        document.getElementById('check_new_client').disabled=false;
                        document.getElementById('prenom_patient').disabled=false;
                        document.getElementById('nom_patient').disabled=false;
                        document.getElementById('adresse').disabled=false;
                        document.getElementById('personne_confiance').disabled=false;
                        document.getElementById('client_exist').disabled=false;
                        document.getElementById('ipm_check').disabled=false;
                        document.getElementById('type_ipm').disabled=false;
                        document.getElementById('participant').disabled=false;
                        document.getElementById('type_paiement').disabled=false;

                    });

                    document.getElementById('generer_ticket').addEventListener('click',function(){
                        //alert(document.getElementById('prenom_patient').value);
                        document.getElementById('nouveau_ticket').submit();
                        document.getElementById('recapitulatif_ticket').hidden=true;
                        document.getElementById('formulaire_ticket_create_ticket').hidden=false;

                        document.getElementById('consultation').value="";
                        document.getElementById('check_new_client').value="";
                        document.getElementById('prenom_patient').value="";
                        document.getElementById('nom_patient').value="";
                        document.getElementById('adresse').value="";
                        document.getElementById('personne_confiance').value="";
                        document.getElementById('client_exist').value="";
                        document.getElementById('ipm_check').value="";
                        document.getElementById('type_ipm').value="";
                        document.getElementById('participant').value="";
                        document.getElementById('type_paiement').value="";
                    })
                   
                    
        </script>
    <style>
        /*
        *	TICKET
        *	---------------------------------------------
        */

        .ticket-wrap {
            text-align: center;
        }

        .ticket {
            display: inline-block;
            margin: 0 auto;
            border: 2px solid #9facbc;
            font-family: "Variable Bahnschrift", "FF DIN", "Franklin Gothic", "Helvetica Neue", sans-serif;
            font-feature-settings: "kern" 1;
            background: #fff;

            width: 8cm !important;
            height: 13cm !important;
        }

        .ticket__header {
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .ticket__co span,
        .ticket__route span {
            display: block;
        }

        .ticket__co {
            display: inline-block;
            position: relative;
            padding-left: 5em;
            line-height: 1;
            color: #5e7186;
        }

        .ticket__co-icon {
            position: absolute;
            top: 50%;
            margin-top: -2em;
            left: 0;
            width: 4em;
            height: auto;
        }

        .ticket__co-name {
            font-size: 2.5em;
            font-variation-settings: "wght" 500, "wdth" 75;
            letter-spacing: -.01em;
        }

        .ticket__co-subname {
            font-variation-settings: "wght" 700;
            color: #506072;
        }

        .ticket__body {
            padding: 5px;
        }

        .ticket__route {
            font-variation-settings: "wght" 300;
            font-size: 2em;
            line-height: 1.1;
        }

        .ticket__description {
            margin-top: .5em;
            font-variation-settings: "wght" 350;
            font-size: 1.125em;
            color: #506072;
        }

        .ticket__timing {
            display: flex;
            align-items: center;
            margin-top: 1rem;
            padding: 1rem 0;
            text-align: left;
        }

        .ticket__timing-total {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            text-align: left;
        }

        .ticket__timing p {
            margin: 0 1rem 0 0;
            padding-right: 1rem;
            border-right: 2px solid #9facbc;
            line-height: 1;
        }

        .ticket__timing p:last-child {
            margin: 0;
            padding: 0;
            border-right: 0;
        }

        .ticket__small-label {
            display: block;
            margin-bottom: .5em;
            font-variation-settings: "wght" 300;
            font-size: .875em;
            color: #506072;
        }

        .ticket__detail {
            font-variation-settings: "wght" 700;
            font-size: 1.25em;
            color: #424f5e;
        }

        .ticket__admit {
            margin-top: 2rem;
            font-size: 2.5em;
            font-variation-settings: "wght" 700, "wdth" 85;
            line-height: 1;
            color: #657990;
        }

        .ticket__fine-print {
            margin-top: 1rem;
            font-variation-settings: "wdth" 75;
            color: #666;
        }

        .ticket__barcode {
            margin-top: 1.25em;
            width: 299px;
            max-width: 100%;
        }

        @media (min-width: 36em) {
            .ticket-wrap {
                margin-bottom: 4em;
                text-align: center;
            }

            

            .ticket__header {
                margin: 0;
            }

            .ticket__body {
                padding: 5px;
            }

            .ticket__detail {
                font-size: 1.75em;
            }

            .ticket__admit {
                margin-top: 2rem;
            }
        }

        @supports (display: grid) {
            @media (min-width: 72em) {
                .ticket-info,
                .ticket-wrap {
                    align-self: center;
                }

                .ticket-wrap {
                    margin-bottom: 0;
                }

                .ticket-info {
                    order: 1;
                }
            }
        }
    </style>

@endsection