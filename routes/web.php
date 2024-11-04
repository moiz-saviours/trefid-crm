<?php

use App\Http\Controllers\Admin\{
    ProfileController as AdminProfileController,
    BrandController as AdminBrandController,
    EmployeeController as AdminEmployeeController,
    TeamController as AdminTeamController,
    InvoiceController as AdminInvoiceController,
    ClientController as AdminClientController,
    LeadController as AdminLeadController,
    PaymentController as AdminPaymentController
};
use App\Http\Controllers\User\{
    ProfileController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {

    /** Profile Routes */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [AdminProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [AdminProfileController::class, 'update'])->name('update');
    });

    /** Brand Routes */
    Route::prefix('brand')->name('brand.')->group(function () {
        Route::get('/', [AdminBrandController::class, 'index'])->name('index');
        Route::get('/create', [AdminBrandController::class, 'create'])->name('create');
        Route::post('/store', [AdminBrandController::class, 'store'])->name('store');
        Route::post('/update', [AdminBrandController::class, 'update'])->name('update');
    });

    /** Employee Routes */
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('s/', [AdminEmployeeController::class, 'index'])->name('index');
        Route::get('/create', [AdminEmployeeController::class, 'create'])->name('create');
        Route::post('/store', [AdminEmployeeController::class, 'store'])->name('store');
        Route::post('/edit', [AdminEmployeeController::class, 'edit'])->name('edit');
        Route::post('/update', [AdminEmployeeController::class, 'update'])->name('update');
    });

    /** Team Routes */
    Route::prefix('team')->name('team.')->group(function () {
        Route::get('/', [AdminTeamController::class, 'index'])->name('index');
        Route::get('/create', [AdminTeamController::class, 'create'])->name('create');
        Route::post('/store', [AdminTeamController::class, 'store'])->name('store');
        Route::post('/edit', [AdminTeamController::class, 'edit'])->name('edit');
        Route::post('/update', [AdminTeamController::class, 'update'])->name('update');
    });

    /** Invoice Routes */
    Route::prefix('invoice')->name('invoice.')->group(function () {
        Route::get('/', [AdminInvoiceController::class, 'index'])->name('index');
        Route::get('/create', [AdminInvoiceController::class, 'create'])->name('create');
        Route::post('/store', [AdminInvoiceController::class, 'store'])->name('store');
        Route::post('/edit', [AdminInvoiceController::class, 'edit'])->name('edit');
        Route::post('/update', [AdminInvoiceController::class, 'update'])->name('update');
    });

    /** Client Routes */
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/', [AdminClientController::class, 'index'])->name('index');
        Route::get('/create', [AdminClientController::class, 'create'])->name('create');
        Route::post('/store', [AdminClientController::class, 'store'])->name('store');
        Route::post('/edit', [AdminClientController::class, 'edit'])->name('edit');
        Route::post('/update', [AdminClientController::class, 'update'])->name('update');
    });

    /** Lead Routes */
    Route::prefix('lead')->name('lead.')->group(function () {
        Route::get('/', [AdminLeadController::class, 'index'])->name('index');
        Route::get('/create', [AdminLeadController::class, 'create'])->name('create');
        Route::post('/store', [AdminLeadController::class, 'store'])->name('store');
        Route::post('/edit', [AdminLeadController::class, 'edit'])->name('edit');
        Route::post('/update', [AdminLeadController::class, 'update'])->name('update');
    });

    /** Payment Routes */
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/', [AdminPaymentController::class, 'index'])->name('index');
        Route::get('/create', [AdminPaymentController::class, 'create'])->name('create');
        Route::post('/store', [AdminPaymentController::class, 'store'])->name('store');
        Route::post('/edit', [AdminPaymentController::class, 'edit'])->name('edit');
        Route::post('/update', [AdminPaymentController::class, 'update'])->name('update');
    });
});

require __DIR__ . '/admin-auth.php';
