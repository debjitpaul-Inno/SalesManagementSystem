@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">

            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Customer</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='customer.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Edit Customer From Here</h4>
            <p>You can update <b class="text-theme">Customer</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">

                            <form id="editForm" method="POST" action="{{route('customer.update',$customer->uuid)}}"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="row">
                                        <div class="col-xl-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="nickname">Nick Name<span class="required"> *</span></label>
                                                <input type="text" class="form-control" id="nickname" name="nickname" value="{{$customer->nickname ?? ''}}" placeholder="short name" />
                                            </div>
                                            <span class="text-danger">@error('nickname'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-xl-6 form-group mb-3">
                                            <label class="form-label" for="phone_number">Phone Number<span class="required"> *</span></label>
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text">+88</span>
                                                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{$customer->phone_number ?? ''}}"/>
                                            </div>
                                            <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-xl-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="first_name">First Name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{$customer->first_name ?? ''}}" placeholder="First Name" />
                                            </div>
                                            <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-xl-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="last_name">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{$customer->last_name ?? ''}}" placeholder="Last Name" />
                                            </div>
                                            <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="col-xl-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="address">Address</label>
                                                <textarea class="form-control" id="address[present]" name="address[present]" rows="3" placeholder="Address">{{$customer->address['present'] ?? ''}}</textarea>
                                            </div>
                                            <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                                        </div>
                                        <x-submit-button buttonName="Update" icon="bi bi-vector-pen fa-lg"></x-submit-button>
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
        $("#editForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                // nickname: "required",
                phone_number: "required",
            },
            messages: {
                // nickname: "NickName is required",
                phone_number: "Phone Number is required",
            }
        });
    </script>
@endpush

