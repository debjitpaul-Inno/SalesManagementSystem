@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Member</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='member.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Edit Member From Here</h4>
            <p>You can update <b class="text-theme">Member</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="editForm" method="POST" action="{{route('member.update', $data->uuid)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @if($errors->any())
                                    {{ implode('', $errors->all('<div>:message</div>')) }}

                                @endif
                                <div class="row">
                                    <div class="col-xl-6">
                                        <label class="form-label" for="membership_date"> Membership Date<span class="required"> *</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="membership_date" value="{{$data->membership_date}}" id="datepicker-component" />
                                            <label class="input-group-text" for="datepicker-component"><i class="fa fa-calendar"></i></label>
                                        </div>
                                        <span class="text-danger">@error('membership_date'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <fieldset class="form-group">
                                            <label for="customer_id" class="mb-2 d-flex align-items-center">Customer Name</label>
                                            <select name="customer_id" class="form-control select2" style="width: 100%">
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{$data->customer_id == $customer->id  ? 'selected' : ''}}>{{ $customer->nickname.' ( '.$customer->phone_number.' )' }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        <span class="text-danger">@error('customer_id'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <fieldset class="form-group">
                                            <label for="membership_type_id" class="mb-2 d-flex align-items-center">Membership Type</label>
                                            <select name="membership_type_id" class="form-control select2" style="width: 100%">
                                                @foreach($membershipTypes as $membershipType)
                                                    <option value="{{ $membershipType->id }}" {{$data->membership_type_id == $membershipType->id  ? 'selected' : ''}}>{{$membershipType->title.' ( '.$membershipType->discount. '%'.' )'}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        <span class="text-danger">@error('membership_type_id'){{ $message }}@enderror</span>
                                    </div>
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

        $("#editForm").validate({
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
