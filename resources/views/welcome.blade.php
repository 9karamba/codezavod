@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content card">
            <h1 class="text-muted card-header">Активное голосование</h1>
            <form action="" method="post" class="card-body">
                @foreach ($votes as $vote)
                    <h4><strong>{{ $vote->question }}</strong></h4>
                    @foreach ($answers as $answer)
                        <div class="form-group">
                            <input type="{{ $vote->name }}" id="answer{{ $loop->index }}" name="{{ $vote->name != 'checkbox' ? 'answers' : 'answers[]' }}" value="{{ $answer->name }}">
                            <label class="form-check-label" for="answer{{ $loop->index }}">{{ $answer->name }}</label>
                        </div>
                    @endforeach
                    <input type="submit" name="statistics" value="Отправить" class="btn btn-primary">
                @endforeach
            </form>
        </div>
    </div>
@endsection
