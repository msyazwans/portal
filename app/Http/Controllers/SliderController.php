<?php

namespace App\Http\Controllers;

use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::whereNull('deleted_at')
            ->get();

        return view('slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->caption = $request->input('caption');
        if(!empty($request->input('status'))) {
            $slider->status = $request->input('status');
        }
        $myFile = $request->file('slider_background');
        if (isset($myFile)) {
            if ($myFile->isValid()) {
                $fileName = $myFile->getClientOriginalName();

                $slider->featured_file_name = $fileName;
                $slider->featured_file_size = $myFile->getSize();
                $slider->featured_content_type = $myFile->getClientMimeType();

            }
        }

        if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
            if (!empty($request->input('start_publishing')) || $request->input('status') == '1') {
                $slider->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                    ->format('Y-m-d h:i');
            } else {
                $slider->start_publishing = Carbon::now()->format('Y-m-d h:i');

            }
        }
        if (!empty($request->input('stop_publishing'))) {
            $slider->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                ->format('Y-m-d h:i');
        }
        $slider->user_id = Auth::user()->id;
        //


        if ($slider->save()) {

            $myFile = $request->file('slider_background'); // <-- rename ikut nama input
            if (isset($myFile)) {
                if ($myFile->isValid()) {
                    $destinationPath = "system/slider/".$slider->id;
                    $fileName = $myFile->getClientOriginalName();


                    if(!file_exists($destinationPath)) {
                        mkdir($destinationPath,757,true);
                    }

                    $destinationThumbPath = "system/slider/".$slider->id."/thumb";

                    if(!file_exists($destinationThumbPath)) {
                        mkdir($destinationThumbPath,757,true);
                    }

                    $thumb_img = Image::make($myFile->getRealPath())->resize(260, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $thumb_img->crop(150, 150, 55, 20);

                    $thumb_img->save($destinationThumbPath.'/'.$fileName,100);

                    $destinationMediumPath = "system/slider/".$slider->id."/medium";

                    if(!file_exists($destinationMediumPath)) {
                        mkdir($destinationMediumPath,757,true);
                    }

                    $medium_img = Image::make($myFile->getRealPath())->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $medium_img->save($destinationMediumPath.'/'.$fileName,100);

                    $myFile->move($destinationPath, $fileName);
                }
            }

            return redirect('/slider/list')->with('successMessage', 'Slider successfully added');
        } else {
            return back()->with('errorMessage', 'Slider not successfully added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($slider_id)
    {
        $slider = Slider::findOrFail($slider_id);
        return view('slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slider_id)
    {
        $slider = Slider::findOrFail($slider_id);
        $slider->caption = $request->input('caption');
        if(!empty($request->input('status'))) {
            $slider->status = $request->input('status');
        }
        $myFile = $request->file('slider_background');
        if (isset($myFile)) {
            if ($myFile->isValid()) {
                $fileName = $myFile->getClientOriginalName();

                $slider->featured_file_name = $fileName;
                $slider->featured_file_size = $myFile->getSize();
                $slider->featured_content_type = $myFile->getClientMimeType();

            }
        }

        if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
            if (!empty($request->input('start_publishing')) || $request->input('status') == '1') {
                $slider->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                    ->format('Y-m-d h:i');
            } else {
                $slider->start_publishing = Carbon::now()->format('Y-m-d h:i');

            }
        }
        if (!empty($request->input('stop_publishing'))) {
            $slider->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                ->format('Y-m-d h:i');
        }
        $slider->user_id = Auth::user()->id;
        //


        if ($slider->save()) {

            $myFile = $request->file('slider_background'); // <-- rename ikut nama input
            if (isset($myFile)) {
                if ($myFile->isValid()) {
                    $destinationPath = "system/slider/".$slider->id;
                    $fileName = $myFile->getClientOriginalName();


                    if(!file_exists($destinationPath)) {
                        mkdir($destinationPath,757,true);
                    }

                    $destinationThumbPath = "system/slider/".$slider->id."/thumb";

                    if(!file_exists($destinationThumbPath)) {
                        mkdir($destinationThumbPath,757,true);
                    }

                    $thumb_img = Image::make($myFile->getRealPath())->resize(260, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $thumb_img->crop(150, 150, 55, 20);

                    $thumb_img->save($destinationThumbPath.'/'.$fileName,100);

                    $destinationMediumPath = "system/slider/".$slider->id."/medium";

                    if(!file_exists($destinationMediumPath)) {
                        mkdir($destinationMediumPath,757,true);
                    }

                    $medium_img = Image::make($myFile->getRealPath())->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $medium_img->save($destinationMediumPath.'/'.$fileName,100);

                    $myFile->move($destinationPath, $fileName);
                }
            }

            return redirect('/slider/list')->with('successMessage', 'Slider successfully updated');
        } else {
            return back()->with('errorMessage', 'Slider not successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($slider_id)
    {
        $slider = Slider::findOrFail($slider_id);

        if($slider->delete()) {
            return redirect('/slider/list')->with('successMessage','Slider successfully deleted');
        }
    }

    public function remove_photo($slider_id)
    {
        $slider = Slider::findOrFail($slider_id);

        $slider->featured_file_name = '';
        $slider->featured_content_type = '';
        $slider->featured_file_size = 0;

        if ($slider->save()) {
            return redirect('/slider/'.$slider_id.'/edit')->with('successMessage', 'Slider photo successfully deleted');
        } else {
            return back()->with('errorMessage', 'Slider photo not successfully deleted.');
        }
    }
}
