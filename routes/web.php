<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('parcels', 'Admin\ParcelsController');
    Route::post('parcels_mass_destroy', ['uses' => 'Admin\ParcelsController@massDestroy', 'as' => 'parcels.mass_destroy']);
    Route::post('parcels_restore/{id}', ['uses' => 'Admin\ParcelsController@restore', 'as' => 'parcels.restore']);
    Route::delete('parcels_perma_del/{id}', ['uses' => 'Admin\ParcelsController@perma_del', 'as' => 'parcels.perma_del']);
    Route::resource('parcels_histories', 'Admin\ParcelsHistoriesController');
    Route::post('parcels_histories_mass_destroy', ['uses' => 'Admin\ParcelsHistoriesController@massDestroy', 'as' => 'parcels_histories.mass_destroy']);
    Route::post('parcels_histories_restore/{id}', ['uses' => 'Admin\ParcelsHistoriesController@restore', 'as' => 'parcels_histories.restore']);
    Route::delete('parcels_histories_perma_del/{id}', ['uses' => 'Admin\ParcelsHistoriesController@perma_del', 'as' => 'parcels_histories.perma_del']);

    Route::resource('trucks', 'Admin\TrucksController');
    Route::post('trucks_mass_destroy', ['uses' => 'Admin\TrucksController@massDestroy', 'as' => 'trucks.mass_destroy']);
    Route::post('trucks_restore/{id}', ['uses' => 'Admin\TrucksController@restore', 'as' => 'trucks.restore']);
    Route::delete('trucks_perma_del/{id}', ['uses' => 'Admin\TrucksController@perma_del', 'as' => 'trucks.perma_del']);

    Route::resource('budgets', 'Admin\BudgetController');
    Route::post('budgets_mass_destroy', ['uses' => 'Admin\BudgetController@massDestroy', 'as' => 'budgets.mass_destroy']);

    Route::get('notify/index', 'NotificationController@index');
});
