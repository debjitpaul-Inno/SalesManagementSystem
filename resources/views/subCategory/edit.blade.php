@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">

            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Sub-Category</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='sub-category.index'></x-back-button>
            </div>
        </div>

        <div id="formControls" class="mb-5">
            <h4>Edit Sub-Category From Here</h4>
            <p>You can update <b class="text-theme">Sub-Category</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="col-lg-12 text-center">
                                <div id="jQueryFileUpload" class="mb-5 col-xl-12">
                                    <h4>Image Upload</h4>
                                    <form  id="fileupload" method="POST" enctype="multipart/form-data" class="m-auto col-lg-6">
                                        @csrf
                                        @method('PUT')
                                        <div class="card" style="overflow: hidden">
                                            <div class="card-body pb-2">
                                                <div class="fileupload-buttonbar mb-2">
                                                    <div class="d-block align-items-center">
                                                        <span class="btn btn-outline-theme fileinput-button me-2 mb-1">
                                                            <i class="fa fa-fw fa-plus"></i>
                                                            <span class="align-items-center">Add files...</span>
                                                            <input type="file" name="image" id="image" data-url="image/update">
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
                            <form id="editForm" method="POST" action="{{route('sub-category.update',$subCategory->uuid)}}"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <input type="text" name="image"  id="imageName" value="" hidden>
                                                    <div class="col-xl-12">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="title">Title<span class="required"> *</span></label>
                                                            <input type="text" class="form-control" name="title" id="title" value="{{$subCategory->title ?? ''}}" />
                                                        </div>
                                                        <span class="text-danger">@error('title'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Category<span class="required"> *</span></label>
                                                            <select class="form-control" name="category_id" id="ex-search">
                                                                @foreach($categories as $category)
                                                                    <option value="{{$category->id}}" {{$subCategory->category_id == $category->id ? 'selected' : ''}}>{{$category->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span class="text-danger">@error('category_id'){{ $message }}@enderror</span>
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <div class="mb-3 form-group">
                                                            <label class="form-label" for="description">Description</label>
                                                            <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3">{{$subCategory->description ?? ''}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <x-card-border></x-card-border>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="pos" id="pos">
                                                <div class="pos-content-container h-100" data-scrollbar="false" data-height="100%">
                                                    <div class="row gx-4">
                                                        <div class="" data-type="meat">
                                                            <!-- BEGIN card -->
                                                            <div class="card h-100">
                                                                <div class="card-body h-100 p-1">
                                                                    @if($subCategory->image != null)
                                                                    <a href="#" class="pos-product" data-bs-toggle="modal" data-bs-target="#modalPosItem">
                                                                        <img class="img" src="{{asset('/storage/images/sub-category/'.$subCategory->image )}}" alt="sub-category image">
{{--                                                                        <img class="img" src="{{ URL::asset("storage/images/sub-category/". $subCategory->image) }}" alt="sub-category image">--}}
                                                                        <div class="info">
                                                                            <div class="title">{{$subCategory->title}} &reg;</div>
                                                                            <div class="desc">{{$subCategory->description}}</div>
                                                                        </div>
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
                                       <x-submit-button buttonName="Update" icon="bi bi-vector-pen fa-lg"></x-submit-button>
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
        $("#editForm").validate({
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

