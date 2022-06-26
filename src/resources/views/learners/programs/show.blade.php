@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection

@section('head_css')
    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'learner'])
    <div id="program">
        <div class="jumbotron jumbotron-fluid program-jumbotron" style="background-image: url(programData.image)">
            <div class="container">
                <h1> @{{ programData.title }}</h1>

                <h4> @{{programData.description}}</h4>

                <!-- <small class="rating">
                    @{{rating}} @{{numberOfStudentEnrolled}} students
                </small>
                <br />
                <span class="last__updated">
                    <span><i class="fa fa-clock-o" aria-hidden="true"></i> Last updated 3/2021 </span>
                    <span class="language"><i class="fa fa-globe"></i> English </span>
                    <span> <i class="fa fa-cc" aria-hidden="true"></i> English [Auto] </span>
                </span> -->
            </div>
        </div>

        <section class="container program-contain">
            <h2 class="mb-5"><strong>Courses</strong> on @{{ programData.title }}</h2>
            <div class="row">
                <div
                    class="mb-5 col-lg-4 col-md-4 col-sm-6 col-xs-6"
                    v-for="(cardinfo, index) in allProgramCourses"
                    :key="index"
                >
                    <div class="card-course">
                        <!-- <div class="card-image"> -->
                        <img class="card-img-top" style="height: 180px; width:340px; object-fit: cover" :src="cardinfo.course_image" alt="" />

                        <!-- </div> -->
                        <div class="card-body">
                            <h5 class="card-title"> @{{ cardinfo.title }}</h5>
                            <h6 class="mb-2 card-subtitle text-muted">
                                @{{ cardinfo.author }}
                            </h6>
                            <p class="card-text" v-html="cardinfo.description"></p>

                            <a class="btn btn-outline-secondary" :href="'/learner/courses/'+cardinfo.id" role="button">View Details</a>
                            <a class="mx-2 btn btn-primary" :href="'/learner/courses/'+cardinfo.id+'/lesson/'+cardinfo.title" role="button">Start Course</a>
                        </div>
                    </div>
                </div>
            </div>

        </section> 
    </div>
@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
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
    <script>
        new Vue({
            el: "#program",
            data: {
                programData: {!! json_encode($data) !!},
                author: "Evan you",
                programTitle: 'Programming',
                numberOfStudentEnrolled: 240,
                desc: "Introduction to Programming",
                allProgramCourses: {!! json_encode($data['courses']) !!},
                rating: "(86900 ratings)",
                aboutProgram:
                    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, architecto!architecto!architecto! Sed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque.",
            },
            created() {
                this.fetchAllProgramCourses()
                if(this.programData.enrolled){
                    toastr["success"]('Enrollment successful!')
                }
            },
            methods: {
                fetchAllProgramCourses() {
                    axios.get(`/learner/courses/all/${this.programData.id}`)
                    .then( res => {
                        this.allProgramCourses = res.data.courses
                    })
                    .catch(e => {
                        console.log(e)
                    })
                }
            },
        });
    </script>
@endsection


