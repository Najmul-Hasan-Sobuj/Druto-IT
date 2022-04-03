<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ServiceSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['service'] = Service::get();
        // return view('AdminPanel.Service.list', $data);
        return view('AdminPanel.Service.service');
    }

    public function fetchService()
    {
        $service = Service::get();
        return response()->json([
            'service' => $service
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return view('AdminPanel.Service.service');

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
            'title'       => 'required',
            'description' => 'required',
            'image'       => 'required|image|mimes:png,jpg'
        ]);
        if ($validation->passes()) {
            $imgName = '';
            if ($request->image) {
                $imgName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads'), $imgName);
            }
            Service::create([
                'title'       => $request->title,
                'description' => $request->description,
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
        // $data['service'] = Service::find($id);
        // return view('AdminPanel.Service.service', $data);

        $service = Service::find($id);
        if ($service) {
            return response()->json([
                'status' => 200,
                'service' => $service
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'message' => 'Service not found'
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
        $validation = Validator::make($request->all(), [
            'title'       => 'required',
            'description' => 'required',
        ]);
        if ($validation->passes()) {
            Service::find($id)->update([
                'title'       => $request->title,
                'description' => $request->description,
            ]);
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validation);
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
        $delete = Service::find($id)->delete();
        // if ($delete) {
        //     return redirect()->back();
        // }else {
        //     echo "unsuccessful";
        // }
    }
}
