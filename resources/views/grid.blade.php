@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <tr class="row">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th colspan="6">
                            <script>
                                sendsearchfunc = function() {$.ajax({
                                    type: 'GET',
                                    url: '/ajax_search',
                                    data: laravel.ajax.formData($('#searchform')),
                                    dataType: 'json',
                                    context: {
                                        sender: event.target,
                                        url: '/ajax_search'
                                    },
                                    success: laravel.ajax.successHandler,
                                    error: laravel.ajax.errorHandler
                                });}
                            </script>
                            <form id="searchform" action="/ajax_search" class="ajax">
                                <input onkeyup="sendsearchfunc();" name="searchinput" type="text">
                                <input onclick="sendsearchfunc();" name="searchtype" type="radio" value="begin" checked> начинается
                                <input onclick="sendsearchfunc();" name="searchtype" type="radio" value="like"> содержит
                            </form>
                        </th>
                    </tr>
                    <tr>
                        <th>Наименование</th>
                        <th>Модель</th>
                        <th>Диаметр</th>
                        <th>Ширина</th>
                        <th>Профиль</th>
                        <th>Розничная цена</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                        @include('partials.tbody')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
