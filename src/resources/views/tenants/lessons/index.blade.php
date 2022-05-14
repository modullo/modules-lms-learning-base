
@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection
@section('head_css')
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
    <div id="lessons">
        <breadcrumbs 
            :items="[
                {url: '/tenant/dashboard', title: 'Home', active: false},
                {url: '', title: 'Lessons', active: true},
            ]">
        </breadcrumbs>
        <div class="container mt-5">


            <section class="container program-contain">
                <h2 class="mb-5">
                    Lessons
                </h2>

                <div class="flex-row add-course-contain d-flex">
                    <div class="col-sm-12 col-md-6">
                        <a style="background-color: #343a40; color:white" class="mt-4 mb-4 btn add-course" href="/tenant/lessons/create">
                            <i class="fa fa-plus"> </i> Add Lesson
                        </a>
                    </div>
                    <div class="ml-auto col-md-6">
                        <label for="tenant"> Filter Lessons By Module </label>
                        <select @change="filterByModule" v-model="currentModule" class="form-control" name="" id="">
                            <option :selected="true">All Lessons</option>
                            <option v-for="(module, index) in modules" :key="index" :value="module.id">@{{ module.course.title + ' &raquo; ' + module.title }}</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 mb-4 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search form-control-feedback"></span>
                        </div>
                    </div>
                    <input
                            v-model="search"
                            type="text"
                            class="form-control"
                            placeholder="Search Lessons"
                    />
                </div>

                <div class="row">

                    <div
                            class="mb-5 col-lg-4 col-md-6"
                            v-for="(cardinfo, index) in searchLessons"
                            :key="index"
                    >
                        <div class="card-course">
                            <img class="card-img-top" style="height: 180px; width:340px; object-fit: cover" :src="cardinfo.lesson_image" alt="" />
                            <div class="card-body">
                                <h4><span style="white-space: normal !important" class="badge badge-pill primary-backgroundColor">@{{ cardinfo . title }}</span></h4>
                                <p class="card-text" v-html="cardinfo.skills_gained"></p>
                                <a class="mx-2 primary-backgroundColo btn btn-outline-secondary btn-rounded app-bt" :href="`/tenant/lessons/${cardinfo.id}`" role="button">Edit</a>
                                <a class="btn app-btn btn-outline-danger" href="#" role="button">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3"></script>
    <link href="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3/dist/vue-loading.css" rel="stylesheet">
    <!-- Init the plugin and component-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        Vue.use(VueLoading);
        Vue.component('loading', VueLoading)
    </script>
    <script>
        new Vue({
            el: "#lessons",

            data: {
                search: "",
                currentModule: "All Lessons",
                cardinfos: {!! json_encode($data) !!},
                modules: {!! json_encode($modules) !!},
                filteredData: '',
            },

            methods: {
                filterByModule(event) {
                    if (this.currentModule !== 'All Lessons') { 
                        this.currentModule = event.target.value
                        let loader = Vue.$loading.show()
                        axios.get(`lessons/all/${this.currentModule}`)
                        .then(res => {
                            loader.hide();
                            this.filteredData = res.data.data
                            this.cardinfos = res.data.data
                            return
                        }).catch(e => {
                            loader.hide();
                            console.log(e)
                        })
                    }
                    this.cardinfos = {!! json_encode($data) !!}
                },
            },

            computed:{
                searchLessons(){
                    if (this.search) {
                        return this.cardinfos.filter( card => card.title.toLowerCase().indexOf(this.search.toLowerCase()) > -1 )
                    }
                    return this.cardinfos
                }
            },

            mounted: function() {
                //console.log(this.modules);
                //console.log(this.cardinfos);
            }
        });
    </script>
@endsection


