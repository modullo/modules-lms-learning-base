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
    {{-- <nav>
        <ol class="breadcrumb">
            <li class="ml-4 breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"> <a href="/tenant/courses">Courses</a></li>
            <li class="breadcrumb-item active">Create Course</li>
        </ol>
    </nav> --}}
    <div id="app">
        <breadcrumbs 
            :items="[
                {url: 'https://google.com', title: 'Home', active: false},
                {url: '/tenant/courses', title: 'Courses', active: false},
                {url: '', title: 'Edit Course', active: true},
            ]">
        </breadcrumbs>
        <div class="container">
            <h3 class="mt-5">Edit Course</h3>
            <div class="mx-auto mt-5 mb-5 card col">
                <div class="card-body">


                    <h3 class="mb-3 form-heading">About Course </h3>
                    <form class="form" @submit.prevent="validateBeforeSubmit">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Title *</label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Title" class="form-control" v-model="form.title" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Title') }" type="text"
                                        placeholder="Enter Course title">
                                    <i v-show="errors.has('Title')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Title')"
                                        class="help text-danger">@{{ errors . first('Title') }}</span>
                                </p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="subtype"> Caption * </label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Caption" class="form-control" v-model="form.caption" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Caption') }" type="text"
                                        placeholder="Enter Caption">
                                    <i v-show="errors.has('Caption')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Caption')"
                                        class="help text-danger">@{{ errors . first('Caption') }}</span>
                                </p>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="visibility's"> Course Duration * </label>
                                <input
                                    :class="{'input': true, 'border border-danger': errors.has('Duration') }" name="Duration" type="datetime-local" class="form-control" v-model="form.duration"
                                    aria-describedby="helpId">
                                    <i v-show="errors.has('Duration')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Duration')"
                                    class="help text-danger">@{{ errors . first('Duration') }}</span>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col">
                                <label for=""> Select Major</label>
                                <select class="form-control"  v-model="form.major_id" name="" id="">
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
                                <input type="url" v-validate="'required'"
                                name="Overview Video"
                                :class="{'input': true, 'border border-danger': errors.has('Overview Video') }"  v-model="form.overviewVideo" placeholder="https://aws.s3.lms_videos/videos/videohere.mp4"
                                    class="form-control" id="overviewvideo" />
                                    <i v-show="errors.has('Overview Video')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Overview Video')"
                                    class="help text-danger">@{{ errors . first('Overview Video') }}</span>
                            </div>
                        </div>

                        <div class="mb-3 form-row">

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


                        <div class="mb-3 form-row">

                            <h3 class="form-heading">

                                Course details
                            </h3>
                        </div>

                        <div class="form-row">


                            <div class="mt-5 mb-5 form-group col-lg-6">
                                <label for="">Course Description</label>

                                <div id="courseDesc">

                                </div>


                            </div>


                            <div class="mt-5 mb-5 form-group col-lg-6">
                                <label for="">What you will learn</label>
                                <div id="whatYouWillLearn">

                                </div>


                            </div>


                            <div class="mt-5 mb-5 form-group col-lg-6">


                                <label for="">Course Requirement</label>
                                <div id="editor">

                                </div>


                            </div>


                            <div class="mt-5 form-group col-6">

                                <label for="">

                                    Cover image
                                </label>
                                <input type="file" class="form-control-file" name="" id="" placeholder=""
                                    aria-describedby="fileHelpId">

                            </div>


                        </div>


                        <div class="mt-5 mb-5 submit-btn d-flex justify-content-between align-items-center">
                            <span class="muted">
        
                                fields with * are required
                            </span>
        
                            <button type="submit" class="btn btn-outline-primary">Edit course</button>
        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <!-- jsdelivr cdn -->
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@<3.0.0/dist/vee-validate.js"></script>
    <script>
        Vue.use(VeeValidate); 
    </script>
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
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
        var dummyData = [
            {
                title: " objects and classes",
                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "inheritance",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "constructor",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "interface",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",
                image:
                    "https://images.unsplash.com/photo-1491841651911-c44c30c34548?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80",
            },
        ];
        new Vue({
            el: "#app",

            data: {

                author: "Evan you",
                programTitle: "Objects And Classes",
                numberOfStudentEnrolled: 240,
                desc: "Learn how to use Postman to build REST & GraphQL request",
                cardinfos: dummyData,
                overviewVideo: '',
                rating: "(86900 ratings)",
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
                validateBeforeSubmit() {
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            // eslint-disable-next-line
                            alert('Form Submitted!');
                            return;
                        }
                    });
                },
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
