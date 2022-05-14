<?php

namespace App\Http\Controllers;

use App\Models\Faculity;
use App\Models\University;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $universities = University::withCount('faculities')->get();
        // if(Auth::user('user')){
        if(auth('admin')->check()){
            // dd('admin');
            // dd($request->guard);
            if($request->has('id')){
                $faculities = Faculity::where('university_id','=',$request->input('id'))->get();
                $university = University::where('id','=',$request->input('id'))->get();
                return response()->view('s_library.admin.univirsity.faculitiesShow',['university' => $university,'faculities'=>$faculities]);
            }else{
                return Response()->view('s_library.admin.univirsity.index',['universities' => $universities]);
            }

        }else{
            // dd('user');
            if($request->has('id')){
                $university = University::where('id','=',$request->input('id'))->get();
                $faculities = Faculity::withCount('departments')->where('university_id','=',$request->input('id'))->get();

                return response()->view('s_library.user.universities.show' ,['university' => $university,'faculities' => $faculities]);
            }else{
                return response()->view('s_library.user.universities.index' ,['universities' => $universities]);
            }
            
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
        return response()->view('s_library.admin.univirsity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {
            $university = new University();
            $university->name = $request->input('name');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_university_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/universities', $imageName);
                $imagePath = 'images/universities/' . $imageName;
                $university->image = $imagePath;
            }
            $isSaved = $university->save();
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
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        //
        
        
        $faculities = $university->faculities;
        if(auth('admin')->check()){
            // dd('admin');
            return response()->json(['message'=>'success' , 'data' => $faculities]);
        }else{
            // dd('user');
            return response()->json(['message'=>'success' , 'data' => $faculities]);

            
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit(University $university)
    {
        //
        return response()->view('s_library.admin.univirsity.edit', ['university' => $university]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, University $university)
    {
        //
        // dd('UPDATE');
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'image' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);
        if (!$validator->fails()) {
            $university->name = $request->input('name');
            if ($request->hasFile('image')) {
                Storage::delete($university->image);
                $file = $request->file('image');
                $imageName = time() . '_university_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/universities', $imageName);
                $imagePath = 'images/universities/' . $imageName;
                $university->image = $imagePath;
            }
            $isSaved = $university->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        //
        $deleted = $university->delete();
        if ($deleted) {
            Storage::delete($university->image);
        }
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'University deleted successfully' : 'University deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
