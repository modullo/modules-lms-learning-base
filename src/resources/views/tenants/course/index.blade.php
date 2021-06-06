
@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection
@section('head_css')
<style>
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">>";
    }
</style>
@endsection



@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div id="program">
        <breadcrumbs 
            :items="[
                {url: 'https://google.com', title: 'Home', active: false},
                {url: '', title: 'Courses', active: true},
            ]">
        </breadcrumbs>
        <div class="container mt-5">
            <section class="container program-contain">
                <h2 class="mb-5">Course</h2>

                <div class="add-course-contain">
                    <a class="mt-4 mb-4 btn btn-primary add-course" href="/tenant/courses/create">

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
                            <img class="card-img-top" :src="cardinfo.image" alt="" />

                            <!-- </div> -->
                            <div class="card-body">
                                <h5 class="card-title">@{{ cardinfo.title }}</h5>
                                <h6 class="mb-2 card-subtitle text-muted">
                                    @{{ cardinfo.author }}
                                </h6>
                                <p class="card-text">@{{ cardinfo.details }} .</p>

                                <a
                                        class="btn app-btn"
                                        href="/tenant/courses/show"
                                        role="button"
                                >View Course</a
                                >

                                <a class="mx-2 btn app-btn" href="/tenant/courses/edit" role="button"
                                >Edit</a
                                >

                                <a class="btn app-btn" href="/#" role="button">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=853&q=80" alt="First slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=853&q=80" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=853&q=80" alt="Third slide">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div> -->
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
                cardinfos: dummyData,
                search:'',
            },

            methods: {},
            computed:{
                searchCourses(){
                    return this.cardinfos.filter(card => {return card.title.match(this.search)})
                }
            }
        });
    </script>
@endsection


