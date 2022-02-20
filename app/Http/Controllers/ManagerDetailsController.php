<?php

namespace App\Http\Controllers;

use App\ManagerDetails;
use Illuminate\Http\Request;

class ManagerDetailsController extends Controller
{

    public function store(Project $project, Request $request){
       return $project->assign_manager($request['user_id']);
    }

    public function destroy(Project $project){
        return $project->remove_manager();
    }
}
