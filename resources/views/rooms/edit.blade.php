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
                <div class="breadcrumb">
                    <div class="breadcrumb-item">등록2단계</div>
                    <div class="breadcrumb-item">내용추가</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-body">
                        두꺼비의 헌집
                        <span class="badge badge-pill badge-success mb-3">check!</span>
                        <form action="{{route('rooms.information'),$room->id}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$room->id}}" name="room_id">
                            <div class="addpoint">
                                <p>방이름 : {{$room->name}}</p>
                                <p>주소 : {{$room->address}}</p>
                                <p>중개사 : {{$room->broker}}</p>
                                @foreach($room->informations as $information)
                                    @if($information->type == "text")
                                        @if($information->count() >  15)
                                            <p>{{$information->description}} : {{$information->value}}</p>
                                        @endif
                                    @else
                                        <p>{{$information->description}} : {{$information->value}}
                                            @for($i=0; $i<$information->value; $i++)
                                                <span class="fa fa-star checked"></span>
                                            @endfor
                                        </p>
                                    @endif
                                @endforeach
                                {{--<div class="form-group">--}}
                                {{--<b class="text-secondary">모든 항목을 추가했습니다.</b>--}}
                                {{--</div>--}}
                            </div>
                            <button class="btn btn-info" type="submit">등록</button>
                            <button class="btn btn-primary float-right" type="button" data-toggle="modal"
                                    data-target="#myModal"><i class="fa fa-plus"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">내용추가</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <select class="check form-control">
                        <option class="dropdown-item checklist" value="">추가항목</option>
                        @foreach($checklists as $key => $value)
                            <option class="dropdown-item checklist" value="{{$value}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-primary add">추가</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script.plugins')
    <script src="/js/AddInput.js"></script>
@endsection