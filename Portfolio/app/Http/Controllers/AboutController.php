<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();
        return view('backend.about.list' , compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.about.create');
    }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title1' => 'required|string', 
            'title2' => 'required|string',
            'image' => 'required|image',
            'description' => 'required|string',

        ]);

        $abouts = new About;
        $abouts->title1 = $request->title1;
        $abouts->title2 = $request->title2;
        $abouts->description = $request->description;

        $image_file = $request->file('image');
        Storage::putFile('public/img/', $image_file);
        $abouts->image = "storage/img/".$image_file->hashName();

        

        $abouts->save();

        return redirect()->route('admin.abouts.create')->with('success', "New About Created successfully");
    }

//     // /**
//     //  * Display the specified resource.
//     //  *
//     //  * @param  int  $id
//     //  * @return \Illuminate\Http\Response
//     //  */
//     // public function show($id)
//     // {
//     //     //
//     // }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
    public function edit($id)
    {
        $about = About::find($id);
        return view ('backend.about.edit' , compact('about'));
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
            'title1' => 'required|string', 
            'title2' => 'required|string',
            'description' => 'required|string', 

        ]);

        $about = About::find($id);
        $about->title1 = $request->title1;
        $about->title2 = $request->title2;
        $about->description = $request->description;
        

        if($request->file('image')){
            $image_file = $request->file('image');
            Storage::putFile('public/img/', $image_file);
            $about->image = "storage/img/".$image_file->hashName();
        }

        
        

        $about->save();

        return redirect()->route('admin.abouts.list')->with('success', "New About Updated successfully");

    }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
    public function destroy($id)
    {
        $about = About::find($id);
        @unlink(public_path($about->image));
        $about ->delete();

        return redirect()->route('admin.abouts.list')->with('success', "About Deleted successfully");
    }
}
