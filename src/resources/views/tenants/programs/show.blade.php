@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection

@section('head_css')
    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
    <style>
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">>";
        }
        .card-course {
            position: relative;
            /* width: 319px; */
            /* display: flex; */
            /* flex-direction: column; */
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            box-shadow: rgb(31 31 31 / 12%) 0px 1px 6px, rgb(31 31 31 / 12%) 0px 1px 4px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            /* box-shadow: 0 2px 2px rga(0, 0, 0, 0.25); */
            border: none;
            border-radius: 0.35rem;
            border-radius: 8px;
            transition: transform .5s;
            cursor: pointer;
        }
        .card-course:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }
        .primary-backgroundColor {
            background-color: #343a40 !important;
            color: white;
        }
    </style>
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div id="program">
        <breadcrumbs
                :items="[
                {url: '/tenant/dashboard', title: 'Home', active: false},
                {url: '/tenant/dashboard/programs', title: 'Programs', active: false},
                {url: '', title: programData.title, active: true},
            ]">
        </breadcrumbs>
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
                <div class="col-md-8">
                    <div class="row">
                        <div
                                class="mb-5 col-md-6"
                                v-for="(cardinfo, index) in allProgramCourses"
                                :key="index"
                        >
                            <div class="card-course">
                                <!-- <div class="card-image"> -->
                                <img class="card-img-top" :src="cardinfo.course_image" alt="" style="height: 200px" />

                                <!-- </div> -->
                                <div class="card-body">
                                    <h5 class="card-title"> @{{ cardinfo.title }}</h5>
                                    <h6 class="mb-2 card-subtitle text-muted">
                                        @{{ cardinfo.author }}
                                    </h6>
                                    <p class="card-text" v-html="cardinfo.description"></p>

                                    <a class="btn btn-outline-secondary" :href="'/tenant/courses/'+cardinfo.id" role="button">Edit</a>
                                    <a class="mx-2 btn btn-primary" :href="'/tenant/courses/show/'+cardinfo.id" role="button">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3>Learners List</h3>
                            <p class="text-center" v-if="learnersData.length < 1 ">No learner has taken this course</p>
                            <div v-if="learnersData.length > 0 ">
                                <p>This course has @{{learnersData.length}} learner(s) out of which <span v-text="learnersCompleted"></span> have completed it.</p>
                                <ol>
                                    <li v-for="(data,index) in learnersData" :key="index"><a href="#" v-text="fullName(data.learner)"></a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
                    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, architecto!architecto!architecto! Sed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quo.",
                learnersData: [],
                learnersCompleted: 0
            },
            created() {
                this.fetchAllProgramCourses()
                this.fetchAllProgramLearners()
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
                },
                fetchAllProgramLearners() {
                    axios.get(`/tenant/programs/${this.programData.id}/learners`)
                        .then( res => {
                            // console.log(res.data.learnerCourses[0])
                            let counter = this.learnersCompleted
                            this.learnersData = res.data.learnerPrograms
                            this.learnersData.forEach(function (val,index) {
                                if(val.completed === true){
                                    counter += 1
                                }
                            })
                            this.learnersCompleted = counter
                        })
                        .catch(e => {
                            console.log(e)
                        })
                },
                fullName(learner){
                    return learner.first_name+' '+learner.last_name
                }
            },
        });
    </script>
@endsection


