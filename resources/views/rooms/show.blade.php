@extends('layouts.app2')

@section('css.plugins')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        .checked {
            color: orange;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3>{{$room->name}}</h3>
                        <p>{{$room->broker}}</p>
                        <p>{{$room->address}}</p>
                        @foreach($room->informations->sortByDesc('type') as $information)
                            <p>
                                {{$information->description}} : <span class="average">{{$information->value}}</span>
                                @if($information->type == "point")
                                    @for($i=1; $i<=$information->value; $i++)
                                        <span class="fa fa-star checked" data-value="{{$i}}"></span>
                                    @endfor
                                @endif
                            </p>
                        @endforeach
                    </div>
                    @if(empty($room->average($room->id)))
                        <div class="card-footer">
                            평점을 추가해주세요
                        </div>
                    @else
                        <div class="card-footer">
                            평점:{{$room->average($room->id)}}
                            <span class="fa fa-star {{$room->average($room->id) >= 1 ? "checked" : ""}}"></span>
                            <span class="fa fa-star {{$room->average($room->id) >= 2 ? "checked" : ""}}"></span>
                            <span class="fa fa-star {{$room->average($room->id) >= 3 ? "checked" : ""}}"></span>
                            <span class="fa fa-star {{$room->average($room->id) >= 4 ? "checked" : ""}}"></span>
                            <span class="fa fa-star {{$room->average($room->id) >= 5 ? "checked" : ""}}"></span>
                            (별점값만)
                        </div>
                    @endif
                </div>
                <a href="{{route('rooms.edit',$room->id)}}" class="btn btn-info float-right  add">추가</a>
                <a href="{{route('rooms.check',$room->id)}}" class="btn btn-info float-right mr-1 add">수정</a>
            </div>
        </div>
    </div>
@endsection

@section('script.plugins')
    <script>
        $(document).ready(function () {
            $()
        });
    </script>
@endsection