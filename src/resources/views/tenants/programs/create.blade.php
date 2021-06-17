
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
                {url: '/tenant/programs', title: 'Program', active: false},
                {url: '', title: 'Create Program', active: true},
            ]">
        </breadcrumbs>
        <div class="container">
            <h3 class="mt-5">Create Major</h3>

            <div class="mx-auto mt-5 card col">
                <div class="card-body">
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
                                <label for="visibilitytype"> Visibility type * </label>

                                <select
                                    v-validate="'required'"
                                    :class="{'input': true, 'border border-danger': errors.has('Visibility Type') }"
                                    class="form-control"
                                    name="Visibility Type"
                                    v-model="form.visiblityType"
                                    id="visibilitytype"

                                >
                                    <option disabled selected="selected">
                                        Select Major Visibility *
                                    </option>

                                    <option value="public">Public </option>
                                    <option value="private">Private</option>
                                </select>
                                <i v-show="errors.has('Visibility Type')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Visibility Type')"
                                        class="help text-danger">@{{ errors . first('Visibility Type') }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6 ">
                                <label for="description"> Program Description * </label>
                                <textarea
                                    v-validate="'required'"
                                    :class="{'input': true, 'border border-danger': errors.has('Program Description') }"
                                    class="form-control"
                                    name="Program Description"
                                    id="description"
                                    placeholder="Program Description"
                                    rows="3"
                                    v-model="form.MajorDescription"
                                ></textarea>
                                <i v-show="errors.has('Program Description')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Program Description')"
                                    class="help text-danger">@{{ errors.first('Program Description') }}</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="">

                                    Program Cover image
                                </label>
                                <input
                                    type="file"
                                    v-on:change="accessImage"
                                    class="mx-auto form-control-file"
                                    aria-describedby="fileHelpId"
                                />
                            </div>

                        </div>

                        <div class="submit-btn d-flex justify-content-between align-items-center">
                        <span class="muted">

                            fields with *  are required
                        </span>

                            <button type="submit" class="btn btn-outline-secondary">Submit</button>
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
    
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        "use strict";
        new Vue({
            el: "#app",

            data: {
                form: {
                    MajorTitle: null,
                    subscriptionType: null,
                    MajorDescription: null,
                    visiblityType: null,
                    subscriptioncost:null,
                    overviewImageUrl: null,
                    overviewVideo: null
                },
            },

            methods: {
                accessImage(e) {
                    this.form.overviewImageUrl = e.target.files[0]
                },
                validateBeforeSubmit(ev) {
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            let loader = Vue.$loading.show()
                            this.uploadImage()
                            .then(() => {
                                axios.post('create',this.form).then(res => {
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
                                    } else {
                                        toastr["error"](e.response.data.error)
                                        
                                    }
                                }) 
                                ev.target.reset()
                            })
                        }
                    });
                },
                async uploadImage() {
                    if (this.form.overviewImageUrl) { 
                        const formData = new FormData();
                        formData.append("file", this.form.overviewImageUrl, this.form.overviewImageUrl.name);
                        await axios.post('/tenant/assets/custom/upload', formData)
                        .then( res => {
                            this.form.overviewImageUrl = res.data.file_url
                        })
                        .catch(e => {
                            console.log(e.response.data.error)
                        })
                    }
                },
            }






        });
    </script>
@endsection


