<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
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
        if ($validation->fails()) {

            return response()->json([
                'status' => 500,
                'errors' => $validation->messages()
            ]);
        }else {
                $service = Service::find($id);
                if ($service) {
                    $service->title       = $request->title;
                    $service->description = $request->description;

                    if ($request->hasFile('image')) {
                        $path = 'uploads/' . $service->image;
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                        $service_image  = $request->file('image');
                        $extention      = $service_image->getClientOriginalName();
                        $fileName       = time() . '.' .$extention;
                        $service_image->move('uploads/', $fileName);
                        Image:: make($service_image)->resize(512, 512)->save($fileName);
                        $service->image = $fileName;
                    }
                    $service->save();

                    return response()->json([
                        'status' => 200,
                        'message' => 'data saved successfully'
                    ]);
                }else {
                    return response()->json([
                        'status' => 404,
                        'message' => 'data not submit'
                    ]);
                }
                
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
        Service::find($id)->delete();
    }
}
