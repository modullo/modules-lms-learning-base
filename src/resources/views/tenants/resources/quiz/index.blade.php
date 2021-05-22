
@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div class="container mt-5">
        <div id="modules">
            <section class="container program-contain">
                <h2 class="mb-5">Quiz</h2>

                <div class="add-course-contain">
                    <a class="btn add-course" href="./create.html">
                        <i class="fa fa-plus"> </i>

                        Add Quiz
                    </a>
                </div>

                <div class="form-group has-search mb-5">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input
                            type="text"
                            class="form-control"
                            placeholder="Search Quiz"
                    />
                </div>

                <div class="row">
                    <div
                            class="col-lg-4 col-md-6 mb-5"
                            v-for="(cardinfo, index) in cardinfos"
                            :key="index"
                    >
                        <div class="card">

                            <!-- </div> -->
                            <div class="card-body">
                                <h5 class="card-title">@{{ cardinfo.title }}</h5>


                                <a class="btn app-btn mx-2" href="./update.html" role="button"
                                >Update</a
                                >

                                <a class="btn app-btn" href="/#" role="button">Delete</a>
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

    <script>
        "use strict";
        var dummyData = [
            {
                title: " OOP Quiz",
                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "Variables Quiz",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "Objects Quiz",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "Interface Quiz",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",
                image:
                    "https://images.unsplash.com/photo-1491841651911-c44c30c34548?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80",
            },
        ];

        new Vue({
            el: "#modules",

            data: {
                cardinfos: dummyData,
            },

            methods: {},
        });
    </script>
@endsection


