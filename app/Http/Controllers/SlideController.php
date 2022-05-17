<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculity;
use App\Models\Slide;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SlideController extends Controller
{

    // public function __construct()
    // {
    //     $this->authorizeResource(Slide::class, 'slide');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //   
        // dd(Auth::user()->id); 
        $slides = Slide::all();
        $users = User::all();
        return response()->view('s_library.user.slides.index',['users' => $users,'slides' => $slides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        $user = Auth::user();
        $user_university = $user->university_id;
        $universities = University::all();
        $faculities = Faculity::where('university_id','=',$user_university)->get();
        $departments = Department::all();
        return response()->view('s_library.user.slides.create' ,['universities' =>$universities,'faculities' => $faculities,'departments' => $departments]);
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
            'subject_number' => 'required|numeric|min:3',
            'subject_name' => 'required|string|min:3',
            'faculity_id' => 'required|numeric|exists:faculities,id',
            'department_id' => 'required|numeric|exists:departments,id',
            'teacher' => 'required|string|min:3',
            'year' => 'required|numeric|min:4',
            'level' => 'required|string|min:3',
            'semester' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'slide_file' => 'required|mimes:pdf,csv,xls,xlsx,doc,docx|max:2048',
        ]);

        if (!$validator->fails()) {

            $user = Auth::user();

            $slide = new Slide();

            $slide->user_id = $user->id;
            $slide->subject_number = $request->input('subject_number');
            $slide->subject_name = $request->input('subject_name');
            $slide->faculity_id = $request->input('faculity_id');
            $slide->department_id = $request->input('department_id');
            $slide->teacher = $request->input('teacher');
            $slide->year = $request->input('year');
            $slide->level = $request->input('level');
            $slide->semester = $request->input('semester');
            $slide->rate = "5";
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_slide_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/slides', $imageName);
                $imagePath = 'images/slides/' . $imageName;
                $slide->image = $imagePath;
            }
            if ($request->hasFile('slide_file')) {
                $file = $request->file('slide_file');
                $fileName = time() . '_slide_files.' . $file->getClientOriginalExtension();
                $request->file('slide_file')->storePubliclyAs('files/slides', $fileName);
                $filesPath = 'files/slides/' . $fileName;
                $slide->slide_file = $filesPath;
            }
            $isSaved = $slide->save();
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
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        //
        $user = Auth::user();
        $user_university = $user->university_id;
        $universities = University::all();
        $faculities = Faculity::where('university_id','=',$user_university)->get();
        $departments = Department::all();
        return response()->view('s_library.user.slides.edit',['slide' =>$slide,'universities' =>$universities,'faculities' => $faculities,'departments' => $departments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        //
        // dd('update');
        $validator = Validator($request->all(), [
            'subject_number' => 'required|numeric|min:3',
            'subject_name' => 'required|string|min:3',
            'faculity_id' => 'required|numeric|exists:faculities,id',
            'department_id' => 'required|numeric|exists:departments,id',
            'teacher' => 'required|string|min:3',
            'year' => 'required|numeric|min:4',
            'level' => 'required|string|min:3',
            'semester' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'slide_file' => 'required|mimes:pdf,csv,xls,xlsx,doc,docx|max:2048',
        ]);

        if (!$validator->fails()) {

            $user = Auth::user();

            $slide->user_id = $user->id;
            $slide->subject_number = $request->input('subject_number');
            $slide->subject_name = $request->input('subject_name');
            $slide->faculity_id = $request->input('faculity_id');
            $slide->department_id = $request->input('department_id');
            $slide->teacher = $request->input('teacher');
            $slide->year = $request->input('year');
            $slide->level = $request->input('level');
            $slide->semester = $request->input('semester');
            $slide->rate = "5";
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_slide_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/slides', $imageName);
                $imagePath = 'images/slides/' . $imageName;
                $slide->image = $imagePath;
            }
            if ($request->hasFile('slide_file')) {
                $file = $request->file('slide_file');
                $fileName = time() . '_slide_files.' . $file->getClientOriginalExtension();
                $request->file('slide_file')->storePubliclyAs('files/slides', $fileName);
                $filesPath = 'files/slides/' . $fileName;
                $slide->slide_file = $filesPath;
            }
            $isSaved = $slide->save();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        //
    }
}
