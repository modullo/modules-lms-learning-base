@extends('layouts.themes.tabler.tabler')

@section('head_js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

@endsection

@section('head_css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            content: ">>";
        }

    </style>
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div id="app">
        <breadcrumbs :items="[
                    {url: 'https://google.com', title: 'Home', active: false},
                    {url: '/tenant/lessons', title: 'Lesson', active: false},
                    {url: '', title: 'Create Lesson', active: true},
                ]">
        </breadcrumbs>
        <div class="container">
            <h3 class="mt-5">Create Track</h3>
            <div class="">
                <p v-if="errors.length > 0">
                    <b class="text-danger">Please correct the following error(s):</b>
                <ul class="text-danger">
                    {{-- <li v-for="error in errors" :key="error.id"> @{{ error }}</li> --}}
                </ul>
                </p>
            </div>
            <div class="mx-auto mt-5 card col">
                <div class="card-body">
                    <form class="form" @submit.prevent="validateBeforeSubmit">
                        <div class="form-row">

                            <div class="form-group col-lg-6">
                                <label for="tenant"> Courses *</label>
                                <select class="form-control" v-model="form.course_id" name="Course" v-validate="'required'"
                                    :class="{'input': true, 'border border-danger': errors.has('Course') }">
                                    <option selected>Select Courses</option>
                                    <option>Objects and Classes</option>
                                    <option>Inheritance</option>
                                </select>
                                <i v-show="errors.has('Course')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Course')"
                                    class="help text-danger">@{{ errors . first('Course') }}</span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="modules"> Modules * </label>
                                <select class="form-control" name="Module" v-validate="'required'"
                                    :class="{'input': true, 'border border-danger': errors.has('Module') }"
                                    v-model="form.module_id">
                                    <option selected>Select Modules</option>
                                    <option>Module 1</option>
                                    <option>Module 2</option>
                                    <option> Module 3</option>
                                </select>
                                <i v-show="errors.has('Module')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Module')"
                                    class="help text-danger">@{{ errors . first('Module') }}</span>
                            </div>


                            <div class="form-group col-lg-6">
                                <label for="title"> Title * </label>
                                {{-- <input
                                    v-validate="'required'"
                                    type="text"
                                    class="form-control"
                                    name="Title"
                                    id=""
                                    aria-describedby="helpId"
                                    placeholder="Track Title"
                                    v-model="form.title"
                                /> --}}
                                {{-- <span class="text-danger">
                                    @{{ errors.first('Title') }}
                                </span> --}}
                                <p class="control has-icon has-icon-right">
                                    <input name="Title" class="form-control" v-model="form.title" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Title') }" type="text"
                                        placeholder="Enter Course title">
                                    <i v-show="errors.has('Title')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Title')"
                                        class="help text-danger">@{{ errors . first('Title') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="description"> Track description * </label>
                                <textarea name="Description" v-validate="'required'"
                                :class="{'input': true, 'border border-danger': errors.has('Description') }" class="form-control" v-model="form.description" id="description"
                                    placeholder="Modules Description" rows="3"></textarea>
                                    <i v-show="errors.has('Description')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Description')"
                                        class="help text-danger">@{{ errors . first('Description') }}</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="image">

                                    Image *
                                </label>
                                <input type="file" v-validate="'required'"
                                v-model="form.image"
                                :class="{'input': true, 'border border-danger': errors.has('Image') }" class="form-control" name="Image" id="" aria-describedby="helpId"
                                    placeholder="">
                                    <i v-show="errors.has('Image')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Image')"
                                        class="help text-danger">@{{ errors . first('Image') }}</span>
                            </div>
                        </div>

                        <div class="mb-8 form-row">
                            <div class="form-group col-lg-6">
                                <label for="skill-gained">Skill gained *</label>
                                <div id="skills_gained"></div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="duration">Duration*</label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Duration" class="form-control" v-model="form.duration" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Duration') }" type="text"
                                        placeholder="Enter Course title">
                                    <i v-show="errors.has('Duration')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Duration')"
                                        class="help text-danger">@{{ errors . first('Duration') }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="mb-8 form-row">

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
                                <select name="Track Type" v-model="form.type" v-validate="'required'"
                                :class="{'input': true, 'border border-danger': errors.has('Track Type') }" class="form-control" id="">
                                    <option selected>
                                        select Track type
                                    </option>
                                    <option>Video</option>
                                    <option>Quiz</option>
                                </select>
                                <i v-show="errors.has('Track Type')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Track Type')"
                                    class="help text-danger">@{{ errors . first('Track Type') }}</span>
                            </div>



                            <div class="form-group col-lg-4">
                                <label for="module No">Track No *</label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Track Number" class="form-control" v-model="form.number" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Track Number') }" type="text"
                                        placeholder="Enter Course title">
                                    <i v-show="errors.has('Track Number')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Track Number')"
                                        class="help text-danger">@{{ errors . first('Track Number') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class=" submit-btn d-flex justify-content-between align-items-center">
                            <span class="muted text-danger font-weight-bold"> Fields with * are required </span>

                            <button type="submit" class="btn btn-outline-primary">
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
            theme: 'snow',
            placeholder: 'Skills To Be  Gained ',
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

        let quill2 = new Quill('#resources', {
            theme: 'snow',
            placeholder: 'Skills To Be  Gained ',
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


        let quill3 = new Quill('#additional_resources', {
            theme: 'snow',
            placeholder: 'Skills To Be  Gained ',
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <!-- jsdelivr cdn -->
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@<3.0.0/dist/vee-validate.js"></script>
    <script>
        Vue.use(VeeValidate); 
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
    </script>
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        "use strict";

        new Vue({
            el: "#app",

            data: {
                form: {
                    title: '',
                    module_id: '',
                    course_id: '',
                    program_id: '',
                    description: '',
                    duration: '',
                    type: '',
                    number: '',
                }
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
                    if (this.form.title && this.description && this.form.module_id && this.form.course_id && this
                        .form.program_id) {
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
                validateTitle() {
                    if (this.form.title) {
                        this.errors['title'] = 'Title cannot be empty'
                    }
                }
            }
        });

    </script>
@endsection
