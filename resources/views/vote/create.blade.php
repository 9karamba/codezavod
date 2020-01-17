@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content content-create card">
            <h1 class="text-muted card-header">Добавить голосование</h1>
            <div class="card-body">
                @if($errors->count())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/home" method="post">

                    @csrf

                    <h4><strong>Введите вопрос:</strong></h4>
                    <input class="form-control mb-4" name="question" type="text" placeholder="Вопрос">

                    <h4><strong>Выберите тип голосования:</strong></h4>
                    <select name="type" class="form-control mb-4">
                        @foreach ($type_votes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>

                    <h4><strong>Введите ответы:</strong></h4>
                    <div class="form-group form-for-add-input">
                        <input class="form-control mb-4" type="text" name="answers[]" placeholder="Ответ">
                    </div>
                    <p><strong>Нажмите чтобы добавить поле ответа: <a href="" class="badge badge-danger" id="add-input">+</a></strong></p>
                    <input class="btn btn-success" type="submit" value="Создать">
                </form>
            </div>
        </div>
    </div>
@endsection