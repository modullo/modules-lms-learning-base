@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection
@section('head_css')
    <link rel="stylesheet" href="{{ asset('LearningBase/css/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('LearningBase/css/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('LearningBase/css/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('LearningBase/css/assets/owl.theme.green.css') }}">
    <style>


        .card-carousel-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px 20px;
            width:100%;
        }
        .card-carousel {
            /*display: flex;*/
            /* justify-content: center; */
            width: 100%
        }
        .card-carousel--overflow-container {
            overflow: scroll;
            width:90vw;
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        .card-carousel--overflow-container::-webkit-scrollbar {
            display: none;
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
            /*white-space: nowrap;*/
            width:2000px;
            display: flex;
            transition: transform 0.8s cubic-bezier(0.43, 0.195, 0.02, 1);

            transform: translatex(0px);
        }
        .card-carousel-cards .card-carousel--card {

            width: 290px!important;
            vertical-align: top;
            padding: 10px;
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
            height:150px;
        }



    </style>

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">--}}
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'learner'])
    <div class="" style="min-height: 100vh">
        <div class="card-container" id="course-card" >
            <div class="card-carosuel-row">

                <h3 class="ml-5 mt-5"> Top courses in @{{programTitle}}</h3>

                <div class="card-carousel-wrapper" >

                    <div class="card-carousel--nav__left" @click="moveCarousel(-1)" :disabled="atHeadOfList"></div><div class="card-carousel">
                        <div class="card-carousel--overflow-container">
                            <div class="card-carousel-cards" :style="{ transform: 'translateX' + '(' + currentOffset + 'px' + ')'}">
                                <div class="card-carousel--card" v-for="item in items">
                                    <a href="#" class="text-dark">
                                        <img :src="item.image"/>
                                        <div class="card-carousel--card--footer">

                                            <h6 class="card-carousel-title">
                                                @{{ item.title }}

                                            </h6>


                                            <small>

                                                @{{item.author}}
                                            </small>


                                            <p class="course-descrition">

                                                @{{item.details}}
                                            </p>
                                        </div>
                                    </a>
                                    <div class="d-flex justify-content-between">
                                        <a :href="'/learner/courses/'+item.title" class="btn btn-primary">
                                            View
                                        </a>
                                        <a :href="'/learner/courses/'+item.title+'/assessment/'+item.author" class="btn btn-primary">
                                            Take Course
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-carousel--nav__right" @click="moveCarousel(1)" :disabled="atEndOfList"></div></div>
            </div>
        </div>


@endsection

@section('body_js')
    <script src="{{ asset('LearningBase/owl.carousel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel();
        });
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
                programTitle: "Introduction to programming",
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
@endsection


