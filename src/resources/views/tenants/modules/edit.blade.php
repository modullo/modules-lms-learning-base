
@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection

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
    <div id="app">
        <breadcrumbs 
            :items="[
                {url: '/tenant/dashboard', title: 'Home', active: false},
                {url: '/tenant/modules', title: 'Modules', active: false},
                {url: '', title: 'Edit Module', active: true},
            ]">
        </breadcrumbs>
        <div class="container">
            <h3 class="mt-5">Edit Modules</h3>
            <div class="mx-auto mt-5 card col">
                <div class="card-body">
                    <form class="form" @submit.prevent="validateBeforeSubmit">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                            <label for="Course"> Course (under which the Module will be) *</label>
                                <select class="form-control" v-model="form.course.id" name="Course" v-validate="'required'"
                                :class="{'input': true, 'border border-danger': errors.has('Course') }" id="">
                                    {{-- <option selected>Select Courses</option> --}}
                                    <option v-for="(course, index) in courses" :key="index" :value="course.id">@{{ course.title }}</option>
                                </select>
                                <i v-show="errors.has('Course')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Course')"
                                    class="help text-danger">@{{ errors . first('Course') }}</span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="title">Module Title * </label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Title" class="form-control" v-model="form.title" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Title') }" type="text"
                                        placeholder="Enter Course title">
                                    <i v-show="errors.has('Title')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Title')"
                                        class="help text-danger">@{{ errors . first('Title') }}</span>
                                </p>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="duration"> Duration </label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Duration" class="form-control" v-model="form.duration" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Duration') }" type="text"
                                        placeholder="20 hours">
                                    <i v-show="errors.has('Duration')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Duration')"
                                        class="help text-danger">@{{ errors . first('Duration') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="description"> Module Description * </label>
                                <textarea
                                    v-model="form.description" v-validate="'required'"
                                    :class="{'input': true, 'border border-danger': errors.has('Description') }" 
                                    class="form-control"
                                    name="Description"
                                    id="description"
                                    v-model="form.description"
                                    placeholder="Modules Description"
                                    rows="3"
                                ></textarea>
                                <i v-show="errors.has('Description')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Description')"
                                        class="help text-danger">@{{ errors . first('Description') }}</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="module-no"> Module No </label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Module Number" class="form-control" v-model="form.module_number" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Module Number') }" type="text"
                                        placeholder="Enter Module Number">
                                    <i v-show="errors.has('Module Number')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Module Number')"
                                        class="help text-danger">@{{ errors . first('Module Number') }}</span>
                                </p>
                            </div>
                        </div>

                        <div
                                class=" submit-btn d-flex justify-content-between align-items-center"
                        >
                            <span class="muted"> fields with * are required </span>

                            <button type="submit" class="btn btn-outline-secondary">
                                Update Module
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
<script>
    Vue.use(VeeValidate); 
</script>
<script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<script>
    "use strict";

    new Vue({
        el: "#app",

        data: {
            form: {!! json_encode($data) !!},
            courses: {!! json_encode($courses) !!}
        },
        methods: {
            validateBeforeSubmit(ev) {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        let loader = Vue.$loading.show()
                        axios.put(`${this.form.id}`,this.form).then(res => {
                            loader.hide();
                            toastr["success"](res.data.message)
                        })
                        .catch(e => {
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
                        ev.target.reset()
                    }
                });
            },
        }

    });
</script>
@endsection


