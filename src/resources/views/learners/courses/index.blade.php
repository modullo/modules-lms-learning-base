@extends('layouts.themes.tabler.tabler')

@section('head_js')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://unpkg.com/vue@2.6.12/dist/vue.js"></script>
<script src="https://unpkg.com/babel-polyfill/dist/polyfill.min.js"></script>
<script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-ellipse-progress/dist/vue-ellipse-progress.umd.min.js"></script>
<script src="https://unpkg.com/bootstrap-vue@2.21.2/dist/bootstrap-vue-icons.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
@endsection
@section('head_css')
<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@2.21.2/dist/bootstrap-vue.css" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
<link href="{{ asset('Themes/tabler/css/dashboard.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('vendor/assessment/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('LearningBase/css/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('LearningBase/css/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('LearningBase/css/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('LearningBase/css/assets/owl.theme.green.css') }}">
    <style>
        .btn-style {
            border-radius: 12em !important;
        }
        .carousel {
            margin: 30px auto 60px;
            padding: 0 80px;
        }
        .carousel .carousel-item {
            text-align: center;
            overflow: hidden;
        }
        .carousel .carousel-item h4 {
            font-family: 'Varela Round', sans-serif;
        }
        .carousel .carousel-item img {
            max-width: 100%;
            display: inline-block;
        }
        /* .carousel .carousel-item .btn {
            border-radius: 0;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
            border: none;
            background: #a177ff;
            padding: 6px 15px;
            margin-top: 5px;
        }
        .carousel .carousel-item .btn:hover {
            background: #8c5bff;
        } */
        /* .carousel .carousel-item .btn i {
            font-size: 14px;
            font-weight: bold;
            margin-left: 5px;
        } */
        .carousel .thumb-wrapper {
            margin: 5px;
            text-align: left;
            background: #fff;
            box-shadow: 0px 2px 2px rgba(0,0,0,0.1);   
        }
        .carousel .thumb-content {
            padding: 15px;
            font-size: 13px;
        }
        .carousel-control-prev, .carousel-control-next {
            height: 44px;
            width: 44px;
            background: none;	
            margin: auto 0;
            border-radius: 50%;
            border: 3px solid rgba(0, 0, 0, 0.8);
        }
        .carousel-control-prev i, .carousel-control-next i {
            font-size: 36px;
            position: absolute;
            top: 50%;
            display: inline-block;
            margin: -19px 0 0 0;
            z-index: 5;
            left: 0;
            right: 0;
            color: rgba(0, 0, 0, 0.8);
            text-shadow: none;
            font-weight: bold;
        }
        .carousel-control-prev i {
            margin-left: -3px;
        }
        .carousel-control-next i {
            margin-right: -3px;
        }
        .carousel-indicators {
            bottom: -50px;
        }
        .carousel-indicators li, .carousel-indicators li.active {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 4px;
            border: none;
        }
        .carousel-indicators li {	
            background: #ababab;
        }
        .carousel-indicators li.active {	
            background: #555;
        }
        .checked {
            color: orange;
        }
        .ratings {
            font-size: .89em;
            font-weight: bold;
        }

        .rating-value {
            font-size: .89em;
            font-weight: bold;
            color: #be5a0e;;
        }
        .price {
            font-size: .89em;
            font-weight: bold; 
        }
        .price .old-price{
            color: #73726c;
            text-decoration: line-through;
        }
        .rated {
            background-color: #ffc48c;
            color: #592b00;
            border-radius: 4px;
            display: inline-block;
            padding: .4rem .8rem;
            white-space: nowrap;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -.02rem;
            font-size: .8rem;
        }
        .col-md-4 col-lg-3{
            padding: 5px !important;
        }
        @media only screen and (max-width: 785px){
            /* .visible-courses {
                display: none;
            } */
            .carousel-control-prev {
                display: none;
            }
            .carousel-control-next {
                display: none;
            }
        }
        .carousel {
            padding: 0 20px !important;
            margin: 0 !important;
        }
        .carousel .carousel-item {
            text-align: left !important;
        }
        @media only screen and (min-width: 900px){
            .searchbar{
            margin-bottom: auto;
            margin-top: 10px;
            height: 60px;
            width: 50%;
            margin: auto;
            border-radius: 30px;
            padding: 10px;
            color: black;
            border: 1px solid #989586;
            border-radius: 9999px;
            background-color: #fbfbf8;
            }
        }

        @media only screen and (max-width: 899px){
            .searchbar{
            margin-bottom: auto;
            margin-top: 10px;
            margin-left: 50px;
            margin-right: 50px;
            height: 60px;
            width: auto;
            border-radius: 30px;
            padding: 10px;
            color: black;
            border: 1px solid #989586;
            border-radius: 9999px;
            background-color: #fbfbf8;
            }
        }

        .search_input{
        color: black;
        border: 0;
        outline: 0;
        width: 92%;
        background: none;
        /* caret-color:transparent; */
        line-height: 40px;
        transition: width 0.4s linear;
        }
        .search_icon{
        height: 40px;
        width: 40px;
        /* float: right; */
        /* display: flex; */
        /* justify-content: center; */
        /* align-items: center; */
        border-radius: 50%;
        color:black;
        text-decoration:none;
        }

    </style>
@endsection

@section('body_content_main')
@include('modules-lms-base::navigation',['type' => 'learner'])
<div id="app">
    <courses-carousel></courses-carousel>
</div>

@endsection

@section('body_js')
    <script src="">
        $(document).ready(function() {
            $('#myCarousel0').carousel({
                interval: 1000
            })
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
    <!-- NOTE: prior to v2.2.1 tiny-slider.js need to be in <body> -->    
    <script src="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3"></script>
    <link href="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3/dist/vue-loading.css" rel="stylesheet">
    <!-- Init the plugin and component-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        Vue.use(VueLoading);
        Vue.component('loading', VueLoading)
    </script>
    <script src="{{ asset('LearningBase/owl.carousel.js') }}"></script>
    {{-- <script src="{{ asset('vendor/learning-base/components/CoursesCarousel.js') }}"></script> --}}
    <script src="{{ asset('vendor/learning-base/app.js') }}"></script>
@endsection


