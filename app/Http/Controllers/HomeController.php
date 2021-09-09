<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = User::with('role')->get();
        $role = Roles::get();

        return view('home', compact('user', 'role'));
    }

    public function updateUserList()
    {
        $user = User::with('role')->get();
        return response()->json($user, 200);
    }

    public function updateRoleList()
    {
        $role = Roles::get();
        return response()->json($role, 200);
    }

    public function storeUser(UserRequest $request)
    {
        $user = User::updateOrCreate(['id' => $request->id],[
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return response()->json($user);
    }

    public function deleteUser(Request $request)
    {
        $deleted = User::whereId($request->id)->delete();
        return response()->json($deleted, 200);
    }

    public function storeRole(Request $request)
    {
        $user = Roles::updateOrCreate(['id' => $request->id],[
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json($user, 200);
    }

    public function deleteRole(Request $request)
    {
        $deleted = Roles::whereId($request->id)->delete();

        return response()->json($deleted, 200);
    }
}
