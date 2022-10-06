<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $data = [];
         $data['sliders'] = Slider::get(['image']);
        return view('front.index', compact('data'));
    }
    public function getSliders() {
        $sliders =  Slider::get('image');
        return view('front.index', compact('sliders'));
    }
}   
