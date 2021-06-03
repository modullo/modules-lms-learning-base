
@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection



@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div class="container mt-5">
        <div id="program">
            <section class="container program-contain">
                <h2 class="mb-5">Course</h2>

                <div class="add-course-contain">
                    <a class="btn btn-primary mt-4 mb-4 add-course" href="/tenant/courses/create">

                        <i class="fa fa-plus"> </i>

                        Add Course
                    </a>
                </div>

                <div class="form-group has-search mb-5">

                    <div class="input-group mb-2">
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
                            class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-5"
                            v-for="(cardinfo, index) in searchCourses"
                            :key="index"
                    >
                        <div class="card-course">
                            <!-- <div class="card-image"> -->
                            <img class="card-img-top" :src="cardinfo.image" alt="" />

                            <!-- </div> -->
                            <div class="card-body">
                                <h5 class="card-title">@{{ cardinfo.title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    @{{ cardinfo.author }}
                                </h6>
                                <p class="card-text">@{{ cardinfo.details }} .</p>

                                <a
                                        class="btn app-btn"
                                        href="/tenant/courses/show"
                                        role="button"
                                >View Course</a
                                >

                                <a class="btn app-btn mx-2" href="/tenant/courses/edit" role="button"
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

