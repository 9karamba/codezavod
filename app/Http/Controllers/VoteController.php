<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Vote;

class VoteController extends Controller
{
    public function active() {
        $votes = App\Vote::show_active();
        foreach ($votes as $vote) :
            $answers = json_decode($vote->answer_options);
        endforeach;
        return view('welcome', compact('votes', 'answers'));
    }

    public function update() {

        $this->validate(request(),[
            'vote_id' => 'required',
            'answers' => 'required',
        ]);

        $vote = (new Vote())->update_voters(request()->all());
        return redirect()->route('show', [$vote->id]);
    }

    public function show(Vote $vote) {
        $answer_options = json_decode($vote->answer_options);
        $all_voters = $vote->all_voters ?? 1;
        return view('vote.show', compact('vote', 'answer_options', 'all_voters'));
    }
}
