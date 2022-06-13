@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">SMS Template Information</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='sms-template.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h6>View <span class="text-theme"> Sms Template</span> Information From Here</h6>
            <p>If you want to update any information of this <b class="text-theme">Template</b> please go to the update
                page
                by clicking the <b class="text-theme">Update</b> button given bellow.</p>
            <div class="row">
                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="row">
                                <div class="row  mt-2">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label text-theme" for="title"><span
                                                    style="font-weight: bold">Subject</span></label>
                                            <span class="float-end">:</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <span class="float-right">{{$template->subject ?? 'N/A'}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label text-theme" for="body"><span
                                                    style="font-weight: bold">Sms Body</span></label>
                                            <span class="float-end">:</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <span class="float-right">{{$template->body ?? 'N/A'}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 text-center mt-5">
                                    <div class="ms-auto">
                                        <a href="{{route('sms-template.edit', $template->uuid)}}"
                                           class="btn btn-outline-theme btn-lg"><i
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

