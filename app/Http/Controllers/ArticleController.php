<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use PHPUnit\Runner\Exception;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::whereNull('deleted_at')
            ->get();

        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('article.create');
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

            $article = new Article();
            $article->title = $request->input('title');
            $article->notes = $request->input('notes');
            if (!empty($request->input('status'))) {
                $article->status = $request->input('status');
            }
            $myFile = $request->file('article_background');
            if (isset($myFile)) {
                if ($myFile->isValid()) {
                    $fileName = $myFile->getClientOriginalName();

                    $article->logo_file_name = $fileName;
                    $article->logo_file_size = $myFile->getSize();
                    $article->logo_content_type = $myFile->getClientMimeType();

                }
            }

            if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
                if (!empty($request->input('start_publishing')) || $request->input('status') == '1') {
                    $article->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                        ->format('Y-m-d h:i');
                } else {
                    $article->start_publishing = Carbon::now()->format('Y-m-d h:i');

                }
            }
            if (!empty($request->input('stop_publishing'))) {
                $article->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                    ->format('Y-m-d h:i');
            }
            $article->user_id = Auth::user()->id;
            //


            if ($article->save()) {

                $myFile = $request->file('article_background'); // <-- rename ikut nama input
                if (isset($myFile)) {
                    if ($myFile->isValid()) {
                        $destinationPath = "system/article/" . $article->id;
                        $fileName = $myFile->getClientOriginalName();


                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 757, true);
                        }

                        $destinationThumbPath = "system/article/" . $article->id . "/thumb";

                        if (!file_exists($destinationThumbPath)) {
                            mkdir($destinationThumbPath, 757, true);
                        }

                        $thumb_img = Image::make($myFile->getRealPath())->resize(260, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                        $thumb_img->crop(150, 150, 55, 20);

                        $thumb_img->save($destinationThumbPath . '/' . $fileName, 100);

                        $destinationMediumPath = "system/article/" . $article->id . "/medium";

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
                return redirect('/article/list')->with('successMessage', 'Article successfully added');
            } else {
                \DB::rollBack();
                return back()->withInput()->with('errorMessage', 'Article not successfully added');
            }
        } catch (\Exception $e){
            return back()->withInput()->with('errorMessage', 'Article not successfully added'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($article_id)
    {
        //
        $article = Article::findOrFail($article_id);
        return view('article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $article_id)
    {
        //
        //
        $article = Article::findOrFail($article_id);
        $article->title = $request->input('title');
        $article->notes = $request->input('notes');

        if (!empty($request->input('status'))) {
            $article->status = $request->input('status');
        }

        $myFile = $request->file('article_background'); // <-- rename ikut nama input
        if (isset($myFile)) {
            if ($myFile->isValid()) {
                $fileName = $myFile->getClientOriginalName();

                $article->logo_file_name = $fileName;
                $article->logo_file_size = $myFile->getClientSize();
                $article->logo_content_type = $myFile->getClientMimeType();
            }
        }

        if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
            if (!empty($request->input('start_publishing')) || $request->input('status') == 1) {
                $article->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                    ->format('Y-m-d h:i');
            } else {
                $article->start_publishing = Carbon::now()->format('Y-m-d h:i');

            }
        }

        if (!empty($request->input('stop_publishing'))) {
            $article->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                ->format('Y-m-d h:i');
        }

        $article->user_id = Auth::user()->id;

        if ($article->save()) {
            $myFile = $request->file('article_background'); // <-- rename ikut nama input
            if (isset($myFile)) {
                if ($myFile->isValid()) {
                    $destinationPath = "system/article/" . $article->id;
                    $fileName = $myFile->getClientOriginalName();

                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 757, true);
                    }

                    $destinationThumbPath = "system/article/" . $article->id . "/thumb";


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

                    $destinationMediumPath = "system/article/" . $article->id . "/medium";


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
            return redirect('/article/list')->with('successMessage', 'Article Successfully added');
        } else {
            return back()->with('errorMessage', 'Article not successfully added');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($article_id)
    {
        //
        $article = Article::findOrFail($article_id);

        if($article->delete()) {
            return redirect('/article/list')->with('successMessage','Article successfully deleted');
        }
    }

    public function remove_photo($article_id)
    {
        $article = Article::findOrFail($article_id);

        $article->logo_file_name = '';
        $article->logo_content_type = '';
        $article->logo_file_size = 0;

        if ($article->save()) {
            return redirect('/article/'.$article_id.'/edit')->with('successMessage', 'Article photo successfully deleted');
        } else {
            return back()->with('errorMessage', 'Article photo not successfully deleted.');
        }
    }
}
