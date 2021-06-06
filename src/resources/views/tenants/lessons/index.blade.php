
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
    <div id="lessons">
        <breadcrumbs 
            :items="[
                {url: 'https://google.com', title: 'Home', active: false},
                {url: '', title: 'Tracks', active: true},
            ]">
        </breadcrumbs>
        <div class="container mt-5">


            <section class="container program-contain">
                <h2 class="mb-5">

                    Tracks
                </h2>

                <div class="flex-row add-course-contain d-flex">
                    <a class="mt-4 mb-4 btn btn-primary add-course" href="/tenant/lessons/create">

                        <i class="fa fa-plus"> </i>

                        Add Track
                    </a>


                    <div class="ml-auto col-md-6">
                        <label for="tenant"> Select Module </label>
                        <select @change="handleSelection"  class="form-control" name="" id="">
                            <option selected>Select Modules</option>
                            <option value="1">Intro</option>
                            <option value="2">Assessment</option>
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
                            placeholder="Search Tracks"
                    />
                </div>

                <div class="row">



                    <div
                            class="mb-5 col-lg-4 col-md-6"
                            v-for="(cardinfo, index) in searchLessons"
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
                                        class="mx-2 btn app-btn"
                                        href="/tenant/lessons/edit"
                                        role="button"
                                >Edit</a
                                >

                                <a class="btn app-btn" href="/#" role="button"
                                >Delete</a
                                >
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
                title: "OOP",
                details: "Lorem ipsum dolor sit amet, consectetuer adipiscing .",
                author: "Evan you",
                module_id: "1",
                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },

            {
                title: "Variables",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",
                module_id: "2",
                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
            {
                title: "Loops",
                details: ".",
                author: "Evan you",
                module_id: "2",
                image:
                    "https://images.pexels.com/photos/39811/pexels-photo-39811.jpeg?h=350&amp;auto=compress&amp;cs=tinysrgb",
            },
        ];

        new Vue({
            el: "#lessons",

            data: {
                search: "",
                currentModule: "",
                cardinfos: dummyData,
            },

            methods: {
                handleSelection(event){
                    this.currentModule = event.target.value
                    console.log(this.currentModule)
                }
            },

            computed:{
                searchLessons(){
                    return this.cardinfos.filter(card => card.title.match(this.search) && card.module_id.match(this.currentModule))
                }
            }
        });
    </script>
@endsection


