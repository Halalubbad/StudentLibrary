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
        $users = User::with('university')->get();
        return Response()->view('s_library.admin.users.index',['users' => $users]);
        
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
            $user->password = Hash::make('password');
            $user->university_id = $request->input('university_id');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_user_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/users', $imageName);
                $imagePath = 'images/users/' . $imageName;
                $user->image = $imagePath;
            }
            $isSaved = $user->save();
            // if ($isSaved) {
            //     Mail::to($user)->send(new UserWelcomeEmail($user));
            //     $admin = Admin::first();
            //     $admin->notify(new NewUserNotification($user));
            // }
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
