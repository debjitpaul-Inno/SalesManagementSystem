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
                                Earning Report
                            </h1>
                        </div>
                        <div class="col-9">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div>
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="col-xl-12">
                                            <div class="form-group d-flex ">
                                                <div class="form-check" style="margin-right: 20px;width: 25%">
                                                    <input class="form-check-input" type="radio" name="filter" id="daily"
                                                           value="{{ \Carbon\Carbon::now()->toDateString() }}"
                                                    @if( old('filter'))
                                                        == "{{ \Carbon\Carbon::now()->toDateString() }}" ? 'checked' :
                                                        ''
                                                    @endif>
                                                    <label class="form-check-label" for="daily">Daily</label>
                                                </div>
                                                <div class="form-check" style="margin-right: 20px;width: 25%">
                                                    <input class="form-check-input " type="radio" name="filter"
                                                           id="weekly"
                                                           value="{{ \Carbon\Carbon::now()->subDays(6)->toDateString() }}" @if( old('filter'))
                                                        == "{{ \Carbon\Carbon::now()->subDays(6)->toDateString() }}" ?
                                                        'checked'
                                                        : '' @endif
                                                    >
                                                    <label class="form-check-label" for="weekly">Weekly</label>
                                                </div>
                                                <div class="form-check" style="margin-right: 20px;width: 25%">
                                                    <input class="form-check-input " type="radio" name="filter"
                                                           id="monthly"
                                                           value="{{ \Carbon\Carbon::now()->subDays(\Carbon\Carbon::now()->subDays(1)->day)->toDateString() }}" @if( old('filter'))
                                                        ==
                                                        "{{ \Carbon\Carbon::now()->subDays(\Carbon\Carbon::now()->subDays(1)->day)->toDateString() }}
                                                        " ? 'checked' : '' @endif>
                                                    <label class="form-check-label" for="monthly">Monthly</label>
                                                </div>
                                                <div class="form-check" style="margin-right: 20px;width: 25%">
                                                    <input class="form-check-input " type="radio" name="filter"
                                                           id="yearly"
                                                           value="{{ \Carbon\Carbon::now()->subMonth(\Carbon\Carbon::now()->subMonth(1)->month)->subDays(\Carbon\Carbon::now()->subDays(1)->day)->toDateString() }}" @if( old('filter'))
                                                        ==
                                                        "{{ \Carbon\Carbon::now()->subMonth(\Carbon\Carbon::now()->subMonth(1)->month)->toDateString() }}
                                                        " ? 'checked' : '' @endif>
                                                    <label class="form-check-label" for="yearly">Yearly</label>
                                                </div>
                                                <input type="text" name="to_date" id="to_date"
                                                       class="form-control form-select-sm" value="{{\Carbon\Carbon::now()}}"
                                                       hidden>
                                                <span class="text-danger">@error('filter'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <x-card-border></x-card-border>
                                </div>
                            </div>
                            <div id="datatable" class="mb-5">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="laravel_datatable" class="table text-nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>{{'SL'}}</th>
                                                <th>{{'Date'}}</th>
                                                <th>{{'Account Name'}}</th>
                                                <th>{{'Reference Number'}}</th>
                                                <th>{{'Transaction Number'}}</th>
                                                <th>{{'Amount'}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="5" style="text-align:right">Total:</th>
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
            <x-delete-modal></x-delete-modal>
        </div>
    </div>

@endsection
@push('customScripts')
    <script>
        $(document).ready(function () {
            load_data();
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

            function load_data(from_date = '', to_date = ''){
                $('#laravel_datatable').DataTable({
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
                        let total = api
                            .column( 5 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        // Total over this page
                        pageTotal = api
                            .column( 5, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        // Update footer
                        $( api.column( 5 ).footer() ).html(
                            addCommas(total)  +' BDT '
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
                                    .addClass( 'compact' )
                                    .css( 'color', '#020202' );
                            },
                            exportOptions: {
                                columns: [0, 1, 2,3,4,5, "visible"],
                            }
                        },
                        { extend: 'csv', className: 'btn btn-secondary buttons-csv buttons-html5 btn-outline-default btn-sm' }
                    ],
                    ajax: {
                        url: '{{ route("report.debit") }}',
                        data:{from_date:from_date, to_date:to_date }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'payment_date', name: 'payment_date'},
                        {data: 'account_name', name: 'account_name'},
                        {data: 'reference_number', name: 'reference_number'},
                        {data: 'tx_number', name: 'tx_number'},
                        {data: 'amount', name: 'amount'}
                    ]
                });
            }
            $('input[type=radio][name=filter]').click(function(e){
                let from_date = e.target.value;
                let to_date = $('#to_date').val();
                if (from_date != '' && to_date != ''){
                    $('#laravel_datatable').DataTable().destroy();
                    load_data(from_date,to_date);
                }
                else{
                    alert('Both Date is required')
                }
            });
        });
    </script>
@endpush
