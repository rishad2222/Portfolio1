<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolio = Portfolio::all();
        return view('backend.portfolio.list' , compact('portfolio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.portfolio.create');
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
            'title' => 'required|string', 
            'sub_title' => 'required|string',
            'big_image' => 'required|image',
            'small_image' => 'required|image',
            'description' => 'required|string', 
            'client' => 'required|string',
            'category' => 'required|string', 

        ]);

        $portfolio = new portfolio;
        $portfolio->title = $request->title;
        $portfolio->sub_title = $request->sub_title;
        $portfolio->description = $request->description;
        $portfolio->client = $request->client;
        $portfolio->category = $request->category;

        $big_file = $request->file('big_image');
        Storage::putFile('public/img/', $big_file);
        $portfolio->big_image = "storage/img/".$big_file->hashName();

        $small_file = $request->file('small_image');
        Storage::putFile('public/img/', $small_file);
        $portfolio->small_image = "storage/img/".$small_file->hashName();

        $portfolio->save();

        return redirect()->route('admin.portfolios.create')->with('success', "New Portfolio Created successfully");
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolio = Portfolio::find($id);
        return view ('backend.portfolio.edit' , compact('portfolio'));
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
            'title' => 'required|string', 
            'sub_title' => 'required|string',
            'description' => 'required|string', 
            'client' => 'required|string',
            'category' => 'required|string', 

        ]);

        $portfolio = portfolio::find($id);
        $portfolio->title = $request->title;
        $portfolio->sub_title = $request->sub_title;
        $portfolio->description = $request->description;
        $portfolio->client = $request->client;
        $portfolio->category = $request->category;

        if($request->file('big_image')){
            $big_file = $request->file('big_image');
            Storage::putFile('public/img/', $big_file);
            $portfolio->big_image = "storage/img/".$big_file->hashName();
        }

        
        if($request->file('small_image')){
            $small_file = $request->file('small_image');
            Storage::putFile('public/img/', $small_file);
            $portfolio->small_image = "storage/img/".$small_file->hashName();
        }
        

        $portfolio->save();

        return redirect()->route('admin.portfolios.list')->with('success', "New Portfolio Updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);
        @unlink(public_path($portfolio->big_image));
        @unlink(public_path($portfolio->small_image));
        $portfolio ->delete();

        return redirect()->route('admin.portfolios.list')->with('success', "portfolio Deleted successfully");
    }
}
