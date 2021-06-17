@extends('layouts.themes.tabler.tabler')
@section('head_css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
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
                {url: '', title: 'Create Quiz', active: true},
            ]">
        </breadcrumbs>
        <div class="container">
            <h3 class="mt-5">Create Quiz</h3>
            <div class="mx-auto mt-5 card col">
                <div class="card-body">
                    <form class="form" @submit.prevent="validateBeforeSubmit">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for=""> Quiz Name </label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Name" class="form-control" v-model="form.quiz_title" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Name') }" type="text"
                                        placeholder="Enter Quiz Name">
                                    <i v-show="errors.has('Name')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Name')"
                                        class="help text-danger">@{{ errors . first('Name') }}</span>
                                </p>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for=""> Quiz Timer </label>
                                <input v-model="form.quiz_timer" type="number" class="form-control" name="" id=""
                                    aria-describedby="helpId" placeholder="Time of Quiz" />
                            </div>

                            <div class="form-group col-lg-6">
                                <label for=""> Total Quiz Mark </label>
                                <input type="number" v-model="form.total_quiz_mark" class="form-control" name="" id=""
                                    aria-describedby="helpId" placeholder="Reward points" />
                            </div>

                            <div class="form-group col-lg-12">
                                <label> Disable Quiz on submit : </label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" v-model="form.disable_on_submit" value="true" name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline1">True</label>
                                  </div>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" v-model="form.disable_on_submit" value="false" name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline2">False</label>
                                </div>
                            </div>

                            <br />

                            <div class="form-group col-lg-12">
                                <label for="">Retake Quiz On Request : </label>
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

                        {{-- Questions Sections --}}
                        <div v-for="(question, index) in form.questions" :key="index" class="mb-3">
                            <div class="mb-5 form-row">
                                <div class="mb-5 form-group col-lg-6">
                                    <h2>Question</h2>
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
                                    <label for=""> Question Answer </label>
                                    <input type="text" class="form-control" v-model="question.answer" aria-describedby="helpId"
                                        placeholder="" />
                                </div>
                                <div class="form-group col-6">
                                    <label for=""> Quiz Score </label>
                                    <input type="number" class="form-control" v-model="question.score" aria-describedby="helpId"
                                        placeholder="" />
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

                                <a href="#" @click.prevent="addQuiz" class="btn btn-outline-secondary">
                                    Add Question
                                </a>
                                <a href="#" @click.prevent="removeQuiz(index)" class="ml-5 btn btn-outline-danger">
                                    Remove Question
                                </a>
                            </div>
                            <hr>
                        </div>

                        <div class="mt-5 submit-btn d-flex justify-content-between align-items-center">
                            <span class="muted"> fields with * are required </span>

                            <button type="submit" class="btn btn-outline-primary">
                                Create Quiz
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
    <link href="https://unpkg.com/@morioh/v-quill-editor/dist/editor.css" rel="stylesheet">
    <script src="https://unpkg.com/@morioh/v-quill-editor/dist/editor.min.js" type="text/javascript"></script>
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
    <script>
        new Vue({
            el: "#app",
            data: {
                index: 1,
                form: {
                    quiz_title: '',
                    total_quiz_mark: '',
                    quiz_timer: '',
                    disable_on_submit: '',
                    retake_on_request: '',
                    questions: [
                        {
                            question_text: '',
                            question_number: 1,
                            score: '',
                            answer: '',
                            question_type: '',
                            options: [""],
                        },
                    ],
                }
            },
            methods: {
                removeQuizOptionForUpdate (index, uindex) {
                    this.form.questions[index].options.splice(uindex, 1)
                },

                addQuizOptionForUpdate (index) {
                    this.form.questions[index].options.push('')
                },
                validateBeforeSubmit(ev) {
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            let loader = Vue.$loading.show()
                            const payload = {
                                quiz_title: this.form.quiz_title,
                                total_quiz_mark: this.form.total_quiz_mark,
                                quiz_timer: this.form.quiz_timer,
                                disable_on_submit: this.form.disable_on_submit,
                                retake_on_request: this.form.retake_on_request,
                                questions: JSON.stringify(this.form.questions)
                            }
                            axios.post('create', payload).then(res => {
                            loader.hide();
                            ev.target.reset()
                            toastr["success"](res.data.message)
                            }).catch(e => {
                                loader.hide();
                                const errors = e.response.data.error
                                if(e.response.data.error){
                                    toastr["error"](e.response.data.error)
                                }
                                else if(e.response.data.validation_error){
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
                addOptions(index) {
                    
                    this.form.questions[index].options.push('B')
                },
                addQuiz() {
                    this.index ++
                    this.form.questions.push(
                        {
                            question_text: '',
                            question_number:  this.index,
                            score: '',
                            answer: '',
                            question_type: '',
                            options: [""],
                        },
                    )

                },
                removeQuiz(quiz_id) {
                    this.index --
                    this.form.questions.splice(quiz_id, 1)
                },
            },
        })
    </script>
@endsection
