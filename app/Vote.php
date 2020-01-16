<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function update_voters(array $data) {

        $id = $data['vote_id'];
        $vote = Vote::find($id);
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

        return $vote;
    }
}
