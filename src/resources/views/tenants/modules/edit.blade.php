
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
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item ml-4"><a href="#">Home</a></li>
            <li class="breadcrumb-item"> <a href="/tenant/modules">Modules</a></li>
            <li class="breadcrumb-item active">Edit Modules</li>
        </ol>
    </nav>
    <div class="container">
        <div id="app">
            <h3 class="mt-5">Edit Modules</h3>
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
                    <form class="form" @submit.prevent="submitForm">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="tenant"> Tenant * </label>
                                <select class="form-control" name="" id="" v-model="form.tenant_id">
                                    <option selected>Select tenants</option>
                                    <option>Tenant 1</option>
                                    <option>Tenant 2</option>
                                    <option>Tenant 3</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tenant"> Courses * </label>
                                <select class="form-control" v-model="form.course_id" name="" id="">
                                    <option selected>Select Courses</option>
                                    <option>Course 1</option>
                                    <option> Course 2</option>
                                    <option> Course 3</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="title"> Title * </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name=""
                                        id=""
                                        v-model="form.title"
                                        aria-describedby="helpId"
                                        placeholder="Modules Title"
                                />
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="duration"> Duration </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name=""
                                        v-model="form.duration"
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder="Modules Duration"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="description"> Program description * </label>
                                <textarea
                                        class="form-control"
                                        name=""
                                        id="description"
                                        v-model="form.description"
                                        placeholder="Modules Description"
                                        rows="3"
                                ></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="module-no"> Module No </label>
                                <input
                                        type="number"
                                        class="form-control"
                                        name=""
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder=""
                                />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="skill-gained">Skill gained*</label>
                                <input type="text" class="form-control" id="skill-gained" />
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

                            <button type="submit" class="btn btn-outline-primary">
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        "use strict";

        new Vue({
            el: "#app",

            data: {
                errors: [],
                form:{
                    tenant_id:'',
                    course_id: '',
                    title: '',
                    description: ''
                }
            },
            methods: {
                submitForm() {  
                    if (this.form.title && this.description && this.form.tenant_id && this.form.course_id) {
                        return true;
                    }

                    this.errors = [];

                    if (!this.form.title) {
                        this.errors.push('Title is required.');
                    }
                    if (!this.form.description) {
                        this.errors.push('Description is required.');
                    }
                    if (!this.form.tenant_id) {
                        this.errors.push('Tenant is required.');
                    }
                    if (!this.form.course_id) {
                        this.errors.push('Course is required.');
                    }

                },
            }

        });
    </script>
@endsection


