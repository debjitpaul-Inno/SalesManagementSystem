@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">

            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Sms Template</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='sms-template.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Edit Sms Template From Here</h4>
            <p>You can update <b class="text-theme">Template</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">

                            <form id="editForm" method="POST" action="{{route('sms-template.update',$template->uuid)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="subject">Subject<span
                                                    class="required"> *</span></label>
                                            <input type="text" class="form-control" id="subject" name="subject"
                                                   value="{{$template->subject ?? ''}}" required/>
                                        </div>
                                        <span class="text-danger">@error('subject'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="description">Sms Body<span class="required"> *</span></label>
                                            <textarea class="form-control" id="body" name="body"
                                                      rows="3" required>{{$template->body ?? ''}}</textarea>
                                        </div>
                                        <span class="text-danger">@error('body'){{ $message }}@enderror</span>
                                    </div>
                                    <x-submit-button buttonName="Update"
                                                     icon="bi bi-vector-pen fa-lg"></x-submit-button>
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
        $("#editForm").validate({
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

