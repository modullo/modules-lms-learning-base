<?php

use Illuminate\Support\Facades\Route;
use Lms\ModulesLmsLearningBase\Http\Controllers\ModulesLmsLearningBaseController;

Route::group(['namespace' => 'Lms\ModulesLmsLearningBase\Http\Controllers','middleware' => 'web'],function() {

    Route::group(['prefix' => 'learner'],function(){
        Route::get('dashboard', 'ModulesLmsLearningBaseController@index');

//        Courses
        Route::group(['prefix' => 'courses'],function() {
            Route::get('', 'ModulesLmsLearningBaseController@courses');
            Route::get('{id}', 'ModulesLmsLearningBaseController@showCourse');
        });

        //        Programs
        Route::group(['prefix' => 'programs'],function() {
            Route::get('/', 'ModulesLmsLearningBaseController@programs');
            Route::get('{id}', 'ModulesLmsLearningBaseController@showCourse');
        });
    });

    Route::group(['prefix' => 'tenant'],function(){

        Route::group(['prefix' => 'courses'],function() {
            Route::get('', 'ModulesLmsLearningBaseTenantController@index');
            Route::get('create', 'ModulesLmsLearningBaseTenantController@create');
            Route::get('show', 'ModulesLmsLearningBaseTenantController@show');
            Route::get('edit', 'ModulesLmsLearningBaseTenantController@show');
        });

        Route::group(['prefix' => 'programs'],function() {
            Route::get('', 'ModulesLmsLearningBaseTenantController@allPrograms');
            Route::get('create', 'ModulesLmsLearningBaseTenantController@createProgram');
            Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
            Route::get('edit', 'ModulesLmsLearningBaseTenantController@editProgram');
        });

        Route::group(['prefix' => 'modules'],function() {
            Route::get('', 'ModulesLmsLearningBaseTenantController@allModules');
            Route::get('create', 'ModulesLmsLearningBaseTenantController@createModules');
            Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
            Route::get('edit', 'ModulesLmsLearningBaseTenantController@editModules');
        });

        Route::group(['prefix' => 'lessons'],function() {
            Route::get('', 'ModulesLmsLearningBaseTenantController@allLesson');
            Route::get('create', 'ModulesLmsLearningBaseTenantController@createLesson');
            Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
            Route::get('edit', 'ModulesLmsLearningBaseTenantController@editLesson');
        });

        Route::group(['prefix' => 'quiz'],function() {
            Route::get('', 'ModulesLmsLearningBaseTenantController@allQuiz');
            Route::get('create', 'ModulesLmsLearningBaseTenantController@createQuiz');
            Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
            Route::get('edit', 'ModulesLmsLearningBaseTenantController@editQuiz');
        });

        Route::group(['prefix' => 'assets'],function() {
            Route::get('', 'ModulesLmsLearningBaseTenantController@allAsset');
            Route::get('create', 'ModulesLmsLearningBaseTenantController@createAsset');
            Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
            Route::get('edit', 'ModulesLmsLearningBaseTenantController@editAsset');
        });

    });
});
