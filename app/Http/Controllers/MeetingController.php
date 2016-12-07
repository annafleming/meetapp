<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $meetings = Auth::user()->meetings()->orderBy('scheduled_at', 'desc');
        $total = $meetings->count();
        if($request->get('limit')) {
            $meetings->limit($request->get('limit'));
        }
        return response()->json([
            'meetings' => $meetings->with('users')->get(),
            'total' => $total
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meeting = new Meeting;
        foreach (['scheduled_at', 'agenda'] as $field) {
            $meeting->$field = null;
        }
        $meeting->id = null;
        $meeting->users = [Auth::user()];
        return $meeting;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $meeting = Meeting::create($request->all());
        $userIds = array_map(function($item) {return $item['id'];}, $request->get('users'));
        $meeting->users()->sync($userIds);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $meeting = Meeting::find($id);

        $userIds = array_map(function($item) {return $item['id'];}, $request->get('users'));
        $meeting->users()->sync($userIds);

        $meeting->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
