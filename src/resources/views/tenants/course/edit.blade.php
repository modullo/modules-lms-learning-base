@extends('layouts.themes.tabler.tabler')

@section('head_css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
    <div id="app">
        <breadcrumbs 
            :items="[
                {url: '/', title: 'Home', active: false},
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

                            <div class="form-group col-md-6">
                                <label for="visibility's"> Course Duration * </label>
                                <input
                                    :class="{'input': true, 'border border-danger': errors.has('Duration') }" name="Duration" 
                                    type="text" class="form-control" v-model="form.duration" placeholder="20 days">
                                    <i v-show="errors.has('Duration')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Duration')"
                                    class="help text-danger">@{{ errors.first('Duration') }}</span>
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
                                <select 
                                v-validate="'required'"
                                :class="{'input': true, 'border border-danger': errors.has('Publish State') }" 
                                name="Publish State"  v-model="form.course_state" class="form-control">
                                    <option :value="null" disabled selected>Select Course Publish State</option>
                                    <option value="published">Published</option>
                                    <option value="draft">draft</option>
                                </select>
                                <i v-show="errors.has('Publish State')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Publish State')"
                                class="help text-danger">@{{ errors.first('Publish State') }}</span>
                            </div>
                            <div class="form-group col-6">
                                <label for=""> Select Designated Program </label>
                                <select
                                    v-if="form.program"
                                        v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('program') }"
                                        name="program"  v-model="form.program" class="form-control">
                                    {{-- <option selected :value="null" disabled>Select Program</option> --}}
                                    <option v-for="(data,index) in programs" :key="index" :value="data.id">@{{ data.title }}</option>
                                </select>
                                <i v-show="errors.has('Publish State')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Publish State')"
                                      class="help text-danger">@{{ errors.first('Publish State') }}</span>
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
                                <editor v-model="form.description" theme="snow"></editor>


                            </div>


                            <div class="mt-5 mb-5 form-group col-lg-6">
                            <label for="">What will be Learnt in the Course</label>
                                <editor v-model="form.skills_to_be_gained" theme="snow"></editor>

                            </div>

                        </div>

                        <div class="mt-5 form-group col-6">

                            <label for="">
                                Course Cover image (only select to update)
                            </label>
                            <input v-on:change="accessImage" type="file" class="form-control-file" name="" id="" placeholder=""
                                aria-describedby="fileHelpId">

                        </div>
                        
                        <div class="mt-5 mb-5 submit-btn d-flex justify-content-between align-items-center">
                            <span class="muted">
    
                                fields with * are required
                            </span>
        
                            <button type="submit" class="btn btn-outline-secondary">Update Course</button>
        
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3"></script>
    <link href="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3/dist/vue-loading.css" rel="stylesheet">
    <!-- Init the plugin and component-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        Vue.use(VueLoading);
        Vue.component('loading', VueLoading)
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
    <link href="https://unpkg.com/@morioh/v-quill-editor/dist/editor.css" rel="stylesheet">

    <script src="https://unpkg.com/@morioh/v-quill-editor/dist/editor.min.js" type="text/javascript"></script>
    <script>
        Vue.use(VeeValidate); 
    </script>
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <!-- Initialize Quill editor -->


    <script>
        "use strict";
        new Vue({
            el: "#app",

            data: {
                form: {!! json_encode($data) !!},
                programs: {!! json_encode($programs) !!},
            },

            methods: {
                accessImage(e) {
                    this.form.course_image = e.target.files[0]
                },
                async formSubmit() {
                    await axios.post('create',this.form).then(res => {
                        loader.hide();
                        toastr["success"](res.data.message)
                    }).catch(e => {
                        loader.hide();
                        // console.log(e.response.data.error)
                        const errors = e.response.data.error
                        if (e.response.status === 400) {
                            
                            Object.entries(errors).forEach(
                                ([, value]) => {
                                    toastr["error"](value)
                                },
                            )
                        }else {
                            toastr["error"](e.response.data.error)
                        }
                    }) 
                },
                validateBeforeSubmit(ev) {
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            let loader = Vue.$loading.show()
                            this.uploadImage()
                            .then(() => {
                                axios.put(`${this.form.id}`,this.form).then(res => {
                                loader.hide();
                                toastr["success"](res.data.message)
                                }).catch(e => {
                                    loader.hide();
                                    if(e.response.data.error){
                                        toastr["error"](e.response.data.error)
                                    }
                                    else if(e.response.data.validation_error){
                                        Object.entries(e.response.data.validation_error).forEach(
                                            ([, value]) => {
                                                toastr["error"](value)
                                            },
                                        )
                                    }
                                }) 
                            })
                        }
                    });
                },
                async uploadImage() {
                    if (typeof this.form.course_image.name !== 'undefined') { 
                        const formData = new FormData();
                        formData.append("asset", this.form.course_image, this.form.course_image.name);
                        await axios.post('/tenant/assets/custom/upload', formData)
                        .then( res => {
                            this.form.course_image = res.data.file_url
                        })
                        .catch(e => {
                            console.log(e.response.data.error)
                        })
                    }
                },
            },
            mounted: function() {
                //console.log(this.programs)
            }

        });

    </script>
@endsection
