
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
                            <div class="form-group col-lg-6">
                                <label for="tenant"> Tenant * </label>
                                <select class="form-control" name="Tenant" v-validate="'required'"
                                :class="{'input': true, 'border border-danger': errors.has('Tenant') }" v-model="form.tenant_id">
                                    <option selected>Select tenants</option>
                                    <option>Tenant 1</option>
                                    <option>Tenant 2</option>
                                    <option>Tenant 3</option>
                                </select>
                                <i v-show="errors.has('Tenant')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Tenant')"
                                    class="help text-danger">@{{ errors . first('Tenant') }}</span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tenant"> Courses * </label>
                                <select class="form-control" v-model="form.course_id" name="Course" v-validate="'required'"
                                :class="{'input': true, 'border border-danger': errors.has('Course') }" id="">
                                    <option>Select Courses</option>
                                    <option>Course 1</option>
                                    <option> Course 2</option>
                                    <option> Course 3</option>
                                </select>
                                <i v-show="errors.has('Course')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('Course')"
                                    class="help text-danger">@{{ errors . first('Course') }}</span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="title"> Title * </label>
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
                                        placeholder="Enter Course Duration">
                                    <i v-show="errors.has('Duration')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Duration')"
                                        class="help text-danger">@{{ errors . first('Duration') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="description"> Program description * </label>
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

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="skill-gained">Skill gained*</label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Skilled Gained" class="form-control" v-model="form.skilled_gained" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Skilled Gained') }" type="text"
                                        placeholder="Enter Skilled Gained">
                                    <i v-show="errors.has('Skilled Gained')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Skilled Gained')"
                                        class="help text-danger">@{{ errors . first('Skilled Gained') }}</span>
                                </p>
                            </div>
                        </div>

                        <div
                                class=" submit-btn d-flex justify-content-between align-items-center"
                        >
                            <span class="muted"> fields with * are required </span>

                            <button type="submit" class="btn btn-outline-primary">
                                Edit Module
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

    <script>
        "use strict";

        new Vue({
            el: "#app",

            data: {
                form:{
                    tenant_id:'',
                    course_id: '',
                    title: '',
                    description: '',
                    skilled_gained: '',
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
            }

        });
    </script>
@endsection


