@extends('admin.layout.base')

@section('title', 'Vote ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">

            <div class="box box-block bg-white">

                <h5 class="mb-1">@lang('admin.vote.vote')</h5>
                <a href="{{ route('admin.vote.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> @lang('admin.vote.add')</a>

                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.vote.question')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $index => $question)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $question->questions }}</td>
                                <td>@if($question->status == 1) <a href="{{ url('admin/vote/status/'.$question->id) }}"><button class="btn btn-success">Active</button></a> @else <a href="{{ url('admin/vote/status/'.$question->id) }}"><button class="btn btn-danger">In-active</button></a> @endif</td>
                                <td>
                                    <a href="{{ route('admin.vote.edit', $question->id) }}"><button class="btn btn-primary">Edit</button></a>

                                    <a href="{{ route('admin.vote.voteresult', $question->id) }}"><button class="btn btn-info">View Vote Result</button></a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
