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
        DB::table('projects')->insert([
            'name' => 'ProjectOne',
        ]);
        DB::table('projects')->insert([
            'name' => 'ProjectTwo',
        ]);
        DB::table('projects')->insert([
            'name' => 'ProjectThree',
        ]);
        DB::table('projects')->insert([
            'name' => 'ProjectFour',
        ]);
        DB::table('projects')->insert([
            'name' => 'ProjectFive',
        ]);

        $projects = DB::table('projects')->get();
        $projects->each(function($project){
            for($i=0; $i<20; $i++){
                DB::table('units')->insert([
                    'name' => 'apartment '.$project.id.'-'.$i,
                    'project_id' => $project.id,
                ]);
            }
        });
    }
}
