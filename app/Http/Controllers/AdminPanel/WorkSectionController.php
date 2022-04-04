<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Support\Facades\Validator;

class WorkSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('AdminPanel.Work.work');
    }

    public function fetchWork()
    {
        $work = Work::get();
        return response()->json([
            'work' => $work,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.Work.work');
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
            'image'       => 'required|image|mimes:png,jpg'
        ]);
        if ($validation->passes()) {
            $imgName = '';
            if ($request->image) {
                $imgName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads'), $imgName);
            }
            Work::create([
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
        $data['work'] = Work::find($id);
        return view('AdminPanel.Work.update', $data);
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
        if (true) {
            $imgName = '';
            if ($request->image) {
                $imgName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads'), $imgName);
            }
            Work::find($id)->update([
                'image'       => $imgName,
            ]);
            return redirect()->back();
        } else {
            echo "failed";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Work::find($id)->delete();
        if ($delete) {
            return redirect()->back();
        }else {
            echo "unsuccessful";
        }
    }
}
