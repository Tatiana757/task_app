<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\CheckPendingTaskStatusJob;
use App\Jobs\CheckActiveTaskStatusJob;

class TaskController extends Controller
{
    public function createJobs()
    {
        CheckPendingTaskStatusJob::dispatch()->onConnection('redis')->onQueue('default'); 
        CheckActiveTaskStatusJob::dispatch()->onConnection('redis')->onQueue('default'); 

        return 1;
    }
}