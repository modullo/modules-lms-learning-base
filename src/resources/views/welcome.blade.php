@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection


@section('body_content_main')
    <div class="mt-3">
        LMS learning base

        <div id="app">
            <hello-world></hello-world>
        </div>
    </div>
@endsection

@section('body_js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection


