@extends('layouts.app')

@section('content')
    {{--    <div id="user-place" class="container" user="{{\Illuminate\Support\Facades\Auth::user()->uuid}}">--}}
    <div id="user-place" class="container" user="{{\Illuminate\Support\Facades\Auth::user()->uuid}}">
        <div class="row justify-content-center">
            @php($code = \Illuminate\Support\Facades\Auth::user()->uuid)
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 10%">VERB</th>
                    <th style="width: 20%">URI</th>
                    <th>data</th>
                    {{--                    <th>parameters</th>--}}
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>GET|HEAD</td>
                    <td>api/{code}/articles</td>
                    <td>
                        <form method="GET" action="{{route('articles.index', ['code' => $code])}}">

                            <div class="input-form">

                                    <button type="submit"
                                            id="articles-index"
                                            class="btn btn-outline-success btn-sm">
                                        вземи списък статии
                                    </button>

                                    <label>
                                        <input class="form-control form-control-sm" type="text"
                                               name="tag"
                                               placeholder="?tag={име на таг}">
                                    </label>
                            </div>

                        </form>
                    </td>
                </tr>
                <tr>
                    <td>POST</td>
                    <td>api/{code}/articles</td>
                    <td>
                        <form method="POST" action="{{route('articles.store', ['code' => $code])}}">

                            <div class="input-form">

                                    <button type="submit"
                                            id="articles-index"
                                            class="btn btn-outline-success btn-sm">
                                        запиши нова статия
                                    </button>

                                    <label>
                                        <input class="form-control form-control-sm" type="text"
                                               name="title"
                                               placeholder="?title={име на статия}">
                                    </label>
                                    <label>
                                        <input class="form-control form-control-sm" type="text"
                                               name="body"
                                               placeholder="?body={текст на статия}">
                                    </label>
                            </div>

                        </form>
                    </td>
                </tr>
                <tr>
                    <td>GET</td>
                    <td>api/{code}/articles/{article}</td>
                    <td>
                        <form method="GET" action="{{route('articles.show', ['code' => $code, 'article' => 25])}}">

                            <div class="input-form">
                                    <button type="submit"
                                            id="articles-show"
                                            class="btn btn-outline-success btn-sm">
                                        детайли по статия 25
                                    </button>
                            </div>

                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
