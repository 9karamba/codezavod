<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_vote extends Model
{
    public function vote() {
        return $this->belongsTo(Vote::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
