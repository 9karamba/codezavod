<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Vote;
use App\Type_vote;

class VoteController extends Controller
{
    public function active() {
        $votes = App\Vote::show_active();
        if(isset($votes)) :
            foreach ($votes as $vote) :
                $answers = json_decode($vote->answer_options);
            endforeach;
            return view('welcome', compact('votes', 'answers'));
        else :
            $message = 'Активных голосований нет.';
            return view('welcome', compact('message'));
        endif;
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
        $all_voters = (int)($vote->all_voters) ? $vote->all_voters : 1;
        return view('vote.show', compact('vote', 'answer_options', 'all_voters'));
    }

    public function index() {
        $votes = App\Vote::show_all();
        return view('vote.index', compact('votes'));
    }

    public function create() {
        $type_votes = (new Type_vote())->show();
        return view('vote.create', compact('type_votes'));
    }

    public function store() {
        $this->validate(request(),[
            'question' => 'required',
            'type' => 'required',
            'answers' => 'required',
        ]);

        $vote = new Vote();

        $vote->question = request('question');
        $vote->type_vote_id = request('type');
        $answer_options = [];

        foreach(request('answers') as $answer) {
            if(trim($answer) != '') {
                $answer_options[] = (object)[
                    'name' => $answer,
                    'number_voters' => 0,
                ];
            }
        }

        $vote->answer_options = json_encode($answer_options);
        $vote->save();
        return redirect()->route('home');
    }

    public function destroy() {
        $this->validate(request(),[
            'id' => 'required',
        ]);

        App\Vote::where('id', '=', request('id'))->delete();
        return redirect()->route('home');
    }

    public function edit() {
        $this->validate(request(),[
            'id' => 'required',
        ]);

        $success = (new Vote())->edit_active(request('id'));
        return redirect()->route('home');
    }
}
