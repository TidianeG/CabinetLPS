@extends('layouts.appuser')
    @section('content')
                        <!--/ Hoverable Table rows -->
                        @if(Auth::user()->point_vente)
                            <div class="row">
                                <div class="col-7">
                                    <div class="d-flex justify-content-start">
                                        <h5 class="pb-1 mb-4" style="margin-right: 20px;">Point vente</h5>
                                        <h5 class="pb-1 mb-4 text-primary"><i class="menu-icon tf-icons fa-solid fa-cash-register"></i>{{Auth::user()->point_vente->nom_point_vente}}</h5>
                                                        
                                    </div>
                                </div>
                                <div class="col-5" style="text-align: right;">
                                    <a href="{{route('get_all_soin_attente_validation')}}"><span>Soin(s) en attente de validation : ({{$soin_en_attente_validation->count()}})</span></a>
                                </div>
                            </div>
                            
                            <div class="row mb-5">
                                <div class="col-md-4 col-lg-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="col-7">
                                                    <h6 class="card-title">{{$recap_etat_journalier['date']}}</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    <p class="card-text">Tickets</p>
                                                </div>
                                                <div class="col-7 text-right" style="text-align: right;">
                                                    <h6 class="card-title badge bg-success ">{{$recap_etat_journalier['nombre_ticket']}}</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    <p class="card-text">Solde</p>
                                                </div>
                                                <div class="col-7 text-right" style="text-align: right;">
                                                    <h6 class="card-title badge bg-success">{{$recap_etat_journalier['somme_total']}} FCFA</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    <p class="card-text">Gérant</p>
                                                </div>
                                                <div class="col-7 text-right" style="text-align: right;">
                                                    <p class="card-title" style="font-weight: bold;">{{$point_vente->gerant}}</p>
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
                                <div class="col-lg-9">
                                    <div class="card p-3">
                                        <h5 class="card-header">Etat journalier</h5>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-hover " id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Tickets vendu</th>
                                                        <th>Montant total</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0 ">
                                                    <?php
                                                        $total_montant = 0;
                                                        $nombre_total = 0;
                                                    ?>
                                                @foreach ($users_grouped as $date_group)
                                                    <tr class="cursor-pointer">
                                                        <td>
                                                            <i class="fa-solid fa-calendar fa-lg text-danger me-3"></i>
                                                            <span class="fw-medium">{{ $date_group->first()->created_at->format('d-m-Y') }}</span>
                                                        </td>
                                                        <?php
                                                            $total = 0;
                                                            $nombre = 0;
                                                        ?>
                                                        @foreach ($date_group as $etat)
                                                            <?php
                                                                $total += $etat->montant_total;
                                                                $nombre ++;
                                                            ?>
                                                        @endforeach
                                                        <td>{{$nombre}}</td>
                                                        <td>{{$total}} FCFA</td>
                                                        
                                                    </tr>
                                                    <?php
                                                        $total_montant += $total;
                                                        $nombre_total += $nombre;
                                                    ?>
                                                @endforeach
                                                </tbody>
                                                <tfoot style="" class="table-dark">
                                                    <tr>
                                                        <th class="text-white">Total</th>
                                                        <th class="text-white">{{$nombre_total}}</th>
                                                        <th class="text-white">{{$total_montant}} FCFA</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-cash-register fa-xl"></i>    
                                <strong>Point de vente non disponible</strong> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> 
                        @endif
           
    @endsection