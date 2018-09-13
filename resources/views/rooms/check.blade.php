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
                        <form action="{{route('rooms.checkEdit',$room->id)}}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="form-group">방이름:<input type="text" class="form-control" value="{{$room->name}}"
                                                               name="name"></div>
                            <div class="form-group">중개사:<input type="text" class="form-control"
                                                               value="{{$room->broker}}" name="broker"></div>
                            <div class="form-group">주소:<input type="text" class="form-control"
                                                              value="{{$room->address}}" name="address"></div>
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                            @foreach($room->informations as $information)
                                <span class="description">{{$information->description}}</span>
                                @if($information->type == "text")
                                    <div class="form-group">
                                        <input type="hidden" value="{{$information->id}}" name="id[]">
                                        <input type="text" class="form-control"
                                               value="{{$information->value}}" name="value[]">
                                        <input type="hidden" value="text" name="type[]">
                                        <input type="hidden" value="{{$information->description}}" name="description[]">
                                    </div>
                                @else
                                    <div class="form-group">
                                        <span class="rate">{{$information->value}}</span>
                                        <span class="fa fa-star checked" data-value="1" onclick="rating()"></span>
                                        <span class="fa fa-star {{$information->value > 1  ? "checked" : ""}}"
                                              data-value="2" onclick="rating()"></span>
                                        <span class="fa fa-star {{$information->value > 2  ? "checked" : ""}}"
                                              data-value="3" onclick="rating()"></span>
                                        <span class="fa fa-star {{$information->value > 3  ? "checked" : ""}}"
                                              data-value="4" onclick="rating()"></span>
                                        <span class="fa fa-star {{$information->value > 4  ? "checked" : ""}}"
                                              data-value="5" onclick="rating()"></span>
                                        <input type="hidden" value="{{$information->id}}" name="id[]">
                                        <input type="hidden" value="{{$information->value}}" name="value[]">
                                        <input type="hidden" value="point" name="type[]">
                                        <input type="hidden" value="{{$information->description}}" name="description[]">
                                    </div>
                                @endif
                            @endforeach
                            <button class="btn btn-warning float-right" type="submit">수정</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script.plugins')
    <script src="/js/star.js"></script>
    <script>
        $(document).ready(function () {
            $('.fa-star').click(function () {
                var $this = $(this);
                $this.siblings('.rate').text($this.data('value'));
            });

        });
    </script>
@endsection