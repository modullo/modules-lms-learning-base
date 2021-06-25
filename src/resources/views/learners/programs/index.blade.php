
@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection

@section('head_css')
    <link rel="stylesheet" href="{{ asset('LearningBase/css/app.css') }}">
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
                {url: '', title: 'Program', active: true},
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
                    placeholder="Search Major"
                />
            </div>

            <h1 class="mb-4">Majors</h1>

            <div class="row">
                <div
                        class="mb-5 col-lg-4 col-md-6 col-sm-12 col-xs-6"
                        v-for="(cardinfo, index) in searchCourses"
                        :key="index"
                >
                    <div class="card-course">
                        <img
                            style="height: 180px; width:340px; object-fit: cover"
                            :src="cardinfo.image"
                            alt=""
                        />
                        <div class="card-body">

                            <h5 class="card-title">
                                <a :href="'/learner/programs/'+cardinfo.id">
                                    @{{ cardinfo.title }}
                                </a>
                            </h5>
                            <p class="card-text">@{{ cardinfo.description }} .</p>
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
                currentIdx: 0,
                search: '',
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
                }
            },
            computed:{
                searchCourses(){
                    return this.cardinfos.filter(card => {return card.title.match(this.search)})
                }
            }
        });
    </script>
@endsection


