<?php

namespace App\Interfaces;

interface ProjectInterface
{

    public function getAllProjects();

    public function getProjectById($id);

//    public function addProject(ProjectRequest $request);
//
//    public function updateProject(User $user, UpdateProjectRequest $request);
//
//    public function deleteProject(User $user);
}
