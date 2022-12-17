@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection


@section('body_content_main')

    @include('modules-lms-base::navigation',['type' => 'learner'])
    <section class="continue_learning">
        <div class="container py-4">
            <div>
                <h2>Continue Learning</h2>
            </div>
            <div class="row">
                @foreach($programs as $program)
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{$program['program']['image']}}" alt="program_img">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$program['program']['title']}}</h5>
                                        <p class="card-text">{{$program['program']['description']}}</p>
                                        <p class="card-text">
                                            <a href="/learner/programs/{{$program['program']['id']}}" role="button" class="mx-2 btn btn-outline-primary">View</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
{{--
    <section class="popular_courses mt-8">
        <div class="container-fluid">
            <div>
                <h2>Popular Courses</h2>
            </div>
            <div class="course_slider">
                @foreach($data['courses'] as $course)
                    <div class="mx-2">
                        <div class="card">
                            <img src="{{$course['course_image']}}" alt="program_img">
                            <div class="card-body">
                                <h5 class="card-title m-0">{{ $course['title'] }}</h5>
                                <p class="card-text">{{$course['duration']}} . 5 lectures</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
--}}
    <div class="container p-5">
    </div>

@endsection

@section('body_js')
    {{--    <script src="{{ asset('js/app.js') }}"></script>--}}
@endsection


