@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="container">
            @if(session('success'))
                <x-alert type="success" message="{{session('success')}}"></x-alert>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-alert type="danger" message="{{$error}}"></x-alert>
            @endforeach
        @endif
        <!-- BEGIN row -->
            <div class="row">
                <!-- BEGIN col-10 -->
                <div class="col-xl-12">
                    <!-- BEGIN row -->
                    <div class="row mb-2">
                        <!-- BEGIN col-9 -->
                        <div class="col-12">
                            <h1 class="page-header">
                                Offer List
                            </h1>
                        </div>
                        <div class="col-9">
                            <hr>
                        </div>
                        <div class="col-xl-12">
                            <div class="ms-auto">
                                <a href="{{route('offer.create')}}" class="btn btn-outline-theme float-end mt-5 mb-3"><i class="fa fa-plus-circle fa-fw me-1"></i> Add
                                    Offer</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div id="datatable" class="mb-5">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="laravel_datatable" class="table text-nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Offer Name</th>
                                                <th>Description</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
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
        </div>
    </div>
    <x-delete-modal></x-delete-modal>
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
                dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
                buttons: [
                    {
                        extend: 'print', className: 'btn btn-secondary buttons-print btn-outline-default btn-sm ms-2',
                        customize: function ( win ) {
                            $(win.document.body).find( 'table' )
                                .css( 'color', '#020202' );
                        },
                        exportOptions: {
                            columns: [0, 1, 2,3, "visible"]
                        }
                    },
                    { extend: 'csv', className: 'btn btn-secondary buttons-csv buttons-html5 btn-outline-default btn-sm' }
                ],
                "order": [[0, "asc"]],
                ajax: "{{route('offer.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: false,
                        className: 'text-center'
                    },
                ]
            });
        });

        function onDelete(e) {
            console.log(e.id)
            document.getElementById('delForm').setAttribute('action', e.id)

        }
    </script>
@endpush
