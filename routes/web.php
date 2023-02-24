<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventFormGroupController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\FormFieldDataController;
use App\Http\Controllers\FormGroupController;
use App\Http\Controllers\FormGroupFormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Event;
use App\Models\EventFormGroup;
use App\Models\Subscriber;
use App\Models\FormField;
use App\Models\FormGroup;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use ProtoneMedia\Splade\Facades\Toast;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function (Request $request) {
        return view('welcome');
    })->name('welcome');
    Route::resource('events', EventController::class);
    Route::resource('groups', FormGroupController::class);
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');
        Route::name('profile.')->prefix('profile')->group(function () {
            Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('update', [ProfileController::class, 'update'])->name('update');
            Route::delete('delete', [ProfileController::class, 'destroy'])->name('destroy');
        });
        Route::resource('events.groups', EventFormGroupController::class);
        Route::resource('groups.forms', FormGroupFormController::class)->except(['index']);
        Route::resource('forms', FormController::class);
        Route::resource('forms.fields', FormFieldController::class);
        Route::resource('forms.fields.data', FormFieldDataController::class);
        Route::resource('subscriptions', SubscriptionController::class)->only(['destroy', 'store', 'index']);
        Route::resource('subscriptions.forms', FormGroupFormController::class)->except(['create']);
        Route::get('/fields/{field}/data', function (FormField $field) {
            Gate::allows('if_admin');
            return response()->json(
                $field->formFieldData()->get()->toArray()
            );
        });
    });

    require __DIR__ . '/auth.php';
});
