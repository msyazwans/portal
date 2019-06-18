<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use PHPUnit\Runner\Exception;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::whereNull('deleted_at')->get();

        return view('question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('question.create');
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

            $question = new Question();
            $question->title = $request->input('title');
            $question->notes = $request->input('notes');;
            if (!empty($request->input('status'))) {
                $question->status = $request->input('status');
            }


            if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
                if (!empty($request->input('start_publishing')) || $request->input('status') == '1') {
                    $question->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                        ->format('Y-m-d h:i');
                } else {
                    $question->start_publishing = Carbon::now()->format('Y-m-d h:i');

                }
            }
            if (!empty($request->input('stop_publishing'))) {
                $question->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                    ->format('Y-m-d h:i');
            }
            $question->user_id = Auth::user()->id;
            //


            if ($question->save()) {


                \DB::commit();
                return redirect('/question/list')->with('successMessage', 'Question successfully added');
            } else {
                \DB::rollBack();
                return back()->withInput()->with('errorMessage', 'Question not successfully added');
            }
        } catch (\Exception $e){
            \DB::rollBack();
            return back()->withInput()->with('errorMessage', 'Question not successfully added'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($question_id)
    {
        //
        $question = Question::findOrFail($question_id);
        return view('question.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $question_id)
    {
        //
        $question = Question::findOrFail($question_id);
        $question->title = $request->input('title');
        $question->notes = $request->input('notes');

        if (!empty($request->input('status'))) {
            $question->status = $request->input('status');
        }



        if (!empty($request->input('start_publishing')) || !empty($request->input('status'))) {
            if (!empty($request->input('start_publishing')) || $request->input('status') == 1) {
                $question->start_publishing = Carbon::createFromFormat('d-m-Y', $request->input('start_publishing'))
                    ->format('Y-m-d h:i');
            } else {
                $question->start_publishing = Carbon::now()->format('Y-m-d h:i');

            }
        }

        if (!empty($request->input('stop_publishing'))) {
            $question->stop_publishing = Carbon::createFromFormat('d-m-Y', $request->input('stop_publishing'))
                ->format('Y-m-d h:i');
        }

        $question->user_id = Auth::user()->id;

        if ($question->save()) {

            return redirect('/question/list')->with('successMessage', 'Question Successfully added');
        } else {
            return back()->with('errorMessage', 'Question not successfully added');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($question_id)
    {
        //
        $question = Question::findOrFail($question_id);

        if($question->delete()) {
            return redirect('/question/list')->with('successMessage','Question successfully deleted');
        }
    }
}
