<?php

namespace App\Http\Controllers;

use App\Project;

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

    public function store()
    {
        // Validate
        $attributes = request()->validate(['title' => 'required', 'description' => 'required']);

        // Persists
        Project::create($attributes);

        // Redirect
        return redirect('/projects');
    }
}
