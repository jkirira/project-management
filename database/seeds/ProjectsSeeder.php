<?php

use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = factory('App\Project', 5)->create();
        $projects->each(function($project){ factory('App\Unit', 20)->create(['project_id' => $project->id]); });
    }
}
