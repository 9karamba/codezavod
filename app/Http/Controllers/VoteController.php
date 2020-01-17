<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Vote;
use App\Type_vote;

class VoteController extends Controller
{
    /*
    *   Выводит активное голосование
    */
    public function active() {
        $votes = App\Vote::show_active();
        if(isset($votes) && !is_string($votes)) :
            $answers = json_decode($votes->answer_options);
            return view('welcome', compact('votes', 'answers'));
        else :
            $message = is_string($votes) ? $votes : 'Активных голосований нет.';
            return view('welcome', compact('message'));
        endif;
    }

    /*
    *   Вызывается когда пользователь голосует 
    *   (прибавляет голоса)
    */
    public function update() {

        $this->validate(request(),[
            'vote_id' => 'required',
            'answers' => 'required',
        ]);

        $vote = (new Vote())->update_voters(request()->all())[0];
        return redirect()->route('show', [$vote->id]);
    }

    /*
    *   Показывает статистику по голосованию
    */
    public function show(Vote $vote) {
        $answer_options = json_decode($vote->answer_options);
        $all_voters = (int)($vote->all_voters) ? $vote->all_voters : 1;
        return view('vote.show', compact('vote', 'answer_options', 'all_voters'));
    }

    /*
    *   Выводит все голосования
    */
    public function index() {
        $votes = App\Vote::show_all();
        $admin = is_string($votes) ? false : true;

        return view('vote.index', compact('votes', 'admin'));
    }

    /*
    *   Выводит типы голосования и форму для создания голосования
    */
    public function create() {
        $type_votes = (new Type_vote())->show();
        return view('vote.create', compact('type_votes'));
    }

    /*
    *   Создает голосование
    */
    public function store() {
        $this->validate(request(),[
            'question' => 'required',
            'type' => 'required',
            'answers' => 'required',
        ]);

        (new Vote())->create(request()->all());
        return redirect()->route('home');
    }

    /*
    *   Удаляет голосование
    */
    public function destroy() {
        $this->validate(request(),[
            'id' => 'required',
        ]);

        App\Vote::where('id', '=', request('id'))->delete();
        return redirect()->route('home');
    }

    /*
    *   Делает голосование активным
    */
    public function edit() {
        $this->validate(request(),[
            'id' => 'required',
        ]);

        $success = (new Vote())->edit_active(request('id'));
        return redirect()->route('home');
    }
}
