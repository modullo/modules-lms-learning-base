<?php

namespace Lms\ModulesLmsLearningBase\Http\Controllers;

use App\Http\Controllers\Controller;

class ModulesLmsLearningBaseTenantController extends Controller
{
    public function create()
    {
        return view('modules-lms-learning-base::tenants.course.create');
    }

    public function show()
    {
        return view('modules-lms-learning-base::tenants.course.edit');
    }

    public function index()
    {
        return view('modules-lms-learning-base::tenants.course.index');
    }

//    Lessons
    public function createLesson()
    {
        return view('modules-lms-learning-base::tenants.lessons.create');
    }

    public function editLesson()
    {
        return view('modules-lms-learning-base::tenants.lessons.edit');
    }

    public function allLesson()
    {
        return view('modules-lms-learning-base::tenants.lessons.index');
    }


    //    Modules
    public function createModules()
    {
        return view('modules-lms-learning-base::tenants.modules.create');
    }

    public function editModules()
    {
        return view('modules-lms-learning-base::tenants.modules.edit');
    }

    public function allModules()
    {
        return view('modules-lms-learning-base::tenants.modules.index');
    }

    //    Programs
    public function createProgram()
    {
        return view('modules-lms-learning-base::tenants.programs.create');
    }

    public function editProgram()
    {
        return view('modules-lms-learning-base::tenants.programs.edit');
    }

    public function allPrograms()
    {
        return view('modules-lms-learning-base::tenants.programs.index');
    }


    //    Asset
    public function createAsset()
    {
        return view('modules-lms-learning-base::tenants.resources.asset.create');
    }

    public function editAsset()
    {
        return view('modules-lms-learning-base::tenants.resources.asset.edit');
    }

    public function allAsset()
    {
        return view('modules-lms-learning-base::tenants.resources.asset.index');
    }


    //    Quiz
    public function createQuiz()
    {
        return view('modules-lms-learning-base::tenants.resources.quiz.create');
    }

    public function editQuiz()
    {
        return view('modules-lms-learning-base::tenants.resources.quiz.edit');
    }

    public function allQuiz()
    {
        return view('modules-lms-learning-base::tenants.resources.quiz.index');
    }
}
