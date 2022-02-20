
<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->numerify('##########'),
        'national_id' => $faker->numerify('##########'),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Issue::class, function($faker){
    return [
        'tenant_id' => function () {
            return factory('App\User')->create()->id;
        },
        'manager_id' => function () {
            return factory('App\User')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph(2),
        'status' => "unanswered",
        'rating' => rand(0,5)
    ];
});

$factory->define(App\Reply::class, function($faker){
    return [
        'issue_id' => function () {
            return factory('App\Issue')->create()->id;
        },
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'body' => $faker->paragraph(2)
    ];
});

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Unit::class, function (Faker $faker) {
    return [
        'name' => 'apartment '.$faker->bothify('##??'),
        'project_id' => function () {
            return factory('App\Project')->create()->id;
        },
    ];
});

$factory->define(App\TenantDetails::class, function (Faker $faker) {
    return [
        'occupation' => $faker->word,
        'unit_id' => function () {
            return factory('App\Unit')->create()->id;
        },
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
    ];
});

$factory->define(App\Roles::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});


//$tenants_with_issues = factory('App\User', 20)->create();
//$admins = factory('App\User', 10)->create();
//$tenants_with_issues->each(function($tenant){ factory('App\Issue', 2)->create(['tenant_id' => $tenant->id, 'manager_id' => rand( 31,40 ), 'role_id' => 1]); });
//$issues = DB::table('issues')->get();
//$issues->each(function($issue){ factory('App\Reply', 3)->create(['issue_id' => $issue->id, 'user_id'=> rand(1,40)]); });
//$tenants_without_issues = factory('App\User', 10)->create();
//$projects = factory('App\Project', 5)->create();
//$projects->each(function($project){ factory('App\Unit', 20)->create(['project_id' => $project->id]); });
//$units = DB::table('units')->get();
//for ($x = 0; $x <= 20; $x++) { factory('App\TenantDetails')->create(['unit_id' => rand(1, 100), 'user_id'=> $x]);}
// factory('App\Roles')->create(['id'=> 1, 'name' => 'Tenant']);
// factory('App\Roles')->create(['id' => 2, 'name' => 'Manager']);
// factory('App\Roles')->create(['id' => 3, 'name' => 'Supervisor']);

//php artisan seed
