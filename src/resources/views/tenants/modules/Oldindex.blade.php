@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection
@section('head_css')
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
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
        <breadcrumbs :items="[
                    {url: '/tenant/dashboard', title: 'Home', active: false},
                    {url: '', title: 'Modules', active: true},
                ]">
        </breadcrumbs>
        <div class="container mt-5">
            <section class="container program-contain">
                <h2 class="mb-5">

                    Modules
                </h2>

                <div class="flex-row add-course-contain d-flex">
                    <a  style="background-color: #343a40;" class="mt-4 mb-4 btn btn-primary add-course" href="/tenant/modules/create">

                        <i class="fa fa-plus"> </i>

                        Add Module
                    </a>
                    <div class="ml-auto col-md-6">
                        <label for="tenant"> Select Course</label>
                        <select @change="handleSelection" v-model="currentCourse" class="form-control">
                            <option :selected="true" disabled>Filter By Course</option>
                            <option v-for="(course, index) in courses" :key="index" :value="course.id">@{{ course.title }}</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 mb-4 input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search form-control-feedback"></span>
                        </div>
                    </div>
                    <input v-model="search" type="text" class="form-control" placeholder="Search Modules" />
                </div>

                <div class="row">
                    <div class="mb-5 col-lg-4 col-md-6" v-for="(cardinfo, index) in searchLessons" :key="index">
                        <div class="card-course">
                            <div class="card-body">
                                <h2><span class="badge badge-pill primary-backgroundColor">@{{ cardinfo . title }}</span></h2>
                                <p class="card-text">@{{ cardinfo . description }} .</p>
                                <a class="mx-2 primary-backgroundColor btn btn-rounded app-bt" :href="`/tenant/modules/${cardinfo.id}`" role="button">Edit</a>

                                <a class="btn app-btn btn-danger" href="/#" role="button">Delete</a>
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
    <script>
        "use strict";
        var dummyData = [{
                title: "Intro",
                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                author: "Evan you",
                course_id: "1",
                image: "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },

            {
                title: "Assessment",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",
                course_id: "2",
                image: "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "Assessment 2",
                details: ".",
                author: "Evan you",
                course_id: "2",
                image: "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
        ];

        new Vue({
            el: "#lessons",

            data: {
                search: "",
                currentCourse: "Filter By Course",
                selected: "Filter By Course",
                cardinfos: {!! json_encode($data) !!},
                courses: {!! json_encode($courses) !!},
            },

            methods: {
                handleSelection(event) {
                    this.currentCourse = event.target.value
                    console.log(this.currentCourse)
                }
            },

            computed: {
                searchLessons() {
                    return this.cardinfos.filter(card => card.title.toLowerCase().match(this.search.toLowerCase()))
                },
            }
        });

    </script>
@endsection
