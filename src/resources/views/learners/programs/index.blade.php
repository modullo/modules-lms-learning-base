
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
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item ml-4"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Programs</li>
        </ol>
    </nav>
    <div>
        <div class="container" id="program" style="padding-top: 60px">


            <div class="input-group mb-4 mb-4">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-search form-control-feedback"></span>
                    </div>
                </div>
                <input
                        type="text"
                        class="form-control"
                        placeholder="Search Major"
                />
            </div>

            <h1 class="mb-4">Majors</h1>

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

                            <h5 class="card-title">
                                <a :href="'/learner/programs/'+cardinfo.title">
                                    @{{ cardinfo.title }}
                                </a>
                            </h5>
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
                title: "Programming",
                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "UI UX ",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",

                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
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


