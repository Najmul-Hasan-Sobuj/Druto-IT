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
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
        ]);


        $service = Service::find($id);
        $service_image = $request->file('image');


        if ($service == null){

            if ($service_image){
                $service = new Service();

//                $service_image = $request->file('image');
                $imageName = $service_image->getClientOriginalName();
                $directory = 'assets/images/service/';
                $imageUrl = $directory . $imageName;
                Image::make($service_image)->resize(512, 512)->save($imageUrl);

                $service->id          = $id;
                $service->title       = $request->title;
                $service->description = $request->description;
                $service->image       = $imageUrl;
                $service->save();
            }else{
                $service->id          = $id;
                $service->title       = $request->title;
                $service->description = $request->description;
                $service->image       = $imageUrl;
                $service->save();
            }


        }else{
            if ($service_image){
                unlink($service->image);
//                $service_image = $request->file('image');
                $imageName = date('mdYHis') . uniqid() . $service_image->getClientOriginalName();
                $directory = 'assets/images/service/';
                $imageUrl = $directory . $imageName;
                Image::make($service_image)->resize(512, 512)->save($imageUrl);

                $service->id          = $id;
                $service->title       = $request->title;
                $service->description = $request->description;
                $service->image       = $imageUrl;
                $service->save();

            }else{
                $service->id          = $id;
                $service->title       = $request->title;
                $service->description = $request->description;
                $service->image       = $imageUrl;
                $service->save();
            }
        }

        return redirect()->route('service.index')->with('message','Service Updated Successfully');

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
