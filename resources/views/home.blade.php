@extends('layouts.app')

@section('content')
    <div id="user-place" class="container" user="{{\Illuminate\Support\Facades\Auth::user()->uuid}}">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button
                    id="articles-list"
                    class="btn btn-outline-success btn-sm">
                    списък статии
                </button>
                <button
                    id="article-content"
                    class="btn btn-outline-success btn-sm">
                    конкретна статия
                </button>
                <button
                    id="article-comment"
                    class="btn btn-outline-success btn-sm">
                    коментар към статия
                </button>
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                <div class="col-md-8 mt-4">
                    <form method="post" action="{{route('articles.store', ['code' => Auth::user()->uuid])}}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>статия номер
                                <input name="article_id" type="number" class="form-control @error('article_id') is-invalid @enderror">
                            </label>
                        </div>
                        <div class="form-group">
                            <label>заглавие
                                <input name="title" type="text" class="form-control @error('title') is-invalid @enderror">
                            </label>
                        </div>
                        <div class="form-group">
                            <label>текст
                                <input name="body" type="text" class="form-control @error('body') is-invalid @enderror">
                            </label>
                        </div>
                        <div class="form-group">
                            <label>таг
                                <input name="tag" type="text" class="form-control @error('tag') is-invalid @enderror">
                            </label>
                        </div>
                        <div class="form-group">
                            <label>илюстрация
                                <input name="image" type="file" class="form-control @error('image') is-invalid @enderror">
                            </label>
                        </div>
                        <button type="submit" class="btn btn-outline-success btn-sm">прати</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

@endsection
