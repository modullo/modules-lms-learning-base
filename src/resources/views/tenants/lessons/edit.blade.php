@extends('layouts.themes.tabler.tabler')

@section('head_js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

@endsection

@section('head_css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            content: ">>";
        }
        @media only screen and (max-width: 1200) {
            .alignForMobile {
                margin-top: 5em;
                margin-bottom: 2.5em;
            }
        }
    </style>
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div id="app">
        <breadcrumbs :items="[
                    {url: '/tenant/dashboard', title: 'Home', active: false},
                    {url: '/tenant/lessons', title: 'Lessons', active: false},
                    {url: '', title: 'Edit Lesson', active: true},
                ]">
        </breadcrumbs>
        <div class="container">
            <h3 class="mt-5">Edit Lesson</h3>
            <div class="mx-auto mt-5 card col">
                <div class="card-body">
                    <form class="form" @submit.prevent="validateBeforeSubmit">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="lesson-type">
                                    Lesson Type *
                                </label>
                                <select name="Lesson Type" v-model="form.lesson_type" v-validate="'required'"
                                :class="{'input': true, 'border border-danger': errors.has('Lesson Type') }" class="form-control" id="">
                                    <option value="video">Video</option>
                                    <option value="quiz">Quiz</option>
                                </select>
                                <i v-show="errors.has('Lesson Type')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Lesson Type')"
                                    class="help text-danger">@{{ errors . first('Lesson Type') }}</span>
                            </div>
                            <div v-if="form.lesson_type === 'quiz'" class="form-group col-lg-6">
                                <label for="tenant"> Choose Quiz Asset *</label>
                                <select class="form-control" v-model="form.resource_id" name="Resource">
                                    <option v-for="(quiz, index) in quizzes" :value="quiz.id" :key="index">@{{quiz.title}}</option>
                                </select>
                            </div>

                            <div v-if="form.lesson_type == 'video'" class="form-group col-lg-6">
                                <label for="tenant"> Choose Video Asset *</label>
                                <select class="form-control" v-model="form.resource_id" name="Resource">
                                    <option v-for="(asset, index) in assetTypes('video')" :value="asset.id" :key="index">@{{asset.asset_name}}</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label for="module No">Lesson Number *</label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Lesson Number" class="form-control" v-model="form.lesson_number" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Lesson Number') }" type="number"
                                        placeholder="1">
                                    <i v-show="errors.has('Lesson Number')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Lesson Number')"
                                        class="help text-danger">@{{ errors . first('Lesson Number') }}</span>
                                </p>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="tenant">Course &raquo; Module *</label>
                                <select class="form-control" v-model="form.module_id" v-validate="'required'" name="Module" ref="ModuleID"
                                    :class="{'input': true, 'border border-danger': errors.has('Module') }">
                                    <option v-for="(module, index) in modules" :value="module.id" :key="index">@{{ module.course.title + ' &raquo; ' +  module.title }}</option>
                                </select>
                                <i v-show="errors.has('Module')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Module')"
                                    class="help text-danger">@{{ errors . first('Module') }}</span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="title"> Lesson Title * </label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Title" class="form-control" v-model="form.title" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Title') }" type="text"
                                        placeholder="Enter Resource title">
                                    <i v-show="errors.has('Title')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Title')"
                                        class="help text-danger">@{{ errors . first('Title') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="mb-5 form-row">
                            <div class="form-group col-lg-6">
                                <label for="description">Lesson Description * </label>
                                <editor style="height: 100px" v-validate="'required'"
                                name="Description"
                                :class="{'input': true, 'border border-danger': errors.has('Description') }" v-model="form.description" theme="snow"></editor>
                                    <i v-show="errors.has('Description')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Description')"
                                        class="help text-danger">@{{ errors . first('Description') }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="mt-3 form-group col-lg-6">
                                <label for="image">
                                  Lesson Cover Image *
                                </label>
                                <input type="file"
                                v-on:change="accessImage"
                                :class="{'input': true, 'border border-danger': errors.has('Image') }" class="form-control" name="Image" id="" aria-describedby="helpId"
                                    placeholder="">
                            </div>
                            
                            <div class="mt-3 form-group col-lg-6">
                                <label for="duration">Lesson Duration *</label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Duration" class="form-control" v-model="form.duration" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Duration') }" type="text"
                                        placeholder="2 minutes">
                                    <i v-show="errors.has('Duration')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Duration')"
                                        class="help text-danger">@{{ errors . first('Duration') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="mb-5 form-row">
                            <div class="form-group col-lg-6">
                                <label for="description"> Skills Gained * </label>
                                <editor style="height: 100px" v-validate="'required'"
                                name="Skills Gained"
                                :class="{'input': true, 'border border-danger': errors.has('Skills Gained') }" v-model="form.skills_gained" theme="snow"></editor>
                                    <i v-show="errors.has('Skills Gained')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Skills Gained')"
                                        class="help text-danger">@{{ errors . first('Skills Gained') }}</span>
                            </div>
                        </div>
                        <div class=" submit-btn d-flex justify-content-between align-items-center">
                            <span class="muted text-danger font-weight-bold"> Fields with * are required </span>
                            <button type="submit" class="btn btn-outline-secondary">
                                Edit Lesson
                            </button>
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
    <link href="https://unpkg.com/@morioh/v-quill-editor/dist/editor.css" rel="stylesheet">
    <script src="https://unpkg.com/@morioh/v-quill-editor/dist/editor.min.js" type="text/javascript"></script>
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
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        "use strict";

        new Vue({
            el: "#app",

            data: {
                form: {!! json_encode($data) !!},
                assets: {!! json_encode($assets) !!},
                modules: {!! json_encode($modules) !!},
                quizzes: {!! json_encode($quizzes) !!},
                resource_id: ''
            },
            mounted: function() {
                //sconsole.log(this.form.module_id)
                //console.log(this.modules)
                // console.log(this.assets)
                // console.log(resource.id)
                // console.log(this.form)
                let resource = this.assets.find(res => res.id == this.form.lesson_resource.id);
                this.form.resource_id = resource.id;
                this.resource_id = resource.id;
                //console.log(this.form.resource_id)
            },
            methods: {
                assetTypes(asset_type) {
                    return this.assets.filter ( asset => asset.type != 'unknown' && asset.type != null && asset.type == "video" )
                },
                accessImage(e) {
                    this.form.lesson_image = e.target.files[0]
                },
                validateBeforeSubmit(ev) {
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            let loader = Vue.$loading.show()
                            this.uploadImage()
                            .then(() => {
                                // replace UUID with (Serial) ID
                                let modul = this.modules.find(mod => mod.id == this.form.module_id);
                                this.form.module_id = modul.raw_id;
                                axios.put(`${this.form.id}`, this.form).then(res => {
                                loader.hide();
                                toastr["success"](res.data.message)
                                }).catch(e => {
                                    loader.hide();
                                    const errors = e.response.data.error
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
                    // if (typeof this.form.lesson_image.name !== 'undefined' null) { 
                    if (this.form.lesson_image) {           
                        if (typeof this.form.lesson_image.name !== 'undefined') { 
                            const formData = new FormData();
                            formData.append("asset", this.form.lesson_image, this.form.lesson_image.name);
                            await axios.post('/tenant/assets/custom/upload', formData)
                            .then( res => {
                                this.form.lesson_image = res.data.file_url
                            })
                            .catch(e => {
                                console.log(e.response.data.error)
                            })
                        }
                    }
                },
            }
        });

    </script>
@endsection
