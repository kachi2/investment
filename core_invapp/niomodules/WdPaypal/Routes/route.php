<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.settings.gateway.withdraw.')->middleware(['admin'])->prefix('admin/settings/gateway/withdraw-method')->group(function () {
    Route::get('/crypto', 'WdPaypalSettingsController@settingsView')->name('wd-crypto');
    Route::post('/crypto', 'WdPaypalSettingsController@savePaypalSettings')->name('wd-crypto.save');
});

Route::name('user.withdraw.account.')->middleware(['user'])->prefix('withdraw/account')->group(function () {
    Route::get('/crypto', 'UserAccountController@form')->name('wd-crypto.form');
    Route::post('/crypto', 'UserAccountController@save')->name('wd-crypto.save');
    Route::get('/crypto/{id}', 'UserAccountController@edit')->name('wd-crypto.edit');
    Route::post('/crypto/{id}/update', 'UserAccountController@update')->name('wd-crypto.update');
    Route::post('/crypto/{id}/delete', 'UserAccountController@delete')->name('wd-crypto.delete');
});

