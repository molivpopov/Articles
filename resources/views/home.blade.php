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
        </div>
    </div>

@endsection
