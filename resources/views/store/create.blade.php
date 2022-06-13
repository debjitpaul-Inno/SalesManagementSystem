@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Add In Warehouse</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='store.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Add Warehouse From Here</h4>
            <p>By adding <b class="text-theme">Warehouse</b> you may keep a clean track of products of each warehouse. To create a
                <b class="text-theme"> Warehouse</b> just fill up the mandatory input fields. </p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="createForm" method="POST" action="{{route('store.store')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="title"> Title<span
                                                    class="required"> *</span></label>
                                            <input type="text" class="form-control" id="title"
                                                   name="title" value="{{ old('title') }}" placeholder="Warehouse Title"
                                                   required/>
                                        </div>
                                        <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Description"
                                                      rows="3">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="divider">
                                        <div
                                            class="divider-text text-theme">
                                            Address
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 mb-3">
                                            <div class="form-group">
                                                <label
                                                    class="form-label"
                                                    for="address_country">
                                                    Country<span
                                                        class="required"> *</span></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div
                                                class="position-relative d-flex align-items-center">
                                                <input type="text"
                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                       name="address[country]"
                                                       placeholder=""/>
                                            </div>
                                        </div>
                                        <span
                                            class="text-danger">@error('address[country]'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 mb-3">
                                            <div class="form-group">
                                                <label
                                                    class="form-label"
                                                    for="address_district">
                                                    District<span
                                                        class="required"> *</span></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div
                                                class="position-relative d-flex align-items-center">
                                                <input type="text"
                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                       name="address[district]"
                                                       placeholder=""/>
                                            </div>
                                        </div>
                                        <span
                                            class="text-danger">@error('address[district]'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 mb-3">
                                            <div class="form-group">
                                                <label
                                                    class="form-label"
                                                    for="address_ps">
                                                    P.S/Upazila<span
                                                        class="required"> *</span></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div
                                                class="position-relative d-flex align-items-center">
                                                <input type="text"
                                                       class="form-control rounded-pill-textarea-textarea-textarea bg-white bg-opacity-15"
                                                       name="address[ps]"
                                                       placeholder=""/>
                                            </div>
                                        </div>
                                        <span
                                            class="text-danger">@error('address[ps]'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 mb-3">
                                            <div class="form-group">
                                                <label
                                                    class="form-label"
                                                    for="address_zip">
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
                                                       name="address[zip]"
                                                       placeholder=""/>
                                            </div>
                                        </div>
                                        <span
                                            class="text-danger">@error('address[zip]'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 mb-3">
                                            <div class="form-group">
                                                <label
                                                    class="form-label"
                                                    for="address_line">
                                                    Address Line<span
                                                        class="required"> *</span></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div
                                                class="position-relative d-flex align-items-center">
                                                <textarea
                                                    class="form-control rounded-pill-textarea-textarea-textarea-textarea bg-white bg-opacity-15"
                                                    name="address[address_line]"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                        <span
                                            class="text-danger">@error('address[address_line]'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-xl-12 text-center mt-5">
                                    <x-submit-button buttonName="Submit" icon="bi bi-sd-card"></x-submit-button>
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
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                title: "required",
                address: "required",
            },
            messages: {
                title: "Title is required",
                address: "Address is required",
            }
        });
    </script>
@endpush

