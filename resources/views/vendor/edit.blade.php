@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">

            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Supplier</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='vendor.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Edit Supplier From Here</h4>
            <p>You can update <b class="text-theme">supplier</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="editForm" method="POST" action="{{route('vendor.update',$vendor->uuid)}}"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="vendor_name"><span class="required">*</span> Supplier Name</label>
                                                <input type="text" class="form-control" id="vendor_name" name="vendor_name" placeholder="vendor name" value="{{ $vendor->vendor_name ?? '' }}" required/>
                                            </div>
                                            <span class="text-danger">@error('vendor_name'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="phone_number"><span class="required">*</span> Supplier Phone Number</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $vendor->phone_number ?? '' }}" placeholder="+88" required/>
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
                                                    Country<span
                                                        class="required"> *</span></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div
                                                class="position-relative d-flex align-items-center">
                                                <input type="text"
                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                       name="vendor_address[country]" value="{{ $vendor->vendor_address['country'] ?? '' }}"
                                                       placeholder=""/>
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
                                                    District<span
                                                        class="required"> *</span></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div
                                                class="position-relative d-flex align-items-center">
                                                <input type="text"
                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                       name="vendor_address[district]" value="{{ $vendor->vendor_address['district'] ?? '' }}"
                                                       placeholder=""/>
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
                                                    P.S/Upazila<span
                                                        class="required"> *</span></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div
                                                class="position-relative d-flex align-items-center">
                                                <input type="text"
                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                       name="vendor_address[ps]" value="{{ $vendor->vendor_address['ps'] ?? '' }}"
                                                       placeholder=""/>
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
                                                       name="vendor_address[zip]" value="{{ $vendor->vendor_address['zip'] ?? '' }}"
                                                       placeholder=""/>
                                            </div>
                                        </div>
                                        <span
                                            class="text-danger">@error('vendor_address[zip]'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 mb-3">
                                            <div class="form-group">
                                                <label
                                                    class="form-label"
                                                    for="vendor_address_line">
                                                    Address Line<span
                                                        class="required"> *</span></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="position-relative d-flex align-items-center">
                                                <textarea class="form-control rounded-pill-textarea-textarea-textarea-textarea bg-white bg-opacity-15"
                                                    name="vendor_address[address_line]"
                                                    rows="3">{{ $vendor->vendor_address['address_line'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <span
                                            class="text-danger">@error('vendor_address[address_line]'){{ $message }}@enderror</span>
                                    </div>
                                <x-submit-button buttonName="Update" icon="bi bi-vector-pen fa-lg"></x-submit-button>
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
        $(document).ready(function (){
            $('#doneIcon').hide()
        })

        $('#image').fileupload({
            dataType: 'json',
            sequentialUploads: true,
            done: function(e, data) {
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

