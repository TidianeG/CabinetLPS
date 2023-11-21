@extends('layouts.appuser')
    @section('content')
                
                <div class="mb-3 mt-3">
                    <!-- -->
                </div>
                    <!-- Hoverable Table rows -->
                <div class="card p-2">
                    
                    <div class="card-header">
                        <h5 class="card-header">Nouveaux soins</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{route('save_soin')}}" method="post" id="">
                                    @csrf
                                    <div id="">
                                        <div class="mb-3" >
                                            <label class="form-label" for="basic-icon-default-fullname">Détais du soin</label>
                                              
                                            <div class="row">
                                                <div class=" col input-group input-group-merge">
                                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="fa-solid fa-hand-holding-medical"></i>
                                                    </span>
                                                    <input type="text" name="description_soin" required class="form-control" id="description_soin" placeholder="Description du soin"  aria-describedby="basic-icon-default-fullname2" />
                                                </div>
                                                <div class="col input-group input-group-merge ">
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
                            <div class="col-lg-6">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Hoverable Table rows -->
                
                <script>
                    
                    
                    // document.getElementById('etat_select').addEventListener('change', function(){
                    //     if (document.getElementById('etat_select').value=='cons') {ultation
                    //         document.getElementById('all_consultation').hidden=false;
                    //     }
                    //     else{
                    //         document.getElementById('all_consultation').hidden=true;
                    //     }
                    // })
                </script>

                                    
    @endsection