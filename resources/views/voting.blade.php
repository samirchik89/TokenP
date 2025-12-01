@extends('layout.app')
<style>
    .page-content {
        padding: 50px 0px !important;
    }

    .property-list-sec.pos-rel {
        padding: 105px 0px;
    }

    .voting_image {
        width: 100%;
    }
</style>
@section('content')
    <div class="page-content">
        <div class="content">
            <!-- Start container-fluid -->
            <div class="container-fluid wizard-border">
                <!-- Property List Starts -->
                <div class="property-list-sec pos-rel">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="{{ route('votingstore') }}" method="POST">
                                    {{ csrf_field() }}
                                    @forelse($questions as $question)
                                        <h5>Voting</h5>
                                        <input type="hidden" name="type[]" value="{{ $question->question_type }}">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for=""
                                                    class="col-form-label">{{ $question->questions }}</label><br>

                                                @if (empty($question->votes))
                                                    @if ($question->question_type == 1)
                                                        <input type="radio" id="yes_option_1" name="option[{{ $question->id }}]"
                                                            value="1"> Yes

                                                        <input type="radio" id="yes_option_0" name="option[{{ $question->id }}]"
                                                            value="0"> No
                                                    @endif

                                                    @if ($question->question_type == 2)
                                                        @foreach ($question->votechild as $value)
                                                            <input type="radio"
                                                                id="option_{{ $value->question_id }}_{{ $value->id }}"
                                                                name="option[{{ $question->id }}]" value="{{ $value->id }}">
                                                            {{ $value->question_choice }}
                                                        @endforeach
                                                    @endif

                                                    @if ($question->question_type == 3)
                                                        @foreach ($question->votechild as $value)
                                                            <input type="checkbox"
                                                                id="option_{{ $value->question_id }}_{{ $value->id }}"
                                                                name="option[{{ $question->id }}][]" value="{{ $value->id }}">
                                                            {{ $value->question_choice }}
                                                        @endforeach
                                                    @endif
                                                    <div>
                                                        <button class="btn btn-success" type="submit">Submit</button>
                                                    </div>
                                                @else
                                                    @if ($question->question_type == 1)
                                                        @php
                                                            $answer = $question->votes->answer == 1 ? 'Yes' : 'No';
                                                        @endphp

                                                        {{ $answer }}
                                                    @endif

                                                    @if ($question->question_type == 2)
                                                        @foreach ($question->votechild as $value)
                                                            @if ($question->votes->answer == $value->id)
                                                                {{ $value->question_choice }}
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                    @if ($question->question_type == 3)
                                                        <?php $answer = explode(',', $question->votes->answer);
                                                        end($answer);
                                                        $answer_key = key($answer); ?>
                                                        @foreach ($question->votechild as $index => $value)
                                                            @if (isset($answer[$index]))
                                                                @if ($answer[$index] == $value->id)
                                                                    {{ $value->question_choice }}@if ($answer_key != $index)
                                                                        ,
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    <img src="{{ asset('/asset/img/tick.png') }}" alt="" srcset=""
                                                        width="5%">
                                                @endif
                                            </div>

                                            @empty
                                                <div class="row voting_image">
                                                    <div class="col-sm-12 text-center">
                                                        <img src="https://www.stockspots.eu/wp-content/uploads/2019/10/2350619-1.png">
                                                    </div>
                                                </div>
                                        @endforelse
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Property List Ends -->
            </div>
        </div>
    </div>
@endsection
