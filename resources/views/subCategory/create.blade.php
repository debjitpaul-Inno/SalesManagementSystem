@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Create Sub-Category</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='sub-category.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Add Sub-Category From Here</h4>
            <p>This is the place where you can create <b class="text-theme">sub-category</b> under a category. To create a <b class="text-theme"> sub-category</b> just fill up the mandatory input fields.  </p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="col-lg-12 text-center">
                                <div id="jQueryFileUpload" class="mb-5 col-xl-12">
                                    <h4>Image Upload</h4>
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

                            <form id="createForm" method="POST" action="{{route('sub-category.store')}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <input type="text" name="image"  id="imageName" value="" hidden>
                                    <div class="col-xl-6">
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="title">Title<span class="required"> *</span> </label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Sub Category Title" required />
                                        </div>
                                        <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 form-group">
                                            <label class="form-label">Category<span class="required"> *</span> </label>
                                            <select class="form-control" name="category_id" id="ex-search">
                                                <option hidden value=""></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="text-danger">@error('category_id'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                        </div>
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
                category_id: "required",
            },
            messages: {
                title: "Title is required",
                category_id: "Category is required",
            }
        });
        // $("#image").on('change', function () {
        //     var imgPath = $(this)[0].value;
        //     var extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        //     if (extension === "gif" || extension === "png" || extension === "jpg" || extension === "jpeg") {
        //         if (typeof (FileReader) != "undefined") {
        //
        //             var image_holder = $("#image-holder");
        //             image_holder.empty();
        //
        //             var reader = new FileReader();
        //             reader.onload = function (e) {
        //                 $("<img />", {
        //                     "src": e.target.result,
        //                     "class": "img-thumbnail"
        //                 }).appendTo(image_holder);
        //             };
        //             image_holder.show();
        //             reader.readAsDataURL($(this)[0].files[0]);
        //         } else {
        //             alert("This browser does not support FileReader.");
        //         }
        //     } else {
        //         alert("Please Select Image Only !");
        //     }
        // });

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
    </script>
@endpush

