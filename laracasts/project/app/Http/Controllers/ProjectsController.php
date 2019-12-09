<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // auth()->id(); // 4
        // auth()->user(); // user
        // auth()->check(); // boolean
        // auth()->guest(); // guest user

        // select * from projects where owner_id = 4
        $projects = Project::where('owner_id', auth()->id())->get();

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
            'title' => ['required', 'min:3'],
            'description' => ['required','min:3'],
        ]);

        $attribute['owner_id'] = auth()->id();

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
