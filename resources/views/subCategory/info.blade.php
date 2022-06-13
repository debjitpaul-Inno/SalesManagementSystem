@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Sub-Category Information</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='sub-category.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h6>View <span class="text-theme"> sub-category</span> Information From Here</h6>
            <p>If you want to update any information of this <b class="text-theme">Sub-Category</b> please go to the update page
                by clicking the <b class="text-theme">Update</b> button given bellow.</p>
            <div class="row">
                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row  mt-2">
                                        <div class="col-xl-6 form-group mb-3">
                                                <label class="form-label text-theme" for="title"><span style="font-weight: bold">Title</span></label>
                                                <span class="float-end">:</span>
                                        </div>
                                        <div class="col-xl-6 form-group mb-3">
                                                <span class="float-right">{{$subCategory->title ?? 'N/A'}}</span>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6 form-group mb-3">
                                                <label class="form-label text-theme" for="title"><span style="font-weight: bold">Category</span></label>
                                                <span class="float-end">:</span>
                                        </div>
                                        <div class="col-xl-6 form-group mb-3">
                                            <a href="{{route('category.show',$subCategory->categories->uuid)}}" class="badge border border-theme text-theme" style="text-decoration: none">{{$subCategory->categories->title}}</a>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xl-6 form-group mb-3">
                                                <label class="form-label text-theme" for="title"><span style="font-weight: bold">Description</span></label>
                                                <span class="float-end">:</span>
                                        </div>
                                        <div class="col-xl-6 form-group mb-3">
                                            <span class="float-right"> {{$subCategory->description ?? 'N/A'}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="pos" id="pos">
                                        <div class="pos-content-container h-100 p-4" data-scrollbar="true" data-height="100%">
                                            <div class="row gx-4">
                                                <div class="col-xxl-3 col-xl-12 col-lg-6 col-md-12 col-sm-6 pb-4" data-type="meat">
                                                    <!-- BEGIN card -->
                                                    <div class="card h-100">
                                                        <div class="card-body h-100 p-1">
                                                            @if($subCategory->image != null)
                                                                <a href="#" class="pos-product" data-bs-toggle="modal" data-bs-target="#modalPosItem">
                                                                    <img class="img" src="{{asset('storage/images/sub-category/'. $subCategory->image)}}" alt="sub-category image">
                                                                </a>
                                                            @else
                                                                <a href="#" class="pos-product align-items-center" data-bs-toggle="modal" data-bs-target="#modalPosItem">
                                                                        <img class="h-200px w-200px" src="{{asset('assets/img/no-image/no-image-available.jpg')}}" alt="sub-category image">
                                                                    </a>
                                                            @endif
                                                        </div>
                                                        <x-card-border></x-card-border>
                                                    </div>
                                                    <!-- END card -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 text-center mt-5">
                                    <div class="ms-auto">
                                        <a href="{{route('sub-category.edit', $subCategory->uuid)}}" class="btn btn-outline-theme btn-lg"><i
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

