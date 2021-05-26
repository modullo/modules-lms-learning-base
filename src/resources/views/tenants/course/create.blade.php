
@extends('layouts.themes.tabler.tabler')

@section('head_js')
    <link
            href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
            rel="stylesheet"
    />
@endsection

@section('head_css')
    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div class="container">
        <div id="app">

            <h3 class="mt-5">Create Course</h3>

            <div class="card col mt-5 mx-auto mb-5">
                <div class="card-body">


                    <h3 class="mb-3 form-heading">About Course </h3>
                    <form class="form">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Title *</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="title"
                                        placeholder="Title of course"

                                    v-model="form.title"
                                />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="subtype"> caption * </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="subtype"
                                        placeholder="Course caption"

                                        v-model="form.caption"
                                />
                            </div>

                            <div class="form-group col-md-3">
                                <label for="visibilitytype"> course duration * </label>
                                <input type="text"
                                       class="form-control" name=""
                                       v-model="form.duration"
                                       aria-describedby="helpId" placeholder="course duration">


                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col">
                                <label for=""> Select Program</label>
                                <select class="form-control" name="" id="" v-model="form.program_id">
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>


                            <div class="form-group col">
                                <label for=""> Select certificate</label>
                                <select class="form-control" name="" id="" v-model="form.certificate">
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>


                            <div class="form-group col">
                                <label for=""> Course instructor</label>
                                <select class="form-control" name="" id="" v-model="form.instructor_id">
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>


                        </div>

                        <div class="form-row">


                            <div class="form-group col-md-6">
                                <label for="overviewvideo">Overview Video *</label>
                                <input type="text"

                                       class="form-control" id="overviewvideo"
                                       v-model="overviewVideo"
                                />
                            </div>
                        </div>

                        <div class="form-row mb-3">

                            <h3 class="form-heading">

                                Course settings
                            </h3>
                        </div>

                        <div class="form-row">


                            <div class="form-group col-6">
                                <label for="">Publish state</label>
                                <input type="text"
                                       class="form-control" name="" id="" aria-describedby="helpId" placeholder="course publish state"
                                       v-model="form.publish_date">
                            </div>


                            <div class="form-group col-6">
                                <label for="">Course pack</label>
                                <input type="text"
                                       class="form-control" name="" id="" aria-describedby="helpId" placeholder="Course pack"
                                       v-model="form.course_pack">
                            </div>


                            <div class="form-group col-lg-6">



                                <label for="">Subscription type</label>

                                <select class="form-control" name="" id="" v-model="form.subscription">
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>




                            <div class="form-group col-6">



                                <label for="">Payment type</label>

                                <select class="form-control" name="" id="" v-model="form.payment_type">
                                    <option></option>
                                    <option></option>
                                    <option></option>
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
                                <input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId"
                                       >

                            </div>







                        </div>












                </div>



                <div class="submit-btn mt-5 mb-5 d-flex justify-content-between align-items-center">
  <span class="muted">

    fields with *  are required
  </span>

                    <button @click.prevent="submitForm" class="btn btn-outline-primary">Add course</button>



                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('body_js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow', placeholder: 'Course requirement ',
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
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
                    [{ header: [1, 2, false] }],
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
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/vue-swal"></script>

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
                // return {
                    overviewVideo:'',
                    form:{
                        title:'',
                        cover_image:'',
                        payment_type:'',
                        subscription:'',
                        course_pack:'',
                        publish_date:'',
                        instructor_id:'',
                        certificate:'',
                        program_id:'',
                        caption:'',
                        duration:''
                    }
                // };
            },
            methods:{
                submitForm(){
                    console.log('working!!')
                    if(!this.form.title)
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You have a missing inputs, All * are required!',
                    })
                    return true;
                }
            }

        });
    </script>
@endsection


