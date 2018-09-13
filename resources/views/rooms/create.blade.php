@extends('layouts.app2')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        기본정보 등록
                    </div>
                    <div class="card-body">
                        <form action="{{route('rooms.store')}}" method="post">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                            @csrf
                            <div class="form-group">방이름(간단히 기억할만한):
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group"> 주소:
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="form-group">중개사:
                                <input type="text" class="form-control" name="broker">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">등록</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection