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
    @include('modules-lms-base::navigation',['type' => 'learner'])
    <div id="app" class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <breadcrumbs
                        :items="[
                {url: '/tenant/dashboard', title: 'Home', active: false},
                {url: '', title: 'Profile Settings', active: true},
            ]">
                </breadcrumbs>
            </div>
        </div>
        <div class="row">
            <div class="col-12 py-4 text-center">
                <img class="rounded-circle border" style="height:100px; width:100px; " :src="user.image ?? 'https://via.placeholder.com/200x200.jpg?text=logo'">
            </div>
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Edit Profile</div>
                        <form class="form" @submit.prevent="validateBeforeSubmit">
                            <input type="hidden" name="update_type" value="user">
                            <div class="flex items-center justify-center h-16 w-16 mx-auto bg-white border-2 border-yellow rounded-full">
                                <i class="ri-user-line text-h3 ri-fw text-black"></i>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="text-medium font-normal text-gray-base mb-1" for="first_name">First name</label>
                                    <input type="text" class="form-control" :class="{'border border-danger': errors.has('first_name') }" id="first_name" name="first_name" v-model="user.first_name" placeholder="Enter first name" v-validate="'required'">
                                    <i v-if="errors.has('first_name')" class="fa fa-warning text-danger"></i>
                                    <span v-if="errors.has('first_name')" class="help text-danger">@{{ errors . first('first_name') }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-medium font-normal text-gray-base mb-1" for="last_name">Last name</label>
                                    <input type="text" class="form-control" :class="{'border border-danger': errors.has('last_name') }" id="last_name" name="last_name" v-model="user.last_name" placeholder="Enter your family name">
                                    <i v-if="errors.has('last_name')" class="fa fa-warning text-danger"></i>
                                    <span v-if="errors.has('last_name')" class="help text-danger">@{{ errors . first('last_name') }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-medium font-normal text-gray-base mb-1" for="">Email</label>
                                    <input type="email" class="form-control" id="" name="" v-model="user.email" placeholder="Enter your email" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-medium font-normal text-gray-base mb-1" for="phone_number">Phone number</label>
                                    <input type="tel" class="form-control" :class="{'border border-danger': errors.has('phone_number') }" id="phone_number" name="phone_number" v-model="user.phone_number" placeholder="Enter phone number">
                                    <i v-if="errors.has('phone_number')" class="fa fa-warning text-danger"></i>
                                    <span v-if="errors.has('phone_number')" class="help text-danger">@{{ errors . first('phone_number') }}</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label> Gender </label>
                                    <div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="gender_male" v-model="user.gender" value="male" name="gender" class="custom-control-input">
                                            <label class="custom-control-label" for="gender_male">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="gender_female" v-model="user.gender" value="female" name="gender" class="custom-control-input">
                                            <label class="custom-control-label" for="gender_female">Female</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="gender_other" v-model="user.gender" value="other" name="gender" class="custom-control-input">
                                            <label class="custom-control-label" for="gender_other">Others</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-medium font-normal text-gray-base mb-1" for="location">Country</label>
                                    <input type="text" class="form-control" :class="{'border border-danger': errors.has('location') }" id="location" name="location" v-model="user.location" placeholder="Enter country">
                                    <i v-if="errors.has('location')" class="fa fa-warning text-danger"></i>
                                    <span v-if="errors.has('location')" class="help text-danger">@{{ errors . first('location') }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-medium font-normal text-gray-base mb-1" for="image">Photo</label>
                                    <input type="file" v-on:change="accessImage" :class="{'input': true, 'border border-danger': errors.has('image') }" class="form-control" name="image" id="image" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="form-row d-none">
                                <div class="form-group col-md-6">
                                </div>
                                <div class="form-group col-md-6">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Save</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12"></div>
        </div>
    </div>

@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <!-- jsdelivr cdn -->
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@<3.0.0/dist/vee-validate.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3"></script>
    <link href="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3/dist/vue-loading.css" rel="stylesheet">
    <!-- Init the plugin and component-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Vue.use(VueLoading);
        Vue.component('loading', VueLoading)
        Vue.use(VeeValidate);
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    {{--    <script src="{{ asset('js/app.js') }}"></script>--}}
    <script>
        "use strict";

        new Vue({
            el: "#app",

            data: {
                user: {!! json_encode($data) !!},
                photo: ''
            },
            methods: {
                accessImage(e) {
                    this.user.image = e.target.files[0]
                    this.photo = e.target.files[0]
                },
                validateBeforeSubmit(ev) {
                    console.log(ev)
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            let loader = Vue.$loading.show()
                            this.uploadImage()
                                .then(() => {
                                    axios.put(`profile-settingss/${this.user.uuid}`, this.user).then(res => {
                                        loader.hide();
                                        toastr["success"](res.data.message)
                                    }).catch(e => {
                                        loader.hide();
                                        const errors = e.response.data.error
                                        if(e.response.data.error){
                                            toastr["error"](e.response.data.error)
                                        }
                                        else if(e.response.data.validation_error){
                                            Object.entries(e.response.data.validation_error).forEach(
                                                ([, value]) => {
                                                    toastr["error"](value)
                                                },
                                            )
                                        }
                                    })
                                })
                        }
                    });
                },
                async uploadImage() {
                    if (this.photo !== '' && typeof this.user.image.name !== 'undefined') {
                        const formData = new FormData();
                        formData.append("asset", this.user.image, this.user.image.name);
                        await axios.post('/tenant/assets/custom/upload', formData)
                            .then( res => {
                                this.user.image = res.data.file_url
                            })
                            .catch(e => {
                                console.log(e.response.data.error)
                            })
                    }
                },
                addScheduleItem(schedule){
                    console.log(schedule)
                    this.schedule_items.push(schedule)
                }
            },
            mounted: function() {
                // console.log(this.schedule_items)
                //console.log(this.assets)
                //console.log(this.quizzes)
            }
        });

    </script>
@endsection


