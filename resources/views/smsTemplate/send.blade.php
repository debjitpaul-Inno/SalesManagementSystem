@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Send Sms Template</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='sms-template.index'></x-back-button>
            </div>
        </div>

        <div id="formControls" class="mb-5">
            <h4>Send Sms Template From Here</h4>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="createForm" method="POST" action="{{route('sms.store')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="col-xl-12">
                                                <div class="form-group d-flex">
                                                    <div class="form-check" style="margin-right: 20px;width: 25%">
                                                        <input class="form-check-input" type="radio" name="sms_to"
                                                               value="all" @if( old('sms_to')) == "all" ? 'checked' :
                                                        '' @endif>
                                                        <label class="form-check-label" for="all">All Staffs</label>
                                                    </div>
                                                    <div class="form-check" style="margin-right: 20px;width: 25%">
                                                        <input class="form-check-input" type="radio" name="sms_to"
                                                               value="customers" @if( old('sms_to')) == "customers" ?
                                                        'checked' : '' @endif>
                                                        <label class="form-check-label" for="customers">All
                                                            Customers</label>
                                                    </div>
                                                    <div class="form-check" style="margin-right: 20px;width: 25%">
                                                        <input class="form-check-input" type="radio" name="sms_to"
                                                               value="members" @if( old('sms_to')) == "members" ?
                                                        'checked' : '' @endif>
                                                        <label class="form-check-label" for="members">All
                                                            Members</label>
                                                    </div>
                                                    <div class="form-check" style="margin-right: 20px;width: 25%">
                                                        <input class="form-check-input" id="specific" type="radio"
                                                               name="sms_to" value="specific" @if( old('sms_to')) ==
                                                        "specific" ? 'checked' : '' @endif>
                                                        <label class="form-check-label" for="specific">Specific Number</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger ms-4">@error('sms_to'){{ $message }}@enderror</span>
                                        <x-card-border></x-card-border>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="title">Subject<span
                                                    class="required"> *</span></label>
                                            <input type="text" class="form-control" id="subject" name="subject"
                                                   value="{{ $template->subject }}" required/>
                                        </div>
                                        <span class="text-danger">@error('subject'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6" id="receiver">
                                        <div class="form-group mb-3">
                                            <label for="receiver" class="form-label">Receiver Number<span class="required"> *</span></label>
                                            <input type="text" class="form-control" name="receiver" id="phone_number"
                                                   placeholder="Receiver Number" value="{{ old('receiver') }}">
                                        </div>
                                        <span class="text-danger">@error('receiver'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="body">Sms Body<span
                                                    class="required"> *</span></label>
                                            <textarea class="form-control" id="body" name="body"
                                                      placeholder="Write the sms template's body here."
                                                      rows="3">{{ $template->body }}</textarea>
                                        </div>
                                        <span class="text-danger">@error('body'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <x-submit-button buttonName="submit" icon="bi bi-sd-card fa-lg"></x-submit-button>
                            </form>
                        </div>
                        <x-card-border></x-card-border>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">

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
            rules:{
                // sms_to: "required",
                subject : "required",
                body : "required",
                receiver: {
                    maxlength:11
                },
            },
            messages:{
                // sms_to: "Receiver is required",
                subject: "Subject is required",
                body: "Message is required",
                receiver: {
                    maxlength: "Phone Number is greater than 11 digits"
                },
            }
        });
        $("#receiver").hide();
        $('input[name="sms_to"]').on('change', function () {
            if (this.value != 'specific') {
                $("#receiver").hide()
            } else {
                $("#receiver").show()
                $("#phone_number").attr('required', '');
            }
        });
    </script>
@endpush

