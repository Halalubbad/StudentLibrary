<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Department;
use App\Models\Faculity;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FaculityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $faculities = Faculity::withCount('departments')->get();
        if(auth('admin')->check()){
            return response()->view('s_library.admin.faculities.index', ['faculities' => $faculities]);
        }else{
            if($request->has('id')){
                $faculity = Faculity::where('id','=',$request->input('id'))->get();
                $departments = Department::withCount('slides')->where('faculity_id','=',$request->input('id'))->get();    
                    return response()->view('s_library.user.departments.index',['faculity' => $faculity,'departments' => $departments]);
            }else{
                return response()->view('s_library.user.faculities.index', ['faculities' => $faculities]);
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
        $universities = University::all();
        return response()->view('s_library.admin.faculities.create', ['universities' => $universities]);
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
        $validator = validator($request->all(), [
            'name' => 'required|string|min:3',
            'university_id' => 'required|numeric|exists:universities,id',
        ]);
        if (!$validator->fails()) {
            $faculty = new Faculity();
            $faculty->name = $request->input('name');
            $faculty->university_id = $request->input('university_id');

            $isSaved = $faculty->save();
            return response()->json([
                'message' => $isSaved ? 'Saved Successfully' : 'Save Failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculity  $faculity
     * @return \Illuminate\Http\Response
     */
    public function show(Faculity $faculity)
    {
        //
        // dd('show');
        $departments = $faculity->departments;
        if(auth('user')->check()){
            return response()->json(['message'=>'success' , 'data' => $departments]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculity  $faculity
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculity $faculity)
    {
        //
        // dd('edit');
        $universities = University::all();
        return response()->view('s_library.admin.faculities.edit', ['faculity' => $faculity, 'universities' => $universities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculity  $faculity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculity $faculity)
    {
        //
        // dd('update');
        $validator = validator($request->all(), [
            'name' => 'required|string|min:3',
            'university_id' => 'required|numeric|exists:universities,id',

        ]);
        if (!$validator->fails()) {
            $faculity->name = $request->input('name');
            $faculity->university_id = $request->input('university_id');

            $isSaved = $faculity->save();
            return response()->json([
                'message' => $isSaved ? 'Updated Successfully' : 'Update Failed!'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculity  $faculity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculity $faculity)
    {
        //
        $deleted = $faculity->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
