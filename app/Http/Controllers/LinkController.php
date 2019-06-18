<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use PHPUnit\Runner\Exception;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $links = Link::whereNull('deleted_at')
            ->get();

        return view('link.index',compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('link.create');
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

            $link = new Link();
            $link->title = $request->input('title');
            $link->url = $request->input('url');;
            if (!empty($request->input('status'))) {
                $link->status = $request->input('status');
            }
            $myFile = $request->file('link_background');
            if (isset($myFile)) {
                if ($myFile->isValid()) {
                    $fileName = $myFile->getClientOriginalName();

                    $link->logo_file_name = $fileName;
                    $link->logo_file_size = $myFile->getSize();
                    $link->logo_content_type = $myFile->getClientMimeType();

                }
            }

            if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
                if (!empty($request->input('start_publishing')) || $request->input('status') == '1') {
                    $link->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                        ->format('Y-m-d h:i');
                } else {
                    $link->start_publishing = Carbon::now()->format('Y-m-d h:i');

                }
            }
            if (!empty($request->input('stop_publishing'))) {
                $link->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                    ->format('Y-m-d h:i');
            }
            $link->user_id = Auth::user()->id;
            //


            if ($link->save()) {

                $myFile = $request->file('link_background'); // <-- rename ikut nama input
                if (isset($myFile)) {
                    if ($myFile->isValid()) {
                        $destinationPath = "system/link/" . $link->id;
                        $fileName = $myFile->getClientOriginalName();


                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 757, true);
                        }

                        $destinationThumbPath = "system/link/" . $link->id . "/thumb";

                        if (!file_exists($destinationThumbPath)) {
                            mkdir($destinationThumbPath, 757, true);
                        }

                        $thumb_img = Image::make($myFile->getRealPath())->resize(260, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                        $thumb_img->crop(150, 150, 55, 20);

                        $thumb_img->save($destinationThumbPath . '/' . $fileName, 100);

                        $destinationMediumPath = "system/link/" . $link->id . "/medium";

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
                return redirect('/link/list')->with('successMessage', 'Link successfully added');
            } else {
                \DB::rollBack();
                return back()->withInput()->with('errorMessage', 'Link not successfully added');
            }
        } catch (\Exception $e){
            return back()->withInput()->with('errorMessage', 'Link not successfully added'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit($link_id)
    {
        //
        $link = Link::findOrFail($link_id);
        return view('link.edit',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $link_id)
    {
        //
        $link = Link::findOrFail($link_id);
        $link->title = $request->input('title');
        $link->url = $request->input('url');

        if (!empty($request->input('status'))) {
            $link->status = $request->input('status');
        }

        $myFile = $request->file('link_background'); // <-- rename ikut nama input
        if (isset($myFile)) {
            if ($myFile->isValid()) {
                $fileName = $myFile->getClientOriginalName();

                $link->logo_file_name = $fileName;
                $link->logo_file_size = $myFile->getClientSize();
                $link->logo_content_type = $myFile->getClientMimeType();
            }
        }

        if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
            if (!empty($request->input('start_publishing')) || $request->input('status') == 1) {
                $link->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                    ->format('Y-m-d h:i');
            } else {
                $link->start_publishing = Carbon::now()->format('Y-m-d h:i');

            }
        }

        if (!empty($request->input('stop_publishing'))) {
            $link->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                ->format('Y-m-d h:i');
        }

        $link->user_id = Auth::user()->id;

        if ($link->save()) {
            $myFile = $request->file('link_background'); // <-- rename ikut nama input
            if (isset($myFile)) {
                if ($myFile->isValid()) {
                    $destinationPath = "system/link/" . $link->id;
                    $fileName = $myFile->getClientOriginalName();

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 757, true);
                    }

                    $destinationThumbPath = "system/link/" . $link->id . "/thumb";


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

                    $destinationMediumPath = "system/link/" . $link->id . "/medium";


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
            return redirect('/link/list')->with('successMessage', 'Link Successfully added');
        } else {
            return back()->with('errorMessage', 'Link not successfully added');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy($link_id)
    {
        //
        $link = Link::findOrFail($link_id);

        if($link->delete()) {
            return redirect('/link/list')->with('successMessage','Link successfully deleted');
        }
    }

    public function remove_photo($link_id)
    {
        $link = Link::findOrFail($link_id);

        $link->logo_file_name = '';
        $link->logo_content_type = '';
        $link->logo_file_size = 0;

        if ($link->save()) {
            return redirect('/link/'.$link_id.'/edit')->with('successMessage', 'Link photo successfully deleted');
        } else {
            return back()->with('errorMessage', 'Link photo not successfully deleted.');
        }
    }
}
