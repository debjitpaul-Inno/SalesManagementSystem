@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Shelf</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='shelf.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Edit Shelf From Here</h4>
            <p>You can update <b class="text-theme">Shelf</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="editForm" method="POST" action="{{route('shelf.update', $data->uuid)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="title">
                                                Title<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                   placeholder="Shelf Title" value="{{$data->title}}"/>
                                        </div>
                                        <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="shelf_number">
                                                Shelf Number<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="shelf_number" name="shelf_number"
                                                   placeholder="Shelf Number" value="{{$data->shelf_number}}"/>
                                        </div>
                                        <span class="text-danger">@error('shelf_number'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="shelf_id">
                                                Warehouse Name<span class="required"> *</span></label>
                                            <select class="form-control ex-search" id="" name="store_id">
                                                @foreach($stores as $store)
                                                    <option value="{{old('store_id', $store->id)}}" {{$data->store_id == $store->id ? 'selected' : ''}}>{{$store->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('store_id'){{ $message }}@enderror</span>
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
