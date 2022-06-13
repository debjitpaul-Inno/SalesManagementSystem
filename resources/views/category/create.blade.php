@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Create Category</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='category.index'></x-back-button>
            </div>
        </div>

        <div id="formControls" class="mb-5">
            <h4>Add Category From Here</h4>
            <p>You can add <b class="text-theme">Category</b> as much as you want. To create a <b class="text-theme"> Category</b> just fill up the mandatory input fields.  </p>
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
{{--                                                <div id="error-msg"></div>--}}
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

                            <form id="createForm" method="POST" action="{{route('category.store')}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="text" name="image"  id="imageName" value="" hidden>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="title">Title<span class="required"> *</span></label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Category Title" required/>
                                        </div>
                                        <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="mb-3 form-group">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                               <x-submit-button buttonName="submit" icon="bi bi-sd-card fa-lg"></x-submit-button>
                            </form>
                        </div>

                        <x-card-border></x-card-border>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">

            </div>
        </div>
    </div>
@endsection
@push('customScripts')
    <script>
        $(document).ready(function (){
            $('#doneIcon').hide()
        })

        $('#image').fileupload({
            dataType: 'json',
            sequentialUploads: true,
            done: function(e, data) {
                // console.log(data);
                $('#doneIcon').show()
                $('#uploaded').text('Image Uploaded Successfully')
                $('#imageName').val(data.result.imageName)
            },

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
            },
            messages: {
                title: "Title is required",
            }
        });

        $(document).ready(function (){
            $('#doneIcon').hide()
        })



    </script>
@endpush

