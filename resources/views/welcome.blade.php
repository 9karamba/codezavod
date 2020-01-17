@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content card">
            <h1 class="text-muted card-header">Активное голосование</h1>
            <div class="card-body">
                @guest
                    <h4><strong>Войдите, чтобы увидеть голосование</strong></h4>
                @else
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
                        <form action="/vote" method="post">

                            @csrf

                            <h4><strong>{{ $votes->question }}</strong></h4>
                            @foreach ($answers as $answer)
                                <div class="form-group">
                                    <input type="{{ $votes->type_vote->name }}" id="answer{{ $loop->index }}" name="{{ $votes->type_vote->name != 'checkbox' ? 'answers' : 'answers[]' }}" value="{{ $answer->name }}">
                                    <label class="form-check-label" for="answer{{ $loop->index }}">{{ $answer->name }}</label>
                                </div>
                            @endforeach
                            <input type="hidden" name="vote_id" value="{{ $votes->id }}">
                            <input type="submit" name="statistics" value="Сохранить" class="btn btn-primary">
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
