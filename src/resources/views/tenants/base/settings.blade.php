@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
{{--        <h3 class="text-h4 text-blue-light mb-4">My Profile</h3>--}}
    <div id="app" class="container">
        <div class="row">
            <div class="col-12 py-4 text-center">
                <img class="rounded-circle border" style="height:100px; width:100px; " :src="organization.logo ?? 'https://via.placeholder.com/200x200.jpg?text=logo'">
            </div>
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Edit Organization</div>
                        <form class="form" @submit.prevent="validateBeforeSubmit">
                            <input type="hidden" name="update_type" value="organization">
                            <div class="flex items-center justify-center h-16 w-16 mx-auto bg-white border-2 border-yellow rounded-full">
                                <i class="ri-user-line text-h3 ri-fw text-black"></i>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="text-medium font-normal text-gray-base mb-1" for="company_name">Name</label>
                                    <input type="text" class="form-control" :class="{'border border-danger': errors.has('company_name') }" id="company_name" name="company_name" v-model="organization.company_name" placeholder="Enter organization/company name" v-validate="'required'">
                                    <i v-if="errors.has('company_name')" class="fa fa-warning text-danger"></i>
                                    <span v-if="errors.has('company_name')" class="help text-danger">@{{ errors . first('company_name') }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-medium font-normal text-gray-base mb-1" for="country">Country</label>
                                    <input type="text" class="form-control" :class="{'border border-danger': errors.has('country') }" id="country" name="country" v-model="organization.country" placeholder="Enter country">
                                    <i v-if="errors.has('country')" class="fa fa-warning text-danger"></i>
                                    <span v-if="errors.has('country')" class="help text-danger">@{{ errors . first('country') }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-medium font-normal text-gray-base mb-1" for="logo">Logo</label>
                                    <input type="file" v-on:change="accessImage" :class="{'input': true, 'border border-danger': errors.has('logo') }" class="form-control" name="logo" id="logo" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Edit Personal Profile</div>
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
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">API Details</div>
                        <p>Generate API credentials</p>
                        <form class="form" @submit.prevent="validateBeforeSubmit">
                            <div class="flex items-center justify-center h-16 w-16 mx-auto bg-white border-2 border-yellow rounded-full">
                                <i class="ri-user-line text-h3 ri-fw text-black"></i>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 m-0">
                                    <label class="font-weight-bold" for="api_token">Token</label>
                                    <input type="text" class="form-control-plaintext" id="api_token" v-model="api.token" value="" readonly>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="button" @click="generateToken">Regenerate</button>
                            <div><i>The generated token will only be displayed once, so make sure to copy it.</i></div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Webhook Details</div>
                        <p>Update your learning platform using external sources</p>
                        <form class="form" @submit.prevent="validateBeforeSubmit">
                            <div class="flex items-center justify-center h-16 w-16 mx-auto bg-white border-2 border-yellow rounded-full">
                                <i class="ri-user-line text-h3 ri-fw text-black"></i>
                            </div>
                            <div class="form-row">
                                <label class="col-auto col-form-label font-weight-bold" for="webhook_users">Users:</label>
                                <div class="form-group col-md-8 m-0">
                                    <input type="text" class="form-control-plaintext" id="webhook_users" value="{{config('app.url')}}/webhook/users" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="col-auto col-form-label font-weight-bold" for="webhook_courses">Courses:</label>
                                <div class="form-group col-md-8 m-0">
                                    <input type="text" class="form-control-plaintext" id="webhook_courses" value="{{config('app.url')}}/webhook/courses" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="col-auto col-form-label font-weight-bold" for="webhook_modules">Modules:</label>
                                <div class="form-group col-md-8 m-0">
                                    <input type="text" class="form-control-plaintext" id="webhook_modules" value="{{config('app.url')}}/webhook/modules" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="col-auto col-form-label font-weight-bold" for="webhook_lessons">Lessons:</label>
                                <div class="form-group col-md-8 m-0">
                                    <input type="text" class="form-control-plaintext" id="webhook_lessons" value="{{config('app.url')}}/webhook/lessons" readonly>
                                </div>
                            </div>
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
                organization: {!! json_encode($data['organization_details']) !!},
                api: {
                    token: '***********************'
                },
                update_type: '',
            },
            methods: {
                accessImage(e) {
                    this.organization.logo = e.target.files[0]
                },
                validateBeforeSubmit(ev) {
                    console.log(ev)
                    this.update_type = ev.target.update_type.value
                    this.organization.update_type = this.update_type
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            let loader = Vue.$loading.show()
                            this.uploadImage()
                                .then(() => {
                                    axios.put(`profile-settings/${this.user.uuid}`, this[this.update_type]).then(res => {
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
                    if (typeof this.organization.logo.name !== 'undefined') {
                        const formData = new FormData();
                        formData.append("asset", this.organization.logo, this.organization.logo.name);
                        await axios.post('/tenant/assets/custom/upload', formData)
                            .then( res => {
                                this.organization.logo = res.data.file_url
                            })
                            .catch(e => {
                                console.log(e.response.data.error)
                            })
                    }
                },
                addScheduleItem(schedule){
                    console.log(schedule)
                    this.schedule_items.push(schedule)
                },
                generateToken(){
                    let loader = Vue.$loading.show()
                    axios.get(`profile-settings/generate-token`).then(res => {
                        loader.hide();
                        this.api.token = res.data.token
                    }).catch(e => {
                        loader.hide();
                        const errors = e.response.data.error
                        if(e.response.data.error){
                            toastr["error"](e.response.data.error)
                        }
                    })
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


