<?php

namespace App\Http\Controllers;

use App\CheckList;
use App\Information;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $rooms = Room::where('user_id', auth()->user()->id)->get();

        foreach ($rooms as $room) {
            $room->average = $room->average();
        }
        return view('rooms.index', ['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $room = new Room();
        $room->user_id = $request->user_id;
        $room->name = $request->name;
        $room->address = $request->address;
        $room->broker = $request->broker;
        $room->save();
        return redirect('/rooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show(Room $room)
    {
        //자신만보기
        if ($room->user_id == auth()->user()->id) {
            //평점계산
            $averages = Information::where([['type', 'point'], ['room_id', $room->id]])->get();
            if ($averages->count() > 0) {
                $sum = 0;
                foreach ($averages as $average) {
                    $sum += ($average->value * 5);
                }
                $sumAvg = (($sum) / ($averages->count() * 5));
                $sumAvg = round($sumAvg, 2);
                return view('rooms.show', ['room' => $room, 'sumAvg' => $sumAvg]);
            } else {
                return view('rooms.show', ['room' => $room]);
            }

        } else {
            echo "<script>alert('잘못된 접근입니다.')</script>";
            return redirect('/rooms');
        }
    }

    public function information(Request $request)
    {
        //type의 0,1,2,..의키값으로 다른 배열에 키를 넣어 값출력
        foreach ($request->type as $k => $v) {
            $information = new Information();
            $information->room_id = $request->room_id;
            $tmp = [];
            $tmp['type'] = $request->type[$k];
            $tmp['value'] = $request->value[$k];
            $tmp['description'] = $request->description[$k];


            $information->type = $tmp['type'];
            $information->value = $tmp['value'];
            $information->description = $tmp['description'];

            $information->save();
        }

        return redirect('/rooms');
    }

    public function check(Room $room)
    {
        return view('rooms.check', ['room' => $room]);
    }

    public function checkEdit(Request $request, Room $room)
    {
        if (empty($request->type)) {
            //information의 값이 없때 오류남
        } else {
            //인포의 id 값을 받아올때가 없으니 find로 찾아서 넣어주기
            foreach ($request->type as $k => $v) {
                $information = Information::find($request->id[$k]);
                if (isset($information)) {
                    $information->type = $request->type[$k];
                    $information->value = $request->value[$k];
                    $information->description = $request->description[$k];
                    $information->save();
                } else {
                    $information = new Information();
                    $information->room_id = $room->id;
                    $tmp = [];
                    $tmp['type'] = $request->type[$k];
                    $tmp['value'] = $request->value[$k];
                    $tmp['description'] = $request->description[$k];

                    $information->type = $tmp['type'];
                    $information->value = $tmp['value'];
                    $information->description = $tmp['description'];
                    $information->save();
                }
            }
        }

        $room->name = $request->name;
        $room->address = $request->address;
        $room->broker = $request->broker;
        $room->update();

        return redirect('/rooms/' . $room->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {

        $checklists = CheckList::all();
        //가상의 배열생성해서 배열에 description모든값을 출력하고 값이없으면 제거해서 출력
        $tmp = [];

        foreach ($checklists as $checklist) {
            $tmp[$checklist->description] = $checklist->type;
        }

        foreach ($room->informations as $information) {
            unset($tmp[$information->description]);
        }

        if ($room->user_id == auth()->user()->id) {
            if (empty($tmp)) {
                echo "<script>alert('모든값을 추가 하셨습니다.');",
                "history.go(-1)</script>";
                return redirect('/rooms');
            } else {
                return view('rooms.edit', ['room' => $room, 'checklists' => $tmp]);
            }
        } else {
            echo "<script>alert('잘못된 접근입니다.');",
            "history.go(-1)</script>";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $room->name = $request->name;
        $room->broker = $request->broker;
        $room->address = $request->address;
        $room->save();

        return view('rooms.edit', ['room' => $room]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
