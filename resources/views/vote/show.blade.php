@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content card">
            <h1 class="text-muted card-header">Статистика</h1>
            <div class="card-body">
                @if($message != '')
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <h4><strong>{{ $vote->question }}</strong></h4>
                @foreach ($answer_options as $answer)
                    <span><strong>{{ $answer->name }}</strong></span>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{ ($answer->number_voters / $all_voters) * 100 }}%" aria-valuenow="{{ $answer->number_voters }}" aria-valuemin="0" aria-valuemax="{{ $all_voters }}">{{ $answer->number_voters }}</div>
                    </div>
                @endforeach
                <a href="{{ url()->previous() }}" class="btn btn-success">Назад</a>
            </div>
        </div>
    </div>
@endsection