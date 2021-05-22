<?php

namespace Lms\ModulesLmsLearningBase\Http\Controllers;

use App\Http\Controllers\Controller;

class ModulesLmsLearningBaseController extends Controller
{
    public function index()
    {
        return view('modules-lms-learning-base::welcome');
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
}
