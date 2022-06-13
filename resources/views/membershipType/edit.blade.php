@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Membership Type</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='membership-type.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Edit Membership Type From Here</h4>
            <p>You can update <b class="text-theme">Membership Type</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="editForm" method="POST" action="{{route('membership-type.update', $membershipType->uuid)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="title">Title<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ $membershipType->title ?? 'N/A' }}" placeholder="Membership Title" />
                                        </div>
                                        <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="discount">Discount<span class="required"> *</span></label>
                                        <div class="input-group flex-nowrap">
                                            <input type="number" min="0" class="form-control" name="discount" value="{{ $membershipType->discount ?? 'N/A' }}" id="discount" placeholder="Discount Percentage" />
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <span class="text-danger">@error('discount'){{ $message }}@enderror</span>
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
                discount: "required",
            },
            messages: {
                title: "Type is required",
                discount: "Membership Date is required",
            }
        });
    </script>
@endpush
