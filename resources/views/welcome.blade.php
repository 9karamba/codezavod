@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content card">
            <h1 class="text-muted card-header">Активное голосование</h1>
            <div class="card-body">
                @if(!isset($votes))
                    <h4><strong>{{ $message }}</strong></h4>
                @else
                    @if($errors->count())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @foreach ($votes as $vote)
                        <form action="/vote" method="post">

                        @csrf

                            <h4><strong>{{ $vote->question }}</strong></h4>
                            @foreach ($answers as $answer)
                                <div class="form-group">
                                    <input type="{{ $vote->type_vote->name }}" id="answer{{ $loop->index }}" name="{{ $vote->type_vote->name != 'checkbox' ? 'answers' : 'answers[]' }}" value="{{ $answer->name }}">
                                    <label class="form-check-label" for="answer{{ $loop->index }}">{{ $answer->name }}</label>
                                </div>
                            @endforeach
                            <input type="hidden" name="vote_id" value="{{ $vote->id }}">
                            <input type="submit" name="statistics" value="Сохранить" class="btn btn-primary">
                        </form>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
