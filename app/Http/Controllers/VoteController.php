<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\Votequestion;
use App\VoteQuestionChild;
class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Votequestion::all();
        return view('admin.vote.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vote.create');
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
            'question' => 'required',
            'question_type' => 'required',            
            'choice'=>'required_if:question_type,2|required_if:question_type,3',
        ]);

        try {
            $model = new Votequestion;
            $model->questions = $request->question;
            $model->question_type = $request->question_type;
            $model->save();

            if(isset($request['choice'])){
                foreach ($request['choice'] as $key => $value) {
                    
                    $vote_child = new VoteQuestionChild;
                    $vote_child->question_id=$model->id;
                    $vote_child->question_choice=$value;
                    $vote_child->save();

                }

            }
            return back()->with('flash_success', 'Question Added Successfully');
        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Something went wrong. Please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       try {
            $question = Votequestion::find($id);
            $child=VoteQuestionChild::where('question_id',$id)->get();

            return view('admin.vote.edit', compact('question','child'));

        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Something went wrong. Please try again');
        }
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
        //dd($request);
        $this->validate($request, [
            'question' => 'required',
            'question_type' => 'required',            
            'choice'=>'required_if:question_type,2|required_if:question_type,3',
        ]);

        try {
            $question = Votequestion::find($id);
            $question->questions = $request->question;
            $question->question_type = $request->question_type;
            $question->save();

            $child=VoteQuestionChild::where('question_id',$id)->delete();

            if(isset($request['choice'])){
                foreach ($request['choice'] as $key => $value) {
                    
                    $vote_child = new VoteQuestionChild;
                    $vote_child->question_id=$question->id;
                    $vote_child->question_choice=$value;
                    $vote_child->save();

                }

            }
            return back()->with('flash_success', 'Question Updated Successfully');
        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Oops something went wrong. Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Change statue of the specified resource
     *
     * @param   int  $id 
     *
     * @return  \Illuminate\Http\Response
     */
    public function status($id)
    {
        try {
            $votequestion = Votequestion::find($id);
            $votequestion->status = ($votequestion->status == 1) ? 0 : 1;
            $votequestion->save();
            return back()->with('flash_success', 'Status Updated Successfully'); 
        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Something went wrong. Please try again');
        }
    }

    public function voteresult($id)
    {
        try {
                        
            $votes = Vote::where('question_id',$id)->with('votequestion')->get();
                        
            return view('admin.vote.result',compact('votes')); 

        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Something went wrong. Please try again');
        }
    }


}
