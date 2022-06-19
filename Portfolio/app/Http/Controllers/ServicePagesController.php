<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class ServicePagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('backend.service.list' , compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'icon' => 'required|string',
            'title' => 'required|string', 
            'description' => 'required|string', 
        ]);

        $service = new service;
        $service->icon = $request->icon;
        $service->title = $request->title;
        $service->description = $request->description;

        $service->save();

        return redirect()->route('admin.services.create')->with('success', "New Service Created successfully");
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
        return view ('backend.service.edit' , compact('service'));
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
        $this->validate($request, [
            'icon' => 'required|string',
            'title' => 'required|string', 
            'description' => 'required|string', 
        ]);

        $service = Service::find($id);
        $service->icon = $request->icon;
        $service->title = $request->title;
        $service->description = $request->description;

        $service->save();

        return redirect()->route('admin.services.list')->with('success', "Service Updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service ->delete();

        return redirect()->route('admin.services.list')->with('success', "Service Deleted successfully");
    }
}
