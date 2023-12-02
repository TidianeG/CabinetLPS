<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Caissier;
use App\Http\Middleware\Medecin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(Admin::class)->group(function () {
    
    Route::get('/list_type_consultation', [App\Http\Controllers\ConsultationController::class, 'getConsultations'])->name('list_type_consultation');
    
    Route::post('/register_consultation', [App\Http\Controllers\ConsultationController::class, 'registerConsultation'])->name('register_consultation');

    Route::put('/update_consultation', [App\Http\Controllers\ConsultationController::class, 'updateConsultation'])->name('update_consultation');
    
    Route::get('/list_users', [App\Http\Controllers\ClientController::class, 'getUsers'])->name('list_users');

    Route::get('/list_users/get-user-cm/{slug}', [App\Http\Controllers\ClientController::class, 'getUser'])->name('get_user_cm');
    
    Route::put('/list_users/get-user-cm/update_password_user_cm', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePasswordUserCM'])->name('update_password_user_cm');    

    Route::put('/list_users/get-user-cm/update_user_cm', [App\Http\Controllers\ClientController::class, 'updateUserCM'])->name('update_user_cm');    
    
    Route::put('/list_users/get-user-cm/update_user_admin', [App\Http\Controllers\ClientController::class, 'updateUserAdmin'])->name('update_user_admin');    
    
    Route::post('/register_user', [App\Http\Controllers\ClientController::class, 'create_user'])->name('register_user');
    
    Route::get('/list_point_de_ventes', [App\Http\Controllers\PointVenteController::class, 'getPointsVentes'])->name('list_point_de_ventes');    
    
    Route::put('/update_point_de_vente', [App\Http\Controllers\PointVenteController::class, 'updatePointVente'])->name('update_point_de_vente');    
    
    
    Route::post('/register_point_vente', [App\Http\Controllers\PointVenteController::class, 'registerPointVente'])->name('register_point_vente');
    
    Route::get('/get-ipms', [App\Http\Controllers\IpmController::class, 'getIPMS'])->name('get_ipms');
    
    Route::post('/get-ipms/register-ipm', [App\Http\Controllers\IpmController::class, 'registerIPM'])->name('register_ipm');
    
    Route::post('/get-ipms/register-ipm-consultation', [App\Http\Controllers\IpmController::class, 'registerIPMConsultation'])->name('register_ipm_consultation');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'home_user'])->name('user_space');
    
    Route::get('/get-all-encaissements', [App\Http\Controllers\EncaissementController::class, 'getAllEncaissement'])->name('get_all_encaissement');
    
    Route::get('/tickets/get-all-tickets', [App\Http\Controllers\TicketController::class, 'getAllTickets'])->name('get_all_tickets');

    Route::post('/tickets/get-all-tickets/lps-etat-finacier', [App\Http\Controllers\TicketController::class, 'etatFinancier'])->name('get_all_tickets_etat_financier');
});

Route::middleware(Caissier::class)->group(function () {
    
    Route::get('/point_de_vente/my_caisse', [App\Http\Controllers\PointVenteController::class, 'myCaisse'])->name('my_caisse'); 
    
    Route::post('/point_de_vente/my_caisse/ticket/create-ticket', [App\Http\Controllers\TicketController::class, 'createTicket'])->name('create_ticket');     
    
    Route::get('/point_de_vente/my_caisse/espace_caisse', [App\Http\Controllers\PointVenteController::class, 'espaceCaisse'])->name('espace_caisse');

    Route::get('/point_de_vente/my_caisse/espace_caisse/get-ipm-client/{param_slug}', [App\Http\Controllers\PointVenteController::class, 'getIPMClient'])->name('get_ipm_client');

    Route::get('/point_de_vente/my_caisse/espace_caisse/get_consultation/{slug}', [App\Http\Controllers\ConsultationController::class, 'getConsultation'])->name('get_consultation');
    
    Route::get('/point_de_vente/my_caisse/espace_caisse/list-all-tickets', [App\Http\Controllers\PointVenteController::class, 'getAllTickets'])->name('list_all_tickets');
    
    Route::get('/point_de_vente/my_caisse/espace_caisse/list-all-tickets-caisse', [App\Http\Controllers\PointVenteController::class, 'getAllTicketsCaisse'])->name('list_all_tickets_caisse');
    
    Route::get('/get-client-ipm/{slug}', [App\Http\Controllers\ClientController::class, 'getClientIPM'])->name('get_client_ipm');

    Route::post('/point_de_vente/my_caisse/espace_caisse/register_encaissement', [App\Http\Controllers\EncaissementController::class, 'newEncaissement'])->name('register_encaissement_new');

    Route::get('/point_de_vente/list-des-clients', [App\Http\Controllers\ClientController::class, 'getClientsCaissier'])->name('list_clients_caisier_space');

    Route::get('/point_de_vente/soins-attente-validation', [App\Http\Controllers\SoinEnAttenteController::class, 'getSoinsAllAttenteValidation'])->name('get_all_soin_attente_validation');

    Route::get('/point_de_vente/soins-attente-validation/save-soin/{slug}', [App\Http\Controllers\SoinController::class, 'saveSoin'])->name('save_soin');

    Route::post('/generer_facture', [App\Http\Controllers\FactureController::class, 'genererFacture'])->name('generer_facture');
});

Route::middleware(Medecin::class)->group(function () {
    
    Route::get('/medecin/my_space/', [App\Http\Controllers\HomeController::class, 'spaceMedecinAllTickets'])->name('medecin_space');

    

    Route::get('/medecin/my_space/add_soin/{slug}', [App\Http\Controllers\SoinController::class, 'addNewSoin'])->name('add_new_soin');

    Route::post('/medecin/my_space/add_soin/save-soin', [App\Http\Controllers\SoinEnAttenteController::class, 'saveSoinEnAttente'])->name('save_soin_en_attente');
    
    
});

Route::post('/register_client', [App\Http\Controllers\ClientController::class, 'register_client'])->name('register_client');    
Route::get('/my_account', [App\Http\Controllers\HomeController::class, 'getAccount'])->name('my_account');

Route::get('/get-all-tickets/get-print-ticket/{slug}', [App\Http\Controllers\TicketController::class, 'getTicket'])->name('get_print_ticket');    
Route::get('/get-all-tickets/get-print-ticket/{slug}', [App\Http\Controllers\TicketController::class, 'getTicket'])->name('get_print_ticket');    

Route::put('/my_account/update_password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePasswordProfile'])->name('password.update_profile');    


Route::get('/list_clients', [App\Http\Controllers\ClientController::class, 'getClients'])->name('list_clients');
    
    Route::get('/list_clients/get_client/{slug}', [App\Http\Controllers\ClientController::class, 'getClient'])->name('get_client');
    
    Route::put('/list_clients/get_client/update_client', [App\Http\Controllers\ClientController::class, 'updateClient'])->name('update_client');
Auth::routes();