<?php
namespace App\Filters;

use App\User;

// builds an eloquent query to pass to the
// $threads->filter( ** $builder_goes here ** )   ->get();

class IssuesFilters extends Filters {

    //filters we can respond to
    protected $filters = ['by'];

    protected function by($username){
//        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }


}
