@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert type="danger" message="{{$error}}"></x-alert>
            @endforeach
        @endif
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update User</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='user.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Edit User From Here</h4>
            <p>You can update <b class="text-theme">User</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="editForm" method="POST" action="{{route('user.update', $data->uuid ?? '')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="first_name">
                                                First Name<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                    value="{{$data->first_name ?? ''}}" readonly/>
                                        </div>
                                        <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="last_name">
                                                Last Name<span class="required"> *</span></label>
                                            <input type="text"class="form-control" id="last_name" name="last_name"
                                                   value="{{$data->last_name ?? ''}}" readonly/>
                                        </div>
                                        <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email">
                                                Email<span class="required"> *</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   placeholder="example@gmail.com" value="{{$data->users->email ?? ''}}"/>
                                        </div>
                                        <span class="text-danger">@error('salary'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label class="form-label">Roles <span class="required"> *</span></label>
                                            <select class="form-control ex-search" name="role_id[]" multiple>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                    @foreach($data->users->roles as $r)
                                                        {{$r->id == $role->id ? 'selected': ''}}
                                                        @endforeach>
                                                        {{ $role->title}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('role_id'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="salary">
                                                Salary<span class="required"> *</span></label>
                                            <input type="number" min="0" class="form-control" id="salary" name="salary"
                                                   placeholder="Salary Amount" value="{{$data->salary ?? ''}}"/>
                                        </div>
                                        <span class="text-danger">@error('salary'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="description">Joining Date<span class="required"> *</span></label>
                                            <div class="input-group">
                                                <input type="text"
                                                       class="form-control"
                                                       name="joining_date"
                                                       id="datepicker-joining-date"
                                                       placeholder="Click to Select"
                                                       value="{{  $data->joining_date ?? ''}}"/>
                                                <label class="input-group-text"
                                                       for="datepicker-joining-date"><i
                                                        class="fa fa-calendar"></i></label>
                                            </div>
                                            <span class="text-danger">@error('joining_date'){{ $message }}@enderror</span>
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
    <script>
        $('#datepicker-joining-date').datepicker({
            autoclose: true
        });
        $("#editForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                salary: "required",
                joining_date: "required",
                role_id: "required",
                email: "required",
            },
            messages: {
                salary: "Salary is required",
                joining_date: "Joining is required",
                role_id: "Role is required",
                email: "Role is required",
            }
        });
    </script>
@endpush
