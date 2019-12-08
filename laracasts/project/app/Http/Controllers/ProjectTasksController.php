<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {

//        $project->tasks()->create(request);


        $attributes = request()->validate(['description' => 'required']);
        $project->AddTask($attributes);

        return back();
    }

    public function update(Task $task)
    {
        // option 1
        if (request()->has('completed')) {
            $task->complete();
        } else {
            $task->incomplete();
        }

        // option 2
        request()->has('completed') ? $task->complete() : $task->incomplete();

        // option 3
        $method = request()->has('completed') ? 'complete' : 'incomplete';
        $task->$method();


//        $task->complete(request()->has('completed'));

        return back();
    }
}
