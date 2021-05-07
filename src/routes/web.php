<?php

use Illuminate\Support\Facades\Route;
use Lms\ModulesLmsLearningBase\Http\Controllers\ModulesLmsLearningBaseController;

Route::group(['namespace' => 'Lms\ModulesLmsLearningBase\Http\Controllers','middleware' => 'web'],function() {

    Route::group(['prefix' => 'learner'],function(){
        Route::get('dashboard', 'ModulesLmsLearningBaseController@index');
    });
});