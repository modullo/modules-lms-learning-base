@extends('layouts.themes.tabler.tabler')

@section('head_css')
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@2.21.2/dist/bootstrap-vue.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/learning/assets/css/styles.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/vue-plyr/dist/vue-plyr.css" />
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/theme/dracula.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/theme/twilight.css') }}">
    <style>
        .time-up-cover{
            background: rgba(255, 255, 255, 0.4);
        }
        .center-time-up{
            text-align: center !important;
            font-size: 26px;
            font-weight: 700;
            color: red;
        }
        .fullScreen{
            position: fixed !important;
            width: 100vw;
            min-height: 100vh;
            background: white;
            top: 0;
            left: 0;
            max-width: 100vw;
            padding-top: 20px;
            z-index: 10;
        }
        .fullScreenController{
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 10px;
            padding-right: 30px;
            z-index: 11;
            cursor: pointer;
        }
    </style>
@endsection

@section('head_js')
    <script src="https://unpkg.com/vue@2.6.12/dist/vue.js"></script>
    <script src="https://unpkg.com/babel-polyfill/dist/polyfill.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-ellipse-progress/dist/vue-ellipse-progress.umd.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@2.21.2/dist/bootstrap-vue-icons.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script src="{{asset('plugins/codemirror/lib/codemirror.js')}}"></script>
    <script src="{{asset('plugins/codemirror/mode/xml/xml.js')}}"></script>
    <script src="{{asset('plugins/codemirror/mode/javascript/javascript.js')}}"></script>
    <script src="{{asset('plugins/codemirror/mode/css/css.js')}}"></script>
    <script src="{{asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
    <script src="{{asset('plugins/codemirror/addon/edit/closetag.js')}}"></script>
    <script src="{{asset('plugins/codemirror/addon/edit/closebrackets.js')}}"></script>

@endsection


@section('body_content_main')

    @include('modules-lms-base::navigation',['type' => 'learner'])
    <div id="app">
        <nav-bar :course-data="courseData"></nav-bar>
        <b-row>
            <b-col lg="9" class="col-remove-p main-section">
                <open-course @send-new-updated-content="wrapperCollectNewContent" :course-data="courseData" @current-lesson="parentListenForLesson" @lesson-ended="markLessonComplete" ref="childRef" :key="componentKey"></open-course>
                <lesson-tabs :course-data="courseData" :active-lesson="activeLesson" :code-lang="codeLang" ref="mobileResponse"></lesson-tabs>
            </b-col>
            <b-col lg="3" class="col-remove-p">
                <sidebar @send-new-content-to-appwrapper="wrapperCollectNewContent" :course-data="courseData" ref="sideContents" @send-video-to-appwrapper="setVideo"></sidebar>
                {{-- <sidebar :course-data="courseData.modules" ref="sideContents" @send-video-to-appwrapper="setVideo"></sidebar> --}}
            </b-col>
        </b-row>
        {{-- <quiz-questions :id="1"></quiz-questions> --}}
    </div>

@endsection

@section('body_js')
    <script src="{{ asset('vendor/learning/components/Navbar.js') }}"></script>
    <script src="{{ asset('vendor/learning/components/OpenCourse.js') }}"></script>
    <script src="{{ asset('vendor/learning/components/Sidebar.js') }}"></script>
    <script src="{{ asset('vendor/learning/components/Sidebar-Item.js') }}"></script>
    <script src="{{ asset('vendor/learning/components/LessonTabs.js') }}"></script>
    <script src="{{ asset('vendor/learning/components/Chapter.js') }}"></script>
    <script src="{{ asset('vendor/learning/components/QuizQuestions.js') }}"></script>
    <script src="{{ asset('vendor/learning/components/CourseQuizQuestions.js') }}"></script>
    <script src="{{ asset('vendor/learning/components/Footer.js') }}"></script>
    <link href="https://unpkg.com/@morioh/v-quill-editor/dist/editor.css" rel="stylesheet">
    <script src="https://unpkg.com/@morioh/v-quill-editor/dist/editor.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3"></script>
    <link href="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3/dist/vue-loading.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/vue-plyr"></script>
    <!-- Init the plugin and component-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/@chenfengyuan/vue-countdown@1"></script>
    <script>
        Vue.use(VueLoading);
        Vue.use(VuePlyr);
        Vue.component('loading', VueLoading)
        Vue.component('vue-plyr', VuePlyr)
        Vue.component(VueCountdown.name, VueCountdown)
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
    {{-- <script src="{{ asset('vendor/learning/app.js') }}"></script> --}}
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                name: 'Musah Musah!',
                courseData: {!! json_encode($data) !!},
                activeLesson: [],
                componentKey: 0,
                languages: {!! json_encode(config('code-editor.languages')) !!},
                codeLang: []
            },
            mounted: function() {
                //console.log(this.courseData)
            },
            created() {
                if(this.courseData.started){
                    toastr["success"]('Course marked as started!')
                }
            },
            methods: {
                setVideo(payload) {
                    // alert('videos' + payload)
                    this.activeLesson = payload
                    this.$refs.sideContents.listener = payload
                    this.$refs.mobileResponse.tabsData = payload
                    this.$refs.childRef.currentVideo = payload
                    if(this.activeLesson.lesson_type === 'video'){
                        // this.componentKey += 1
                        console.log(this.componentKey)
                    }
                    if(this.activeLesson.has_code_editor === true){
                        this.codeLang = this.languages[this.activeLesson.code_language]
                    }

                    // this.$refs.sideContents.mobileResponse = payload
                },
                wrapperCollectNewContent(payload) {
                    this.activeLesson = payload
                    this.$refs.sideContents.listener = payload
                    this.$refs.mobileResponse.tabsData = payload
                    this.$refs.sideContents.mobileResponse = payload
                    this.$root.$emit('bv::toggle::collapse', 'accordion-10')
                },
                parentListenForLesson(payload) {
                    this.activeLesson = payload
                    this.$refs.sideContents.listener = payload
                    this.$refs.mobileResponse.tabsData = payload
                    this.$refs.sideContents.mobileResponse = payload
                },
                markLessonComplete() {
                    // console.log(this.activeLesson)
                    // console.log(this.courseData)
                    this.completeCourse(this.activeLesson.id,this.courseData.id)
                },
                completeCourse(id, courseId) {
                    let loader = Vue.$loading.show();
                    let completeUrl = `/learner/courses/completeCourse/${id}`
                    if(this.activeLesson.lesson_type === 'scheduler'){
                        completeUrl = `/learner/courses/completeCourse/${id}?scheduler=true`
                    }
                    axios
                        .post(completeUrl, {course_id: courseId})
                        .then((res) => {
                            // Emit event with course data
                              console.log(res.data.course)
                            this.$emit('send-new-updated-content', res.data.course)
                            location.reload()
                            this.componentkey += 1
                            loader.hide();
                            //   this.filteredData = res.data.data;
                            // alert('Lesson Marked as COMPLETED')
                        })
                        .catch((e) => {
                            loader.hide();
                        });
                },

            }
        })
    </script>
@endsection


