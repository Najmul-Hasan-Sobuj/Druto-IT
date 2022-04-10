<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TeamSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AdminPanel.Team.team');
    }

    public function fetchTeam()
    {
        $team = Team::get();
        return response()->json([
            'team' => $team,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.Team.team');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'        => 'required',
            'skills'      => 'required',
            'designation' => 'required',
            'facebook'    => 'required',
            'linkedin'    => 'required',
            'twitter'     => 'required',
            'github'      => 'required',
            'image'       => 'required|image|mimes:png,jpg'
        ]);               
        if ($validation->passes()) {
            $imgName = '';
            if ($request->image) {
                $imgName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads'), $imgName);
            }
            Team::create([
                'name'        => $request->name,
                'skills'      => $request->skills,
                'designation' => $request->designation,
                'facebook'    => $request->facebook,
                'linkedin'    => $request->linkedin,
                'twitter'     => $request->twitter,
                'github'      => $request->github,
                'image'       => $imgName,
            ]);
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validation);
        }
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
        $team = Team::find($id);
        if ($team) {
            return response()->json([
                'status' => 200,
                'team' => $team
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'message' => 'team not found'
            ]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Team::find($id)->delete();
        
    }
}
