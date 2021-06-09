
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
                {url: 'https://google.com', title: 'Home', active: false},
                {url: '/tenant/programs', title: 'Program', active: false},
                {url: '', title: 'Edit Program', active: true},
            ]">
        </breadcrumbs>
        <div class="container">
            <h3 class="mt-5">Edit Major</h3>

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
                                        v-model="form.type"
                                        id="visibilitytype"
                                        @focus="clearError"
                                >
                                    <option disabled selected="selected">
                                        Select Major Visibility *
                                    </option>
                                    <option>Public </option>
                                    <option>Private</option>
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
                                    class="form-control"
                                    name="Program Description"
                                    v-validate="'required'"
                                    :class="{'input': true, 'border border-danger': errors.has('Program Description') }"
                                    id="description"
                                    placeholder="Program Description"
                                    rows="3"
                                    v-model="form.description"
                                    @focus="clearError"
                                ></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="">

                                    Program Cover image
                                </label>
                                <input
                                    type="file"
                                    class="mx-auto form-control-file"
                                    name=""
                                    id=""
                                    placeholder=""
                                    aria-describedby="fileHelpId"
                                    @focus="clearError"
                                />


                            </div>

                        </div>



                        <div class="submit-btn d-flex justify-content-between align-items-center">
                        <span class="muted">

                            fields with *  are required
                        </span>

                            <button type="submit" class="btn btn-outline-primary">Submit</button>



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

    <script>
        "use strict";

        new Vue({
            el: "#app",

            data: {
                form: {!! json_encode($data) !!}
            },

            methods: {
                clearError(){
                    this.errors = [];
                },
                validateBeforeSubmit() {
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            // eslint-disable-next-line
                            alert('Form Submitted!');
                            return;
                        }
                    });
                },
            }






        });
    </script>
@endsection


