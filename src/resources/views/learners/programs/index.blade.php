
@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'learner'])
    <div>
        <div class="container" id="program" style="padding-top: 60px">


            <div class="form-group has-search mb-5">
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control" placeholder="Search Course" />
            </div>

            <h1 class="mb-4">Program</h1>

            <div class="row">
                <div
                        class="col-lg-4 col-md-6 col-sm-12 col-xs-6 mb-5"
                        v-for="(cardinfo, index) in cardinfos"
                        :key="index"
                >
                    <div class="card-course">
                        <img
                                class="card-img-top"
                                :src="cardinfo.image"
                                alt=""
                                width="100%"
                        />
                        <div class="card-body">
                            <a href="./program.html">
                                <h5 class="card-title">@{{ cardinfo.title }}</h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted">
                                @{{ cardinfo.author }}
                            </h6>
                            <p class="card-text">@{{ cardinfo.details }} .</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

    <script>
        "use strict";
        var dummyData = [
            {
                title: " Program title",
                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "Program Title",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "Program Title",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "Program Title",
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
                currentIdx: 0,
            },
        });
    </script>
@endsection


