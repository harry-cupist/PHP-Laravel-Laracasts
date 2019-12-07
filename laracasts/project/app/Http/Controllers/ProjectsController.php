<?php

namespace App\Http\Controllers;

use App\Project;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));

    }
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        $attribute = request()->validate([
//            'title' => 'required',
            'title' => ['required', 'min:3'], // min string length: 3
            'description' => ['required','min:3'],
//            'password' => ['required', 'confirmed'],
        ]);

        // validated attribute(array) is returned. => request(['title', 'description']) is no needed.
        // change to $validated

        Project::create($attribute);

        return redirect('/projects');
    }
    public function edit(Project $project)
    {

        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $project->update(request(['title', 'description']));

        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/projects');
    }

}
