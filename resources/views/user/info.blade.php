@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            @if(session('success'))
                <x-alert type="success" message="{{session('success')}}"></x-alert>
            @endif
            @if ($errors)
                @foreach ($errors->all() as $error)
                    <x-alert type="danger" message="{{$error}}"></x-alert>
                @endforeach
            @endif
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">User Information</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='user.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mt-3">
            <div class="card">
                <div class="card-body p-0">
                    <!-- BEGIN profile -->
                    <div class="profile">
                        <!-- BEGIN profile-container -->
                        <div class="profile-container">
                            <!-- BEGIN profile-sidebar -->
                            <div class="profile-sidebar">
                                <div class="desktop-sticky-top">
                                    <div class="profile-img">
                                        @if($data->image != null)
                                            <img src="{{asset("storage/images/".$data->image)}}"
                                                 alt="image">
                                        @else
                                            <img src="{{asset('assets/img/user/profile.jpg')}}" alt=""/>
                                        @endif
                                    </div>
                                    <!-- profile info -->
                                    <h4 class="mt-2">{{ $data->full_name }}</h4>
                                    <div
                                        class="mb-3 text-white text-opacity-50 fw-bold mt-n2">{{ Auth::user()->email }}</div>

                                    <hr class="mt-4 mb-4"/>
                                    <!-- profile info end -->
                                </div>
                            </div>
                            <!-- END profile-sidebar -->

                            <!-- BEGIN profile-content -->
                            <div class="profile-content">
                                <ul class="profile-tab nav nav-tabs nav-tabs-v2">
                                    <li class="nav-item">
                                        <a href="#profile-post" class="nav-link active" data-bs-toggle="tab">
                                            <div class="nav-field">Basic Information</div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#profile-followers" class="nav-link" data-bs-toggle="tab">
                                            <div class="nav-field">Advance Information</div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#profile-media" class="nav-link" data-bs-toggle="tab">
                                            <div class="nav-field">Workplace Information</div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="profile-content-container">
                                    <div class="row gx-4">
                                        <div class="col-xl-12">
                                            <div class="tab-content p-0">
                                                <!-- BEGIN tab-pane -->
                                                <div class="tab-pane fade show active" id="profile-post">
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <!-- post header -->
                                                            <p>Profile Information stage <b class="text-theme">1</b> of
                                                                <b class="text-theme">3</b></p>
                                                            <hr class="mb-3 mt-1"/>
                                                            <div class="row  mt-4">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label" for="first_name">First
                                                                            Name</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ ucwords($data->first_name ?? 'N/A') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label" for="last_name">Last
                                                                            Name</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ ucwords($data->last_name ?? 'N/A') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label" for="phone_number">Phone
                                                                            Number</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ $data->phone_number ?? 'N/A' }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="divider">
                                                                <div class="divider-text text-theme">
                                                                    Present Address
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                               for="present_address[country]">Country</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ ucwords($data->present_address['country'] ?? 'N/A') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                               for="present_address[district]">District</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ ucwords($data->present_address['district'] ?? 'N/A') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                               for="present_address[ps]">P.S /
                                                                            Upazila</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ ucwords($data->present_address['ps'] ?? 'N/A') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                               for="present_address[zip]">ZIP
                                                                            Code</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ $data->present_address['zip'] ?? 'N/A' }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                               for="present_address[address_line]">Address
                                                                            Line </label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ ucfirst($data->present_address['address_line'] ?? 'N/A') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="divider">
                                                                <div class="divider-text text-theme">
                                                                    Permanent Address
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                               for="permanent_address[country]">Country</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ ucwords($data->permanent_address['country'] ?? 'N/A') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                               for="permanent_address[district]">District</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ ucwords($data->permanent_address['district'] ?? 'N/A') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                               for="permanent_address[ps]">P.S /
                                                                            Upazila</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ ucwords($data->permanent_address['ps'] ?? 'N/A') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                               for="permanent_address[zip]">ZIP
                                                                            Code</label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ $data->permanent_address['zip'] ?? 'N/A' }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label class="form-label"
                                                                               for="permanent_address[address_line]">Address
                                                                            Line </label>
                                                                        <span class="float-end">:</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <span
                                                                            class="float-right"> {{ ucfirst($data->permanent_address['address_line'] ?? 'N/A') }} </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-arrow">
                                                            <div class="card-arrow-top-left"></div>
                                                            <div class="card-arrow-top-right"></div>
                                                            <div class="card-arrow-bottom-left"></div>
                                                            <div class="card-arrow-bottom-right"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END tab-pane -->

                                                <!-- BEGIN tab-pane -->
                                                <div class="tab-pane fade" id="profile-followers">
                                                    <p>Profile Information stage <b class="text-theme">2</b> of <b
                                                            class="text-theme">3</b></p>
                                                    <hr class="mb-3 mt-1"/>
                                                    <div class="row ">
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="gender">Gender </label>
                                                                <span class="float-end">:</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <span
                                                                    class="float-right"> {{ ucwords($data->gender ?? 'N/A') }} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="dob">Date of
                                                                    Birth </label>
                                                                <span class="float-end">:</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <span
                                                                    class="float-right"> {{ (date('j F, Y', strtotime($data->dob))) ?? 'N/A' }} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="nid">National ID </label>
                                                                <span class="float-end">:</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <span
                                                                    class="float-right"> {{ $data->nid ?? 'N/A' }} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="blood_group">Blood Group
                                                                    Id </label>
                                                                <span class="float-end">:</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <span
                                                                    class="float-right"> {{ ucwords($data->blood_group ?? 'N/A') }} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END tab-pane -->

                                                <!-- BEGIN tab-pane -->
                                                <div class="tab-pane fade" id="profile-media">
                                                    <p>Profile Information stage <b class="text-theme">3</b> of <b
                                                            class="text-theme">3</b></p>
                                                    <hr class="mb-3 mt-1"/>
                                                    <div class="row ">
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="joining_date">Joining
                                                                    Date </label>
                                                                <span class="float-end">:</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <span
                                                                    class="float-right"> {{ (date('j F, Y', strtotime($data->joining_date))) ?? 'N/A' }} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label" for="salary">Salary </label>
                                                                <span class="float-end">:</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <span class="float-right">{{ $data->salary ?? 'N/A' }} BDT</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label"
                                                                       for="designation">Designation </label>
                                                                <span class="float-end">:</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group mb-3">
                                                                <span
                                                                    class="float-right"> {{ ucwords($data->designation ?? 'N/A') }} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END tab-pane -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END profile-content -->
                        </div>
                        <!-- END profile-container -->
                    </div>
                    <!-- END profile -->
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>

            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')
    <script>
        //img upload
        $('.profile-img img').click(function () {
            $('#profile-image').click();
        });
        $('#blood-group').picker({search: true});

        $("#image").on('change', function () {
            var imgPath = $(this)[0].value;
            var extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg") {
                if (typeof (FileReader) != "undefined") {

                    var image_holder = $("#image-holder");
                    image_holder.empty();

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail"
                        }).appendTo(image_holder);
                    };
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {
                alert("Please Select Image Only !");
            }
        });
    </script>
@endpush

