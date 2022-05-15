<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculity;
use App\Models\Slide;
use App\Models\University;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Department::class, 'department');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Department::with('faculity')->get();
        return Response()->view('s_library.admin.department.index', ['departments'=>$departments]);
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
        $faculities = Faculity::all();
        return response()->view('s_library.admin.department.create',['universities' => $universities ,'faculities'=>$faculities]);
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
        // dd('store');
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'faculity_id' => 'required|numeric|exists:faculities,id',
            
        ]);

        if (!$validator->fails()) {
            $department = new Department();
            $department->name = $request->input('name');
            $department->faculity_id = $request->input('faculity_id');            
            
            $isSaved = $department->save();
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
        // dd('show D');
        $slides = Slide::where('department_id','=',$department->id)->get();
        return response()->view('s_library.user.departments.showSlides',['slides' => $slides,'department'=> $department]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
        $universities = University::all();
        $faculities = Faculity::all();
        return Response()->view('s_library.admin.department.edit' ,['department' => $department ,'universities' => $universities ,'faculities'=>$faculities] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
        // dd('update');
        $validator = validator($request->all(), [
            'name' => 'required|string|min:3',
            'university_id' => 'required|numeric|exists:universities,id',
            'faculity_id' => 'required|numeric|exists:faculities,id',

        ]);
        if (!$validator->fails()) {
            $department->name = $request->input('name');
            $department->faculity_id = $request->input('faculity_id');

            $isSaved = $department->save();
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
        $deleted = $department->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted successfully' : 'Delete failed!'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
