<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['user_id','name','broker','address'];

    public function informations(){
        return $this->hasMany('App\Information');
    }

    function average(){
        $informations = Information::where([['type', 'point'], ['room_id', $this->id]])->get();
        if ($informations->count() > 0) {
            $sum = 0;
            foreach ($informations as $information) {
                $sum += ($information->value * 5);
            }
            $sumAvg = (($sum) / ($informations->count() * 5));
            $sumAvg = round($sumAvg, 2);
            return $sumAvg;
        }
    }
}
