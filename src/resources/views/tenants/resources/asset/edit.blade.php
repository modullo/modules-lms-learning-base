@extends('layouts.themes.tabler.tabler')

@section('head_css')
<style>
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">>";
    }
</style>
@endsection


@section('body_content_main')
    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div id="app">
        <breadcrumbs 
            :items="[
                {url: '/tenant/dashboard', title: 'Home', active: false},
                {url: '/tenant/assets', title: 'Assets', active: false},
                {url: '', title: 'Edit Asset', active: true},
            ]">
        </breadcrumbs>
        <div class="container">
            <h3 class="mt-5">Edit Assets</h3>
            <div class="mx-auto mt-5 card col">
                <div class="card-body">
                    <form class="form" @submit.prevent="validateBeforeSubmit">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="asset-name">Asset Name *</label>
                                <p class="control has-icon has-icon-right">
                                    <input name="Asset Name" class="form-control" v-model="form.asset_name" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('Asset Name') }" type="text"
                                        placeholder="Enter Asset Name">
                                    <i v-show="errors.has('Asset Name')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('Asset Name')"
                                        class="help text-danger">@{{ errors . first('Asset Name') }}</span>
                                </p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""> Upload Type </label>
                                <select 
                                    v-validate="'required'" 
                                    :class="{'input': true, 'border border-danger': errors.has('UploadType') }" 
                                    class="form-control"
                                    name="UploadType"
                                    @change="toggleAssetUpload" 
                                    v-model="form.type">
                                    <option value="video" :selected="form.type == 'video'">Video</option>
                                    <option value="image" :selected="form.type == 'image'">Image</option>
                                </select>
                                <i v-show="errors.has('UploadType')" class="fa fa-warning text-danger"></i>
                                <span v-show="errors.has('UploadType')"
                                    class="help text-danger">@{{ errors.first('UploadType') }}</span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div v-if="toggleAsset !== 'image'" class="form-group col-md-6">
                                <label for="asset-name">Video URL</label>
                                <p class="control has-icon has-icon-right">
                                    <input name="VideoURL" class="form-control" v-model="form.asset_url" v-validate="'required'"
                                        :class="{'input': true, 'border border-danger': errors.has('VideoURL') }" type="url"
                                        >
                                    <i v-show="errors.has('VideoURL')" class="fa fa-warning text-danger"></i>
                                    <span v-show="errors.has('VideoURL')"
                                        class="help text-danger">@{{ errors . first('Video Url') }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div v-if="toggleAsset === 'image'" class="form-group col-md-6">
                                <label for="">
                                    Upload Asset Image File
                                </label>
                                <input 
                                    type="file" 
                                    v-on:change="accessImage" 
                                    class="form-control-file" 
                                    aria-describedby="fileHelpId" />
                            </div>
                        </div>

                        <div class=" submit-btn d-flex justify-content-between align-items-center">
                            <span class="muted"> fields with * are required </span>
                            <button type="submit" class="btn btn-outline-secondary">
                                Update Asset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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

    <script>
        "use strict";

        new Vue({
            el: "#app",

            data: {   
                form: {!! json_encode($data) !!},
                asset_url: '',
                toggleAsset: {!! json_encode($data['type']) !!}
            },
            methods: {
                accessImage(e) {
                    this.form.asset_url = e.target.files[0]
                },
                validateBeforeSubmit(ev) {
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            let loader = Vue.$loading.show()
                            //this.form.asset_url = this.toggleAsset !== 'image' ?  this.form.asset_url : this.asset_url;
                            this.form.asset_type = this.form.type;
                            this.uploadImage()
                            .then(() => {
                                //console.log(this.form)
                                axios.put(`${this.form.id}`, this.form).then(res => {
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
                    if (typeof this.form.asset_url.name !== 'undefined') { 
                        const formData = new FormData();
                        formData.append("asset", this.form.asset_url, this.form.asset_url.name);
                        await axios.post('/tenant/assets/custom/upload', formData)
                        .then( res => {
                            this.form.asset_url = res.data.file_url
                        })
                        .catch(e => {
                            console.log(e.response.data.error)
                        })
                    }
                },
                transformToFormData(object) {
                    const formData = new FormData()
                    Object.keys(object).forEach(key => formData.append(key, object[key]))
                    return formData
                },
                toggleAssetUpload(e) {
                    // if (this.form.type === 'image') {
                        this.toggleAsset = e.target.value
                        this.form.asset_url = ''
                    // }

                    // if (this.form.type === 'video') {
                    //     this.toggleAsset = true
                    // }
                }
            }
        });

    </script>
@endsection
