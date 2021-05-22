@extends('layouts.themes.tabler.tabler')

@section('head_css')
    <style>


        .card-carousel-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px 20px;
            width:100%;
        }
        .card-carousel {
            display: flex;
            /* justify-content: center; */
            width: 100%
        }
        .card-carousel--overflow-container {
            overflow: hidden;
        }
        .card-carousel--nav__left,
        .card-carousel--nav__right {
            display: inline-block;
            width: 15px;
            height: 15px;
            padding: 10px;
            box-sizing: border-box;
            border-top: 2px solid #000;
            border-right: 2px solid #000;
            cursor: pointer;
            margin: 0 20px;
            transition: transform 0.8s cubic-bezier(0.43, 0.195, 0.02, 1);
        }
        .card-carousel--nav__left[disabled],
        .card-carousel--nav__right[disabled] {
            opacity: 0.2;
            border-color: #000;
        }
        .card-carousel--nav__left {
            transform: rotate(-135deg);
        }
        .card-carousel--nav__left:active {
            transform: rotate(-135deg) scale(0.9);
        }
        .card-carousel--nav__right {
            transform: rotate(45deg);
        }
        .card-carousel--nav__right:active {
            transform: rotate(45deg) scale(0.9);
        }
        .card-carousel-cards {
            white-space: nowrap;
            transition: transform 0.8s cubic-bezier(0.43, 0.195, 0.02, 1);

            transform: translatex(0px);
        }
        .card-carousel-cards .card-carousel--card {

            width: 219px;
            display: inline-block;
            vertical-align: top;
            margin: 0 10px;
            background-color: #fff;
        }
        .card-carousel-cards .card-carousel--card:first-child {
            margin-left: 0;
        }
        .card-carousel-cards .card-carousel--card:last-child {
            margin-right: 0;
        }
        .card-carousel-cards .card-carousel--card img {
            display: block;
            width: 100%;
            height: auto;
        }
        .card-carousel-cards .card-carousel--card--footer {
            padding: 10px;
            height:200px;
        }



    </style>
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation')
    <div>
        <div id="program">

            <div class="jumbotron jumbotron-fluid program-jumbotron">
                <div class="container">
                    <h1>@{{ programTitle }}</h1>

                    <h4>@{{desc}}</h4>

                    <small class="rating">
                        @{{rating}} @{{numberOfStudentEnrolled}} students </small
                    ><br />

                    <span class="last__updated">
              <span>
                  <i class="fa fa-clock-o" aria-hidden="true"></i>
                  Last updated 3/2021 </span>

              <span class="language">
                  <i class="fa fa-globe"></i>
                  English </span>

              <span> <i class="fa fa-cc" aria-hidden="true"></i> English [Auto] </span>
            </span>
                </div>
            </div>
        </div>


    </div>


    <div class="container row" >

        <div class="card-container" id="course-card" >

            <div class="card-carosuel-row">

                <h3> Top courses in @{{programTitle}}</h3>

                <div class="card-carousel-wrapper" >

                    <div class="card-carousel--nav__left" @click="moveCarousel(-1)" :disabled="atHeadOfList"></div><div class="card-carousel">
                        <div class="card-carousel--overflow-container">
                            <div class="card-carousel-cards" :style="{ transform: 'translateX' + '(' + currentOffset + 'px' + ')'}">
                                <div class="card-carousel--card" v-for="item in items">
                                    <img :src="item.image"/>
                                    <div class="card-carousel--card--footer">

                                        <h6 class="card-carousel-title">
                                            @{{ item.title }}

                                        </h6>


                                        <small>

                                            @{{item.author}}
                                        </small>

                                        <div class="star-rating">
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>
                                            <i class="fa fa-star star"></i>


                                        </div>

                                        <div class="course-descrition">

                                            @{{item.details}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-carousel--nav__right" @click="moveCarousel(1)" :disabled="atEndOfList"></div></div>
            </div>
        </div>

        <div id="carousel">
            <carousel></carousel>
        </div>
@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script>
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
                title: "inheritance",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
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
                title: "interface",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",
                image:
                    "https://images.unsplash.com/photo-1491841651911-c44c30c34548?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80",
            },

            {
                title: "interface",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",
                image:
                    "https://images.unsplash.com/photo-1491841651911-c44c30c34548?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80",
            },

            {
                title: "interface",
                details: "alrazy ipsum dolor sit amet, consectetuer adipiscing elit.",
                author: "Evan you",
                image:
                    "https://images.unsplash.com/photo-1491841651911-c44c30c34548?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80",
            },
        ];


        Vue.component("carousel", {
            template: "#carousel",


        })

        new Vue({
            el:"#course-card",

            data: {

                currentOffset: 0,
                windowSize:3,
                paginationFactor: 220,
                items: dummyData,
                author: "Evan you",
                programTitle: "C++ Certificate Program",
                numberOfStudentEnrolled: 240,
                desc: "Learn how to use Postman to build REST & GraphQL request",
                cardinfos: dummyData,
                rating: "(86900 ratings)",
                aboutProgram:
                    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, architecto!architecto!architecto! Sed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libero nihil id veniam illo voluptates non dicta debitis enim nam minim,Nesciunt voluptate sequi odit corporis laboriosam molestiae repellat labore, ducimus ad nulla voluptates reprehenderit quidem impedit. Debitis magnam quis voluptatum obcaecati, voluptates atque deleniti nobis. Illum quos laudantium nemo quo.",






            },

            computed: {
                atEndOfList() {
                    return this.currentOffset <= (this.paginationFactor * -1) * ((this.items.length - 1) - this.windowSize)
                },
                atHeadOfList() {
                    return this.currentOffset === 0
                }
            },


            methods: {
                moveCarousel(direction) {
                    if (direction === 1 && !this.atEndOfList) {
                        this.currentOffset -= this.paginationFactor
                    } else if (direction === -1 && !this.atHeadOfList) {
                        this.currentOffset += this.paginationFactor
                    }
                }
            }





        })


    </script>


    <script>



        new Vue({
            el: "#program",

            data: {
                author: "Evan you",
                programTitle: "C++ Certificate Program",
                numberOfStudentEnrolled: 240,
                desc: "Learn how to use Postman to build REST & GraphQL request",
                cardinfos: dummyData,
                rating: "(86900 ratings)",
                aboutProgram:
                    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, architecto!architecto!architecto! Sed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libSed amet eos quos quae eaque, nemo aspernatur libero nihil id veniam illo voluptates non dicta debitis enim nam minim,Nesciunt voluptate sequi odit corporis laboriosam molestiae repellat labore, ducimus ad nulla voluptates reprehenderit quidem impedit. Debitis magnam quis voluptatum obcaecati, voluptates atque deleniti nobis. Illum quos laudantium nemo quo.",
            },

            methods: {},
        });
    </script>
@endsection


