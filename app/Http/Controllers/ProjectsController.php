<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
    /**
     * Projects index.
     */
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the project.
     */
    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    /**
     * Create the project.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Persist a new project.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        // Persists
        $project = auth()->user()->projects()->create($this->validateRequest());

        // Redirect
        return redirect($project->path());
    }

    /**
     * Update the project.
     *
     * @param Project $project
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Project $project)
    {
        // Authorize
        $this->authorize('update', $project);

        // Update
        $project->update($this->validateRequest());

        return redirect($project->path());
    }

    /**
     * Edit the project.
     *
     * @param Project $project
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Validate the request attributes.
     *
     * @return array
     */
    public function validateRequest()
    {
        return request()->validate([
            'title'       => 'required',
            'description' => 'required',
            'notes'       => 'min:3',
        ]);
    }
}
