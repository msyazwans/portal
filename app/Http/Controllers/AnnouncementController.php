<?php

namespace App\Http\Controllers;

use App\Announcement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use PHPUnit\Runner\Exception;


class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $announcements = Announcement::whereNull('deleted_at')
            ->get();

        return view('announcement.index',compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('announcement.create');
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

            $announcement = new Announcement();
            $announcement->title = $request->input('title');
            $announcement->caption = $request->input('caption');
            if (!empty($request->input('status'))) {
                $announcement->status = $request->input('status');
            }
            $myFile = $request->file('announcement_background');
            if (isset($myFile)) {
                if ($myFile->isValid()) {
                    $fileName = $myFile->getClientOriginalName();

                    $announcement->featured_file_name = $fileName;
                    $announcement->featured_file_size = $myFile->getSize();
                    $announcement->featured_content_type = $myFile->getClientMimeType();

                }
            }

            if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
                if (!empty($request->input('start_publishing')) || $request->input('status') == '1') {
                    $announcement->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                        ->format('Y-m-d h:i');
                } else {
                    $announcement->start_publishing = Carbon::now()->format('Y-m-d h:i');

                }
            }
            if (!empty($request->input('stop_publishing'))) {
                $announcement->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                    ->format('Y-m-d h:i');
            }
            $announcement->user_id = Auth::user()->id;
            //


            if ($announcement->save()) {

                $myFile = $request->file('announcement_background'); // <-- rename ikut nama input
                if (isset($myFile)) {
                    if ($myFile->isValid()) {
                        $destinationPath = "system/announcement/" . $announcement->id;
                        $fileName = $myFile->getClientOriginalName();


                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 757, true);
                        }

                        $destinationThumbPath = "system/announcement/" . $announcement->id . "/thumb";

                        if (!file_exists($destinationThumbPath)) {
                            mkdir($destinationThumbPath, 757, true);
                        }

                        $thumb_img = Image::make($myFile->getRealPath())->resize(260, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                        $thumb_img->crop(150, 150, 55, 20);

                        $thumb_img->save($destinationThumbPath . '/' . $fileName, 100);

                        $destinationMediumPath = "system/announcement/" . $announcement->id . "/medium";

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
                return redirect('/announcement/list')->with('successMessage', 'Announcement successfully added');
            } else {
                \DB::rollBack();
                return back()->withInput()->with('errorMessage', 'Announcement not successfully added');
            }
        } catch (\Exception $e){
            return back()->withInput()->with('errorMessage', 'Announcement not successfully added'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit($announcement_id)
    {
        //
        $announcement = Announcement::findOrFail($announcement_id);
        return view('announcement.edit',compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $announcement_id)
    {
        //
        {
            //
            $announcement = Announcement::findOrFail($announcement_id);
            $announcement->title = $request->input('title');
            $announcement->caption = $request->input('caption');

            if (!empty($request->input('status'))) {
                $announcement->status = $request->input('status');
            }

            $myFile = $request->file('announcement_background'); // <-- rename ikut nama input
            if (isset($myFile)) {
                if ($myFile->isValid()) {
                    $fileName = $myFile->getClientOriginalName();

                    $announcement->featured_file_name = $fileName;
                    $announcement->featured_file_size = $myFile->getClientSize();
                    $announcement->featured_content_type = $myFile->getClientMimeType();
                }
            }

            if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
                if (!empty($request->input('start_publishing')) || $request->input('status') == 1) {
                    $announcement->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                        ->format('Y-m-d h:i');
                } else {
                    $announcement->start_publishing = Carbon::now()->format('Y-m-d h:i');

                }
            }

            if (!empty($request->input('stop_publishing'))) {
                $announcement->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                    ->format('Y-m-d h:i');
            }

            $announcement->user_id = Auth::user()->id;

            if ($announcement->save()) {
                $myFile = $request->file('announcement_background'); // <-- rename ikut nama input
                if (isset($myFile)) {
                    if ($myFile->isValid()) {
                        $destinationPath = "system/announcement/" . $announcement->id;
                        $fileName = $myFile->getClientOriginalName();

                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 757, true);
                        }

                        $destinationThumbPath = "system/announcement/" . $announcement->id . "/thumb";


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

                        $destinationMediumPath = "system/announcement/" . $announcement->id . "/medium";


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
                return redirect('/announcement/list')->with('successMessage', 'Announcement Successfully added');
            } else {
                return back()->with('errorMessage', 'Announcement not successfully added');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($announcement_id)
    {
        //
        $announcement = Announcement::findOrFail($announcement_id);

        if($announcement->delete()) {
            return redirect('/announcement/list')->with('successMessage','Announcement successfully deleted');
        }
    }

    public function remove_photo($announcement_id)
    {
        $announcement = Slider::findOrFail($announcement_id);

        $announcement->featured_file_name = '';
        $announcement->featured_content_type = '';
        $announcement->featured_file_size = 0;

        if ($announcement->save()) {
            return redirect('/announcement/'.$announcement.'/edit')->with('successMessage', 'Announcement photo successfully deleted');
        } else {
            return back()->with('errorMessage', 'Announcement photo not successfully deleted.');
        }
    }
}
