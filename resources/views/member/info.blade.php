@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Member Information</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='member.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h6>View <span class="text-theme"> Member</span> Information From Here</h6>
            <p>If you want to update any information of this <b class="text-theme">Member</b> please go to the
                update page
                by clicking the <b class="text-theme">Update</b> button given bellow.</p>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="customer_id">Customer Name</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <a href="{{ route('customer.show',$member->customers->uuid) }}" class="float-right badge border border-theme text-light" style="text-decoration: none;font-size: 13px">{{ ucwords( $member->customers->nickname ?? 'N/A') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="type">Membership Type</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <a href="{{ route('membership-type.show',$member->membershipTypes->uuid) }}" class="float-right badge border border-theme text-light" style="text-decoration: none;font-size: 13px">{{ ucwords($member->membershipTypes->title) ?? 'N/A' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="membership_date">Membership Date</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span
                                                    class="float-right">{{  date('j F, Y', strtotime($member->membership_date))}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 text-center mt-5">
                                    <div class="ms-auto">
                                        <a href="{{route('member.edit', $member->uuid)}}" class="btn btn-outline-theme btn-lg"><i
                                                class="bi bi-vector-pen fa-lg"></i>
                                            <span class="small">Update</span></a>
                                    </div>
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
@push('customScripts')

@endpush
