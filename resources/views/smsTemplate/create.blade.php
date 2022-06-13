@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Create Sms Template</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='sms-template.index'></x-back-button>
            </div>
        </div>

        <div id="formControls" class="mb-5">
            <h4>Add Sms Template From Here</h4>
            <p>You can add <b class="text-theme">Sms Template</b> as much as you want. To create a <b class="text-theme"> Template</b> just fill up the mandatory input fields.  </p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="createForm" method="POST" action="{{route('sms-template.store')}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="title">Subject<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Template Subject" required/>
                                        </div>
                                        <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="body">Sms Body<span class="required"> *</span></label>
                                            <textarea class="form-control" id="body" name="body" placeholder="Write the sms template's body here." rows="3"></textarea>
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
            rules: {
                subject: "required",
                body: "required",
            },
            messages: {
                subject: "Subject is required",
                body: "Sms Body is required",
            }
        });
    </script>
@endpush

