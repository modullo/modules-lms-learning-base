<?php

use Illuminate\Support\Facades\Route;
use Modullo\ModulesLmsLearningBase\Http\Controllers\ModulesLmsLearningBaseController;

Route::group(['namespace' => 'Modullo\ModulesLmsLearningBase\Http\Controllers','middleware' => ['web']],function() {


    Route::middleware('auth')->group(function () {


        // Routes for LEARNERS
        Route::group(['prefix' => 'learner'], function(){

            Route::get('/dashboard','ModulesLmsLearningBaseController@index')->name('learner-dashboard');
            Route::get('/profile-settings','Learner\SettingsController@index')->name('profile-learner-settings');
            Route::put('/profile-settingss/{id}','Learner\SettingsController@update')->name('update-profile-learner-settings');


            // Routes for Courses
            Route::group(['prefix' => 'courses'], function() {
                Route::get('', 'ModulesLmsLearningBaseController@courses')->name('learner-courses');
                Route::get('all', 'ModulesLmsLearningBaseController@allCourses')->name('learner-courses.all');
                Route::get('{id}', 'ModulesLmsLearningBaseController@showCourse');
                Route::get('all/{id}', 'ModulesLmsLearningBaseController@allProgramCourses');
                Route::post('completeCourse/{id}', 'ModulesLmsLearningBaseController@completeLesson');
                Route::get('fetchQuiz/{id}', 'ModulesLmsLearningBaseController@fetchLessonQuiz');
                Route::post('submitQuiz/{quiz_id}/{lesson_id}', 'ModulesLmsLearningBaseController@submitQuiz');
                Route::get('{id}/lesson/{slug}', 'ModulesLmsLearningBaseController@showLesson');
                Route::get('{id}/lesson/{slug}/complete', 'ModulesLmsLearningBaseController@completeLesson');
                Route::get('{id}/start-course', 'ModulesLmsLearningBaseController@startCourse');


                Route::get('{id}/lesson/{lessonId}/launch-scheduler', 'ModulesLmsLearningBaseController@launchScheduler');
            });

            // Routes for Program
            Route::group(['prefix' => 'programs'], function() {
                Route::get('/', 'ModulesLmsLearningBaseController@programs')->name('learner-programs');
                Route::get('all', 'ModulesLmsLearningBaseController@allPrograms')->name('all-programs');
                Route::get('{id}', 'ModulesLmsLearningBaseController@showProgram');
                Route::get('{id}/enroll', 'ModulesLmsLearningBaseController@enrollToProgram');
            });

        });

        // Routes for TENANT (ADMINS)
        Route::group(['prefix' => 'tenant'],function() {

            Route::get('dashboard','ModulesLmsLearningBaseTenantController@index')->name('tenant-dashboard');
            Route::get('/profile-settings','SettingsController@index')->name('profile-settings');
            Route::put('/profile-settings/{id}','SettingsController@update')->name('update-profile-settings');
            Route::get('/profile-settings/generate-token','SettingsController@generateToken')->name('generate-token');
            Route::get('/learner-management','ModulesLmsLearningBaseTenantController@management')->name('tenant-learner-management');

            Route::group(['prefix' => 'learners'],function() {
                Route::get('{learner}/programs', 'ModulesLmsLearningBaseTenantController@learnerPrograms');
                Route::get('{learner}/courses', 'ModulesLmsLearningBaseTenantController@learnerCourses');
            });

            Route::group(['prefix' => 'courses'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allCourses');
                Route::get('create', 'ModulesLmsLearningBaseTenantController@create');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitCourse');
                Route::get('show/{id}', 'ModulesLmsLearningBaseTenantController@show');
                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editCourse');
                Route::put('{id}', 'ModulesLmsLearningBaseTenantController@updateCourse');
                Route::get('{id}/learners', 'ModulesLmsLearningBaseTenantController@allLearnerCourses');
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
                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@showProgram');
                Route::get('edit/{id}', 'ModulesLmsLearningBaseTenantController@editProgram');
                Route::get('{id}/learners', 'ModulesLmsLearningBaseTenantController@allLearnerPrograms');
                Route::get('{id}/learners/{learner}', 'ModulesLmsLearningBaseTenantController@learnerPrograms');
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
                Route::post('create/{id}', 'ModulesLmsLearningBaseTenantController@submitLesson');
                Route::put('{id}', 'ModulesLmsLearningBaseTenantController@updateLesson');
                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editLesson');
                Route::get('all/{id}', 'ModulesLmsLearningBaseTenantController@filterLessonsByModule');
            });

            Route::group(['prefix' => 'quiz'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allQuiz');
                Route::get('create', 'ModulesLmsLearningBaseTenantController@createQuiz');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitQuiz');
                Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
                Route::put('questions/{id}', 'ModulesLmsLearningBaseTenantController@updateQuestions');
                Route::post('questions/add/{id}', 'ModulesLmsLearningBaseTenantController@addQuestions');
                Route::delete('questions/{id}', 'ModulesLmsLearningBaseTenantController@destroyQuestions');
                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editQuiz');
                Route::put('{id}', 'ModulesLmsLearningBaseTenantController@updateQuiz');
            });

            Route::group(['prefix' => 'assets'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allAsset');
                Route::post('custom/upload', 'ModulesLmsLearningBaseTenantController@uploadAsset');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitAsset');
                Route::get('create', 'ModulesLmsLearningBaseTenantController@createAsset');
                Route::put('{id}', 'ModulesLmsLearningBaseTenantController@updateAsset');
                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editAsset');
            });

            Route::group(['prefix' => 'schedule'],function() {
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitSchedule');
            });

        });
    });

});
