@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Create Member</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='member.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Add Member From Here</h4>
            <p>You can add <b class="text-theme">Member</b> as much as you want. To create a <b
                    class="text-theme">Member</b> just fill up the mandatory input fields. </p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="createForm" method="POST" action="{{route('member.store')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="customer_id">
                                                Customer Name<span class="required"> *</span></label>
                                            <select class="form-control ex-search" id="customer_id" name="customer_id" required>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->nickname.' ( '.$customer->phone_number.' )' }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('customer_id'){{ $message }}@enderror</span>
                                        </div>

                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="membership_type_id">Membership Type<span class="required"> *</span></label>
                                            <select class="form-control ex-search" id="membership_type_id" name="membership_type_id" required>
                                                @foreach($membershipTypes as $membershipType)
                                                    <option value="{{ $membershipType->id }}">{{ $membershipType->title.' ( '.$membershipType->discount. '%'.' )' }}</option>
                                                @endforeach
                                            </select>
                                        <span class="text-danger">@error('membership_type_id'){{ $message }}@enderror</span>
                                    </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label" for="membership_date">Membership Date <span class="required"> *</span> </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="membership_date" id="datepicker-component" placeholder="Click to select"  value=""/>
                                                <label class="input-group-text" for="datepicker-component"><i class="fa fa-calendar"></i></label>
                                            </div>
                                            <span class="text-danger">@error('membership_date'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <x-submit-button buttonName="Submit" icon="bi bi-sd-card fa-lg"></x-submit-button>
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
                customer_id: "required",
                membership_type_id: "required",
                membership_date: "required",
            },
            messages: {
                customer_id: "Customer is required",
                membership_type_id: "Membership Type is required",
                membership_date: "Membership Date is required",
            }
        });
    </script>
@endpush
