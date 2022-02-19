<?php

namespace App\Repositories;

use App\Interfaces\ProjectInterface;

use App\User;
use Illuminate\Support\Facades\Hash;

class ProjectRepository implements ProjectInterface
{

    public function getAllProjects()
    {
        return Project::latest()->get();
    }

    public function getProjectById($id)
    {
        return Project::find($id);
    }


//    public function addProject(ProjectRequest $request){}
//
//    public function updateProject(User $user, UpdateProjectRequest $request){}
//
//    public function deleteProject(User $user){}
}
