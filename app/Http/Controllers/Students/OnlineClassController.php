<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Traits\ZoomMeetingTrait;
use App\Models\Grade;
use App\Models\OnlineClass;
use Illuminate\Http\Request;

class OnlineClassController extends Controller
{
    use ZoomMeetingTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $online_classes = OnlineClass::all();
        return view('pages.online-classes.index',compact('online_classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online-classes.add',compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $meetings = $this->createMeeting($request);
//
//        OnlineClass::create([
//            'Grade_id' => $request->Grade_id,
//            'Classroom_id' => $request->Classroom_id,
//            'section_id' => $request->section_id,
//            'user_id' => auth()->user()->id,
//            'meeting_id' => $meetings->id,
//            'topic' => $request->topic,
//            'start_at' => $request->start_time,
//            'duration' => $meetings->duration,
//            'password' => $meetings->password,
//            'start_url' => $meetings->start_url,
//            'join_url' => $meetings->join_url,
//        ]);
//        toastr()->success(trans('messages.success'));
//        return redirect()->route('online_classes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(OnlineClass $onlineClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OnlineClass $onlineClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OnlineClass $onlineClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            OnlineClass::where('meeting_id',$request->meeting_id)->delete();

            toastr()->error('message.delete');
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

    public function indirectCreate(){

        $Grades = Grade::all();
        return view('pages.online-classes.indirect',compact('Grades'));
    }

    public function indirectStore(Request $request){

        try {
            OnlineClass::create([
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online-class.index');

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
