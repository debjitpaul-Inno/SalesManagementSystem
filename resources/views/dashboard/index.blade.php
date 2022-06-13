@extends('layouts.master')
@section('content')
    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        @if($unavailableProducts != 0)
            <div class="row">
                <div class="col-xl-10">
                    <a href="{{route('product.unavailable')}}" class="text-decoration-none "><i class="fas fa-triangle-exclamation fa-fw blink_me" style="color: red;font-size: 25px"></i><span style="font-size: 16px"> {{$unavailableProducts}} UNAVAILABLE PRODUCT(S) <small style="font-size: 12px">(click to check)</small>  </span> </a>
                </div>
            </div>
        @endif

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
                               class="form-control form-select-sm" value="{{\Carbon\Carbon::now()->toDateString()}}"
                               hidden>
                        <span class="text-danger">@error('filter'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>
            <x-card-border></x-card-border>
        </div>


        <div class="row">
            <!-- BEGIN col-3 -->
            <div class="col-xl-3 col-lg-6">
                <!-- BEGIN card -->
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">TOTAL REVENUE</span>
                            <a href="#"  class="expandBtn text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                        </div>
                        <!-- END title -->
                        <!-- BEGIN stat-lg -->
                        <div class="row align-items-center mb-2">
                            <div class="col-7" id="totalRevenue">
                                {{--                                <h3 class="mb-0">{{number_format($revenues, 0, ".", ",")}}</h3>--}}
                                <h3 class="mb-0">{{number_format($account->sum('net_total'), 0, ".", ",")}}</h3>
                            </div>
                            <div class="col-5">
                                <div class="mt-n2" data-render="apexchart" data-type="bar" data-title="Visitors" data-height="30"></div>
                            </div>
                        </div>
                        <!-- END stat-lg -->
                        <!-- BEGIN stat-sm -->
                        <div class="small text-white text-opacity-50 text-truncate">
                            @if($percentIncrease)
                                <i class="fa fa-chevron-up"></i> Growth Rate: <b class="text-theme-100"> {{ number_format($percentIncrease, 1, ".", "")}}%</b><br />
                            @else
                                @if($percentDecrease == 0)
                                    <i class="bi bi-emoji-frown fa-fw me-1"></i> Nothing To compare<br />
                                @else
                                    <i class="fa fa-chevron-down fa-fw me-1"></i>Growth Rate: <b class="text-theme-200">{{number_format($percentDecrease, 1, ".", "")}}%</b><br />
                                @endif
                            @endif
                            <i class="fas fa-coins fa-fw me-1"></i><b class="text-theme">{{$duePercentage}}%</b> Due in account <br />
                        </div>
                        <!-- END stat-sm -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <x-card-border></x-card-border>
                </div>
                <!-- END card-arrow -->
                <!-- END card -->
            </div>
            <div class="col-xl-3 col-lg-6">
                <!-- BEGIN card -->
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">CUSTOMERS</span>
                            <a href="#"  class="expandBtn text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                        </div>
                        <!-- END title -->
                        <!-- BEGIN stat-lg -->
                        <div class="row align-items-center mb-2">
                            <div class="col-7">
                                <h3 class="mb-0">{{number_format($countCustomer), 0,".",","}}</h3>
                            </div>
                            <div class="col-5">
                                <div class="mt-n3 mb-n2" data-render="apexchart" data-type="pie" data-title="Visitors" data-height="45"></div>
                            </div>
                        </div>
                        <!-- END stat-lg -->
                        <!-- BEGIN stat-sm -->
                        <div class="small text-white text-opacity-50 text-truncate">
                            @if($customerIncrease)
                                <i class="fa fa-chevron-up fa-fw me-1"></i>Growth Rate: <b class="text-theme-100">{{number_format($customerIncrease, 1, ".", "")}}%</b><br />
                            @else
                                @if($customerDecrease == 0)
                                    <i class="bi bi-emoji-frown fa-fw me-1"></i> Nothing To compare<br />
                                @else
                                    <i class="fa fa-chevron-down fa-fw me-1"></i>Growth Rate:<b class="text-theme-100">{{number_format($customerDecrease, 1,".", "")}}%</b> than last month<br />
                                @endif
                            @endif
                            <i class="fas fa-user-tie fa-fw me-1"></i><b class="text-theme">{{$countMembers}}</b>  member(s) in {{number_format($countCustomer), 0,".",","}} customer(s) <br />
                        </div>
                        <!-- END stat-sm -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <x-card-border></x-card-border>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>

            <div class="col-xl-3 col-lg-6">
                <!-- BEGIN card -->
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">TOTAL ORDERS</span>
                            <a href="#"  class="expandBtn text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                        </div>
                        <!-- END title -->
                        <!-- BEGIN stat-lg -->
                        <div class="row align-items-center mb-2">
                            <div class="col-7">
                                <h3 class="mb-0">{{$totalOrder}}</h3>

                            </div>
                            <div class="col-5">
                                <div class="mt-n2" data-render="apexchart" data-type="line" data-title="Visitors" data-height="30"></div>
                            </div>
                        </div>
                        <!-- END stat-lg -->
                        <!-- BEGIN stat-sm -->
                        <div class="small text-white text-opacity-50 text-truncate">
                            @if($orderIncrease)
                                <i class="fa fa-chevron-up fa-fw me-1"></i>Growth Rate: <b class="text-theme-100">{{number_format($orderIncrease, 1, ".", "")}}%</b><br />
                            @else
                                @if($orderDecrease == 0)
                                    <i class="bi bi-emoji-frown fa-fw me-1"></i> Nothing To compare<br />
                                @else
                                    <i class="fa fa-chevron-down fa-fw me-1"></i>Growth Rate:<b class="text-theme-100">{{number_format($orderDecrease, 1,".", "")}}%</b><br />
                                @endif
                            @endif
                            <i class="fa fa-shopping-bag fa-fw me-1"></i> <b class="text-theme"> {{$todaysOrder}}</b> order(s) today <br />

                        </div>
                        <!-- END stat-sm -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <x-card-border></x-card-border>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>
            <div class="col-xl-3 col-lg-6">
                <!-- BEGIN card -->
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">AVAILABLE PRODUCTS</span>
                            <a href="#"  class="expandBtn text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                        </div>
                        <!-- END title -->
                        <!-- BEGIN stat-lg -->
                        <div class="row align-items-center mb-2">
                            <div class="col-7">
                                <h3 class="mb-0">{{$totalProducts}}</h3>
                            </div>
                            <div class="col-5">
                                <div class="mt-n3 mb-n2" data-render="apexchart" data-type="donut" data-title="Stock In Amount" data-height="45"></div>
                            </div>
                        </div>
                        <!-- END stat-lg -->
                        <!-- BEGIN stat-sm -->
                        <div class="small text-white text-opacity-50 text-truncate">
                            @if($sellIncrease)
                                <i class="fa fa-chevron-up fa-fw me-1"></i>Growth Rate: <b class="text-theme-100">{{number_format($sellIncrease, 1,".", "")}}%</b><br />
                            @else
                                @if($sellDecrease == 0)
                                    <i class="bi bi-emoji-frown fa-fw me-1"></i> Nothing To compare<br />
                                @else
                                    <i class="fa fa-chevron-down fa-fw me-1"></i>Growth Rate: <b class="text-theme-100"> {{number_format($sellDecrease, 1,".", "")}}%</b><br />
                                @endif
                            @endif
                            <a href="{{route('product.closeToStockOut')}}" class="text-decoration-none"><i class="fas fa-exclamation-circle fa-fw me-1 text-theme"></i> <b>{{$aboutToStockOut}}</b> products close to stock out<br /></a>
                        </div>
                        <!-- END stat-sm -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <x-card-border></x-card-border>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>

            <!-- BEGIN col-6 -->
            <div class="col-xl-6">
                <!-- BEGIN card -->
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">LAST 30 DAYS DEBIT & CREDIT GRAPH</span>
                            <a href="#"  class=" expandBtn text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                        </div>
                        <!-- END title -->
                        <!-- BEGIN chart -->
                        <div class="ratio ratio-21x9 mb-3">
                            <div id="chart-server"></div>
                        </div>
                        <!-- END chart -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <x-card-border></x-card-border>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>
            <!-- END col-6 -->
            <!-- BEGIN col-6 -->
            <div class="col-xl-6">
                <!-- BEGIN card -->
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">TOP PRODUCTS</span>
                            <a href="#"  class="expandBtn text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                        </div>
                        <!-- END title -->
                        <!-- BEGIN table -->
                        <div class="table-responsive">
                            <table class="w-100 mb-0 small align-middle text-nowrap" id="topProducts"></table>
                        </div>
                        <!-- END table -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <x-card-border></x-card-border>
                    <!-- END card-arrow -->
                </div>
                <!-- END card -->
            </div>
            <!-- END col-6 -->
        </div>
    </div>
    <!-- END #content -->
@endsection

@push('customScripts')

    <script src="{{asset('assets/plugins/apexcharts/dist/apexcharts.js')}}"></script>
    <script src="{{asset('assets/js/demo/dashboard.js')}}"></script>
    <script>
        $(document).ready(function() {
            window.dispatchEvent(new Event('resize'));
        });

        $('input[type=radio][name=filter]').click(function(e){
            let from_date = e.target.value;
            let to_date = $('#to_date').val();
            let sum = 0;
            fetch(`dashboard/accounts-data/${from_date}/${to_date}`)
                .then(res => res.json())
                .then(res => {
                    $('#totalRevenue').html( ` <h3 class="mb-0">${addCommas(res)}</h3>`)
                })
                .catch(err => {
                    console.log(err)
                })
        });
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

        //card-expand
        $('.expandBtn').click(function(){
            let element = $(this).parent('div').parent('div').parent('div')[0];
            if($(element).hasClass("card-expand") === true){
                element.classList.remove("card-expand");
            }else{
                element.classList.add("card-expand");
            }
        });
    </script>
@endpush
