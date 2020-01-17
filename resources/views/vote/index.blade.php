@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content card">
            <h1 class="text-muted card-header">Админ панель</h1>
            <div class="card-body">
                <a href="/vote/create" class="btn btn-success mb-4">Создать голосование</a>
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Активность</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($votes as $key => $vote)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td><a href="/vote/{{ $vote->id }}">{{ $vote->question }}</a></td>
                                <td>{{ $vote->active ? 'Активно' : '-' }}</td>
                                <td>
                                    @if(!$vote->active)
                                        <form action="/vote/edit" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $vote->id }}">
                                            <input class="btn btn-dark" type="submit" value="Активировать">
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <form action="/vote/delete" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $vote->id }}">
                                        <input class="btn btn-danger" type="submit" value="Удалить">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection