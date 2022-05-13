
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
    <div id="program">
        <breadcrumbs 
            :items="[
                {url: '/tenant/dashboard', title: 'Home', active: false},
                {url: '', title: 'Courses', active: true},
            ]">
        </breadcrumbs>
        <div class="container mt-5">
            <section class="container program-contain">
                <h2 class="mb-5">Course</h2>

                <div class="add-course-contain">
                    <a style="background-color: #343a40; color:white" class="mt-4 mb-4 btn add-course" href="/tenant/courses/create">

                        <i class="fa fa-plus"> </i>

                        Add Course
                    </a>
                </div>

                <div class="mb-5 form-group has-search">

                    <div class="mb-2 input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-search form-control-feedback"></span>
                            </div>
                        </div>
                        <input
                                v-model="search"
                                type="text"
                                class="form-control"
                                placeholder="Search Course"
                        />
                    </div>
                </div>
                <div class="row">
                    <div
                            class="mb-5 col-lg-4 col-md-4 col-sm-6 col-xs-6"
                            v-for="(cardinfo, index) in searchCourses"
                            :key="index"
                    >
                        <div class="card-course">
                            <!-- <div class="card-image"> -->
                            <img class="card-img-top" style="height: 180px; width:340px; object-fit: cover" :src="cardinfo.course_image" alt="" />

                            <!-- </div> -->
                            <div class="card-body">
                                <h5 class="card-title">@{{ cardinfo.title }}</h5>
                                <h6 class="mb-2 card-subtitle text-muted">
                                    @{{ cardinfo.author }}
                                </h6>
                                <p class="card-text">@{{ cardinfo.details }} .</p>

                                <!--<a
                                        class="btn btn-outline-secondary"
                                        :href="`/tenant/courses/show/${cardinfo.id}`"
                                        role="button"
                                >View Course</a
                                >-->

                                <a class="mx-2 btn btn-outline-secondary" :href="`/tenant/courses/${cardinfo.id}`" role="button"
                                >Edit</a
                                >

                                <a class="btn btn-outline-danger" href="/#" role="button">Delete</a>
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
        var dummyData = [
            {
                title: " objects and classes",
                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "inheritance",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "constructor",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "interface",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",
                image:
                    "https://images.unsplash.com/photo-1491841651911-c44c30c34548?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80",
            },
        ];

        new Vue({
            el: "#program",

            data: {
                cardinfos: {!! json_encode($data) !!},
                search:'',
            },

            methods: {},
            computed:{
                searchCourses(){
                    return this.cardinfos.filter( card => { return card.title.toLowerCase().indexOf(this.search.toLowerCase()) > -1 } )
                    //return this.cardinfos.filter(card => {return card.title.match(this.search)})
                }
            }
        });
    </script>
@endsection


