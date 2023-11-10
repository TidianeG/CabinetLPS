<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Caissier;

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

Auth::routes();

Route::middleware(Admin::class)->group(function () {
    Route::get('/list_clients', [App\Http\Controllers\ClientController::class, 'getClients'])->name('list_clients');
    Route::get('/list_clients/get_client/{slug}', [App\Http\Controllers\ClientController::class, 'getClient'])->name('get_client');
    Route::get('/list_type_consultation', [App\Http\Controllers\ConsultationController::class, 'getConsultations'])->name('list_type_consultation');
    Route::post('/register_consultation', [App\Http\Controllers\ConsultationController::class, 'registerConsultation'])->name('register_consultation');
    Route::get('/list_users', [App\Http\Controllers\ClientController::class, 'getUsers'])->name('list_users');
    Route::post('/register_user', [App\Http\Controllers\ClientController::class, 'create_user'])->name('register_user');
    Route::post('/register_client', [App\Http\Controllers\ClientController::class, 'register_client'])->name('register_client');    

    Route::get('/list_point_de_ventes', [App\Http\Controllers\PointVenteController::class, 'getPointsVentes'])->name('list_point_de_ventes');    
    Route::post('/register_point_vente', [App\Http\Controllers\PointVenteController::class, 'registerPointVente'])->name('register_point_vente');
    
    Route::get('/get-ipms', [App\Http\Controllers\IpmController::class, 'getIPMS'])->name('get_ipms');
    Route::post('/get-ipms/register-ipm', [App\Http\Controllers\IpmController::class, 'registerIPM'])->name('register_ipm');
    Route::post('/get-ipms/register-ipm-consultation', [App\Http\Controllers\IpmController::class, 'registerIPMConsultation'])->name('register_ipm_consultation');


    Route::get('/get-all-encaissements', [App\Http\Controllers\EncaissementController::class, 'getAllEncaissement'])->name('get_all_encaissement');
    Route::get('/tickets/get-all-tickets', [App\Http\Controllers\TicketController::class, 'getAllTickets'])->name('get_all_tickets');
});

Route::middleware(Caissier::class)->group(function () {
    Route::get('/point_de_vente/my_caisse', [App\Http\Controllers\PointVenteController::class, 'myCaisse'])->name('my_caisse');    

    Route::post('/point_de_vente/my_caisse/ticket/create-ticket', [App\Http\Controllers\TicketController::class, 'createTicket'])->name('create_ticket');     
    Route::get('/point_de_vente/my_caisse/espace_caisse', [App\Http\Controllers\PointVenteController::class, 'espaceCaisse'])->name('espace_caisse');

    Route::get('/point_de_vente/my_caisse/espace_caisse/get_consultation/{slug}', [App\Http\Controllers\ConsultationController::class, 'getConsultation'])->name('get_consultation');
    Route::get('/point_de_vente/my_caisse/espace_caisse/list-all-tickets', [App\Http\Controllers\PointVenteController::class, 'getAllTickets'])->name('list_all_tickets');
    Route::get('/point_de_vente/my_caisse/espace_caisse/list-all-tickets-caisse', [App\Http\Controllers\PointVenteController::class, 'getAllTicketsCaisse'])->name('list_all_tickets_caisse');
    
    Route::get('/get-client-ipm/{slug}', [App\Http\Controllers\ClientController::class, 'getClientIPM'])->name('get_client_ipm');

    Route::post('/point_de_vente/my_caisse/espace_caisse/register_encaissement', [App\Http\Controllers\EncaissementController::class, 'newEncaissement'])->name('register_encaissement_new');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'home_user'])->name('user_space');


Route::get('/my_account', [App\Http\Controllers\HomeController::class, 'getAccount'])->name('my_account');
