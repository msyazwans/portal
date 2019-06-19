<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Slider;
use App\Link;
use App\Announcement;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        $dt = Carbon::now();
        $sliders = Slider::whereNull('deleted_at')
            ->where('status','=',1)
            ->whereRaw('"'.$dt.'" between start_publishing and IF(stop_publishing IS NULL,NOW(),stop_publishing)')
            ->get();

        $links = Link::whereNull('deleted_at')
            ->where('status','=',1)
            ->whereRaw('"'.$dt.'" between start_publishing and IF(stop_publishing IS NULL,NOW(),stop_publishing)')
            ->get();

        $announcements = Announcement::whereNull('deleted_at')
            ->where('status','=',1)
            ->whereRaw('"'.$dt.'" between start_publishing and IF(stop_publishing IS NULL,NOW(),stop_publishing)')
            ->get();

        return view('welcome',compact('sliders','links', 'announcements'));
    }
}
