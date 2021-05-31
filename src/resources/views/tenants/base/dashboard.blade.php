@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection


@section('body_content_main')

    @include('modules-lms-base::modules-lms-base.src.resources.views.navigation',['type' => 'learner'])
    <div class="container p-5">
       Dashboard
    </div>

@endsection

@section('body_js')

    {{--    <script src="{{ asset('js/app.js') }}"></script>--}}
@endsection


