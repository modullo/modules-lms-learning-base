
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


                        <div class="mb-8 mt-8" v-for="(quiz,index) in quizzes" :key="index">
                                <div class="mt-4 mb-4 col-md-6">
                                      <label for=""> Quiz Score </label>
                                        <input
                                                type="number"
                                                class="form-control"
                                                name=""
                                                id=""
                                                placeholder=""
                                        />
                                </div>
                            <button v-if="index >= 1" @click.prevent="removeQuiz(index)" class="btn btn-outline-danger float-lg-right">
                                Remove Quiz
                            </button>
                            <div class="form-row mb-5">
                                <div class="form-group col-lg-6 mb-5">
                                    <h2>Question @{{ index+1 }}</h2>

                                    <div id="question"></div>
                                </div>
                            </div>

                            <div class="form-row mt-5">
                                <div class="form-group col-md-6 "   v-for="i in 4" :key="i">
                                    <label for=""> Options </label>
                                    <input

                                            type="text"
                                            class="form-control"
                                            name=""
                                            id=""
                                            aria-describedby="helpId"
                                            placeholder="quiz options"
                                    />
                                </div>
                            </div>


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
                        <button @click.prevent="addQuiz" class="btn btn-outline-primary float-lg-right">
                            Add Quiz
                        </button>
                        <button @submit.prevent="submitForm" class="btn btn-outline-primary">
                            Submit Quiz
                        </button>
                    </div>
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

        new Vue({
            el: "#app",

            data: {
                errors: [],
                quizzes:[
                    {
                        score:'',
                        question:'',
                        options:[

                        ]
                    }
                ],
                aboutProgram:
                    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, architecto!architecto!architecto! Sed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libero nihil id veniam illo voluptates non dicta debitis enim nam minim,Nesciunt voluptate sequi odit corporis laboriosam molestiae repellat labore, ducimus ad nulla voluptates reprehenderit quidem impedit. Debitis magnam quis voluptatum obcaecati, voluptates atque deleniti nobis. Illum quos laudantium nemo quo.",
                form:{
                    title:null
                }
            },
            methods: {
                submitForm(event) {
                    event.preventDefault()
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

                addQuiz(){
                    this.quizzes.push(
                        {
                            score:'',
                            question:'',
                            options:[

                            ]
                        }
                    )
                },

                removeQuiz(index){
                    this.quizzes.splice(index,1)
                }
            }
        });
    </script>
@endsection


