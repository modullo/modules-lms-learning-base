
@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection

@section('head_css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">>";
        }
    </style>
@endsection

@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'learner'])
    <div id="program">
        <breadcrumbs 
            :items="[
                {url: '/learner/dashboard', title: 'Home', active: false},
                {url: '', title: 'Programs', active: true},
            ]">
        </breadcrumbs>
        <div class="container" style="padding-top: 60px">


            <div class="mb-4 input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-search form-control-feedback"></span>
                    </div>
                </div>
                <input
                    type="text"
                    v-model="search"
                    class="form-control"
                    placeholder="Search Programs"
                />
            </div>

            <h1 class="mb-4">Available Programs</h1>

            <div class="row">
                <div
                        class="mb-5 col-lg-4 col-md-6 col-sm-12 col-xs-6"
                        v-for="(cardinfo, index) in searchCourses"
                        :key="index"
                >
                    <div class="card-course">
                        <img class="card-img-top" :src="cardinfo.image" alt="" style="height: 200px" />
                        <div class="card-body bg-white">

                            <h5 class="card-title">
                                <a :href="'/learner/programs/'+cardinfo.id">
                                    @{{ cardinfo.title }}
                                </a>
                            </h5>
                            <p class="card-text">@{{ cardinfo.description.substring(0,100) }}</p>
                            <a v-if="enrolledPrograms.includes(cardinfo.id) == false" class="mx-2 btn btn-primary" :class="{disabled: toEnroll === cardinfo.id}" :href="'/learner/programs/'+cardinfo.id+'/enroll'" @click="toEnroll = cardinfo.id" role="button">@{{ toEnroll === cardinfo.id ? 'Enrolling...' : 'Enroll' }}</a>
                            <a v-if="enrolledPrograms.includes(cardinfo.id) == true" class="mx-2 btn btn-outline-primary" :href="'/learner/programs/'+cardinfo.id" role="button">View</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <!-- Init the plugin and component-->
    <script src="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3"></script>
    <link href="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3/dist/vue-loading.css" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        Vue.use(VueLoading);
        Vue.component('loading', VueLoading)
    </script>
    <script>
        new Vue({
            el: "#program",

            data: {
                cardinfos: [],
                learnersPrograms: [],
                currentIdx: 0,
                search: '',
                toEnroll: '',
                enrolledPrograms: [],
            },
            created() {
                this.fetchAllPrograms()
            },
            methods: {
                fetchAllPrograms() {
                    let loader = Vue.$loading.show()
                    axios.get('programs/all')
                    .then( res => {
                        loader.hide();
                        this.cardinfos = res.data.programs
                        this.learnersPrograms = res.data.learnersPrograms

                        let collector = []
                        this.learnersPrograms.forEach(function (val,index) {
                            collector.push(val.program.id)
                        })
                        this.enrolledPrograms = collector
                    })
                    .catch(e => {
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
                },
            },
            computed:{
                searchCourses(){
                    return this.cardinfos.filter(card => {return card.title.match(this.search)})
                },
            }
        });
    </script>
@endsection


