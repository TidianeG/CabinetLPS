<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
                           
                                <div class="l-col-right ticket-wrap" aria-label="A fake boat ticket demonstrating mixing font weights and widths">
                                    <div class="ticket p-1" aria-hidden="true">
                                        <div class="ticket__header" style="border-bottom:1px dashed #424f5e;">
                                            <nav class="navbar navbar-light" style="margin-bottom: 10px !important;">
                                                <div class="">
                                                    <a class="navbar-brand" href="#">
                                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logo.png'))) }}" style="width: 20%; height: 70px;" >
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
                                                <div class="col-6" style="text-align: left !important;">
                                                    <span class="text-left">N° {{$numero}}</span>
                                                </div>
                                                <div class="col-6" style="text-align: right !important;">
                                                    <span id="date_ticket" style="text-align: right;">{{$date}}</span> <span id="date_ticket" class="ml-2" style="text-align: right;">{{$time}}</span>
                                                </div>
                                            </div>
                                            <div style="text-align: left !important;">
                                                <span class="text-left">Patient : {{$client}}</span>
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
                                                            <td id="td_consultation">{{$consultation}}</td>
                                                            @if($prix_consultation_ipm != 0)
                                                                <td id="td_prix" style="text-align: right;">{{$prix_consultation_ipm}}</td>
                                                            @else
                                                                <td id="td_prix" style="text-align: right;">{{$prix}}</td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                    
                                                </table>
                                            </div>
                                            <div class="ticket__timing-total">
                                                <table class=" table-borderless w-100">
                                                    <thead>
                                                        @if($prix_consultation_ipm != 0)
                                                            <tr class="" style="padding-bottom: 2px !important;">
                                                                <th style="font-size:16px">IPM</th>
                                                                <th style="font-size:16px; text-align: right;" id="th_total">{{$taux_IPM}} %</th>
                                                            </tr>
                                                        @endif
                                                        
                                                        <tr class="" style="padding-bottom: 2px !important;">
                                                            <th style="font-size:16px">Total</th>
                                                            <th style="font-size:16px; text-align: right;" id="th_total">{{$total}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="font-size:12px" >Paiement</th>
                                                            <th style="font-size:12px; text-align: right;" id="td_paiement">{{$type_paiement}}</th>
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
            border: 1px dashed #000;
            font-family: "Variable Bahnschrift", "FF DIN", "Franklin Gothic", "Helvetica Neue", sans-serif;
            font-feature-settings: "kern" 1;
            background: #fff;

            width: 8cm !important;
            height: 15cm !important;
        }
        body{
            width: 8cm !important;
            height: 15cm !important;
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
                padding: 10px;
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>