<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy("id","ASC")->paginate(20);

        return view("admin.task.index",[
            "tasks" => $tasks,
        ]);
    }

    public function create()
    {
        $taskStatuses = TaskStatus::get();

        return view("admin.task.create",[
            "taskStatuses" => $taskStatuses,
        ]);
    }

    public function store(TaskCreateRequest $request)
    {
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->start_datetime = $request->start_datetime;
        $task->end_datetime = $request->end_datetime;
        $task->task_status_id = TaskStatus::getIdBySlug('pending');
        $task->save();

        return redirect(route('admin.tasks.index'));
    }

    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::get();

        return view("admin.task.create",[
            "task" => $task,
            "taskStatuses" => $taskStatuses,
        ]);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->title = $request->title;
        $task->description = $request->description;
        $task->task_status_id = $request->status_id;
        $task->save();

        return redirect(route('admin.tasks.index'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        
        return redirect(route("admin.tasks.index"));
    }
}