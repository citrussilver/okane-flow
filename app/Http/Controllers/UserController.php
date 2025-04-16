<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(auth());
        $users = auth()->user()->get();
        return Inertia::render('User/Index', [
            'users' => UserResource::collection($users)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Create', [
            // get roles for dropdown
            'roles' => RoleResource::collection(Role::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'nominated_password' => Hash::make($request->password),
            'confirmed_password' => Hash::make($request->password),
            // 'role_id' => 2
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // $user = auth()->user()->getById($id);
        return inertia('User/Show', [
            'user' => UserResource::make($user)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('User/Edit', [
            // get roles for dropdown
            'roles' => RoleResource::collection(Role::all()),
            'user' => UserResource::make($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        // utilize UserRequest to make validated() method work
        $user->update($request->validated());

        // long version
        // $user->update([
        //     'full_name' => $request->get('full_name'),
        //     'email' => $request->get('email'),
        //     'role_id' => $request->get('role_id')
        // ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
