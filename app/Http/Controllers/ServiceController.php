<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use PHPUnit\Runner\Exception;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = Service::whereNull('deleted_at')
            ->get();

        return view('service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            \DB::beginTransaction();

            $service = new Service();
            $service->title = $request->input('title');
            $service->url = $request->input('url');
            $service->notes = $request->input('notes');
            if (!empty($request->input('status'))) {
                $service->status = $request->input('status');
            }
            $myFile = $request->file('service_background');
            if (isset($myFile)) {
                if ($myFile->isValid()) {
                    $fileName = $myFile->getClientOriginalName();

                    $service->featured_file_name = $fileName;
                    $service->featured_file_size = $myFile->getSize();
                    $service->featured_content_type = $myFile->getClientMimeType();

                }
            }

            if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
                if (!empty($request->input('start_publishing')) || $request->input('status') == '1') {
                    $service->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                        ->format('Y-m-d h:i');
                } else {
                    $service->start_publishing = Carbon::now()->format('Y-m-d h:i');

                }
            }
            if (!empty($request->input('stop_publishing'))) {
                $service->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                    ->format('Y-m-d h:i');
            }
            $service->user_id = Auth::user()->id;
            //


            if ($service->save()) {

                $myFile = $request->file('service_background'); // <-- rename ikut nama input
                if (isset($myFile)) {
                    if ($myFile->isValid()) {
                        $destinationPath = "system/service/" . $service->id;
                        $fileName = $myFile->getClientOriginalName();


                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 757, true);
                        }

                        $destinationThumbPath = "system/service/" . $service->id . "/thumb";

                        if (!file_exists($destinationThumbPath)) {
                            mkdir($destinationThumbPath, 757, true);
                        }

                        $thumb_img = Image::make($myFile->getRealPath())->resize(260, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                        $thumb_img->crop(150, 150, 55, 20);

                        $thumb_img->save($destinationThumbPath . '/' . $fileName, 100);

                        $destinationMediumPath = "system/service/" . $service->id . "/medium";

                        if (!file_exists($destinationMediumPath)) {
                            mkdir($destinationMediumPath, 757, true);
                        }

                        $medium_img = Image::make($myFile->getRealPath())->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                        $medium_img->save($destinationMediumPath . '/' . $fileName, 100);

                        $myFile->move($destinationPath, $fileName);
                    }
                }
                \DB::commit();
                return redirect('/service/list')->with('successMessage', 'Service successfully added');
            } else {
                \DB::rollBack();
                return back()->withInput()->with('errorMessage', 'Service not successfully added');
            }
        } catch (\Exception $e){
            return back()->withInput()->with('errorMessage', 'Service not successfully added'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($service_id)
    {
        //
        $service = Service::findOrFail($service_id);
        return view('service.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $service_id)
    {
        //
        $service = Service::findOrFail($service_id);
        $service->title = $request->input('title');
        $service->url = $request->input('url');
        $service->notes = $request->input('notes');

        if (!empty($request->input('status'))) {
            $service->status = $request->input('status');
        }

        $myFile = $request->file('service_background'); // <-- rename ikut nama input
        if (isset($myFile)) {
            if ($myFile->isValid()) {
                $fileName = $myFile->getClientOriginalName();

                $service->featured_file_name = $fileName;
                $service->featured_file_size = $myFile->getClientSize();
                $service->featured_content_type = $myFile->getClientMimeType();
            }
        }

        if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
            if (!empty($request->input('start_publishing')) || $request->input('status') == 1) {
                $service->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                    ->format('Y-m-d h:i');
            } else {
                $service->start_publishing = Carbon::now()->format('Y-m-d h:i');

            }
        }

        if (!empty($request->input('stop_publishing'))) {
            $service->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                ->format('Y-m-d h:i');
        }

        $service->user_id = Auth::user()->id;

        if ($service->save()) {
            $myFile = $request->file('service_background'); // <-- rename ikut nama input
            if (isset($myFile)) {
                if ($myFile->isValid()) {
                    $destinationPath = "system/service/" . $service->id;
                    $fileName = $myFile->getClientOriginalName();

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 757, true);
                    }

                    $destinationThumbPath = "system/service/" . $service->id . "/thumb";


                    if (!file_exists($destinationThumbPath)) {
                        mkdir($destinationThumbPath, 757, true);
                    }


                    $thumb_img = Image::make($myFile->getRealPath())->resize(260, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    //$thumb_img = Image::make($myFile->getRealPath())->crop(150, 150, 940, 640);
                    // $width = Image::make($myFile->getRealPath())->width();
                    $thumb_img->crop(150, 150, 55, 20);

                    //$thumb_img->crop(150, 150, 30, 30);
                    $thumb_img->save($destinationThumbPath . '/' . $fileName, 100);

                    $destinationMediumPath = "system/service/" . $service->id . "/medium";


                    if (!file_exists($destinationMediumPath)) {
                        mkdir($destinationMediumPath, 757, true);
                    }


                    $medium_img = Image::make($myFile->getRealPath())->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    //$medium_img = Image::make($myFile->getRealPath())->resize(300, 162);
                    $medium_img->save($destinationMediumPath . '/' . $fileName, 100);

                    $myFile->move($destinationPath, $fileName);
                }
            }
            return redirect('/service/list')->with('successMessage', 'Service Successfully added');
        } else {
            return back()->with('errorMessage', 'Service not successfully added');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($service_id)
    {
        //
        $service = Service::findOrFail($service_id);

        if($service->delete()) {
            return redirect('/service/list')->with('successMessage','Service successfully deleted');
        }
    }

    public function remove_photo($service_id)
    {
        $service = Service::findOrFail($service_id);

        $service->featured_file_name = '';
        $service->featured_content_type = '';
        $service->featured_file_size = 0;

        if ($service->save()) {
            return redirect('/service/'.$service_id.'/edit')->with('successMessage', 'Service photo successfully deleted');
        } else {
            return back()->with('errorMessage', 'Service photo not successfully deleted.');
        }
    }
}
