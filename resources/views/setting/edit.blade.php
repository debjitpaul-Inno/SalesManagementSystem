@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert type="danger" message="{{$error}}"></x-alert>
            @endforeach
        @endif
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Settings</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Edit Settings From Here</h4>
            <p>You can update <b class="text-theme">Settings</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form class="form form-vertical" action="{{route('setting.store')}}" id="editForm"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        @if($settings != null)
                                            <div class="card mb-2">
                                                <div class="card-body pb-2">
                                                    <div class="row pb-1">

                                                        <div class="col-sm-6 text-center">
                                                            <div>
                                                                @if($settings->logo != null)
                                                                    <img class="img h-200px w-200px"
                                                                         src="{{asset("storage/logos/".$settings->logo)}}"
                                                                         alt="logo" >
                                                                @else
                                                                    <img class="h-200px w-200px"
                                                                         src="{{asset('assets/img/no-image/no-image-available.jpg')}}"
                                                                         alt="sub-category image">
                                                                @endif
                                                            </div>
                                                            <label for="" class="form-label mt-3"
                                                                   style="font-weight: bold">Logo</label>
                                                        </div>


                                                        <div class="col-sm-6 text-center">
                                                            <div>
                                                                @if($settings->favicon != null)
                                                                    <img class="img h-200px w-200px"
                                                                         src="{{asset("storage/favicons/".$settings->favicon)}}"
                                                                         alt="logo" >
                                                                @else
                                                                    <img class="h-200px w-200px"
                                                                         src="{{asset('assets/img/no-image/no-image-available.jpg')}}"
                                                                         alt="sub-category image">
                                                                @endif
                                                            </div>
                                                            <label for="" class="form-label mt-3"
                                                                   style="font-weight: bold">Favicon</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <x-card-border></x-card-border>
                                            </div>
                                        @endif
                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="logo" class="mb-2">
                                                    Logo</label>
                                                <input type="file" value="{{ old('logo') }}" class="form-control"
                                                       id="logo" name="logo">
                                            </div>
                                            <span class="text-danger">@error('logo'){{ $message }}@enderror</span>
                                            <div class="form-group col-sm-6 my-2">
                                                <div id="logo-holder"
                                                     style="width: 200px; position: relative"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="favicon" class="mb-2">
                                                    Favicon</label>
                                                <input type="file" value="{{ old('favicon') }}" class="form-control"
                                                       id="favicon" name="favicon">
                                            </div>
                                            <span class="text-danger">@error('favicon'){{ $message }}@enderror</span>
                                            <div class="form-group col-sm-6 my-2">
                                                <div id="favicon-holder"
                                                     style="width: 200px; position: relative"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="title" class="mb-2">
                                                    Organization Name<span class="required"> *</span></label>
                                                <input type="text" value="{{ $settings->title ?? old('title') ?? '' }}"
                                                       class="form-control" id="title" name="title">
                                            </div>
                                            <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="email" class="mb-2">Email Address<span
                                                        class="required"> *</span>
                                                </label>
                                                <input type="email" value="{{ $settings->email ?? old('email') ?? '' }}"
                                                       class="form-control" id="email" name="email">
                                            </div>
                                            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="email" class="mb-2"> Merchant Number<span class="required"> *</span></label>
                                                <input type="text" value="{{ $settings->mid ?? old('mid') ?? '' }}"
                                                       class="form-control" id="mid" name="mid">
                                            </div>
                                            <span class="text-danger">@error('mid'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="phone_number" class="mb-2">
                                                    Phone Number<span class="required"> *</span></label>
                                                <input type="text"
                                                       value="{{ $settings->phone_number ?? old('phone_number') ?? '' }}"
                                                       class="form-control" id="phone_number" name="phone_number">
                                            </div>
                                            <span
                                                class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group mb-3">
                                                <label for="footer_text" class="form-label"> Footer Text</label>
                                                <textarea class="form-control" name="footer_text"
                                                          rows="3">{{ $settings->footer_text ?? old('footer_text') ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="divider">
                                            <div
                                                class="divider-text text-theme">
                                                Address
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="address['country']"
                                                       class="mb-2">Country<span class="required"> *</span></label>
                                                <input type="text" name="address[country]"
                                                       id="country" class="form-control"
                                                       value="{{ $settings->address['country'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="address[district]"
                                                       class="mb-2">District<span class="required"> *</span></label>
                                                <input type="text" name="address[district]" id="district"
                                                       class="form-control"
                                                       value="{{ $settings->address['district'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="address[upazila]" class="mb-2">Thana/Upazila<span
                                                        class="required"> *</span></label>
                                                <input type="text" name="address[upazila]" id="present_upazila"
                                                       class="form-control"
                                                       value="{{ $settings->address['upazila'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="address[post_code]" class="mb-2"> Post
                                                    Code<span class="required"> *</span></label>
                                                <input type="text" name="address[post_code]" id="present_post"
                                                       class="form-control"
                                                       value="{{ $settings->address['post_code'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="address[address_line]" class="mb-2">
                                                    Address Line<span class="required"> *</span></label>
                                                <textarea class="form-control"
                                                          name="address[address_line]" id="present_add"
                                                          rows="2"
                                                          required>{{ $settings->address['address_line'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <x-submit-button buttonName="Update"
                                                     icon="bi bi-vector-pen fa-lg"></x-submit-button>
                                </div>
                            </form>
                        </div>
                        <x-card-border></x-card-border>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')
    <script>
        $("#editForm").validate({
            rules: {
                title: "required",
                email: "required",
                mid: "required",
                phone_number: "required",
                document: "mimes:jpeg,png,doc,docs,pdf",
            },
            messages: {
                title: "Title is required",
                email: "Email is required",
                mid: "Merchant Id is required",
                phone_number: "Phone Number is required",
            }
        });
        $("#logo").on('change', function () {
            var imgPath = $(this)[0].value;
            var extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg" || extension === "svg") {
                if (typeof (FileReader) != "undefined") {

                    var image_holder = $("#logo-holder");
                    image_holder.empty();

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail",
                            "height": "150px"
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
        $("#favicon").on('change', function () {
            var imgPath = $(this)[0].value;
            var extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg" || extension === "svg") {
                if (typeof (FileReader) != "undefined") {

                    var image_holder = $("#favicon-holder");
                    image_holder.empty();

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "img-thumbnail",
                            "height": "150px"
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

