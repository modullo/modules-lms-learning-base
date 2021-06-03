@extends('layouts.themes.tabler.tabler')

@section('head_css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            content: ">>";
        }

    </style>
@endsection

@section('head_js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endsection

@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item ml-4"><a href="#">Home</a></li>
            <li class="breadcrumb-item"> <a href="/tenant/courses">Courses</a></li>
            <li class="breadcrumb-item active">Create Course</li>
        </ol>
    </nav>
    <div class="container">
        <div id="app">
            <h3 class="mt-5">New Course</h3>
            <div class="">
                <p v-if="errors.length > 0">
                    <b class="text-danger">Please correct the following error(s):</b>
                <ul class="text-danger">
                    <li v-for="error in errors" :key="error.id"> @{{ error }}</li>
                </ul>
                </p>
            </div>
            <div class="card col mt-5 mx-auto mb-5">
                <div class="card-body">


                    <h3 class="mb-3 form-heading">About Course </h3>
                    <form class="form" @submit.prevent="submitForm()">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Title *</label>
                                <input type="text" class="form-control" id="title"
                                    placeholder="Enter the title of the course" :value="programTitle"
                                    v-model="form.title" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="subtype"> caption * </label>
                                <input type="text" class="form-control" id="subtype" placeholder="Course caption"
                                    v-model="form.caption" />
                            </div>

                            <div class="form-group col-md-3">
                                <label for="visibility's"> course duration * </label>
                                <input type="datetime-local" class="form-control" name="" id="" v-model="form.duration"
                                    aria-describedby="helpId">

                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col">
                                <label for="" v-model="form.major_id"> Select Major</label>
                                <select class="form-control" name="" id="">
                                    <option>Select A Major</option>
                                    <option>Beginner</option>
                                    <option>Intermediate</option>
                                    <option>Master</option>
                                </select>
                            </div>


                            <div class="form-group col">
                                <label for=""> Select certificate</label>
                                <select class="form-control" name="" id="">
                                    <option>Select a certificate for the course</option>
                                    <option>Introduction to Objects Cert</option>
                                    <option>Intermediate Degree to Objects and Classes Cert</option>
                                </select>
                            </div>


                            <div class="form-group col">
                                <label for=""> Course instructor</label>
                                <select class="form-control" name="" id="">
                                    <option>Select Appopriate Course Instructor</option>
                                    <option>Evan you</option>
                                </select>
                            </div>


                        </div>

                        <div class="form-row">


                            <div class="form-group col-md-6">
                                <label for="overviewvideo">Overview Video *</label>
                                <input type="url" placeholder="https://aws.s3.lms_videos/videos/videohere.mp4"
                                    class="form-control" id="overviewvideo" v-model="overviewVideo" />
                            </div>
                        </div>

                        <div class="form-row mb-3">

                            <h3 class="form-heading">

                                Course settings
                            </h3>
                        </div>

                        <div class="form-row">


                            <div class="form-group col-6">
                                <label for=""> Publish State</label>
                                <select class="form-control" name="" id="">
                                    <option>Select Course Publish State</option>
                                    <option>Publish</option>
                                    <option>draft</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="">Subscription type</label>

                                <select class="form-control" name="" id="">
                                    <option>Select Subscription Type</option>
                                    <option>Free</option>
                                    <option>Recurring</option>
                                </select>
                            </div>


                            <div class="form-group col-6">


                                <label for="">Payment type</label>

                                <select class="form-control" name="" id="">
                                    <option>Select payment type</option>
                                    <option>Card</option>
                                    <option>Coupon</option>
                                </select>
                            </div>


                        </div>


                        <div class="form-row mb-3">

                            <h3 class="form-heading">

                                Course details
                            </h3>
                        </div>

                        <div class="form-row">


                            <div class="form-group col-lg-6 mt-5 mb-5">
                                <label for="">Course Description</label>

                                <div id="courseDesc">

                                </div>


                            </div>


                            <div class="form-group col-lg-6 mt-5 mb-5">
                                <label for="">What you will learn</label>
                                <div id="whatYouWillLearn">

                                </div>


                            </div>


                            <div class="form-group col-lg-6 mt-5 mb-5">


                                <label for="">Course Requirement</label>
                                <div id="editor">

                                </div>


                            </div>


                            <div class="form-group col-6 mt-5">

                                <label for="">

                                    Cover image
                                </label>
                                <input type="file" class="form-control-file" name="" id="" placeholder=""
                                    aria-describedby="fileHelpId">

                            </div>


                        </div>


                        <div class="submit-btn mt-5 mb-5 d-flex justify-content-between align-items-center">
                            <span class="muted">
        
                                fields with * are required
                            </span>
        
                            <button type="submit" class="btn btn-outline-primary">Update course</button>
        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body_js')

    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Course requirement ',
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
        });

    </script>


    <script>
        var quill = new Quill('#courseDesc', {
            theme: 'snow',
            placeholder: 'Course description...',
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
        });

    </script>


    <script>
        var quill = new Quill('#whatYouWillLearn', {
            theme: 'snow',
            placeholder: 'What you will learn...',
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },

        });

    </script>

    <script>
        "use strict";

        new Vue({
            el: "#app",

            data: {

                author: "Evan you",
                programTitle: "Objects And Classes",
                numberOfStudentEnrolled: 240,
                desc: "Learn how to use Postman to build REST & GraphQL request",
                cardinfos: dummyData,
                rating: "(86900 ratings)",
                errors: [],
                aboutProgram: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, architecto!architecto!architecto! Sed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libero nihil id veniam illo voluptates non dicta debitis enim nam minim,Nesciunt voluptate sequi odit corporis laboriosam molestiae repellat labore, ducimus ad nulla voluptates reprehenderit quidem impedit. Debitis magnam quis voluptatum obcaecati, voluptates atque deleniti nobis. Illum quos laudantium nemo quo.",
                form: {
                    title: '',
                    caption: '',
                    duration: '',
                    major_id: '',
                    instructor_id: '',
                    overview: '',
                },
            },

            methods: {
                submitForm() {
                    if (this.form.title && this.form.caption && this.form.duration && this.form.major_id &&
                        this.form.instructor_id && this.form.overview) {
                        return true;
                    }

                    this.errors = [];

                    if (!this.form.title) {
                        this.errors.push('Title is required.');
                    }
                    if (!this.form.caption) {
                        this.errors.push('Caption is required.');
                    }
                    if (!this.form.duration) {
                        this.errors.push('Duration is required.');
                    }
                    if (!this.form.major_id) {
                        this.errors.push('Course is required.');
                    }
                    if (!this.form.instructor_id) {
                        this.errors.push('Course is required.');
                    }
                    if (!this.form.overview) {
                        this.errors.push('Course is required.');
                    }

                },
            },

        });

    </script>
@endsection
