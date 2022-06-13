@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Create Supplier</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='vendor.index'></x-back-button>
            </div>
        </div>

        <div id="formControls" class="mb-5">
            <h4>Add Supplier From Here</h4>
            <p>You can add <b class="text-theme">supplier</b> as much as you want. To create a <b class="text-theme"> supplier</b> just fill up the [ * ] marked input fields.  </p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="createForm" method="POST" action="{{route('vendor.store')}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="vendor_name">Supplier Name<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="vendor_name" name="vendor_name"
                                                   value="{{ old('vendor_name') }}" placeholder="Vendor Name" required/>
                                        </div>
                                        <span class="text-danger">@error('vendor_name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="phone_number">Supplier Phone Number<span class="required"> *</span></label>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">+88</span>
                                            <input type="number" min="0" class="form-control" name="phone_number" value="{{ old('phone_number') }}" id="phone_number"  />
                                        </div>
                                        <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="divider">
                                    <div
                                        class="divider-text text-theme">
                                        Supplier Address
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                class="form-label"
                                                for="vendor_country">
                                                Country<span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div
                                            class="position-relative d-flex align-items-center">
                                            <input type="text"
                                                   class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                   name="vendor_address[country]" value="{{ old('vendor_address[country]')}}"
                                                   placeholder="" required/>
                                        </div>
                                    </div>
                                    <span
                                        class="text-danger">@error('vendor_address[country]'){{ $message }}@enderror</span>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                class="form-label"
                                                for="vendor_district">
                                                District<span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div
                                            class="position-relative d-flex align-items-center">
                                            <input type="text"
                                                   class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                   name="vendor_address[district]" value="{{old('vendor_address[district]')}}"
                                                   placeholder="" required/>
                                        </div>
                                    </div>
                                    <span
                                        class="text-danger">@error('vendor_address[district]'){{ $message }}@enderror</span>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                class="form-label"
                                                for="vendor_ps">
                                                P.S/Upazila<span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div
                                            class="position-relative d-flex align-items-center">
                                            <input type="text"
                                                   class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                   name="vendor_address[ps]" value="{{ old('vendor_address[ps]')}}"
                                                   placeholder="" required/>
                                        </div>
                                    </div>
                                    <span
                                        class="text-danger">@error('vendor_address[ps]'){{ $message }}@enderror</span>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                class="form-label"
                                                for="vendor_zip">
                                                ZIP Code <span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div
                                            class="position-relative d-flex align-items-center">
                                            <input type="text"
                                                   class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                   maxlength="4"
                                                   name="vendor_address[zip]" value="{{old('vendor_address[zip]')}}"
                                                   placeholder="" required>
                                        </div>
                                    </div>
                                    <span class="text-danger">@error('vendor_address[zip]'){{ $message }}@enderror</span>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                class="form-label"
                                                for="vendor_address_line">
                                                Address Line<span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="position-relative d-flex align-items-center">
                                            <textarea class="form-control rounded-pill-textarea-textarea-textarea-textarea bg-white bg-opacity-15" name="vendor_address[address_line]"
                                                rows="3" required>{{old('vendor_address[address_line]')}}</textarea>
                                        </div>
                                    </div>
                                    <span class="text-danger">@error('vendor_address[address_line]'){{ $message }}@enderror</span>
                                </div>

                               <x-submit-button buttonName="submit" icon="bi bi-sd-card fa-lg"></x-submit-button>
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
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                vendor_name: "required",
                phone_number: "required",
                vendor_address : "required"
            },
            messages: {
                vendor_name: "Vendor Name is required",
                phone_number: "Vendor Phone Number is required",
                vendor_address: "Vendor Address is required",

            }
        });




    </script>
@endpush

