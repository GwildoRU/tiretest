@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Загрузка прайс-листа</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/doupload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label">Файл прайс-листа:</label>

                            <div class="col-md-6">
                                <input type="file" name="file" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Загрузить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="https://cloud.mail.ru/public/8dd4/rAohnHJec">Скачать тестовый файл прайс-листа</a>
                </div>
            </div>
        </div>
    </div>
@endsection

