<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = ['id','room_id','type','value','description'];

    public function rooms(){
        return $this->first('App\Room');
    }
}
