@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Create Product</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='product.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Add Product From Here</h4>
            <p>You can add <b class="text-theme">Product</b> as much as you want. To create a <b
                    class="text-theme">Product</b> just fill up the <b style="font-size: larger"> [ * ]</b> marked input fields. </p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <!-- BEGIN UPDATE IMAGE -->
                            <div class="col-lg-12 text-center">
                                <div id="jQueryFileUpload" class="mb-5 col-xl-12">
                                    <h4>Product Image Upload</h4>
                                    <form  id="fileupload" method="POST" enctype="multipart/form-data" class="m-auto col-lg-6">
                                        @csrf
                                        <div class="card" style="overflow: hidden">
                                            <div class="card-body pb-2">
                                                <div class="fileupload-buttonbar mb-2">
                                                    <div class="d-block align-items-center">
                                                        <span class="btn btn-outline-theme fileinput-button me-2 mb-1">
                                                            <i class="fa fa-fw fa-plus"></i>
                                                            <span class="align-items-center">Add files...</span>
                                                            <input type="file" name="image" id="image" data-url="image/upload">
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
                            <form id="createForm" method="POST" action="{{route('product.store')}}"  enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="image"  id="imageName" value="" hidden>
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="title">Title<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Product Title" />
                                        </div>
                                        <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label class="form-label">Sub-Category<span class="required"> *</span> </label>
                                            <select class="form-control ex-search" name="sub_category_id" id="">
                                                <option hidden value=""></option>
                                                @foreach($subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}" @if (old('sub_category_id') == $subCategory->id) selected="selected" @endif>{{ $subCategory->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('sub_category_id'){{ $message }}@enderror</span>
                                    </div>
                                    <!-- BEGIN #inputGroup -->
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="price">Price<span class="required"> *</span></label>
                                        <div class="input-group flex-nowrap">
                                            <input type="number" min="0" class="form-control" name="price" value="{{ old('price') }}" id="price" placeholder="Price" />
                                            <span class="input-group-text">BDT</span>
                                        </div>
                                        <span class="text-danger">@error('price'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="unit">Unit<span class="required"> *</span></label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="unit" id="unit" value="{{ old('unit') }}" placeholder="Unit" />
                                        </div>
                                        <span class="text-danger">@error('unit'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3">
                                            <label class="form-label">Rack <span class="required"> *</span></label>
                                            <select class="form-control ex-search" name="rack_id[]" multiple>
                                                <option hidden value=""></option>
                                                @foreach($racks as $rack)
                                                    <option value="{{ $rack->id }}" @if (old('rack_id') == $rack->id) selected="selected" @endif>{{ $rack->rack_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('rack_id'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="vendor_id">
                                                Supplier<span class="required"> *</span></label>
                                            <select class="form-control ex-search" id="" name="vendor_id">
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}" @if (old('vendor_id') == $vendor->id) selected="selected" @endif>{{ $vendor->vendor_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('vendor_id'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="model">Barcode Number</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="barcode_number" id="barcode_number" value="{{ old('barcode_number') }}" placeholder="Barcode Number" />
                                        </div>
                                        <span class="text-danger">@error('barcode_number'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="model">Model</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="model" id="model" value="{{ old('model') }}" placeholder="Model Number" />
                                        </div>
                                        <span class="text-danger">@error('model'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="brand">Brand</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="brand" id="brand" value="{{ old('brand') }}" placeholder="Brand" />
                                        </div>
                                        <span class="text-danger">@error('brand'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 form-group mb-3">
                                        <label class="form-label" for="color">Color</label>
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="color" id="color" value="{{ old('color') }}" placeholder="Color" />
                                        </div>
                                        <span class="text-danger">@error('color'){{ $message }}@enderror</span>
                                    </div>

                                    <div class="col-xl-6" hidden>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="quantity">Quantity</label>
                                            <input type="number" min="0" class="form-control" id="quantity"
                                                   name="quantity" value="{{ old('quantity') ?? 0 }}" placeholder="Quantity"
                                                   />
                                        </div>
                                        <span class="text-danger">@error('quantity'){{ $message }}@enderror</span>
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                        </div>
                                        <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                                    </div>
{{--                                    <div class=" col-xl-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="status">Status <span class="required"> *</span></label>--}}
{{--                                            <div class="form-check mt-2">--}}
{{--                                                <input class="form-check-input" type="radio" name="status" id="available"--}}
{{--                                                       value="AVAILABLE" @if( old('status')) == "AVAILABLE" ? 'checked' : '' @endif--}}
{{--                                                required>--}}
{{--                                                <label class="form-check-label" for="available">Available</label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="radio" name="status" id="not_available"--}}
{{--                                                       value="NOT_AVAILABLE" @if( old('status')) == "NOT_AVAILABLE" ? 'checked' : '' @endif--}}
{{--                                                required>--}}
{{--                                                <label class="form-check-label" for="not_available">Not Available</label>--}}
{{--                                            </div>--}}
{{--                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
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
        $("#createForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                title: "required",
                price: "required",
                unit: "required",
                // status: "required",
                sub_category_id: "required",
                vendor_id: "required",
                rack_id: "required",
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
