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
            <div class="col-12">
                <a href="{{route('rooms.create')}}" class="btn btn-success float-right col-md-12 mb-3">등록</a>
            </div>
            <div class="col-12">
                <select name="" id="sort" class="form-control mb-3">
                    <option value="new">최신순</option>
                    <option value="average">평점순</option>
                </select>
            </div>
            <div class="col" id="rooms">
            </div>
        </div>
    </div>
@endsection

@section('script.plugins')
    <script type="text/javascript">
        var rooms = @json($rooms);

        $(function () {
            sort();
            $('#sort').change(function () {
                sort();
            });
        })

        function sort() {
            var sort = $('#sort option:selected').val();
            switch (sort) {
                case 'new':
                    rooms.sort(function (a, b) {
                        return b.id - a.id;
                    });
                    content();
                    break;
                case 'average':
                    rooms.sort(function (a, b) {
                        return (a.average > b.average) ? -1 : (a.average < b.average) ? 1 : 0;
                    });
                    content();
                    break;
            }
        }

        function content() {
            $('#rooms .card').remove();
            for ($i = 0; $i < Object.keys(rooms).length; $i++) {
                var content =
                    '<a href="rooms/'+rooms[$i].id+'" style="text-decoration: none;color: #646464;">' +
                    '<div class="card mb-3">\n' +
                    '<div class="card-body">' +

                    '<p>방제목:' + rooms[$i].name + '</p>\n' +
                    '<p>중개사:' + rooms[$i].broker + '</p>\n' +
                    '<p>주소:' + rooms[$i].address + '</p>\n' +
                    '<p>평점:' + rooms[$i].average + '' +
                    '<span class="fa fa-star checked"></span>' +
                    '<span class="fa fa-star checked"></span>' +
                    '<span class="fa fa-star checked"></span>' +
                    '<span class="fa fa-star checked"></span>' +
                    '<span class="fa fa-star checked"></span>' +
                    '</p>\n' +
                    '</div>\n' +
                    '</div>'
                '</a>';
                $('#rooms').append(content);
            }
        }
    </script>
@endsection