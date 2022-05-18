@extends('layouts.themes.tabler.tabler')

@section('head_css')
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@2.21.2/dist/bootstrap-vue.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/learning/assets/css/styles.css') }}">
@endsection

@section('head_js')
    <script src="https://unpkg.com/vue@2.6.12/dist/vue.js"></script>
    <script src="https://unpkg.com/babel-polyfill/dist/polyfill.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-ellipse-progress/dist/vue-ellipse-progress.umd.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@2.21.2/dist/bootstrap-vue-icons.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

@endsection


@section('body_content_main')

    @include('modules-lms-base::navigation',['type' => 'learner'])
    <div id="app">
        <nav-bar :course-data="courseData"></nav-bar>
        <b-row>
            <b-col lg="9" class="col-remove-p main-section">
                <open-course @send-new-updated-content="wrapperCollectNewContent" :course-data="courseData" @current-lesson="parentListenForLesson" ref="childRef"></open-course>
                <lesson-tabs :course-data="courseData" ref="mobileResponse"></lesson-tabs>
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
    <script src="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3"></script>
    <link href="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3/dist/vue-loading.css" rel="stylesheet">
    <!-- Init the plugin and component-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        Vue.use(VueLoading);
        Vue.component('loading', VueLoading)
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
                courseData: {!! json_encode($data) !!}
            },
            mounted: function() {
                //console.log(this.courseData)
            },
            methods: {
                setVideo(payload) {
                    // alert('videos' + payload)
                    this.$refs.sideContents.listener = payload
                    this.$refs.mobileResponse.tabsData = payload
                    this.$refs.childRef.currentVideo = payload

                    // this.$refs.sideContents.mobileResponse = payload
                },
                wrapperCollectNewContent(payload) {
                    this.$refs.sideContents.listener = payload
                    this.$refs.mobileResponse.tabsData = payload
                    this.$refs.sideContents.mobileResponse = payload
                    this.$root.$emit('bv::toggle::collapse', 'accordion-10')
                },
                parentListenForLesson(payload) {
                    this.$refs.sideContents.listener = payload
                    this.$refs.mobileResponse.tabsData = payload
                    this.$refs.sideContents.mobileResponse = payload
                }
            }
        })
    </script>
@endsection


