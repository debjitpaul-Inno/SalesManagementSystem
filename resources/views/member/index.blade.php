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
                                Member List
                            </h1>
                        </div>
                        <div class="col-9">
                            <hr>
                        </div>
                        <div class="col-xl-12">
                            <div class="ms-auto">
                                <a href="{{route('member.create')}}" class="btn btn-outline-theme float-end mb-3"><i
                                        class="fa fa-plus-circle fa-fw me-1" style="margin-bottom: 10px"></i> Add
                                    Member</a>
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
                                                <th>{{'SL'}}</th>
                                                <th>{{'Name'}}</th>
                                                <th>{{'Membership Type'}}</th>
                                                <th>{{'Membership Date'}}</th>
                                                <th>{{'Action'}}</th>
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
            <x-delete-modal></x-delete-modal>
        </div>
    </div>
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
                "order": [[0, "desc"]],
                ajax: "{{route('member.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'customer_id', name: 'customer_id'},
                    {data: 'membership_type_id', name: 'membership_type_id'},
                    {data: 'membership_date', name: 'membership_date'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: false,
                        className: 'text-center'
                    },
                ],
                // "columnDefs": [
                //     {"className": "dt-center", "targets": "_all"}
                // ]
            });
        });

        function onDelete(e) {
            console.log(e.id)
            document.getElementById('delForm').setAttribute('action', e.id)
        }
    </script>
@endpush
