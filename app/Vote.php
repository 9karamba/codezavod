<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function type_vote() {
        return $this->hasOne(Type_vote::class);
    }

    public static function show_active() {
        return static::join('type_vote', function ($join) {
            $join->on('votes.type_vote_id', '=', 'type_vote.id')
                 ->where('votes.active', '=', 1);
        })
        ->get();;
    }
}
