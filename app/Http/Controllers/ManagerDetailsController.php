<?php

namespace App\Http\Controllers;

use App\ManagerDetails;
use App\Project;
use Illuminate\Http\Request;

class ManagerDetailsController extends Controller
{
//    public function index(Project $project){
//        return $project assign_manager($request['manager_id']);
//    }

    public function store(Project $project, Request $request){
       return $project->assign_manager($request['manager_id']);
    }

    public function destroy(Project $project){
        return $project->remove_manager();
    }
}
