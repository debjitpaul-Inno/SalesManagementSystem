@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Product Information</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='product.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h6>View <span class="text-theme"> Product</span> Information From Here</h6>
            <p>If you want to update any information of this <b class="text-theme">Product</b> please go to the update page
                by clicking the <b class="text-theme">Update</b> button given bellow.</p>
            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="title">Title</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span class="float-right">{{ $product->title ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="sub_category_id">Sub Category</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <a href="{{ route('sub-category.show',$product->subCategories->uuid) }}" class="float-right badge border border-theme text-light" style="text-decoration: none;font-size: 13px">{{ ucwords( $product->subCategories->title ?? 'N/A') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="price">Price</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span class="float-right">{{ $product->price ?? 'N/A' }} BDT</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="unit">Unit</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span class="float-right">{{ $product->unit ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="barcode_number">Barcode</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span class="float-right">{{ $product->barcode_number ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="model">Model</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span class="float-right">{{ $product->model ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="brand">Brand</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span class="float-right"> {{ $product->brand ?? 'N/A' }} </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="color">Color</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span class="float-right"> {{ $product->color ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="rack_id">Rack</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                @foreach($product->racks as $rack)
                                                    <a href="{{ route('rack.show',$rack->uuid ?? '') }}" class="float-right badge border border-theme text-light mt-2" style="text-decoration: none;font-size: 13px">{{ ucwords( $rack->rack_number ?? 'N/A') }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="vendor_id">Vendor Name</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <a href="{{ route('vendor.show',$product->vendors->uuid ?? '') }}" class="float-right badge border border-theme text-light mt-2" style="text-decoration: none;font-size: 13px">{{ ucwords( $product->vendors->vendor_name ?? 'N/A') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="description">Description</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span class="float-right"> {{ $product->description ?? 'N/A' }} </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="status">Status</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                @if($product->status == "AVAILABLE")
                                                    <span class="float-right badge bg-success" style="color: darkgreen"> Available</span>
                                                @else
                                                    <span class="float-right badge bg-danger" style="color: darkred"> Not Available</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="pos" id="pos">
                                        <div class="pos-content-container h-100 p-4" data-scrollbar="true" data-height="100%">
                                            <div class="row gx-4">
                                                <div class="col-xxl-3 col-xl-12 col-lg-6 col-md-4 col-sm-6 pb-4" data-type="meat">
                                                    <!-- BEGIN card -->
                                                    <div class="card h-100">
                                                        <div class="card-body h-100 p-1">
                                                            @if($product->image != null)
                                                                <a href="#" class="pos-product" data-bs-toggle="modal" data-bs-target="#modalPosItem">
                                                                    <img class="img" src="{{asset('storage/images/product/'. $product->image)}}" alt="product image">
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
                                        <a href="{{route('product.edit', $product->uuid)}}" class="btn btn-outline-theme btn-lg"><i
                                                class="bi bi-send-check fa-lg"></i>
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

