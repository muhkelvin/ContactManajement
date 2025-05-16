<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactGroupController;
use App\Http\Controllers\ExportController;
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

// Redirect root to contacts list
Route::get('/', function () {
    return redirect()->route('contacts.index');
});

// Contact routes
Route::controller(ContactController::class)->group(function () {
    // List all contacts
    Route::get('/contacts', 'index')->name('contacts.index');

    // Show contact creation form
    Route::get('/contacts/create', 'create')->name('contacts.create');

    // Store new contact
    Route::post('/contacts', 'store')->name('contacts.store');

    // Show single contact
    Route::get('/contacts/{contact}', 'show')->name('contacts.show');

    // Show edit form
    Route::get('/contacts/{contact}/edit', 'edit')->name('contacts.edit');

    // Update contact
    Route::put('/contacts/{contact}', 'update')->name('contacts.update');

    // Delete contact
    Route::delete('/contacts/{contact}', 'destroy')->name('contacts.destroy');

    // Search contacts
    Route::get('/search', 'search')->name('contacts.search');
});

// Contact Group routes
Route::controller(ContactGroupController::class)->group(function () {
    // List all groups
    Route::get('/groups', 'index')->name('groups.index');

    // Show group creation form
    Route::get('/groups/create', 'create')->name('groups.create');

    // Store new group
    Route::post('/groups', 'store')->name('groups.store');

    // Show edit form
    Route::get('/groups/{group}/edit', 'edit')->name('groups.edit');

    // Update group
    Route::put('/groups/{group}', 'update')->name('groups.update');

    // Delete group
    Route::delete('/groups/{group}', 'destroy')->name('groups.destroy');

    // Filter contacts by group
    Route::get('/groups/{group}/contacts', 'showContacts')->name('groups.contacts');
});

// Export routes
Route::controller(ExportController::class)->group(function () {
    // Export all contacts to CSV
    Route::get('/export/contacts', 'exportContacts')->name('export.contacts');

    // Export contacts from specific group to CSV
    Route::get('/export/group/{group}', 'exportGroupContacts')->name('export.group');
});
