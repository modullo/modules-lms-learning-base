
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
            <h3 class="mt-5">Edit Lessons</h3>

            <div class="card col mt-5 mx-auto">
                <div class="card-body">
                    <form class="form">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="tenant"> Tenant * </label>
                                <select class="form-control" name="" id="">
                                    <option selected>Select tenants</option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
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
                                <label for="modules"> Modules * </label>
                                <select class="form-control" name="" id="">
                                    <option selected>Select Modules</option>
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
                                        placeholder="Lesson Title"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="description">  Lesson description * </label>
                                <textarea
                                        class="form-control"
                                        name=""
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

                        <div class="form-row">


                            <div class="form-group col-md-6">
                                <label for="skill-gained">Skill gained *</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="skill-gained"

                                />
                            </div>


                            <div class="form-group col-md-6">
                                <label for="duration">Duration*</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id=""

                                />
                            </div>


                            <div class="form-group col-md-6">
                                <label for="lesson-resource">Lesson Resource*</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id=""

                                />
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="additional-resource">Addtional-Resource *</label>
                                <textarea class="form-control" name="" id="" rows="3"></textarea>
                            </div>




                            <div class="form-group col-lg-4">
                                <label for="lesson-type">

                                    Lesson Type *
                                </label>
                                <select class="form-control" name="" id="">
                                    <option selected>
                                        select lesson type

                                    </option>

                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>



                            <div class="form-group col-lg-4">
                                <label for="module No">Lesson No *</label>
                                <input type="number"
                                       class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                            </div>




                            <div class="form-group col-lg-4">
                                <label for="module No">Content type *</label>
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

                            <button type="submit" class="btn btn-outline-primary">
                                Update Lesson
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

    <script>
        "use strict";

        new Vue({
            el: "#app",

            data: {
            },
        });
    </script>
@endsection


