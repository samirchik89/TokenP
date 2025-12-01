@extends('admin.layout.base')

@section('title', 'Token')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h3> Token Tickets</h3>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Website</th>
                        <th>Bitcointalk</th>
                        <th>Social Media</th>
                        <th>Email</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($addtoken as $index=>$addtoken)
                    <tr>

                        <td>{{ $index + 1 }}</td>
                        <td>{{ $addtoken->website }} </td>
                        <td>{{$addtoken->bitcointalk}}</td>
                        <td>{{$addtoken->reddit}}</td>
                        <td>{{$addtoken->email}}</td>
                        <td>{{$addtoken->description}}</td>
                        <td>
                            @if($addtoken->status == "0")
                            <a href="{{route('admin.addtokendone',$addtoken->id)}}" class="btn btn-success">Done</a>
                            @else($addtoken->status == "1")
                             <b style="color: green;">Support Done</b>
                            @endif
                        </td>
                    </tr>
                     @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
