<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerRequest;
use App\Interfaces\ManagerInterface;
use App\Jobs\NewTenantMailJob;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ManagersController extends Controller
{

    protected $managerRepo;

    public function __construct(ManagerInterface $managerRepo)
    {
        $this->managerRepo = $managerRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = $this->managerRepo->getAllManagers();

        return response()->json($managers, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerRequest $managerRequest)
    {
        $manager = $this->managerRepo->addManager($managerRequest);

        dispatch(new NewTenantMailJob($manager));

        Artisan::call('queue:work --once');

        return response()->json($manager, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manager = $this->managerRepo->getManagerById($id);

        return response()->json($manager, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, ManagerRequest $managerRequest)
    {
        $manager = $this->managerRepo->updateManager($user, $managerRequest);

        return response()->json($manager, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->managerRepo->deleteManager($user);

        return response()->json(['message' => "success"], 200);


    }
}
