<?php

namespace Tests\Setup;

use App\Project;
use App\Task;
use App\User;

class ProjectFactory
{
    /**
     * Hold the number of tasks for a project.
     */
    protected $tasksCount = 0;

    /**
     * The user associated for a project.
     */
    protected $user;

    /**
     * Number of tasks to go with a project.
     */
    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    /**
     * Set the user.
     *
     * @param User $user
     */
    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Create a project and related task associated with user.
     */
    public function create()
    {
        $project = factory(Project::class)->create([
            'owner_id' => $this->user ?? factory(User::class),
        ]);

        factory(Task::class, $this->tasksCount)->create([
            'project_id' => $project->id,
        ]);

        return $project;
    }
}
