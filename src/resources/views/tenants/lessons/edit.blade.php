
@extends('layouts.themes.tabler.tabler')

@section('head_js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

@endsection

@section('head_css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
            <li class="breadcrumb-item ml-4"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="/tenant/lessons">Lesson</a></li>
            <li class="breadcrumb-item active">Create Lesson</li>
        </ol>
    </nav>
    <div class="container">
        <div id="app">
            <h3 class="mt-5">Edit Track</h3>
            <div class="">
                <p v-if="errors.length > 0">
                    <b class="text-danger">Please correct the following error(s):</b>
                    <ul class="text-danger">
                        <li v-for="error in errors" :key="error.id"> @{{ error }}</li>
                    </ul>
                </p>
            </div>
            <div class="card col mt-5 mx-auto">
                <div class="card-body">
                    <form class="form">
                        <div class="form-row">

                            <div class="form-group col-lg-6">
                                <label for="tenant"> Courses *</label>
                                <select  class="form-control" v-model="form.course_id">
                                    <option selected>Select Courses</option>
                                    <option>Objects and Classes</option>
                                    <option>Inheritance</option>
                                </select>
                            </div>


                            <div class="form-group col-lg-6">
                                <label for="modules"> Modules * </label>
                                <select  class="form-control" v-model="form.module_id">
                                    <option selected>Select Modules</option>
                                    <option>Module 1</option>
                                    <option>Module 2</option>
                                    <option> Module 3</option>
                                </select>
                            </div>


                            <div class="form-group col-lg-6">
                                <label for="title"> Title * </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name=""
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder="Track Title"
                                        v-model="form.title"
                                />
                                <small class="text-danger" v-show="errors.length > 0">
                                    @{{ errors['title'] }}
                                </small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="description">  Track description * </label>
                                <textarea
                                        class="form-control"
                                        v-model="form.description"
                                        id="description"
                                        placeholder="Modules Description"
                                        rows="3"
                                ></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="image">

                                    Image *
                                </label>
                                <input type="file"
                                       class="form-control" name="" id="" aria-describedby="helpId" placeholder="">

                            </div>
                        </div>

                        <div class="form-row mb-8">
                            <div class="form-group col-lg-6">
                                <label for="skill-gained">Skill gained *</label>
                                <div id="skills_gained"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="duration">Duration*</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id=""

                                />
                            </div>
                        </div>

                        <div class="form-row mb-8">

                            <div class="form-group col-md-6">
                                <label for="resource">Track Resource*</label>
                                <div id="resources"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="additional-resource">Addtional-Resource *</label>

                                    <div id="additional_resources"></div>
                            </div>

                        </div>
                        <div class="form-row">


                            <div class="form-group col-lg-4">
                                <label for="lesson-type">

                                    Track Type *
                                </label>
                                <select class="form-control" name="" id="">
                                    <option selected>
                                        select Track type

                                    </option>

                                    <option>Video</option>
                                    <option>Quiz</option>
                                </select>
                            </div>



                            <div class="form-group col-lg-4">
                                <label for="module No">Track No *</label>
                                <input type="number"
                                       class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                        <div
                                class="
                  submit-btn
                  d-flex
                  justify-content-between
                  align-items-center
                "
                        >
                            <span class="muted"> fields with * are required </span>

                            <button @click.prevent="submitForm" type="submit" class="btn btn-outline-primary">
                                Create Track
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body_js')
    <script>
        let quill = new Quill('#skills_gained', {
            theme: 'snow', placeholder: 'Skills To Be  Gained ',
            modules: {
                toolbar: [
                    [{header: [1, 2, false]}],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
        });

        let quill2 = new Quill('#resources', {
            theme: 'snow', placeholder: 'Skills To Be  Gained ',
            modules: {
                toolbar: [
                    [{header: [1, 2, false]}],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
        });


        let quill3 = new Quill('#additional_resources', {
            theme: 'snow', placeholder: 'Skills To Be  Gained ',
            modules: {
                toolbar: [
                    [{header: [1, 2, false]}],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        "use strict";

        new Vue({
            el: "#app",

            data: {
                errors:[],
                form:{
                    title:'',
                    module_id:'',
                    course_id:'',
                    program_id:'',
                    description:'',
                }
            },
            methods:{
                submitForm() {
                    if (this.form.title && this.description && this.form.module_id && this.form.course_id && this.form.program_id) {
                        return true;
                    }

                    this.errors = [];

                    if (!this.form.module_id) {
                        this.errors.push('Module is required.');
                    }
                    if (!this.form.title) {
                        this.errors.push('Title is required.');
                    }
                    if (!this.form.course_id) {
                        this.errors.push('Course is required.');
                    }
                    if (!this.form.program_id) {
                        this.errors.push('Program is required.');
                    }
                    if (!this.form.description) {
                        this.errors.push('Description is required.');
                    }

                    // if(!this.form.form.title){
                    //     this.form.errors['title'] = 'Title cannot be empty';

                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: 'Oops...',
                    //         text: 'You have a missing inputs, All * are required!',
                    //     })
                    //     return true;
                    // }

                },
                validateTitle(){
                    if(this.form.title){
                        this.errors['title'] = 'Title cannot be empty'
                    }
                }
            }
        });
    </script>
@endsection


