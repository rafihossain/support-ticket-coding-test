<?php

use App\Http\Controllers\Admin\AdminSupportTicketController;
use App\Http\Controllers\Customer\CustomerSupportTicketController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');


/*==============================================
                SUPPORT TICKET
==============================================*/

Route::middleware('auth')->prefix('admin/support-ticket')->name('admin.support.ticket.')->controller(AdminSupportTicketController::class)->group(function () {

    Route::get('/', 'all_tickets')->name('all');
    Route::get('/delete/{id}', 'delete')->name('delete');
    Route::get('/view/{id}', 'view')->name('view');
    Route::post('/bulk-action', 'bulk_action')->name('bulk.action');
    Route::post('/status-change', 'status_change')->name('status.change');
    Route::post('/send-message', 'send_message')->name('send.message');

});

Route::middleware('auth')->prefix('customer/support-ticket')->name('customer.support.ticket.')->controller(CustomerSupportTicketController::class)->group(function () {

    Route::get('/', 'support_tickets')->name('all');
    Route::get('/new', 'new_ticket')->name('new');
    Route::post('/new', 'store_ticket')->name('store');
    Route::post('/delete/{id}', 'delete')->name('delete');
    Route::get('/view/{id}', 'support_ticket_view')->name('view');
    Route::post('/bulk-action', 'bulk_action')->name('bulk.action');
    Route::post('/status-change', 'status_change')->name('status.change');
    Route::post('/send-message', 'send_message')->name('send.message');

});


// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
// Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';
