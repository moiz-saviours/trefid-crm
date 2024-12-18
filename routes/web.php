<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\User\{BrandController,
    BrandsController,
    CompanyController,
    ContactController,
    ContactsController,
    InvoiceController,
    LeadController,
    LeadStatusController,
    PaymentController,
    ProfileController,
    TeamController,
    TeamMemberController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /** Companies Routes */
    Route::prefix('companies')->name('company.')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
    });
    /** Contacts Routes */
    Route::name('contact.')->group(function () {
        Route::get('/contacts', [ContactController::class, 'index'])->name('index');
        Route::prefix('contacts')->group(function () {

        });
    });
    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
    /** Team Members Routes */
    Route::name('team-member.')->group(function () {
        Route::get('/team-members', [TeamMemberController::class, 'index'])->name('index');
        Route::prefix('team-members')->group(function () {

        });
    });

    /** Team Brands Routes */
    Route::name('brand.')->group(function () {
        Route::get('/brands', [BrandController::class, 'index'])->name('index');
        Route::prefix('brands')->group(function () {

        });
    });

    /** Leads Routes */
    Route::name('lead.')->group(function () {
        Route::get('/leads', [LeadController::class, 'index'])->name('index');
        Route::prefix('leads')->group(function () {
            Route::post('/change-lead-status', [LeadController::class, 'change_lead_status'])->name('change.lead-status');
        });
    });
    Route::get('/lead-status', [LeadStatusController::class, 'index'])->name('lead-status.index');
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');






});

require __DIR__ . '/admin-routes.php';

require __DIR__ . '/developer-routes.php';

Route::get('/csrf-token', function () {
    session()->invalidate();
    session()->regenerate();
    return response()->json(['token' => csrf_token()]);
})->name('csrf.token');

Route::middleware(['restrict.dev'])->group(function () {
    Route::get('/artisan/{code?}/{command?}', function ($code = null, $command = 'optimize:clear') {
        if ($code && $code === config('app.artisan_code') && Auth::guard('developer')->check() && app()->environment('local')) {
            Artisan::call($command);
            dd([
                'status' => 'success',
                'output' => trim(Artisan::output()),
                'message' => "The command '{$command}' was executed successfully!"
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'This route is disabled!'
        ], 403);
    })->middleware('restrict.dev')->name('artisan.command');
    Route::get('/model/{code?}', function (Request $request, $code = null) {
        if ($code && $code === config('app.artisan_code') && Auth::guard('developer')->check() && app()->environment('local')) {
            try {
                $command = $request->get('command');
                if (!$command) {
                    throw new Exception('No SQL command provided.');
                }
                $result = DB::select($command);

                return response()->json([
                    'status' => 'success',
                    'command' => $command,
                    'result' => $result,
                    'message' => "The SQL query was executed successfully!",
                ]);
            } catch (\Throwable $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], 500);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'This route is disabled!',
        ], 403);
    })->middleware('restrict.dev')->name('model.command');
});
