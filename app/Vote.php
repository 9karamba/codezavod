<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Vote extends Model
{
    public function type_vote() {
        return $this->belongsTo(Type_vote::class);
    }

    public function user_votes() {
        return $this->hasOne(User_vote::class);
    }

    public static function show_active() {
        $user = Auth::user();
        $vote = static::where('active', 1)->with('type_vote')->get()[0];

        if(Auth::check() && $user->admin) :
            return 'Администраторы не голосуют :( Но вы можете посмотреть статистику в своем профиле.';
        elseif(Auth::check() && isset($vote->id) && !DB::table('user_votes')->where('user_id', $user->id)->where('vote_id', $vote->id)->get()->count()) :
            return $vote;
        else :
            return isset($vote->id) ? 'Вы уже проголосовали.' : 'Активного голосования пока нет';
        endif;
    }

    public static function show_all() {
        $user = Auth::user();
        $admin = $user->admin;

        if($admin) :
            return static::select('id', 'question', 'active')->get();
        else :
            return 'Здесь могла быть реклама. Ну или информация о '. $user->name;
        endif;
    }

    public static function update_voters(array $data) {

        $user = Auth::user();
        $id = $data['vote_id'];
        $vote = Vote::find($id);

        if(!DB::table('user_votes')->where('user_id', $user->id)->where('vote_id', $vote->id)->get()->count()) :
            $answer = $data['answers'];
            $answer_options = json_decode($vote->answer_options);
            
            if(!is_array($answer)) {
                foreach (json_decode($vote->answer_options) as $key => $value) :
                    if($value->name == $answer){
                        $answer_options[$key]->number_voters++;
                    }
                endforeach;
            }
            else {
                foreach ($answer as $ans) :
                    foreach (json_decode($vote->answer_options) as $key => $value) :
                        if($value->name == $ans){
                            $answer_options[$key]->number_voters++;
                        }
                    endforeach;
                endforeach;
            }
            
            DB::table('votes')
                ->where('id', $id)
                ->update([
                    'all_voters' => $vote->all_voters + 1,
                    'answer_options' => $answer_options
                ]);

            $user_vote = new User_vote();
            $user_vote->user_id = $user->id;
            $user_vote->vote_id = $vote->id;
            $user_vote->save();
        endif;

        return static::where('id', $vote->id)->get(); //where('id', $vote->id)->with('user_votes')->get()
    }

    public function edit_active(string $id) {
        DB::table('votes')
            ->where('active', 1)
            ->update([
                'active' => 0,
            ]);
        DB::table('votes')
            ->where('id', $id)
            ->update([
                'active' => 1
            ]);
    }
}
