<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function getTasks(Request $request)
    {
        try{
            $tasks = Task::orderBy('id', 'DESC')->paginate(20);
            
            return (new TaskCollection($tasks))->response()->setStatusCode(200);
        }catch(\Exception $error){
            Log::channel("task")->error('error getTasks()');
            Log::channel("task")->error($error->getMessage(), [
                'file' => $error->getFile(),
                'line' => $error->getLine(),         
            ]);
            return response()->json(null, 500);
        }
    }

    public function getTaskById(Request $request, Task $task)
    {
        try{

            return (new TaskResource($task))->response()->setStatusCode(200);
        }catch(\Exception $error){
            Log::channel("task")->error('error getTaskById()');
            Log::channel("task")->error($error->getMessage(), [
                'file' => $error->getFile(),
                'line' => $error->getLine(),         
            ]);
            return response()->json(null, 500);
        }
    }
}
