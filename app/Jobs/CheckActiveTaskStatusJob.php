<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\TaskStatus;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckActiveTaskStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }
    
    public function handle()
    {
        $now = Carbon::now();

        $tasks = Task::whereHas('status', function ($query) {
                return $query->where('slug', 'active');
            })
            ->where('end_datetime', '>=', $now)
            ->get();

        foreach ($tasks as $task) {
            $task->task_status_id = TaskStatus::getIdBySlug('expired');
            $task->save();
        }
    }
}