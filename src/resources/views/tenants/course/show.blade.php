@extends('layouts.themes.tabler.tabler')

@section('head_css')
    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
    <style>
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">>";
        }
    </style>
@endsection


@section('body_content_main')
@include('modules-lms-base::navigation',['type' => 'tenant'])
<nav>
    <ol class="breadcrumb">
        <li class="ml-4 breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"> <a href="/tenant/courses">Courses</a></li>
        <li class="breadcrumb-item active">View Course</li>
    </ol>
</nav>
<div id="course">
        <div class="jumbotron jumbotron-fluid program-jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1>@{{ courseData.title }}</h1>

                        <h4 v-html="courseData.description"></h4>

                        <p>Author by @{{author}}</p>
                        <small class="rating">
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            @{{rating}} @{{numberOfStudentEnrolled}} students </small
                        ><br />

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
                        <video
                                class="course-video"
                                src="/What A Beautiful Name - Hillsong Worship.mp4"
                                controls
                        ></video>
                    </div>
                </div>
            </div>
        </div>

        <section class=" program-contain">
            <div class="col-lg-8">
                <div class="card what-you-will-learn">
                    <div class="card-body">
                        <h2>What you'll learn</h2>

                        <div class="row">
                            <div class="col-lg-6">

                                <ul class="what-you-will-learn-list">

                                    <li>

                                        Build enterprise level React Native apps and deploy to Apple App Store and Google Play Store
                                    </li>
                                    <li>
                                        Build enterprise level React Native apps and deploy to Apple App Store and Google Play Store
                                    </li>
                                    <li>
                                        Build enterprise level React Native apps and deploy to Apple App Store and Google Play Store
                                    </li>


                                </ul>
                            </div>

                            <div class="col-lg-6">
                                <ul class="what-you-will-learn-list">

                                    <li>
                                        Build enterprise level React Native apps and deploy to Apple App Store and Google Play Store
                                    </li>
                                    <li>
                                        Build enterprise level React Native apps and deploy to Apple App Store and Google Play Store
                                    </li>
                                    <li>
                                        Build enterprise level React Native apps and deploy to Apple App Store and Google Play Store
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="mt-5 course-content">

                    <h2>

                        Course content
                    </h2>
                    <div id="accordianId" role="tablist" class="mb-5" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="section1HeaderId">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordianId" class="sectionheading" href="#section1ContentId" aria-expanded="true" aria-controls="section1ContentId">
                                        Introduction
                                    </a>
                                </h5>
                            </div>
                            <div id="section1ContentId" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
                                <div class="card-body d-flex justify-content-between">
                                    <h6>
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                        Section 1 content
                                    </h6>


                                    <p>
                                        1:20:00
                                    </p>
                                </div>

                                <div class="card-body d-flex justify-content-between">
                                    <h6>
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                        Section 1 content
                                    </h6>


                                    <p>
                                        1:20:00
                                    </p>
                                </div>


                                <div class="card-body d-flex justify-content-between">
                                    <h6>
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                        Section 1 content
                                    </h6>


                                    <p>
                                        1:20:00
                                    </p>
                                </div>
                            </div>


                        </div>

                    </div>



                    <div class="container">

                    </div>


                </div>

                <div class="mt-5 mb-5 requirement">
                    <h2>Requirements</h2>

                    <ul class="requirement-list">
                        <li>@{{requirments}}</li>
                    </ul>
                </div>

                <h2>Description</h2>
                <span v-if="!readMoreActivated">@{{ description.slice(0, 600) }}</span>
                <p
                        class="see-more"
                        v-if="!readMoreActivated"
                        @click="activateReadMore"
                        href="#"
                >
                    See more
                    <i class="fa fa-angle-down"></i>
                </p>
                <span v-if="readMoreActivated" v-html="description"></span>

                <div class="mt-5 mb-5 testimonial-container">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Testimonial</h2>

                            <div class="user-details">
                                <img
                                        class="img-fluid avatar"
                                        src="https://images.unsplash.com/photo-1571008887538-b36bb32f4571?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80"
                                        alt="avatar"
                                />

                                <div class="user">
                                    <span class="username">@{{username}}</span>

                                    <span>131 course</span>
                                    <span>23 reviews</span>
                                </div>
                            </div>

                            <div class="mx-2 star-rating">
                                <i class="fa fa-star star"></i>
                                <i class="fa fa-star star"></i>
                                <i class="fa fa-star star"></i>
                                <i class="fa fa-star star"></i>
                                <i class="fa fa-star star"></i>

                                <span>1 month ago</span>
                            </div>

                            <div class="mt-4 testimonial">
                                <p>@{{testimonial}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{--    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>--}}

    {{--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}

@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script>
        "use strict";

        new Vue({
            el: "#course",

            data: {
                author: "Evan you",
                courseTitle: "Objects And Classes",
                numberOfStudentEnrolled: 240,
                shortDesc: "Learn how to use Postman to build REST & GraphQL request",
                rating: "(86900 ratings)",
                username: "John doe",
                description:
                    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, architecto!architecto!architecto! Sed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libero nihil id veniam illo voluptates non dicta debitis enim nam minim,Nesciunt voluptate sequi odit corporis laboriosam molestiae repellat labore, ducimus ad nulla voluptates reprehenderit quidem impedit. Debitis magnam quis voluptatum obcaecati, voluptates atque deleniti nobis. Illum quos laudantium nemo quo.",
                readMoreActivated: false,

                testimonial:
                    "The instructor has perfect explaining skills. This course helped to clarify some things and prepare me (hopefully) to start playing around with postman. I will also be looking forward to see the Postman course from Valentin.",
                requirments:
                    "The possibility of installing new tools on your computer.",
                courseData: {!! json_encode($data) !!},
            },

            methods: {
                activateReadMore() {
                    this.readMoreActivated = true;
                },
            },

        });
    </script>
    {{--    <script src="{{ asset('js/app.js') }}"></script>--}}
@endsection


