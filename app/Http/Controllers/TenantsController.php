<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Interfaces\TenantInterface;
use App\User;
use Illuminate\Http\Request;

class TenantsController extends Controller
{

    protected $tenantRepo;

    public function __construct(TenantInterface $tenantRepo)
    {
        $this->tenantRepo = $tenantRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->tenantRepo->getAllTenants();

        return response()->json($tenants, 200);
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
    public function store(TenantRequest $tenantRequest)
    {
        $tenant = $this->tenantRepo->addTenant($tenantRequest);

        return response()->json($tenant, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tenant = $this->tenantRepo->getTenantById($id);

        return response()->json($tenant, 200);
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
    public function update(User $user, UpdateTenantRequest $tenantRequest)
    {
        $tenant = $this->tenantRepo->updateTenant($user, $tenantRequest);

        return response()->json($tenant, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->tenantRepo->deleteTenant($user);

        return response()->json(['message' => "success"], 200);


    }
}
