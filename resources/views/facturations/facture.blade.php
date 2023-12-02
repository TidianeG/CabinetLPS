<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous" >


</head>
<body>
    <style>
       

h6{font-size:1em;}



.invoice {
  background: #fff;
  
  
}

.logo {
  width: 4cm;
}

.document-type {
  text-align: right;
  color: #444;
}

.conditions {
  font-size: 0.7em;
  color: #666;
}

.bottom-page {
  font-size: 0.7em;
}
    </style>
     

     <div class="container">
             <div class="invoice">
                 <div class="d-fex justify-content-beetwen">
                    <table class="table">
                        
                            <th class="text-left">
                                <div class="">
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logo_facture.png'))) }}" style="width: 100px; height: 60px;" >

                                </div>
                            </th>
                            <th class="text-right">
                                <div class="">
                                    <h6 class="document-type display-4">FACTURE</h6>
                                    <p class="text-right"><strong th:text="${invoiceReference}">N° {{$numero}}</strong></p>
                                </div>
                            </th>
                        
                        
                    </table>
                     
                     
                 </div>
                 <div class="">
                     <div class="" style="margin-top: -40px !important;">
                         <p class="addressMySam">
                             <strong>CABINET MEDICAL PEDIATRIQUE</strong><br/>
                             <strong>LE PEDIATRE DU SOIR</strong><br/>
                             <span>Sacré Coeur 3 près de la Boulangerie Jaune</span><br/>
                             <span>Fixe : +221 33 848 93 21</span><br>
                             <span>Mobile : +221 77 869 41 14</span>
                         </p>
                     </div>
                     <div class="d-flex justify-content-end text-right" style="margin-top: -80px !important;">
                         <br/><br/><br/>
                         <p class="addressDriver ">
                             <strong th:text="${driver.getCompanyName()}">Patient</strong><br/>
                             Réf. Client <em th:text="${driver.getUserId()}">{{$numero_client}}</em><br/>
                             <span th:text="${driver.getFirstName()}">{{$client}}</span><br/>
                             <span th:text="${driver.getAddress()}">{{$adresse}}</span>
                             
                         </p>
                     </div>
                 </div>
                 <h6>Générée le  <span >{{$date}}</span> <span th:text="${end}"></span>
                 </h6>
                 <br/>
                 <table class="table table-striped">
                     <thead>
                     <tr>
                         <th>Description</th>
                         <!--<th>Quantité</th>-->
                         <!--<th>Unité</th>-->
                         <!--<th>PU TTC</th>-->
                         <th>Nombre</th>
                         <th class="text-right">Prix</th>
                         <th class="text-right">Total</th>
                     </tr>
                     </thead>
                     <tbody>
                     <tr>
                         <td>{{$consultation}} </td>
                         <!--<td>13</td>-->
                         <!--<td>Kilomètres</td>-->
                         <!--<td class="text-right">1,20€</td>-->
                         <td>1</td>
                         <td class="text-right" th:text="${summaryDriverClientsPayment.get('mysamHT')}">{{$total}} FCFA</td>
                         <td class="text-right" th:text="${summaryDriverClientsPayment.get('mysamTTC')}">{{$total}} FCFA</td>
                     </tr>
                     <tr>
                         <td>Frais de service MySam à 10% pour la période du <span th:text="${start}">date</span> au <span
                                 th:text="${end}">date</span></td>
                         <!--<td>15</td>-->
                         <!--<td>Minutes</td>-->
                         <!--<td class="text-right">0,25€</td>-->
                         <td>20%</td>
                         <td class="text-right" th:text="${summaryDriverPayment.get('mysamHT')}">0,00€</td>
                         <td class="text-right" th:text="${summaryDriverPayment.get('mysamTTC')}">0,00€</td>
                     </tr>
                     <tr>
                         <td>Pénalités d'annulation</td>
                         <!--<td>5</td>-->
                         <!--<td>Minutes</td>-->
                         <!--<td class="text-right">-10€</td>-->
                         <td>20%</td>
                         <td class="text-right" th:text="${summaryPenalties.get('driverHT')}">0,00€</td>
                         <td class="text-right" th:text="${summaryPenalties.get('driverTTC')}">0,00€</td>
                     </tr>
                     </tbody>
                     <tfoot>
                        <tr>
                            <td></td>
                            
                            <td><strong>Total</strong></td>
                            <td class="text-right" colspan="2" th:text="${totalTTC}">0,00€</td>
                        </tr>
                     </tfoot>
                 </table>
                 
                 <p class="conditions">
                     En votre aimable règlement
                     <br/>
                     Et avec nos remerciements.
                     <br/><br/>
                    
                 <br/>
                 <br/>
                 <br/>
     
                 <p class="bottom-page text-right">
                     CABINET MEDICAL PEDIATRIQUE - LE PEDIATRE DU SOIR<br/>
                     Sacré Coeur 3 près de la Boulangerie Jaune <br> +221 33 848 93 21 | +221 77 869 41 14
<br/>
                     www.lepediatredusoir.sn<br/>
                     <!--IBAN FR76 1470 7034 0031 4211 7882 825 - SWIFT CCBPFRPPMTZ-->
                 </p>
             </div>
         </div>

</body>
</html>