<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Mail\NewTenantMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    protected $userRepo;

    public function __construct(UserInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $users = User::latest()->filter($filters);
//
//        $users = $users->get();

//        $users = User::latest()->get();

        $users = $this->userRepo->getAllUsers();
        return response()->json($users, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }


    public function store(UserRequest $request)
    {

//        $user = User::create([
//            'tenant_id' => auth()->id(),
//            'title' => $request['title'],
//            'body' => $request['body'],
//            'status' => "unanswered",
//        ]);

        if($request->role_id == 1 ){

            $user = $this->userRepo->addTenant($request);

        } else if ($request->role_id == 2) {

            $user = $this->userRepo->addManager($request);

        } else {
            return response()->json([], 500);
        }

        return response()->json($user, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
//    public function show(User $user)
    public function show($id)
    {
//        $user = User::with('replies')->find($id);

        $user = $this->userRepo->getUserById($id);
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UserRequest $request)
    {

        if($request->role_id == 1 ){

            $user = $this->userRepo->updateTenant($user, $request);
            return response()->json($user, 200);

        } else if ($request->role_id == 2) {

            $user = $this->userRepo->updateManager($user, $request);
            return response()->json($user, 200);

        } else {
            return response()->json([], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
//    public function destroy(User $user)
    public function destroy(User $user)
    {
//        $this->authorize('update', $user);
//        $user = User::find($id);
//
//        $user->delete();

        $this->userRepo->deleteUser($user);

        return response()->json(['message' => "success"], 200);

    }
}
