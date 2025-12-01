@extends('admin.layout.base')

@section('title', 'Edit Vote Question ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
            <a href="{{ route('admin.vote.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

			<h5 style="margin-bottom: 2em;">@lang('admin.vote.edit')</h5>

            <form class="form-horizontal" action="{{route('admin.vote.update', $question->id)}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
				<div class="form-group row">
					<label for="promo_code" class="col-xs-2 col-form-label">@lang('admin.vote.edit')</label>
					<div class="col-xs-10">
						<input class="form-control" autocomplete="off"  type="text" value="{{ $question->questions }}" name="question" required id="vote" placeholder="Edit Vote Question">
					</div>
				</div>

				<div class="form-group row">
					<label for="promo_code" class="col-xs-2 col-form-label">@lang('admin.vote.question_type')</label>
					<div class="col-xs-10">
						<select class="form-control" name="question_type" required id="question_type" required="">
							<option value="">Choose Question Type</option>
							<option value="0" @if($question->question_type==0) selected @endif>Yes/No Type</option>
							<option value="1" @if($question->question_type==1) selected @endif >Optional Type</option>
							<option value="2" @if($question->question_type==2) selected @endif>Multiple Choice Type</option>
						</select>
					</div>
				</div>

				<div class="form-group row"  id="choices_section"  @if($question->question_type==0) style="display: none;" @endif>
					<label for="promo_code" class="col-xs-2 col-form-label">Choices</label>
					<div class="col-xs-10" id="choices_block">
					<?php $child_count=count($child); ?>

					@foreach($child as $index => $value)
						<input class="form-control" autocomplete="off"  type="text" name="choice[]" required id="choice_{{$index+1}}" placeholder="Enter your choice" value="{{$value->question_choice}}"> 
						<button id="remove_choice_{{$index+1}}" class="remove"  type="button"><i class="fa fa-times"></i></button>
					@endforeach						
					</div>
					<div class="col-xs-10 col-xs-offset-2">
						<button class="btn btn-info" id="add_choice" type="button">+ Add Choice</button>
					</div>
				</div>
                
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">@lang('admin.vote.edit')</button>
						<a href="{{route('admin.vote.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    $(document).ready(function() {

    	var choice=<?php echo $child_count; ?>;

        $('#question_type').click(function() {
        	var id=$(this).val();
        	//alert(id);
        	if(id!=0 && id!=1){
        		$('#choices_section').show();
        	}
        	else{
        		//$('#choices_block').html('');
        		$('#choices_section').hide();
        	}
        });

        $('#add_choice').click(function(e) {
        	choice = choice + 1;
        	var html='<input class="form-control" autocomplete="off"  type="text" name="choice[]" required id="choice_'+choice+'" placeholder="Enter your choice"> <button id="remove_choice_'+choice+'" class="remove"  type="button"><i class="fa fa-times"></i></button>';

    		$('#choices_block').append(html);

    		$('.remove').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                alert(fieldNum);
                var fieldID = "#choice_" + fieldNum;
                $(this).remove();
                $(fieldID).remove();

            });
        });

        $('.remove').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                //alert(fieldNum);
                var fieldID = "#choice_" + fieldNum;
                $(this).remove();
                $(fieldID).remove();

            });

    });
</script>
@endsection

