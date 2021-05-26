
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
            <h3 class="mt-5">Edit Program</h3>

            <div class="card col mt-5 mx-auto">
                <div class="card-body">
                    <form class="form"  @submit="submitForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Title *</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="title"
                                        placeholder="Title of program"


                                />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="subtype"> Subscription type * </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="subtype"
                                        placeholder="Select Subscription type"


                                />
                            </div>

                            <div class="form-group col-md-3">
                                <label for="visibilitytype"> Visibility type * </label>

                                <select
                                        class="form-control"
                                        name=""
                                        v-model="form"
                                        id="visibilitytype"
                                >
                                    <option disabled selected="selected">
                                        Select program Visibility *
                                    </option>

                                    <option>select 1</option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6 ">
                                <label for="description"> Program description * </label>
                                <textarea
                                        class="form-control"
                                        name=""
                                        id="description"
                                        placeholder="Program Description"
                                        rows="3"

                                ></textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for=""></label>
                                <input
                                        type="file"
                                        class="form-control-file mx-auto"
                                        name=""
                                        id=""
                                        placeholder=""
                                        aria-describedby="fileHelpId"
                                />


                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="subscriptioncost">Subscription Cost *</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="subscriptioncost"

                                />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="overviewvideo">Overview Video *</label>
                                <input type="text"

                                       class="form-control" id="overviewvideo"

                                />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="customSwitch1"
                                    />
                                    <label class="custom-control-label" for="customSwitch1">
                                        Include Subscription Limit *
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="submit-btn d-flex justify-content-between align-items-center">


                            <button type="submit" class="btn btn-outline-primary">Update Program</button>



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
        var dummyData = [
            {
                title: " objects and classes",
                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "inheritance",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "constructor",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "interface",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",
                image:
                    "https://images.unsplash.com/photo-1491841651911-c44c30c34548?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80",
            },
        ];

        new Vue({
            el: "#app",

            data: {

                cardinfos: dummyData,

            },
            methods: {
                submitForm() {
                    console.log('working!!')
                    if (!this.form.title) {
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


