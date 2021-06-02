
@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection

@section('head_css')
    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div class="container">
        <div id="app">
            <h3 class="mt-5">Create Modules</h3>

            <div class="card col mt-5 mx-auto">
                <div class="card-body">
                    <form class="form" @submit.prevent="submitForm">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="tenant"> Courses * </label>
                                <select class="form-control" name="" id="">
                                    <option selected>Select Courses</option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
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
                                        placeholder="Modules Title"
                                />
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="duration"> Duration </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name=""
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder="Modules Duration"
                                />
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
                            <div class="form-group col-lg-6">
                                <label for="description"> Module description * </label>
                                <textarea
                                        class="form-control"
                                        name=""
                                        id="description"
                                        placeholder="Modules Description"
                                        rows="3"
                                ></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="skill-gained">Skill gained*</label>
                                <textarea cols="5" rows="3" type="text" class="form-control" id="skill-gained">
                                </textarea>
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
                                Create Module
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
                form:{
                    tenant_id:''
                }
            },
            methods: {
                submitForm() {
                    console.log('working!!')
                    if (!this.form.tenant_id) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'You have a missing inputs, All * are required!',
                        })
                        return true;
                    }

                },
            }

        });
    </script>
@endsection


