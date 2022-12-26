<?php

use Illuminate\Support\Facades\Route;
//use Modullo\ModulesLmsBaseAccounts\Http\Controllers\ModulesLmsBaseAccountsTenantController;

Route::prefix('api/v1')->namespace('Modullo\ModulesLmsLearningBase\Http\Controllers')->name('api.')->group(function (){
    Route::middleware('auth:sanctum')->group(function (){
        Route::prefix('learner')->group(function(){

            // Routes for Courses
            Route::group(['prefix' => 'courses'], function() {
                Route::get('', 'ModulesLmsLearningBaseController@allLearnerCourses');
//                Route::get('all', 'ModulesLmsLearningBaseController@allCourses')->name('learner-courses.all');
                Route::get('{id}', 'ModulesLmsLearningBaseController@showCourse');
//                Route::get('all/{id}', 'ModulesLmsLearningBaseController@allProgramCourses');
                Route::post('completeCourse/{id}', 'ModulesLmsLearningBaseController@completeLesson');
//                Route::get('fetchQuiz/{id}', 'ModulesLmsLearningBaseController@fetchLessonQuiz');
//                Route::post('submitQuiz/{quiz_id}/{lesson_id}', 'ModulesLmsLearningBaseController@submitQuiz');
//                Route::get('{id}/lesson/{slug}', 'ModulesLmsLearningBaseController@showLesson');
                Route::get('{id}/lesson/{slug}/complete', 'ModulesLmsLearningBaseController@completeLesson');
                Route::get('{id}/start-course', 'ModulesLmsLearningBaseController@startCourse');


//                Route::get('{id}/lesson/{lessonId}/launch-scheduler', 'ModulesLmsLearningBaseController@launchScheduler');
            });

            // Routes for Program
            Route::group(['prefix' => 'programs'], function() {
                Route::get('/', 'ModulesLmsLearningBaseController@allLearnerprograms');
//                Route::get('all', 'ModulesLmsLearningBaseController@allPrograms');
                Route::get('{id}', 'ModulesLmsLearningBaseController@showProgram');
                Route::get('{id}/enroll', 'ModulesLmsLearningBaseController@enrollToProgram');
            });

        });

        Route::prefix('tenant')->group(function(){
            Route::get('/settings/generate-user-token/{email}','SettingsController@generateUserToken')->name('generate-user-token');

            Route::group(['prefix' => 'learners'],function() {
                Route::get('{id}/program/{programId}/enroll', 'ModulesLmsLearningBaseTenantController@programEnroll');
                Route::get('{id}/program/{programId}/complete', 'ModulesLmsLearningBaseTenantController@programComplete');
                
                Route::get('{id}/course/{courseId}/start', 'ModulesLmsLearningBaseTenantController@courseStart');
                Route::get('{id}/course/{courseId}/complete', 'ModulesLmsLearningBaseTenantController@courseComplete');
                
                Route::get('{id}/lesson/{lessonId}/start', 'ModulesLmsLearningBaseTenantController@lessonStart');
                Route::get('{id}/lesson/{lessonId}/complete', 'ModulesLmsLearningBaseTenantController@lessonComplete');
            });

            Route::group(['prefix' => 'programs'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allPrograms')->name('all-programs');
                Route::put('edit/{id}', 'ModulesLmsLearningBaseTenantController@updateProgram')->name('update-programs');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitProgram');
//                Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@showProgram');
//                Route::get('edit/{id}', 'ModulesLmsLearningBaseTenantController@editProgram');
                Route::get('{id}/learners', 'ModulesLmsLearningBaseTenantController@allLearnerPrograms');
                
                Route::post('enroll', 'ModulesLmsLearningBaseTenantController@programEnroll');
                Route::post('complete', 'ModulesLmsLearningBaseTenantController@programComplete');
            });

            Route::group(['prefix' => 'courses'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allCourses');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitCourse');
                Route::get('show/{id}', 'ModulesLmsLearningBaseTenantController@show');
//                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editCourse');
                Route::put('{id}', 'ModulesLmsLearningBaseTenantController@updateCourse');
                Route::get('{id}/learners', 'ModulesLmsLearningBaseTenantController@allLearnerCourses');

                Route::post('start', 'ModulesLmsLearningBaseTenantController@courseStart');
                Route::post('complete', 'ModulesLmsLearningBaseTenantController@courseComplete');
            });

            Route::group(['prefix' => 'modules'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allModules');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitModule');
//                Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
//                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editModules');
                Route::put('{id}', 'ModulesLmsLearningBaseTenantController@updateModule');
                Route::get('all/{id}', 'ModulesLmsLearningBaseTenantController@filterModulesByCourse');
            });


            Route::group(['prefix' => 'grades'],function() {
//                Route::get('', 'ModulesLmsLearningBaseTenantController@allGrades');
//                Route::get('single', 'ModulesLmsLearningBaseTenantController@showGrade');
            });

            Route::group(['prefix' => 'lessons'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allLesson');
//                Route::get('create', 'ModulesLmsLearningBaseTenantController@createLesson');
                Route::post('create/{id}', 'ModulesLmsLearningBaseTenantController@submitLesson');
                Route::put('{id}', 'ModulesLmsLearningBaseTenantController@updateLesson');
//                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editLesson');
                Route::get('all/{id}', 'ModulesLmsLearningBaseTenantController@filterLessonsByModule');
            });

            Route::group(['prefix' => 'quiz'],function() {
                Route::get('', 'ModulesLmsLearningBaseTenantController@allQuiz');
//                Route::get('create', 'ModulesLmsLearningBaseTenantController@createQuiz');
                Route::post('create', 'ModulesLmsLearningBaseTenantController@submitQuiz');
//                Route::get('show', 'ModulesLmsLearningBaseTenantController@showCourse');
                Route::put('questions/{id}', 'ModulesLmsLearningBaseTenantController@updateQuestions');
                Route::post('questions/add/{id}', 'ModulesLmsLearningBaseTenantController@addQuestions');
                Route::delete('questions/{id}', 'ModulesLmsLearningBaseTenantController@destroyQuestions');
//                Route::get('{id}', 'ModulesLmsLearningBaseTenantController@editQuiz');
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
