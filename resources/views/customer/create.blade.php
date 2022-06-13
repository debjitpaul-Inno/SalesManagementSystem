@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Create Customer</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='customer.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Add Customer From Here</h4>
            <p>You can add <b class="text-theme">customer</b> in this section. To create a <b class="text-theme"> customer</b> just fill up the<b class="text-theme"> required</b> input fields.  </p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="createForm" method="POST" action="{{route('customer.store')}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="nickname">Nick Name<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Short Name" />
                                        </div>
                                        <span class="text-danger">@error('nickname'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="phone_number">Phone Number<span class="required"> *</span></label>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">+88</span>
                                            <input type="text" class="form-control" name="phone_number" id="phone_number"/>
                                        </div>
                                        <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" />
                                        </div>
                                        <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" />
                                        </div>
                                        <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="address[present]">Address</label>
                                            <textarea class="form-control" id="address[present]" name="address[present]" rows="3" placeholder="Address"></textarea>
                                        </div>
                                        <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                                    </div>
                                </div>
{{--                               <x-submit-button buttonName="submit" onClick="checkNickName()"></x-submit-button>--}}
                                <div class="col-xl-12 text-center mt-5">
                                    <div class="ms-auto">
                                        <button type="submit" class="btn btn-outline-green btn-lg" onclick="checkNickName()"><i class="bi bi-sd-card fa-lg"></i>
                                            <span class="small">Submit</span></button>
                                    </div>
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
        function checkNickName(){
            if (!$('#nickname').val()){
               let first_name = $('#first_name').val()
               let last_name = $('#last_name').val()
                let nickname = first_name + ' '+ last_name
                $('#nickname').val(nickname)
            }
        }
        $('#selectpicker').picker({search : true});

        $('#fileupload').fileupload({
            url: '--- your url here ---',
            dataType: 'json',
            sequentialUploads: true,
            done: function(e, data) {
                //console.log(data.result);
            }
        });
        $('#fileupload').on('fileuploadadd', function (e, data) {
            data.submit();
        });
        $("#createForm").validate({
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

