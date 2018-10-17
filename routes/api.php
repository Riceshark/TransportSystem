<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('parcels', 'ParcelsController', ['except' => ['create', 'edit']]);

        Route::resource('parcels_histories', 'ParcelsHistoriesController', ['except' => ['create', 'edit']]);

        Route::resource('trucks', 'TrucksController', ['except' => ['create', 'edit']]);

});
