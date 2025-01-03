<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserSharedResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Initialize the PermissionController with middleware that sets the authenticated user.
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('view', $this->user);
        return Inertia::render('Admin/Users/Index', [
            'users' => UserSharedResource::collection(User::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', $this->user);
        return Inertia::render('Admin/Users/Create', [
            'roles' => RoleResource::collection(Role::all()),
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', $this->user);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles($request->input('roles.*.name'));
        $user->syncPermissions($request->input('permissions.*.name'));
        return to_route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('update', $this->user);
        $user->load(['roles', 'permissions']);
        return Inertia::render('Admin/Users/Edit', [
            'user' => new UserResource($user),
            'roles' => RoleResource::collection(Role::all()),
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('update', $this->user);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|' . Rule::unique('users', 'email')->ignore($user),
            'roles' => ['sometimes', 'array'],
            'permissions' => ['sometimes', 'array']
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->syncRoles($request->input('roles.*.name'));
        $user->syncPermissions($request->input('permissions.*.name'));

        return to_route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete', $this->user);
        $user->delete();
        return to_route('admin.users.index');
    }
}
