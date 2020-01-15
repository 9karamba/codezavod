<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_vote extends Model
{
    public function vote() {
        return $this->belongsTo(Vote::class);
    }
}
