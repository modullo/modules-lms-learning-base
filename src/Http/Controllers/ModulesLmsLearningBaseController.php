<?php

namespace Lms\ModulesLmsLearningBase\Http\Controllers;

use App\Http\Controllers\Controller;

class ModulesLmsLearningBaseController extends Controller
{
    public function index()
    {
        return view('modules-lms-learning-base::welcome');
    }
}