@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Supplier Information</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='vendor.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h6>View <span class="text-theme"> Supplier</span> Information From Here</h6>
            <p>If you want to update any information of this <b class="text-theme">Supplier</b> please go to the update page
                by clicking the <b class="text-theme">Update</b> button given bellow.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="row  mt-2">
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-theme" for="vendor_name"><span style="font-weight: bold">Supplier Name</span></label>
                                        <span class="float-end">:</span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <span class="float-right">{{$vendor->vendor_name ?? 'N/A'}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row  mt-2">
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-theme" for="phone_number"><span style="font-weight: bold">Supplier Phone Number</span></label>
                                        <span class="float-end">:</span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <span class="float-right">{{$vendor->phone_number ?? 'N/A'}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="divider">
                                <div
                                    class="divider-text text-theme">
                                    Supplier Address
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-theme" for="title"><span style="font-weight: bold"> Country</span></label>
                                        <span class="float-end">:</span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <span class="float-right">{{$vendor->vendor_address['country'] ?? ''}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-theme" for="vendor_address['district']"><span style="font-weight: bold"> District</span></label>
                                        <span class="float-end">:</span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <span class="float-right">{{$vendor->vendor_address['district'] ?? ''}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-theme" for="vendor_address['ps']"><span style="font-weight: bold"> PS/Upazilla</span></label>
                                        <span class="float-end">:</span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <span class="float-right">{{$vendor->vendor_address['ps'] ?? ''}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-theme" for="vendor_address['zip']"><span style="font-weight: bold"> ZIP Code</span></label>
                                        <span class="float-end">:</span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <span class="float-right">{{$vendor->vendor_address['zip'] ?? ''}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-theme" for="vendor_address['address_line']"><span style="font-weight: bold"> Address Line </span></label>
                                        <span class="float-end">:</span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <span class="float-right">{{$vendor->vendor_address['address_line'] ?? ''}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 text-center mt-5">
                                <div class="ms-auto">
                                    <a href="{{route('vendor.edit', $vendor->uuid)}}" class="btn btn-outline-theme btn-lg"><i
                                            class="bi bi-vector-pen fa-lg"></i>
                                        <span class="small">Update</span></a>
                                </div>
                            </div>
                        </div>
                      <x-card-border></x-card-border>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


