<?php

use Illuminate\Support\Facades\Route;
use Modullo\ModulesLmsLearningBase\Http\Controllers\ModulesLmsLearningBaseController;

Route::group(['namespace' => 'Modullo\ModulesLmsLearningBase\Http\Controllers','middleware' => ['web']],function() {


    Route::middleware('auth')->group(function () {
        Route::group(['prefix' => 'learner'],function(){
            

            Route::get('/test','ModulesLmsLearningBaseController@test')->name('learner-test');
            Route::get('/dashboard','ModulesLmsLearningBaseController@index')->name('learner-dashboard');
            Route::get('/profile-settings','ModulesLmsLearningBaseController@settings')->name('profile-settings');

//        Courses
            Route::group(['prefix' => 'courses'],function() {
                Route::get('', 'ModulesLmsLearningBaseController@courses')->name('learner-courses');
                Route::get('{id}', 'ModulesLmsLearningBaseController@showCourse');
            });

            //        Program
            Route::group(['prefix' => 'programs'],function() {
                Route::get('/', 'ModulesLmsLearningBaseController@programs');
                Route::get('{id}', 'ModulesLmsLearningBaseController@showProgram');
            });
        });

        Route::group(['prefix' => 'tenant'],function(){

            Route::get('dashboard','ModulesLmsLearningBaseTenantController@index')->name('tenant-dashboard');
            Route::get('/profile-settings','ModulesLmsLearningBaseTenantController@settings')->name('profile-settings');
            Route::get('/learner-management','ModulesLmsLearningBaseTenantController@management')->name('tenant-learner-management');


            Route::group(['prefix' => 'courses'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allCourses');
                Route::get('create', 'ModulesLmsLearningBaseTenantController@create');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitCourse');
                Route::get('show/{id}', 'ModulesLmsLearningBaseTenantController@show');
                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editCourse');
                Route::put('{id}', 'ModulesLmsLearningBaseTenantController@updateCourse');  
            });




            Route::group(['prefix' => 'grades'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allGrades');
                Route::get('single', 'ModulesLmsLearningBaseTenantController@showGrade');
            });

            Route::group(['prefix' => 'programs'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allPrograms')->name('all-programs');
                Route::put('edit/{id}', 'ModulesLmsLearningBaseTenantController@updateProgram')->name('update-programs');
                Route::get('create', 'ModulesLmsLearningBaseTenantController@createProgram');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitProgram');
                Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
                Route::get('edit/{id}', 'ModulesLmsLearningBaseTenantController@editProgram');
            });

            Route::group(['prefix' => 'modules'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allModules');
                Route::get('create', 'ModulesLmsLearningBaseTenantController@createModules');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitModule');
                Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editModules');
                Route::put('{id}', 'ModulesLmsLearningBaseTenantController@updateModule'); 
                Route::get('all/{id}', 'ModulesLmsLearningBaseTenantController@filterModulesByCourse'); 
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
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitQuiz');
                Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
                Route::get('edit', 'ModulesLmsLearningBaseTenantController@editQuiz');
            });

            Route::group(['prefix' => 'assets'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allAsset');
                Route::post('custom/upload', 'ModulesLmsLearningBaseTenantController@uploadAsset');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitAsset');
                Route::get('create', 'ModulesLmsLearningBaseTenantController@createAsset');
                Route::put('{id}', 'ModulesLmsLearningBaseTenantController@updateAsset');
                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editAsset');
            });

        });
    });

});
