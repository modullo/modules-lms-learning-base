
@extends('layouts.themes.tabler.tabler')

@section('head_css')
    <link
            href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
            rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
@endsection

@section('head_js')

@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div class="container">
        <div id="app">
            <h3 class="mt-5">Create Quiz</h3>

            <div class="card col mt-5 mx-auto">
                <div class="card-body">
                    <form class="form" @submit.prevent="submitForm">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for=""> Quiz Name </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name=""
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder="Title of Quiz"
                                        v-model="form.title"
                                />
                            </div>

                            <div class="form-group col-lg-6">
                                <label for=""> Quiz Timer </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name=""
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder="Time of Quiz"
                                />
                            </div>

                            <div class="form-group col-lg-6">
                                <label for=""> Reward Points </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name=""
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder="Reward points"
                                />
                            </div>

                            <div class="form-group col-lg-6">
                                <label for=""> Total Quiz on Request </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name=""
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder="Total Quiz marks"
                                />
                            </div>

                            <div class="form-group col-lg-12">
                                <label> Disable Quiz on submit </label>

                                <div class="form-check form-check-inline mx-3">
                                    <label class="form-check-label">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name=""
                                                id=""
                                                value="checkedValue"
                                        />True
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name=""
                                                id=""
                                                value="checkedValue"
                                        />
                                        False
                                    </label>
                                </div>
                            </div>

                            <br />

                            <div class="form-group col-lg-12">
                                <label> Retake Quiz on Request </label>

                                <div class="form-check form-check-inline mx-3">
                                    <label class="form-check-label">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name=""
                                                id=""
                                                value="checkedValue"
                                        />True
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name=""
                                                id=""
                                                value="checkedValue"
                                        />
                                        False
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row ">
                            <div class="form-group">
                                <label for=""> Quiz Score </label>
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

                        <div class="form-row mb-5">
                            <div class="form-group col-lg-6 mb-5">
                                <h2>Question</h2>

                                <div id="question"></div>
                            </div>
                        </div>


                        <div class="form-row mt-5">
                            <div class="form-group col-lg-12 " style="margin-top: 40px">
                                <label for=""> Options </label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name=""
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder="quiz options"
                                />

                                <input
                                        type="text"
                                        class="form-control mt-2"
                                        name=""
                                        id=""
                                        aria-describedby="helpId"
                                        placeholder="quiz options"
                                />
                            </div>
                            <button type="button" class="btn btn-outline-primary">
                                Add options
                            </button>
                        </div>

                        <div
                                class="
                  submit-btn
                  d-flex
                  justify-content-between
                  align-items-center
                  mt-5
                "
                        >
                            <span class="muted"> fields with * are required </span>

                            <button type="submit" class="btn btn-outline-primary">
                                Add Quiz
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->

    <script>
        var quill = new Quill("#question", {
            theme: "snow",

            placeholder: "Quiz Question...",

            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ["bold", "italic", "underline"],
                    ["image", "code-block"],
                ],
            },
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                author: "Evan you",
                programTitle: "C++ Certificate Program",
                numberOfStudentEnrolled: 240,
                desc: "Learn how to use Postman to build REST & GraphQL request",
                cardinfos: dummyData,
                rating: "(86900 ratings)",
                errors: [],
                aboutProgram:
                    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, architecto!architecto!architecto! Sed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libero nihil id veniam illo voluptates non dicta debitis enim nam minim,Nesciunt voluptate sequi odit corporis laboriosam molestiae repellat labore, ducimus ad nulla voluptates reprehenderit quidem impedit. Debitis magnam quis voluptatum obcaecati, voluptates atque deleniti nobis. Illum quos laudantium nemo quo.",
                form:{
                    title:null
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


