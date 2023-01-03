<?php

namespace Modullo\ModulesLmsLearningBase\Jobs;

use Hostville\Modullo\Sdk;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Modullo\ModulesLmsBaseAccounts\Services\ModulesLmsBaseAccountsTenantService;
use Modullo\ModulesLmsLearningBase\Http\Controllers\ModulesLmsLearningBaseTenantController;

class Complete3pCourseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $course;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 6;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
//    public $maxExceptions = 4;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 60;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($course)
    {
        $this->course = $course;
        $this->onConnection('database');
    }

    /**
     * The number of seconds after which the job's unique lock will be released.
     *
     * @var int
     */
//    public $uniqueFor = 300;

    /**
     * The unique ID of the job.
     *
     * @return string
     */
//    public function uniqueId()
//    {
//        return now()->getTimestampMs();
//    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Sdk $sdk)
    {
        $course = $this->course;
        $request = new \Illuminate\Http\Request($course);
        $complete = app(ModulesLmsLearningBaseTenantController::class)->courseComplete($request,$sdk);
    }
}
