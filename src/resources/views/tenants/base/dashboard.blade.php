@extends('layouts.themes.tabler.tabler')

@section('head_js')

@endsection


@section('body_content_main')

    @include('modules-lms-base::navigation',['type' => 'tenant'])
    <div class="container p-5">
       <div class="row">
           <div class="col-md-3">
               <div class="card report-card">
                   <div class="card-body">
                       <div class="row d-flex justify-content-center">
                           <div class="col">
                               <p class="text-dark mb-1 fw-semibold">Learners</p>
                               <h4 class="font-22 fw-bold">{{$data['learners']}}</h4>
                           </div>
                           <div class="col-auto align-self-center">
                               <div class="bg-gray d-flex justify-content-center align-items-center thumb-md rounded-circle p-3 text-white">
                                   <i class="fa fa-users"></i>
                               </div>
                           </div>
                       </div>
                   </div><!--end card-body-->
               </div>
           </div>
           <div class="col-md-3">
               <div class="card report-card">
                   <div class="card-body">
                       <div class="row d-flex justify-content-center">
                           <div class="col">
                               <p class="text-dark mb-1 fw-semibold">Programs</p>
                               <h4 class="font-22 fw-bold">{{$data['programs']}}</h4>
                           </div>
                           <div class="col-auto align-self-center">
                               <div class="bg-gray d-flex justify-content-center align-items-center thumb-md rounded-circle p-3 text-white">
                                   <i class="fa fa-list"></i>
                               </div>
                           </div>
                       </div>
                   </div><!--end card-body-->
               </div>
           </div>
           <div class="col-md-3">
               <div class="card report-card">
                   <div class="card-body">
                       <div class="row d-flex justify-content-center">
                           <div class="col">
                               <p class="text-dark mb-1 fw-semibold">Courses</p>
                               <h4 class="font-22 fw-bold">{{$data['courses']}}</h4>
                           </div>
                           <div class="col-auto align-self-center">
                               <div class="bg-gray d-flex justify-content-center align-items-center thumb-md rounded-circle p-3 text-white">
                                   <i class="fa fa-book"></i>
                               </div>
                           </div>
                       </div>
                   </div><!--end card-body-->
               </div>
           </div>
       </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">New Users</h4>
                            </div><!--end col-->
                        </div>  <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Date</th>
                                </tr><!--end tr-->
                                </thead>
                                <tbody>
                                    @foreach($data['newLearners'] as $learner)
                                        <tr>
                                            <td>{{$learner['first_name'].' '.$learner['last_name']}}</td>
                                            <td>{{dateParse($learner['created_at'])}}</td>
                                        </tr><!--end tr-->
                                    @endforeach
                                </tbody>
                            </table> <!--end table-->
                        </div><!--end /div-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
            <div class="col-lg-6">
            </div> <!--end col-->
        </div>

    </div>

@endsection

@section('body_js')

    {{--    <script src="{{ asset('js/app.js') }}"></script>--}}
@endsection


