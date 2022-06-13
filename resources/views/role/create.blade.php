@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Create Role</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='role.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Add Role From Here</h4>
            <p>You can add <b class="text-theme">Role</b> as much as you want. To create a <b
                    class="text-theme">Role</b> just fill up the mandatory input fields. </p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="createForm" method="POST" action="{{route('role.store')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="title">
                                                Title<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="title"
                                                   placeholder="Role Title" name="title" value="{{ old('title') }}"/>
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
                                            <label for="status"> Status<span class="required"> *</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="active"
                                                       value="ACTIVE" @if( old('status')) == "1" ? 'checked' : '' @endif
                                                required>
                                                <label class="form-check-label" for="active">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="inactive"
                                                       value="INACTIVE" @if( old('status')) == "0" ? 'checked' :
                                                '' @endif
                                                required>
                                                <label class="form-check-label" for="inactive">Inactive</label>
                                            </div>
                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider  mt-4">
                                    <div class="divider-text bg-theme"><span class="required">* </span> Permission List<span class="required"> *</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 mb-2 text-end">
                                        <span class="check-all border border-theme text-theme">
                                            <span style="margin-right: 20px" class="mt-1">Check All</span> <input
                                                class="form-check-input mx-auto mt-0" type="checkbox"
                                                id="checkAll"/>
                                        </span>
                                    </div>
                                    <div class="col-xl-6 d-flex text-center">
                                        <p style="width: 50%;margin-bottom: -5px">Title</p>
                                        <p style="width: 50%;margin-bottom: -5px">Action</p>
                                    </div>

                                    <div class="col-xl-6 d-flex text-center vanish-div">
                                        <p class="vanish-p" style="width: 50%;margin-bottom: -5px">Title</p>
                                        <p class="vanish-p" style="width: 50%;margin-bottom: -5px">Action</p>
                                    </div>
                                    <div class="divider" style="margin:0 0;">
                                        <div class="divider-text bg-theme"></div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                @if(count($permissions)!==0)
                                       @foreach($permissions as $permission)
                                            <div class="col-xl-6 d-flex text-center" id="per-div">
                                                <p style="width: 50%">{{$permission->title ?? ''}}</p>
                                                <input class="form-check-input mx-auto" type="checkbox"
                                                       name="permission_id[]" id="permission" value="{{$permission->id}}"/>
                                            </div>
                                        @endforeach
                                 @else
                                        <div class="col-xl-12 text-center ">
                                            <h2 class="text-danger">No Data Available  </h2>

                                        </div>
                                 @endif
                                </div>

                        <div class="col-xl-12 text-center mt-5">
                            <div class="ms-auto">
                                <x-submit-button buttonName="Submit" icon="bi bi-sd-card" ></x-submit-button>
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
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                title: "required",
                permission_id: "required",
                status: "required",
            },
            messages: {
                title: "Title is required",
                permission_id: "Permission is required",
                status: "Status is required",
            }
        });
        $('#checkAll').click(function(e){
            $('input:checkbox').prop('checked',this.checked);
        });
    </script>
@endpush
