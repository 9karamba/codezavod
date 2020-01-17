<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Type_vote extends Model
{
    public function vote() {
        return $this->hasOne(Vote::class)
                    ->withDefault(['name' => 'radio']);
    }

    public function show() {
        return DB::table('type_votes')
            ->select('id', 'name')
            ->get();
    }
}
