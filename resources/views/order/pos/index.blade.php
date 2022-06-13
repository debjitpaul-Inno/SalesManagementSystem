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
                                Order List
                            </h1>
                        </div>
                        <div class="col-9">
                            <hr>
                        </div>
                        <div class="col-xl-12">
                            <div class="ms-auto">
                                <a href="{{route('order.pos.create')}}" class="btn btn-outline-theme float-end mt-5 mb-3"><i
                                        class="fa fa-plus-circle fa-fw me-1"></i> Add Order</a>
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
                                                <th>{{'Date'}}</th>
                                                <th>{{'Order Number'}}</th>
                                                <th>{{'Total'}}</th>
                                                <th>{{'VAT'}}</th>
                                                <th>{{'Discount'}}</th>
                                                <th>{{'Net Total'}}</th>
                                                <th>{{'Status'}}</th>
                                                <th>{{'Action'}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="8" style="text-align:left">Total:</th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
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
    <!-- ================== BEGIN DELETE MODAL ================== -->
    <x-delete-modal></x-delete-modal>
    <!-- ================== END DELETE MODAL ================== -->
@endsection
@push('customScripts')
    <script>
        $(document).ready(function () {
            function addCommas(nStr)
            {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
            $('#laravel_datatable').DataTable({
                "drawCallback": function (settings) {
                    // feather.replace();
                },
                "footerCallback": function ( tfoot, data, start, end, display ) {
                    // console.log(tfoot)
                    var api = this.api();


                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 6 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 6, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 6 ).footer() ).html(
                        'Total:' + ' '+ addCommas(pageTotal)  +' BDT '
                    );
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
                            columns: [0,1, 2,3,4,5,6,7, "visible"]
                        }
                    },
                    { extend: 'csv', className: 'btn btn-secondary buttons-csv buttons-html5 btn-outline-default btn-sm' }
                ],
                "order": [[0, "asc"]],
                ajax: "{{route('order.pos.index') }}",

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'order_number', name: 'order_number'},
                    {data: 'total', name: 'total'},
                    {data: 'tax', name: 'tax'},
                    {data: 'discount', name: 'discount'},
                    {data: 'net_total', name: 'net_total'},
                    {data: 'status', name: 'status'},
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
