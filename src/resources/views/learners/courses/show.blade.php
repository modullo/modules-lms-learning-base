@extends('layouts.themes.tabler.tabler')

@section('head_css')
    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
@endsection

@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'learner'])
    <div id="course" class="mb-5">
        {{-- <breadcrumbs 
            :items="[
                {url: '/tenant/dashboard', title: 'Home', active: false},
                {url: '', title: 'courseTitle', active: true},
            ]">
        </breadcrumbs> --}}
        <div class="jumbotron jumbotron-fluid program-jumbotron">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <h1>@{{ courseDetails . title }}</h1>

                        <h4>@{{ToText(courseDetails.description)}}</h4>

                        <p>Author by @{{ author }}</p>
                        <small class="rating">
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            @{{ rating }} @{{ numberOfStudentEnrolled }} students </small><br />

                        <span class="last__updated">
                            <span>
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                Last updated 3/2021
                            </span>

                            <span class="language">
                                <i class="fa fa-globe"></i>
                                English
                            </span>

                            <span>
                                <i class="fa fa-cc" aria-hidden="true"></i> English [Auto]
                            </span>
                        </span>
                    </div>

                    <div class="course-video col-lg-4">
                        <video class="course-video" src="/What A Beautiful Name - Hillsong Worship.mp4" controls></video>
                    </div>
                </div>
            </div>
        </div>

        <section class="container-fluid program-contain">
            <div class="col-lg-8">
                <div class="card what-you-will-learn">
                    <div class="card-body">
                        <h2>What you'll learn</h2>

                        <ul class="what-you-will-learn-list">
                            <div class="row">
                                <div class="col-lg-6">
                                    <li> @{{ ToText(courseDetails . skills_to_be_gained) }}</li>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>

                <div class="mt-5 course-content">

                    <h2>
                        Course content
                    </h2>
                    <div id="accordianId" role="tablist" class="mb-5" aria-multiselectable="true">
                        <div class="card">
                            <div class="p-2 card-body" style="cursor: pointer">
                                <div class="mb-1" v-for="(module, moduleIndex) in courseDetails.modules" :key="moduleIndex">
                                    <div class="card-header">
                                        <div class="w-100 d-flex justify-content-between" data-toggle="collapse"
                                            data-parent="#accordianId" :href="'#section1ContentId'+moduleIndex"
                                            aria-expanded="true" :aria-controls="'section1ContentId'+moduleIndex" role="tab"
                                            id="section1HeaderId">
                                            <span style="font-size: 1.1em">
                                                {{-- @{{counter = moduleIndex + 1}}. @{{module.title}} --}}
                                                @{{ module . module_number }}. @{{ module . title }}
                                            </span>
                                            <span>
                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                                    stroke-width="2" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" class="css-i6dzq1">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div v-if="module.lessons.length > 0" :id="'section1ContentId'+moduleIndex"
                                        class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
                                        <div v-for="(lesson, lessonIndex) in module.lessons" :key="lessonIndex"
                                            class="card-body d-flex justify-content-between">
                                            <h6>
                                                <i class="p-1 fa fa-play" aria-hidden="true"></i>
                                                @{{ lesson . title }}
                                            </h6>
                                            <p>
                                                1:20:00
                                            </p>
                                        </div>
                                    </div>
                                    <div v-else :id="'section1ContentId'+moduleIndex" class="collapse in" role="tabpanel"
                                        aria-labelledby="section1HeaderId">
                                        <div class="card-body d-flex justify-content-between">
                                            <h6>
                                                No Lesson Available
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 mb-5 requirement">
                    <h2>Requirements</h2>

                    <ul class="requirement-list">
                        <li>@{{ requirments }}</li>
                    </ul>
                </div>

                <h2>Description</h2>
                <span v-if="!readMoreActivated">@{{ ToText(courseDetails . description . slice(0, 600)) }}</span>
                {{-- <p class="see-more" v-if="!readMoreActivated" @click="activateReadMore" href="#">
                    See more
                    <i class="fa fa-angle-down"></i>
                </p>
                <span v-if="readMoreActivated" v-html="description"></span> --}}
            </div>
        </section>
    </div>

@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <script>
        "use strict";

        new Vue({
            el: "#course",

            data: {
                courseDetails: {!! json_encode($data) !!},
                author: "Evan you",
                counter: 1,
                numberOfStudentEnrolled: 240,
                shortDesc: "Learn how to use Postman to build REST & GraphQL request",
                rating: "(86900 ratings)",
                username: "John doe",
                description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, architecto!architecto!architecto! Sed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libero nihil id veniam illo voluptates non dicta debitis enim nam minim,Nesciunt voluptate sequi odit corporis laboriosam molestiae repellat labore, ducimus ad nulla voluptates reprehenderit quidem impedit. Debitis magnam quis voluptatum obcaecati, voluptates atque deleniti nobis. Illum quos laudantium nemo quo.",
                readMoreActivated: false,

                testimonial: "The instructor has perfect explaining skills. This course helped to clarify some things and prepare me (hopefully) to start playing around with postman. I will also be looking forward to see the Postman course from Valentin.",
                requirments: "The possibility of installing new tools on your computer.",
            },

            methods: {
                generateIdForModules() {
                    ++this.counter
                },
                activateReadMore() {
                    this.readMoreActivated = true;
                },
                ToText(HTML) {
                    var input = HTML;
                    return input.replace(/<(style|script|iframe)[^>]*?>[\s\S]+?<\/\1\s*>/gi, '').replace(
                        /<[^>]+?>/g, '').replace(/\s+/g, ' ').replace(/ /g, ' ').replace(/>/g, ' ');
                },
            },

        });
    </script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
@endsection
