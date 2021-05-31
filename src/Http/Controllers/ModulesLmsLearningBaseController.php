<?php

namespace Modullo\ModulesLmsLearningBase\Http\Controllers;

use App\Http\Controllers\Controller;

class ModulesLmsLearningBaseController extends Controller
{
    public function index()
    {
        return view('modules-lms-learning-base::learners.base.dashboard');
    }

    public function settings()
    {
        return view('modules-lms-learning-base::learners.base.settings');
    }


    public function courses()
    {
        return view('modules-lms-learning-base::learners.courses.index');
    }

    public function showCourse()
    {
        return view('modules-lms-learning-base::learners.courses.show');
    }

    public function programs()
    {
        return view('modules-lms-learning-base::learners.programs.index');
    }

    public function showProgram()
    {
        return view('modules-lms-learning-base::learners.programs.show');
    }
}
