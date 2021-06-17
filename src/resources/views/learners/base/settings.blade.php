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
        <breadcrumbs 
            :items="[
                {url: '/tenant/dashboard', title: 'Home', active: false},
                {url: '', title: 'Profile Settings', active: true},
            ]">
        </breadcrumbs>
        <div class="rounded-md row" style="min-height:100vh">
            <div class="py-6 pl-6 mx-auto col-lg-9 col-md-9 col-12">
                <div class="mx-auto border rounded-circle" style="height:100px; width:100px; "></div>
                <h3 class="mb-4 font-bold text-h5 text-blue-light">Edit Profile</h3>
                <div class="w-8/12">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto bg-white border-2 rounded-full border-yellow">
                        <i class="text-black ri-user-line text-h3 ri-fw"></i>
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
                        <div class="mb-4 ">
                            <div class="my-3">
                                <label class="mb-1 font-normal text-medium text-gray-base">First name</label>
                                <input type="text" name="firstName" v-model="firstName" placeholder="Enter a your First Name" class="form-control">
                                {{-- <span v-if="errors.firstName" class="text-danger font-weight-bold">@{{errors.firstName}}</span> --}}
                            </div>
                        </div>
                        <div>
                            <div class="my-3">
                                    <label class="mb-1 font-normal text-medium text-gray-base">Last name</label>
                            <input type="text" v-model="lastName" placeholder="Enter your last name" class="form-control">
                            {{-- <span v-if="errors.lastName" class="text-danger font-weight-bold">@{{errors.lastName}}</span> --}}
                        </div>
    
                        <div class="mb-4">
                            <label class="mb-1 font-normal text-medium text-gray-base">Email</label>
                            <input type="email" v-model="email" placeholder="Enter you email" class="form-control">
                            {{-- <span v-if="errors.email" class="text-danger font-weight-bold">@{{errors.email}}</span> --}}
                        </div>
                        <div class="mt-3 mb-6">
                            <label class="mb-1 font-normal text-medium text-gray-base">Phone number</label>
                            <input type="email" v-model="phone" placeholder="Enter your phone number" class="form-control">
                            {{-- <span v-if="errors.phone" class="text-danger font-weight-bold">@{{errors.phone}}</span> --}}
                        </div>
                        <button type="submit" class="py-3 btn btn-primary btn-block">
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
    <script src="{{ asset('vendor/breadcrumbs/BreadCrumbs.js') }}"></script>
    <script>
        new Vue({
            el:"#settings",
            data: {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                errors: [],
                breadcrumbData: [
                    {url: '/tenant/dashboard', title: 'Home', active: false},
                    {url: '/tenant/dashboard', title: 'Page 1', active: false},
                    {url: '/tenant/dashboard', title: 'Page 2', active: true}
                ]
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


