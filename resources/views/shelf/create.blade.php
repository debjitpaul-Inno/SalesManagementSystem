@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Create Shelf</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='shelf.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Add Shelf From Here</h4>
            <p>You can add <b class="text-theme">Shelf</b> as much as you want. To create a <b
                    class="text-theme">Shelf</b> just fill up the mandatory input fields. </p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="createForm" method="POST" action="{{route('shelf.store')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="title">
                                                Title<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                   placeholder="Shelf Title" value="{{ old('title') }}"/>
                                        </div>
                                        <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="shelf_number">
                                                Shelf Number<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="shelf_number" name="shelf_number"
                                                   placeholder="Shelf Number" value="{{ old('shelf_number') }}"/>
                                        </div>
                                        <span class="text-danger">@error('shelf_number'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="shelf_id">
                                                Warehouse Name<span class="required"> *</span></label>
                                            <select class="form-control ex-search" id="" name="store_id">
                                                @foreach($stores as $store)
                                                    <option value="{{ $store->id }}" @if (old('store_id') == $store->id) selected="selected" @endif>{{ $store->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('store_id'){{ $message }}@enderror</span>
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
                title: "required",
                shelf_number: "required",
                store_id: "required",
            },
            messages: {
                title: "Title is required",
                shelf_number: "Shelf Number is required",
                store_id: "Shelf Number is required",
            }
        });
    </script>
@endpush
