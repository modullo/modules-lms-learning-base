@extends('layouts.themes.tabler.tabler')
@section('head_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            content: ">>";
        }

    </style>
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div id="app">
        <breadcrumbs :items="[
                    {url: '/tenant/dashboard', title: 'Home', active: false},
                    {url: '/tenant/quiz', title: 'Quiz', active: false},
                    {url: '', title: 'Edit Quiz', active: true},
                ]">
        </breadcrumbs>
        <div class="container">
            <h3 class="mt-5">Edit Quiz</h3>
            <div class="mx-auto mt-5 card col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" style="width: 33.3%;padding: .5em; background-color:#343a40">
                        <a class="text-center w-100 nav-link active font-weight-bold" data-toggle="tab" href="#tabs-1" role="tab">Quiz Section</a>
                    </li>
                    <li class="nav-item" style="width: 33.3%;padding: .5em; background-color:#343a40">
                        <a class="text-center w-100 nav-link font-weight-bold" data-toggle="tab" href="#tabs-2" role="tab">Quiz Questions</a>
                    </li>
                    <li class="nav-item" style="width: 33.3%;padding: .5em; background-color:#343a40">
                        <a class="text-center w-100 nav-link font-weight-bold" data-toggle="tab" href="#tabs-3" role="tab">Add New Question</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                        <div class="card-body">
                            <form class="form" @submit.prevent="validateBeforeSubmit">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label for=""> Quiz Type </label>
                                        <select v-model="form.quiz_type" id="quiz_type" class="form-control" @change="form.pq_course = ''">
                                            <option value="">-- Choose--</option>
                                            <option value="regular">Regular</option>
                                            <option value="pre-qualifier">Pre-qualifier</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6" v-if="form.quiz_type === 'pre-qualifier'">
                                        <label for=""> Course to Pre-qualify for </label>
                                        <select v-model="form.pq_course" id="pq_course" class="form-control">
                                            <option value="">-- Choose--</option>
                                            <option v-for="(course,courseIndex) in courses" :value="course.id">@{{course.title}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for=""> Quiz Title </label>
                                        <p class="control has-icon has-icon-right">
                                            <input name="quiz_title" class="form-control" v-model="form.title" v-validate="'required'"
                                                   :class="{'input': true, 'border border-danger': errors.has('quiz_title') }" type="text"
                                                   placeholder="Enter Quiz Title">
                                            <i v-show="errors.has('quiz_title')" class="fa fa-warning text-danger"></i>
                                            <span v-show="errors.has('quiz_title')"
                                                  class="help text-danger">@{{ errors . first('quiz_title') }}</span>
                                        </p>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for=""> Quiz Score (Total) </label>
                                        <input type="number" v-model="form.total_quiz_mark" class="form-control" name="" id=""
                                               aria-describedby="helpId" placeholder="Reward points" />
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="timing_mode"> Timing Mode </label>
                                        <select v-model="form.timing_mode" id="timing_mode" name="timing_mode" class="form-control">
                                            <option value="">-- Choose--</option>
                                            <option value="self-paced">Self paced</option>
                                            <option value="timed">Timed</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6" v-if="form.timing_mode === 'timed'">
                                        <label> Set Time per Question </label>
                                        <div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="time_per_question_yes" v-model="form.time_per_question" value="yes" name="time_per_question" class="custom-control-input">
                                                <label class="custom-control-label" for="time_per_question_yes">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="time_per_question_no" v-model="form.time_per_question" value="no" name="time_per_question" class="custom-control-input">
                                                <label class="custom-control-label" for="time_per_question_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6" v-if="form.time_per_question !== 'yes'">
                                        <label for=""> Total Quiz Time (in minutes) </label>
                                        <input v-model="form.quiz_timer" type="number" class="form-control" name="" id=""
                                               aria-describedby="helpId" placeholder="Quiz Time (in minutes)" />
                                    </div>

                                    <div class="form-group col-lg-6" v-if="form.quiz_type === 'pre-qualifier'">
                                        <label for=""> Pass Mark </label>
                                        <input type="number" v-model="form.pass_mark" class="form-control" name="" id=""
                                               aria-describedby="helpId" placeholder="Enter qualifier minimum score" />
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label> Randomize Questions </label>
                                        <div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="randomize_questions_yes" v-model="form.randomize_questions" value="true" name="randomize_questions" class="custom-control-input">
                                                <label class="custom-control-label" for="randomize_questions_yes">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="randomize_questions_no" v-model="form.randomize_questions" value="false" name="randomize_questions" class="custom-control-input">
                                                <label class="custom-control-label" for="randomize_questions_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label> Randomize Options </label>
                                        <div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="randomize_options_yes" v-model="form.randomize_options" value="true" name="randomize_options" class="custom-control-input">
                                                <label class="custom-control-label" for="randomize_options_yes">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="randomize_options_no" v-model="form.randomize_options" value="false" name="randomize_options" class="custom-control-input">
                                                <label class="custom-control-label" for="randomize_options_no">No</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline d-none">
                                                <input type="radio" id="randomize_options_choose" v-model="form.randomize_options" value="per_question" name="randomize_options" class="custom-control-input">
                                                <label class="custom-control-label" for="randomize_options_choose">Choose per question</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label> Disable Quiz on Submit </label>
                                        <div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline1" v-model="form.disable_on_submit" value="true" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">True</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" v-model="form.disable_on_submit" value="false" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">False</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Retake Quiz On Request </label>
                                        <div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="true" v-model="form.retake_on_request" id="customRadioInline3" name="customRadioInline2"
                                                       class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline3">True</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="false" v-model="form.retake_on_request" id="customRadioInline4" name="customRadioInline2" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline4">False</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 submit-btn d-flex justify-content-between align-items-center">
                                    <span class="muted"> fields with * are required </span>

                                    <button type="submit" class="btn btn-outline-secondary">
                                        Edit Quiz
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                        {{-- Questions Sections --}}
                        <div v-for="(question, index) in form.questions" :key="index" class="mt-3 mb-5">
                            <div class="mb-5 form-row">
                                <div class="mb-5 form-group col-lg-12">
                                    <h2>Question @{{index + 1}}</h2>
                                    <editor style="height: 100px" v-model="question.question_text" theme="snow"></editor>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for=""> Question Type </label>
                                    <select v-model="question.question_type" id="" class="form-control">
                                        <option value="options">Options</option>
                                        <option value="case_study">Case Study</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for=""> Options Answer </label>
                                    <input type="text" v-model="question.answer" name="answer" id="" class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label for=""> Quiz Score </label>
                                    <input type="number" class="form-control" v-model="question.score"
                                        aria-describedby="helpId" placeholder="" />
                                </div>
                            </div>
                            <div v-if="question.question_type === 'options'">
                                <div v-for="(option, uindex) in question.options" :key="uindex"
                                class="form-row">
                                    <div class="p-0 form-group col-lg-6">
                                        <label for=""> Options</label>
                                        <input type="text" v-model="question.options[uindex]" class="form-control">
                                    </div>
                                    <div class="my-auto ml-3 col-1">
                                        <span @click.prevent="removeQuizOptionForUpdate(index, uindex)" style="cursor: pointer;font-size: 2em" class="mt-4"><i class="fas fa-backspace"></i></span>
                                    </div>
                                    <div class="my-auto col-1">
                                        <span @click.prevent="addQuizOptionForUpdate(index)" style="font-size: 2em; cursor: pointer;" class="mt-4"><i class="far fa-plus-square"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">

                                <a href="#" @click.prevent="updateQuestion(question)" class="btn btn-outline-secondary">
                                    Update Question
                                </a>
                                <a href="#" @click.prevent="deleteQuestion(question)" class="ml-5 btn btn-outline-danger">
                                    Remove Question
                                </a>
                            </div>
                            <hr>
                        </div>
                    </div>

                    {{-- Add Quiz Question Section --}}
                    <div class="tab-pane" id="tabs-3" role="tabpanel">
                        <div class="mt-5 mb-5 form-row">
                            <div class="mb-5 form-group col-lg-12">
                                <h2>Question Text</h2>
                                <editor style="height: 100px" v-model="question_text" theme="snow"></editor>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-lg-6">
                                <label for=""> Question Type </label>
                                <select v-model="question_type" id="" class="form-control">
                                    <option value="options">Options</option>
                                    <option value="case_study">Case Study</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for=""> Option Answer </label>
                                <input type="text" v-model="answer" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for=""> Quiz Score </label>
                                <input type="number" class="form-control" v-model="score"
                                    aria-describedby="helpId" placeholder="" />
                            </div>
                        </div>
                        <div v-if="question_type === 'options'">
                            <div v-for="(option, optionIndex) in question.options" :key="optionIndex"
                            class="form-row">
                                <div class="p-0 form-group col-lg-6">
                                    <label for=""> Options</label>
                                    <input type="text" v-model="question.options[optionIndex]" class="form-control">
                                </div>
                                <div class="my-auto ml-3 col-1">
                                    <span @click.prevent="removeOption(optionIndex)" style="cursor: pointer;font-size: 2em" class="mt-4"><i class="fas fa-backspace"></i></span>
                                </div>
                                <div class="my-auto col-1">
                                    <span @click.prevent="addOptions(optionIndex)" style="font-size: 2em; cursor: pointer;" class="mt-4"><i class="far fa-plus-square"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="float-right m-3 form-row ">
                            <a href="#" @click.prevent="createQuestion" class="btn btn-outline-secondary">
                                Submit Question
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <!-- jsdelivr cdn -->
    <link href="https://unpkg.com/@morioh/v-quill-editor/dist/editor.css" rel="stylesheet">
    <script src="https://unpkg.com/@morioh/v-quill-editor/dist/editor.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@<3.0.0/dist/vee-validate.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    <script>
        new Vue({
            el: "#app",
            data: {
                index: 1,
                form: {!! json_encode($data) !!},
                question_text: '',
                answer: '',
                question_type: '',
                score: '',
                question_number: '',
                question: {
                    options: [
                        ""
                    ],
                },
            },
            mounted: function() {
                // console.log(this.form)
            },
            methods: {
                addQuizOptionForUpdate (index) {
                    this.form.questions[index].options.push('')
                },
                removeQuizOptionForUpdate (index, uindex) {
                    this.form.questions[index].options.splice(uindex, 1)
                },
                addOptions(index) {
                    this.question.options.push('')
                },
                removeOption(index) {
                    this.question.options.splice(index, 1)
                },
                validateBeforeSubmit(ev) {
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            let loader = Vue.$loading.show()
                            const payload = {
                                quiz_title: this.form.title,
                                quiz_type: this.form.quiz_type,
                                pq_course: this.form.pq_course,
                                total_quiz_mark: this.form.total_quiz_mark,
                                pass_mark: this.form.pass_mark,
                                timing_mode: this.form.timing_mode,
                                time_per_question: this.form.time_per_question,
                                quiz_timer: this.form.quiz_timer,
                                disable_on_submit: this.form.disable_on_submit,
                                retake_on_request: this.form.retake_on_request,
                                randomize_questions: this.form.randomize_questions,
                                randomize_options: this.form.randomize_options,
                                questions: JSON.stringify(this.form.questions)
                            }
                            axios.put(`${this.form.id}`, payload).then(res => {
                                loader.hide();
                                toastr["success"](res.data.message)
                            }).catch(e => {
                                loader.hide();
                                const errors = e.response.data.error
                                if (e.response.data.error) {
                                    toastr["error"](e.response.data.error)
                                } else if (e.response.data.validation_error) {
                                    Object.entries(e.response.data.validation_error).forEach(
                                        ([, value]) => {
                                            toastr["error"](value)
                                        },
                                    )
                                }
                            })
                        }
                    });
                },
                createQuestion(ev) {
                    // console.log(this.form.questions[this.form.questions.length - 1].question_number)
                    let loader = Vue.$loading.show()
                    const payload = {
                        question_text: this.question_text,
                        answer: this.answer,
                        question_type: this.question_type,
                        options: this.question.options,
                        score: this.score,
                        question_number: this.form.questions[this.form.questions.length - 1].question_number + 1,
                    }
                    axios.post(`questions/add/${this.form.id}`, payload).then(res => {
                        console.log(res)
                        this.question_text = ''
                        this.answer = ''
                        this.question_type = ''
                        this.score = '',
                        loader.hide();
                        toastr["success"](res.data.message)
                    }).catch(e => {
                        loader.hide();
                        if (e.response.data.error) {
                            toastr["error"](e.response.data.error)
                        } else if (e.response.data.validation_error) {
                            Object.entries(e.response.data.validation_error).forEach(
                                ([, value]) => {
                                    toastr["error"](value)
                                },
                            )
                        }
                    })
                },

                updateQuestion(question) {
                    let loader = Vue.$loading.show()
                    const payload = {
                        question_text: question.question_text,
                        answer: question.answer,
                        question_type: question.question_type,
                        score: question.score,
                        question_number: question.question_number,
                        question_id: question.id,
                        options: question.options,
                    }
                    axios.put(`questions/${this.form.id}`, payload).then(res => {
                        loader.hide();
                        toastr["success"](res.data.message)
                    }).catch(e => {
                        loader.hide();
                        const errors = e.response.data.error
                        if (e.response.data.error) {
                            toastr["error"](e.response.data.error)
                        } else if (e.response.data.validation_error) {
                            Object.entries(e.response.data.validation_error).forEach(
                                ([, value]) => {
                                    toastr["error"](value)
                                },
                            )
                        }
                    })
                },

                deleteQuestion(question) {
                    swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Question Again!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        axios.delete(`questions/${question.id}`).then(res => {
                            loader.hide();
                            // toastr["success"](res.data.message)
                        }).catch(e => {
                            loader.hide();
                            swal("Operation Cancelled! Server Error", {icon: 'error'});
                        })
                        swal("Poof! Your Question has been deleted!", {
                        icon: "success",
                        });
                    } else {
                        swal("Operation Cancelled!");
                    }
                    });
                }
            },
        })

    </script>
@endsection
