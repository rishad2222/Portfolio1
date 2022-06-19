<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Main;
use App\Service;
use App\Portfolio;
use App\About;

class PagesController extends Controller
{
    public function index(){
        $main = Main::first();
        $services = Service::all();
        $portfolios = Portfolio::all();
        $abouts = About::all();
        return view('frontend.index', compact('main','services','portfolios','abouts'));
    }
    public function dashboard(){
        return view('backend.admin');
    }
    public function about(){
        return view('backend.about');
    }
    public function contact(){
        return view('backend.contact');
    }
}
