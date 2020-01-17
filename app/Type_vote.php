<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Type_vote extends Model
{
    public function vote() {
        return $this->belongsTo(Vote::class);
    }

    public function show() {
        return DB::table('type_vote')
            ->select('id', 'name')
            ->get();
    }
}
