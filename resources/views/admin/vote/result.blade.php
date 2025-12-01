@extends('admin.layout.base')

@section('title', 'Vote Result')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
               
                <h5 class="mb-1">@lang('admin.vote.vote')</h5>

                <a href="{{ route('admin.vote.index') }}" style="margin-left: 1em;" class="btn btn-primary pull-right">
                    <i class="fa fa-arrow-left"></i> Back
                </a>

                <div>
                    <p>Question : @if(count($votes)>0) {{$votes[0]['votequestion']['questions']}} @endif</p>
                    <p>Question Type: @if(count($votes)>0) @if($votes[0]['votequestion']['question_type']==0) Yes/No 
                    @elseif($votes[0]['votequestion']['question_type']==1)  Optional @elseif($votes[0]['votequestion']['question_type']==2) Multiple Choice @endif @endif</p>

                    
                    <table class="table table-striped table-bordered dataTable" id="table-2">
                        <thead>
                            <td>S.No</td>
                            <td>User</td>
                            <td>Answer</td>
                        </thead>
                        <tbody>
                        @forelse($votes as $index => $value)
                            <tr>
                                <?php $question_type=$value->votequestion->question_type; ?>

                                <td>{{$index+1}}</td>
                                <td>{{$value->user->name}}</td>
                                <td>
                                @if($question_type==0)
                                    @php 
                                        $answer = ($value->answer == 1) ? "Yes" : "No"; 
                                    @endphp  

                                    {{$answer}} 
                                @endif
                                    
                                @if($question_type==1)
                                    @foreach($value->votequestion->votechild as $value1)
                                        @if($value->answer==$value1->id)       
                                            {{$value1->question_choice}}
                                        @endif
                                    @endforeach
                                @endif
                                   
                                @if($question_type==2)
                                    
                                    <?php 
                                        $answer=explode(',', $value->answer); 
                                        end($answer); 
                                        $answer_key = key($answer); 
                                    ?>

                                    @foreach($value->votequestion->votechild as $index => $value1)
                                        @if(isset($answer[$index]))       
                                            @if($answer[$index]==$value1->id)       
                                                {{$value1->question_choice}}@if($answer_key!=$index),
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                    </table>
                </div>
               
            </div>
            
        </div>
    </div>
@endsection