<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class VoteController extends Controller
{
    public function active() {
        $votes = App\Vote::show_active();
        foreach ($votes as $vote) :
            $answers = json_decode($vote->answer_options);
        endforeach;
        return view('welcome', compact('votes', 'answers'));
    }
}
