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
    <div id="settings">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item ml-4"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Profile Settings</li>
            </ol>
        </nav>
        <div class="rounded-md row" style="min-height:100vh">
            <div class="col-lg-9 col-md-9 col-12 py-6 pl-6 mx-auto">
                <div class="rounded-circle border mx-auto" style="height:100px; width:100px; "></div>
                <h3 class="text-h5 text-blue-light mb-4 font-bold">Edit Profile</h3>
                <div class="w-8/12">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-white border-2 border-yellow rounded-full">
                        <i class="ri-user-line text-h3 ri-fw text-black"></i>
                    </div>
                    <div class="">
                        <p v-if="errors.length > 0">
                            <b class="text-danger">Please correct the following error(s):</b>
                            <ul class="text-danger">
                                <li v-for="error in errors" :key="error.id"> @{{ error }}</li>
                            </ul>
                        </p>
                    </div>
                    <form @submit.prevent="validateForm()">
                        <div class=" mb-4">
                            <div class="my-3">
                                <label class="text-medium font-normal text-gray-base mb-1">First name</label>
                                <input type="text" name="firstName" v-model="firstName" placeholder="Enter a your First Name" class="form-control">
                                {{-- <span v-if="errors.firstName" class="text-danger font-weight-bold">@{{errors.firstName}}</span> --}}
                            </div>
                        </div>
                        <div>
                            <div class="my-3">
                                    <label class="text-medium font-normal text-gray-base mb-1">Last name</label>
                            <input type="text" v-model="lastName" placeholder="Enter your last name" class="form-control">
                            {{-- <span v-if="errors.lastName" class="text-danger font-weight-bold">@{{errors.lastName}}</span> --}}
                        </div>
    
                        <div class="mb-4">
                            <label class="text-medium font-normal text-gray-base mb-1">Email</label>
                            <input type="email" v-model="email" placeholder="Enter you email" class="form-control">
                            {{-- <span v-if="errors.email" class="text-danger font-weight-bold">@{{errors.email}}</span> --}}
                        </div>
                        <div class="mt-3 mb-6">
                            <label class="text-medium font-normal text-gray-base mb-1">Phone number</label>
                            <input type="email" v-model="phone" placeholder="Enter your phone number" class="form-control">
                            {{-- <span v-if="errors.phone" class="text-danger font-weight-bold">@{{errors.phone}}</span> --}}
                        </div>
                        <button type="submit" class="btn btn-primary btn-block py-3">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body_js')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script>
        new Vue({
            el:"#settings",

            data: {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                errors: [],
            },
            methods: {
                validateForm: function () {
                if (this.firstName && this.lastName && this.phone && this.email) {
                    return true;
                }

                    this.errors = [];

                    if (!this.firstName) {
                        this.errors.push('First Name is required.');
                    }
                    if (!this.lastName) {
                        this.errors.push('Last Name is required.');
                    }
                    if (!this.phone) {
                        this.errors.push('Phone Number is required.');
                    }
                    if (!this.email) {
                        this.errors.push('Email is required.');
                    }

                }
            }
        })


    </script>
@endsection


