<?php

namespace App\Http\Controllers;

use App\Models\Faculity;
use App\Models\Slide;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $users = User::with('university')->withCount('permissions')->get();
        return Response()->view('s_library.admin.users.index',['users' => $users]);
        
    }

    public function editUserPermissions(Request $request, User $user)
    {
        $permissions = Permission::where('guard_name', '=', 'user')->get();
        $userPermissions = $user->permissions;
        foreach ($permissions as $permission) {
            $permission->setAttribute('assigned', false);
            foreach ($userPermissions as $userPermission) {
                if ($permission->id == $userPermission->id) {
                    $permission->setAttribute('assigned', true);
                }
            }
        }

        return response()->view('s_library.admin.users.user-permissions', ['permissions' => $permissions, 'user' => $user]);
    }

    public function updateUserPermissions(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id',
        ]);
        if (!$validator->fails()) {
            $permission = Permission::findOrFail($request->input('permission_id'));
            if ($user->hasPermissionTo($permission)) {
                $user->revokePermissionTo($permission);
            } else {
                $user->givePermissionTo($permission);
            }
            return response()->json(['message' => 'Permission updated successfully'], Response::HTTP_OK);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
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

    public function store(Request $request)
    {
        // register
        // dd('store');
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'university_id' => 'required|numeric|exists:universities,id',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make('password'); // Hash::make($request->input('password'))
            $user->university_id = $request->input('university_id');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_user_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/users', $imageName);
                $imagePath = 'images/users/' . $imageName;
                $user->image = $imagePath;
            }
            $isSaved = $user->save();
            $userRole = Role::where('guard_name','=','user')->get();
            // if ($isSaved) $user->assignRole($userRole->id);
            return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        // dd('show');
        // dd($user->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $universities = University::all();
        $authuser_id = Auth::user()->id;
        $user = User::where('id','=',$authuser_id)->get();
        // dd($authuser_id);
        return response()->view('s_library.user.profile.edit',['authuser_id' => $authuser_id,'user' =>$user, 'universities' => $universities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        // dd('update');
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'university_id' => 'required|numeric|exists:universities,id',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {

            $authuser = Auth::user();

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->university_id = $request->input('university_id');
            $user->password = $authuser->password;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_suser_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/users', $imageName);
                $imagePath = 'images/users/' . $imageName;
                $user->image = $imagePath;
            }

            $isSaved = $user->save();
            return response()->json([
                'message' => $isSaved ? 'Updated Successfully' : 'Update failed!'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function destroy(User $user)
    {
        //
        $deleted = $user->delete();
        if ($deleted) {
            Storage::delete($user->image);
        }
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'User deleted successfully' : 'User deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
