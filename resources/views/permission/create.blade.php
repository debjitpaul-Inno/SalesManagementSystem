@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Create Permission</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='permission.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Add Permission From Here</h4>
            <p>You can add <b class="text-theme">Permission</b> as much as you want. To create a <b
                    class="text-theme">Permission</b> just fill up the mandatory input fields. </p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="createForm" method="POST" action="{{route('permission.store')}}"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="title">
                                                Title<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                   placeholder="Permission Title" value="{{ old('title') }}"/>
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
                                    <div class=" col-xl-6">
                                        <div class="form-group">
                                            <label for="status">Status <span class="required"> *</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="active"
                                                       value="ACTIVE" @if( old('status')) == "1" ? 'checked' : '' @endif
                                                required>
                                                <label class="form-check-label" for="active">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="inactive"
                                                       value="INACTIVE" @if( old('status')) == "0" ? 'checked' : '' @endif
                                                required>
                                                <label class="form-check-label" for="inactive">Inactive</label>
                                            </div>
                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 text-center mt-5">
                                    <div class="ms-auto">
                                        <button type="submit" class="btn btn-outline-theme btn-lg"><i
                                                class="bi bi-send-check fa-lg"></i>
                                            <span class="small">Submit</span></button>
                                    </div>
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
    <script type="text/javascript">
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                title: "required",
                status: "required",
            },
            messages: {
                title: "Title is required",
                status: "Status is required",
            }
        });


    </script>
@endpush
