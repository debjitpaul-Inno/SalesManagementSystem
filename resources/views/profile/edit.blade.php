@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Profile</h1>
                </div>
                @if(session('success'))
                    <x-alert type="success" message="{{session('success')}}"></x-alert>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alert type="danger" message="{{$error}}"></x-alert>
                    @endforeach
                @endif
                @if($data != null)
                    <div class="ms-auto col-12">
                             <span class="menu-icon">
                                <a href="{{route('profile.show',$data->uuid ?? '')}}"
                                   class="btn btn-outline-theme btn-lg active float-end"> <i
                                        class="bi bi-eye-fill ml-5"></i> View Profile</a>
                             </span>
                    </div>
                @endif
                <div class="col-12">
                    <hr/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mb-5" id="formControls">
                <div class="col-xl-12">
                @if($data == null)
                    <!-- BEGIN CREATE IMAGE -->
                        <div class="col-lg-12 text-center">
                            <div id="jQueryFileUpload" class="mb-5 col-xl-12">
                                <h4>Image Upload</h4>
                                <form id="fileupload" method="POST" enctype="multipart/form-data"
                                      class="m-auto col-lg-6">
                                    @csrf
                                    <div class="card" style="overflow: hidden">
                                        <div class="card-body pb-2">
                                            <div class="fileupload-buttonbar mb-2">
                                                <div class="d-block align-items-center">
                                                    <span class="btn btn-outline-theme fileinput-button me-2 mb-1">
                                                        <i class="fa fa-fw fa-plus"></i>
                                                        <span class="align-items-center">Add files...</span>
                                                        <input type="file" name="image" id="image"
                                                               data-url="image/upload">
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="error-msg"></div>
                                        </div>
                                        <table class="table table-card mb-0 fs-13px">
                                            <thead>
                                            <tr class="fs-12px">
                                                <th class="pt-2 pb-2 w-25">PREVIEW</th>
                                                <th class="pt-2 pb-2 w-25">FILENAME</th>
                                                <th class="pt-2 pb-2 w-25">SIZE</th>
                                                <th class="pt-2 pb-2 w-25">STATUS</th>
                                            </tr>

                                            </thead>
                                            <tbody class="files">
                                            <tr class="empty-row">
                                                <td colspan="4" class="text-center p-3">
                                                    <div id="doneIcon" class="text-green-300 mb-2"><i
                                                            class="fa fa-check-circle fa-3x"></i></div>
                                                    <p id="uploaded"></p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <x-card-border></x-card-border>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END CREATE IMAGE -->

                        <form id="createForm" class="form form-vertical" action="{{route('profile.store')}}"
                              method="POST" enctype="multipart/form-data">

                        @csrf
                        @else
                            <!-- BEGIN UPDATE IMAGE -->
                                <div class="col-lg-12 text-center">
                                    <div id="jQueryFileUpload" class="mb-5 col-xl-12">
                                        <h4>Upload Profile Image</h4>
                                        <form id="fileupload" method="POST" enctype="multipart/form-data"
                                              class="m-auto col-lg-6">
                                            @csrf
                                            @method('PUT')
                                            <div class="card" style="overflow: hidden">
                                                <div class="card-body pb-2">
                                                    <div class="fileupload-buttonbar mb-2">
                                                        <div class="d-block align-items-center">
                                                            <span
                                                                class="btn btn-outline-theme fileinput-button me-2 mb-1">
                                                                <i class="fa fa-fw fa-plus"></i>
                                                                <span
                                                                    class="align-items-center">Add files...</span>
                                                                <input
                                                                    type="file"
                                                                    name="image"
                                                                    id="image"
                                                                    data-url="image/update">

                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id="error-msg"></div>
                                                </div>
                                                <table class="table table-card mb-0 fs-13px">
                                                    <thead>
                                                    <tr class="fs-12px">
                                                        <th class="pt-2 pb-2 w-25">PREVIEW</th>
                                                        <th class="pt-2 pb-2 w-25">FILENAME</th>
                                                        <th class="pt-2 pb-2 w-25">SIZE</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="files">
                                                    <tr class="empty-row">
                                                        <td colspan="4" class="text-center p-3">
                                                            <div id="doneIcon" class="text-green-300 mb-2"><i
                                                                    class="fa fa-check-circle fa-3x"></i></div>
                                                            <p id="uploaded"></p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <x-card-border></x-card-border>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END UPDATE IMAGE -->
                                <form id="editForm" method="POST" action="{{route('profile.update', $data->uuid)}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @endif

                                    <input type="text" value="{{ Auth::user()->id ?? '' }}" id="user_id"
                                           name="user_id" hidden>
                                    <input type="text" name="image" id="imageName" value="" hidden>

                                    <div class="card mt-3">
                                        <div class="card-body p-0">
                                            <!-- BEGIN profile -->
                                            <div class="profile">
                                                <!-- BEGIN profile-container -->
                                                <div class="profile-container">
                                                    <!-- BEGIN profile-sidebar -->
                                                    <div class="profile-sidebar">
                                                        <div class="desktop-sticky-top">
                                                            <div class="profile-img upload-image">

                                                                <div id="up-image">
                                                                    @if($data != null && $data->image != null)
                                                                        <img
                                                                            src="{{asset("storage/images/profile/".$data->image)}}"
                                                                            alt="" srcset="">
                                                                    @else
                                                                        <img
                                                                            src="{{asset('assets/img/user/profile.jpg')}}"
                                                                            alt=""/>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!-- profile info -->
                                                            @if($data != null)
                                                                <h4 class="mt-2">{{ $data->full_name }}</h4>
                                                                <div
                                                                    class="mb-3 text-white text-opacity-50 fw-bold mt-n2">{{ Auth::user()->email }}</div>

                                                                <hr class="mt-4 mb-4"/>

                                                                <!-- profile info end -->
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- END profile-sidebar -->

                                                    <!-- BEGIN profile-content -->
                                                    <div class="profile-content">
                                                        <ul class="profile-tab nav nav-tabs nav-tabs-v2">
                                                            <li class="nav-item">
                                                                <a href="#profile-post" class="nav-link active"
                                                                   data-bs-toggle="tab">
                                                                    <div class="nav-field">Basic Information</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#profile-followers" class="nav-link"
                                                                   data-bs-toggle="tab">
                                                                    <div class="nav-field">Advance Information</div>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#profile-media" class="nav-link"
                                                                   data-bs-toggle="tab">
                                                                    <div class="nav-field">Workplace Information</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="profile-content-container">
                                                            <div class="row gx-4">
                                                                <div class="col-xl-12">
                                                                    <div class="tab-content p-0">
                                                                        <!-- BEGIN tab-pane -->
                                                                        <div class="tab-pane fade show active"
                                                                             id="profile-post">
                                                                            <div class="card mb-3">
                                                                                <div class="card-body">
                                                                                    <!-- post header -->
                                                                                    <p>Profile Information stage <b
                                                                                            class="text-theme">1</b> of
                                                                                        <b class="text-theme">3</b></p>
                                                                                    <hr class="mb-3 mt-1"/>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="first_name">First
                                                                                                    Name<span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       name="first_name"
                                                                                                       id="first_name"
                                                                                                       value="{{$data->first_name ?? old('first_name') ?? ''}}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                            <span
                                                                                                class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="last_name">Last
                                                                                                    Name<span
                                                                                                        class="required"> *</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       name="last_name"
                                                                                                       id="last_name"
                                                                                                       value="{{$data->last_name ?? old('last_name') ?? ''}}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                            <span
                                                                                                class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="phone_number">Phone
                                                                                                    Number<span
                                                                                                        class="required"> *</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       name="phone_number"
                                                                                                       id="phone_number"
                                                                                                       value="{{$data->phone_number?? old('phone_number') ?? ''}}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                            <span
                                                                                                class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="divider">
                                                                                        <div
                                                                                            class="divider-text text-theme">
                                                                                            Present Address
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="country">
                                                                                                    Country<span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       name="present_address[country]"
                                                                                                       id="present_country"
                                                                                                       value="{{ $data->present_address['country'] ?? '' }}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-danger">@error('present_address[country]'){{ $message }}@enderror</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="present_district">
                                                                                                    District<span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       name="present_address[district]"
                                                                                                       id="present_district"
                                                                                                       value="{{ $data->present_address['district'] ?? ''  }}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-danger">@error('present_address[district]'){{ $message }}@enderror</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="present_ps">
                                                                                                    P.S/Upazila<span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       name="present_address[ps]"
                                                                                                       id="present_ps"
                                                                                                       value="{{ $data->present_address['ps'] ?? '' }}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-danger">@error('present_address[ps]'){{ $message }}@enderror</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="present_zip">
                                                                                                    ZIP Code <span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       maxlength="4"
                                                                                                       name="present_address[zip]"
                                                                                                       id="present_zip"
                                                                                                       value="{{ $data->present_address['zip'] ?? '' }}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-danger">@error('present_address[zip]'){{ $message }}@enderror</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="present_address_line">
                                                                                                    Address Line<span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <textarea
                                                                                                    class="form-control rounded-pill-textarea-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                    name="present_address[address_line]"
                                                                                                    id="present_address_line"
                                                                                                    rows="3">{{ $data->present_address['address_line'] ?? '' }}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-danger">@error('present_address[address_line]'){{ $message }}@enderror</span>
                                                                                    </div>

                                                                                    <div class="divider">
                                                                                        <div
                                                                                            class="divider-text text-theme">
                                                                                            Permanent Address
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row pb-4">
                                                                                        <div class="text-center">
                                                                                            <span
                                                                                                class="check-all border border-theme text-theme"><span
                                                                                                    style="margin-right: 20px"
                                                                                                    class="mt-1">Same as Present</span>
                                                                                            <input
                                                                                                class="form-check-input mx-auto mt-0"
                                                                                                type="checkbox"
                                                                                                id="same_as_present"
                                                                                                name="same_as_present"/></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="permanent_country">
                                                                                                    Country<span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       name="permanent_address[country]"
                                                                                                       id="permanent_country"
                                                                                                       value="{{ $data->permanent_address['country'] ?? '' }}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-danger">@error('permanent_address[country]'){{ $message }}@enderror</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="permanent_district">
                                                                                                    District<span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       name="permanent_address[district]"
                                                                                                       id="permanent_district"
                                                                                                       value="{{ $data->permanent_address['district'] ?? ''  }}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-danger">@error('permanent_address[district]'){{ $message }}@enderror</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="permanent_ps">
                                                                                                    P.S/Upazila<span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       name="permanent_address[ps]"
                                                                                                       id="permanent_ps"
                                                                                                       value="{{ $data->permanent_address['ps'] ?? '' }}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-danger">@error('permanent_address[ps]'){{ $message }}@enderror</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="permanent_zip">
                                                                                                    ZIP Code <span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       maxlength="4"
                                                                                                       name="permanent_address[zip]"
                                                                                                       id="permanent_zip"
                                                                                                       value="{{ $data->permanent_address['zip'] ?? '' }}"
                                                                                                       placeholder=""/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-danger">@error('permanent_address[zip]'){{ $message }}@enderror</span>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="permanent_address_line">
                                                                                                    Address Line<span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <textarea
                                                                                                    class="form-control rounded-pill-textarea-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                    name="permanent_address[address_line]"
                                                                                                    id="permanent_address_line"
                                                                                                    rows="3">{{ $data->permanent_address['address_line'] ?? '' }}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span
                                                                                            class="text-danger">@error('permanent_address[address_line]'){{ $message }}@enderror</span>
                                                                                    </div>
                                                                                </div>
                                                                                <x-card-border></x-card-border>
                                                                            </div>
                                                                        </div>
                                                                        <!-- END tab-pane -->

                                                                        <!-- BEGIN tab-pane -->
                                                                        <div class="tab-pane fade"
                                                                             id="profile-followers">
                                                                            <div class="card mb-3">
                                                                                <div class="card-body">
                                                                                    <p>Profile Information stage <b
                                                                                            class="text-theme">2</b> of
                                                                                        <b
                                                                                            class="text-theme">3</b></p>
                                                                                    <hr class="mb-3 mt-1"/>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <label class="form-label"
                                                                                                   for="gender">Gender</label>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative align-items-center">
                                                                                                <select
                                                                                                    class="form-control"
                                                                                                    id="ex-search"
                                                                                                    name="gender">
                                                                                                    <option hidden
                                                                                                            value="{{ old('gender') ?? $data->gender ?? '' }}"> {{ucwords($data->gender ?? '')}}</option>
                                                                                                    <option value="male"
                                                                                                            @if (old('gender') == 'male') selected="selected" @endif>
                                                                                                        Male
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="female"
                                                                                                        @if (old('gender') == 'female') selected="selected" @endif>
                                                                                                        Female
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="other"
                                                                                                        @if (old('gender') == 'other') selected="selected" @endif>
                                                                                                        Other
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <span
                                                                                                class="text-danger">@error('gender'){{ $message }}@enderror</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="nid">National
                                                                                                    ID <span
                                                                                                        class="required"> *</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       maxlength="10"
                                                                                                       name="nid"
                                                                                                       id="nid"
                                                                                                       value="{{$data->nid ?? old('nid') ?? ''}}"
                                                                                                       placeholder="Insert 10 digit NID number"/>
                                                                                            </div>
                                                                                            <span
                                                                                                class="text-danger">@error('nid'){{ $message }}@enderror</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <label class="form-label"
                                                                                                   for="dob">Date
                                                                                                of Birth</label>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative align-items-center">
                                                                                                <div
                                                                                                    class="input-group">
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           name="dob"
                                                                                                           id="datepicker-component"
                                                                                                           placeholder="Click to Select"
                                                                                                           value="{{$data->dob ?? old('dob') ?? ''}}"/>
                                                                                                    <label
                                                                                                        class="input-group-text"
                                                                                                        for="datepicker-component"><i
                                                                                                            class="fa fa-calendar"></i></label>
                                                                                                </div>
                                                                                                <span
                                                                                                    class="text-danger">@error('dob'){{ $message }}@enderror</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <label class="form-label"
                                                                                                   for="gender">Blood
                                                                                                Group</label>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative align-items-center">
                                                                                                <select
                                                                                                    class="form-control"
                                                                                                    id="blood-group"
                                                                                                    name="gender">
                                                                                                    <option hidden
                                                                                                            value="{{ $data->blood_group ?? '' }}"> {{ucwords($data->blood_group ?? '') }}</option>
                                                                                                    <option value="a+"
                                                                                                            @if (old('blood_group') == 'a+') selected="selected" @endif>
                                                                                                        A+
                                                                                                    </option>
                                                                                                    <option value="a-"
                                                                                                            @if (old('blood_group') == 'a-') selected="selected" @endif>
                                                                                                        A-
                                                                                                    </option>
                                                                                                    <option value="b+"
                                                                                                            @if (old('blood_group') == 'b+') selected="selected" @endif>
                                                                                                        B+
                                                                                                    </option>
                                                                                                    <option value="b-"
                                                                                                            @if (old('blood_group') == 'b-') selected="selected" @endif>
                                                                                                        B-
                                                                                                    </option>
                                                                                                    <option value="o+"
                                                                                                            @if (old('blood_group') == 'o+') selected="selected" @endif>
                                                                                                        O+
                                                                                                    </option>
                                                                                                    <option value="o-"
                                                                                                            @if (old('blood_group') == 'o-') selected="selected" @endif>
                                                                                                        O-
                                                                                                    </option>
                                                                                                    <option value="ab+"
                                                                                                            @if (old('blood_group') == 'ab+') selected="selected" @endif>
                                                                                                        AB+
                                                                                                    </option>
                                                                                                    <option value="ab-"
                                                                                                            @if (old('blood_group') == 'ab-') selected="selected" @endif>
                                                                                                        AB-
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <span
                                                                                                class="text-danger">@error('present_address[address_line1]'){{ $message }}@enderror</span>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <x-card-border></x-card-border>
                                                                            </div>
                                                                        </div>
                                                                        <!-- END tab-pane -->

                                                                        <!-- BEGIN tab-pane -->
                                                                        <div class="tab-pane fade"
                                                                             id="profile-media">
                                                                            <div class="card mb-3">
                                                                                <div class="card-body">
                                                                                    <p>Profile Information stage <b
                                                                                            class="text-theme">3</b> of
                                                                                        <b
                                                                                            class="text-theme">3</b></p>
                                                                                    <hr class="mb-3 mt-1"/>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="salary">Salary</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       maxlength="10"
                                                                                                       name="salary"
                                                                                                       id="salary"
                                                                                                       value="{{$data->salary ?? 0 }}"
                                                                                                       readonly/>
                                                                                            </div>
                                                                                            <span
                                                                                                class="text-danger">@error('salary'){{ $message }}@enderror</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="designation">Designation</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div
                                                                                                class="position-relative d-flex align-items-center">
                                                                                                <input type="text"
                                                                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                                                                       name="designation"
                                                                                                       id="designation"
                                                                                                       value="{{$data->designation ?? ''}}"/>
                                                                                            </div>
                                                                                            <span
                                                                                                class="text-danger">@error('designation'){{ $message }}@enderror</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-xl-6 mb-3">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    class="form-label"
                                                                                                    for="joining_date">Joining
                                                                                                    Date <span
                                                                                                        class="required"> *</span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6">
                                                                                            <div class="input-group">
                                                                                                @if($data == null)
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           name="joining_date"
                                                                                                           id="datepicker-joining-date"
                                                                                                           placeholder="Click to Select"
                                                                                                           value="{{ old('joining_date') ?? ''}}"/>
                                                                                                    <label
                                                                                                        class="input-group-text"
                                                                                                        for="datepicker-joining-date"><i
                                                                                                            class="fa fa-calendar"></i></label>
                                                                                                @else
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           name="joining_date"
                                                                                                           placeholder="Click to Select"
                                                                                                           value="{{ $data->joining_date }}"
                                                                                                           readonly/>
                                                                                                @endif

                                                                                            </div>
                                                                                            <span
                                                                                                class="text-danger">@error('joining_date'){{ $message }}@enderror</span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-xl-12 text-center mt-5">
                                                                                            <div class="ms-auto">
                                                                                                <button type="submit"
                                                                                                        id="submit"
                                                                                                        class="btn btn-outline-theme btn-lg">
                                                                                                    <i
                                                                                                        class="bi bi-send-check fa-lg"></i>
                                                                                                    <span class="small">Submit</span>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <x-card-border></x-card-border>
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
                                </form>
                        </form>
                        <x-card-border></x-card-border>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')
    <script>
        $('#datepicker-joining-date').datepicker({
            autoclose: true
        });

        //img upload
        // $('.profile-img img').click(function () {
        //     $('#profile-image').click();
        // });
        // $('#up-image').click(function () {
        //     $('#profile-image').click();
        // });
        $('#blood-group').picker({search: true});

        $("input[name*='same_as_present']").click(function () {
            $("#permanent_country").val($("#present_country").val());
            $("#permanent_district").val($("#present_district").val());
            $("#permanent_ps").val($("#present_ps").val());
            $("#permanent_zip").val($("#present_zip").val());
            $("#permanent_address_line").val($("#present_address_line").val());
        })


        $(document).ready(function () {

            $('#doneIcon').hide()
        })

        $('#image').fileupload({
            {{--url: '{{route('category.imageSubmit')}}',--}}
            dataType: 'json',
            sequentialUploads: true,
            done: function (e, data) {
                $('#doneIcon').show()
                $('#uploaded').text('Image Uploaded Successfully')
                $('#imageName').val(data.result.imageName)
                console.log(data.result);
            }
        });
        $('#image').on('fileuploadadd', function (e, data) {
            data.submit();
        });

    </script>
@endpush
