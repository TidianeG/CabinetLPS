@extends('layouts.appuser')
    @section('content')
                <div class="card p-2">
                    
                    <h5 class="card-header">Détails du ticket</h5>
                    <div class="row">
                        <div class="col-4">
                            <iframe id="frame" class="mt-3" src="{{asset('storage\documents\Tickets\pdf\Ticket_caisse'.$ticket->numero.'.pdf')}}" frameborder="0" width="300" height="550"></iframe>
                        </div>
                        <div class="col-8">
                            <div>
                                <a href="{{route('espace_caisse')}}" class="btn btn-primary mb-3"><i class="fa-solid fa-rotate-left fa-lg text-white me-3"></i>Retour à la caisse</a>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success" onclick="print()"><i class="fa-solid fa-print fa-lg text-white me-3"></i>Imprimer le Ticket</button>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <script>
                    function print() {
                        var frame = document.getElementById('frame');
                        frame.contentWindow.focus();
                        frame.contentWindow.print();
                    }
                </script>
    @endsection