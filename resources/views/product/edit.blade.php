@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">

            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Product</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='product.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Edit Product From Here</h4>
            <p>You can update <b class="text-theme">Product</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <!-- BEGIN UPDATE IMAGE -->
                            <div class="col-lg-12 text-center">
                                <div id="jQueryFileUpload" class="mb-5 col-xl-12">
                                    <h4>Update Product Image</h4>
                                    <form  id="fileupload" method="POST" enctype="multipart/form-data" class="m-auto col-lg-6">
                                        @csrf
                                        @method('PUT')
                                        <div class="card" style="overflow: hidden">
                                            <div class="card-body pb-2">
                                                <div class="fileupload-buttonbar mb-2">
                                                    <div class="d-block align-items-center">
                                                            <span
                                                                class="btn btn-outline-theme fileinput-button me-2 mb-1">
                                                                <i class="fa fa-fw fa-plus"></i>
                                                                <span
                                                                    class="align-items-center">Add files...</span>
                                                                <input
                                                                    type="file"
                                                                    name="image"
                                                                    id="image"
                                                                    data-url="image/update">

                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-card mb-0 fs-13px" >
                                                <thead>
                                                <tr class="fs-12px">
                                                    <th class="pt-2 pb-2 w-25">PREVIEW</th>
                                                    <th class="pt-2 pb-2 w-25">FILENAME</th>
                                                    <th class="pt-2 pb-2 w-25">SIZE</th>
                                                </tr>
                                                </thead>
                                                <tbody class="files">
                                                <tr class="empty-row">
                                                    <td colspan="4" class="text-center p-3">
                                                        <div id="doneIcon" class="text-green-300 mb-2"><i class="fa fa-check-circle fa-3x"></i></div>
                                                        <p id="uploaded"></p>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <x-card-border></x-card-border>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END UPDATE IMAGE -->
                            <form id="editForm" method="POST" action="{{route('product.update',$data->uuid ?? '')}}"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="text" name="image"  id="imageName" value="" hidden>
                                <div class="row mb-4 align-content-end">
                                    <div class="col-md-3 m-auto ">
                                        <div class="pos" id="pos">
                                            <div class="pos-content-container h-100 float-right" data-scrollbar="false" data-height="100%">
                                                <div class="row gx-4">
                                                    <div class="" data-type="meat">
                                                        <!-- BEGIN card -->
                                                        <div class="card h-100">
                                                            <div class="card-body h-100 p-1">
                                                                @if($data->image != null)
                                                                    <a href="#" class="pos-product" data-bs-toggle="modal" data-bs-target="#modalPosItem">
                                                                        <img class="img" src="{{asset("storage/images/product/".$data->image)}}" alt="category image" style="height:100%">
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
                                </div>
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
                                        <div class="mb-3">
                                            <label class="form-label">Sub-Category <span class="required"> *</span></label>
                                            <select class="form-control ex-search" name="sub_category_id" id="">
                                                @foreach($subCategories as $subCategory)
                                                    <option value="{{old('sub_category_id', $subCategory->id)}}" {{$data->sub_category_id == $subCategory->id ? 'selected' : ''}}>{{ $subCategory->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('sub_category_id'){{ $message }}@enderror</span>
                                    </div>
                                    <!-- BEGIN #inputGroup -->
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="price">Price<span class="required"> *</span></label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="price" id="price" value="{{ $data->price }}" placeholder="Price" />
                                            <span class="input-group-text">BDT</span>
                                        </div>
                                        <span class="text-danger">@error('price'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="unit">Unit<span class="required"> *</span></label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="unit" id="unit" value="{{ $data->unit }}" placeholder="Unit" />
                                        </div>
                                        <span class="text-danger">@error('unit'){{ $message }}@enderror</span>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label class="form-label">Rack <span class="required"> *</span></label>
                                            <select class="form-control ex-search" name="rack_id[]" multiple>
                                                @foreach($racks as $rack)
                                                    <option value="{{ $rack->id }}"
                                                    @foreach($data->racks as $r)
                                                        {{$r->id == $rack->id ? 'selected': ''}}
                                                        @endforeach>
                                                        {{ $rack->rack_number}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('rack_id'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="vendor_id">Vendor<span class="required"> *</span></label>
                                            <select class="form-control ex-search" id="" name="vendor_id">
                                                @foreach($vendors as $vendor)
                                                    <option value="{{old('vendor_id', $vendor->id)}}" {{$data->vendor_id == $vendor->id ? 'selected' : ''}}>{{$vendor->vendor_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('vendor_id'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="model">Barcode Number</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="barcode_number" id="barcode_number" value="{{ $data->barcode_number }}" placeholder="Barcode Number" />
                                        </div>
                                        <span class="text-danger">@error('barcode_number'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="model">Model</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="model" id="model" value="{{ $data->model }}" placeholder="Model" />
                                        </div>
                                        <span class="text-danger">@error('model'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="brand">Brand</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="brand" id="brand" value="{{ $data->brand }}" placeholder="Brand" />
                                        </div>
                                        <span class="text-danger">@error('brand'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="color">Color</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="color" id="color" value="{{ $data->color }}" placeholder="Color" />
                                        </div>
                                        <span class="text-danger">@error('color'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="quantity">Quantity</label>
                                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="{{ $data->quantity ?? '' }}" readonly/>
                                        </div>
                                        <span class="text-danger">@error('quantity'){{ $message }}@enderror</span>
                                    </div>


                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3">{{ $data->description ?? '' }}</textarea>
                                        </div>
                                        <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                    </div>
{{--                                    <div class=" col-xl-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="status"> Status<span class="required"> *</span></label>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="radio" name="status" id="available"--}}
{{--                                                       value="AVAILABLE" {{($data->status == "AVAILABLE") ? "checked" : ""}}>--}}
{{--                                                <label class="form-check-label" for="available">Available</label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="radio" name="status" id="not_available"--}}
{{--                                                       value="NOT_AVAILABLE" {{($data->status == "NOT_AVAILABLE") ? "checked" : ""}}>--}}
{{--                                                <label class="form-check-label" for="not_available">Not Available</label>--}}
{{--                                            </div>--}}
{{--                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


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
        $(":input").keypress(function(event){
            if (event.which == '10' || event.which == '13') {
                event.preventDefault();
            }
        });
        $(document).ready(function (){
            $('#doneIcon').hide()
        })

        $('#image').fileupload({
            dataType: 'json',
            sequentialUploads: true,
            done: function(e, data) {
                $('#doneIcon').show()
                $('#uploaded').text('Image Uploaded Successfully')
                $('#imageName').val(data.result.imageName)
                console.log(data.result);
            }
        });
        $('#image').on('fileuploadadd', function (e, data) {
            data.submit();
        });

        $("#editForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                title: "required",
                price: "required",
                unit: "required",
                // status: "required",
                sub_category_id: "required",
                rack_id: "required",
                vendor_id: "required",
            },
            messages: {
                title: "Title is required",
                price: "Price is required",
                unit: "Unit is required",
                // status: "Status is required",
                sub_category_id: "Sub Category is required",
                rack_id: "Rack Number is required",
                vendor_id: "Vendor is required",
            }
        });
    </script>
@endpush

