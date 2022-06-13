@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="container">
            <!-- BEGIN row -->
{{--            <div class="row">--}}
                <!-- BEGIN col-10 -->
{{--                <div class="col-xl-12">--}}
            @if(session('success'))
                <x-alert type="success" message="{{session('success')}}"></x-alert>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-alert type="danger" message="{{$error}}"></x-alert>
                @endforeach
            @endif
            <!-- BEGIN row -->
            <div class="row mb-2">
                <div class="col-12">
                    <h1 class="page-header">
                        Category List
                    </h1>
                </div>
                <!-- BEGIN col-9 -->
                <div class="col-9">
                    <hr>
                </div>
                <div class="col-xl-12">
                    <div class="ms-auto">
                        <a href="{{route('category.create')}}" class="btn btn-outline-theme float-end mt-5 mb-3"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Category</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div id="datatable" class="mb-5">
                        {{--                                <h4>Datatable</h4>--}}
                        {{--                                <p>DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, built upon the foundations of progressive enhancement, that adds all of these advanced features to any HTML table. Please read the <a href="https://datatables.net/" target="_blank">official documentation</a> for the full list of options.</p>--}}
                        <div class="card">
                            <div class="card-body">
                                <table id="laravel_datatable" class="table w-100">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <x-card-border></x-card-border>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================== BEGIN DELETE MODAL ================== -->
    <x-delete-modal></x-delete-modal>
    <!-- ================== END DELETE MODAL ================== -->
@endsection
@push('customScripts')
    <script>
        $(document).ready(function () {

            $('#laravel_datatable').DataTable({
                "drawCallback": function (settings) {
                    // feather.replace();
                },

                processing: true,
                serverSide: true,
                lengthMenu: [ 10, 20, 30, 40, 50 ],
                responsive: true,
                dom:"<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
                buttons: [
                    {
                        extend: 'print', className: 'btn btn-secondary buttons-print btn-outline-default btn-sm ms-2',
                        customize: function ( win ) {
                            $(win.document.body).find( 'table' )
                                .css( 'color', '#020202' );
                        },
                        exportOptions: {
                            columns: [0,1,2,"visible"]
                        }
                    },

                    { extend: 'csv', className: 'btn btn-secondary buttons-csv buttons-html5 btn-outline-default btn-sm' }
                ],
                "order": [[0, "asc"]],
                ajax: "{{route('category.index') }}",
                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: false,
                        className: 'text-center',

                    },
                ],


            });
        });
    </script>
@endpush