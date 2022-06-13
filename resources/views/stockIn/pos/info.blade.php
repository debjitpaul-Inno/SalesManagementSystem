@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Stock In Information</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='stockIn.pos.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h6>View <span class="text-theme"> Stock In</span> Information From Here</h6>
            <p>If you want to update any information of this <b class="text-theme">Stock In</b> please go to the
                update page
                by clicking the <b class="text-theme">Update</b> button given bellow.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="title">Voucher Number</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span
                                                    class="float-right"> {{  $stock->voucher_number ?? 'N/A' }} </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="shelf_number">Date</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span
                                                    class="float-right"> {{ (date('j F, Y', strtotime($stock->date))) ?? 'N/A' }} </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="shelf_number">Description</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span
                                                    class="float-right" id="description"></span>
                                                <input type="text" id="desc" value="{{ $stock->description }}" hidden>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="shelf_number">Total Amount</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span
                                                    class="float-right">{{ $stock->amount }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @if($accounts->due != 0)
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="shelf_number">Due</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span
                                                    class="float-right" >{{ $accounts->due }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="store_id">Supplier Name</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <a href="{{route('vendor.show',$stock->vendors->uuid)}}"
                                                   class="badge border border-theme text-theme"
                                                   style="text-decoration: none;font-size: 12px">{{$stock->vendors->vendor_name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="store_id">Receiver Name</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <a href="{{route('user.show',$stock->users->profiles->uuid)}}"
                                                   class="badge border border-theme text-theme"
                                                   style="text-decoration: none;font-size: 12px">{{$stock->users->profiles->full_name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="store_id">Paying Status</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                @if($stock->status == "PAID")
                                                    <label class="badge bg-success"
                                                           style="font-size: 12px">{{ucfirst(strtolower($stock->status))}}</label>
                                                @elseif($stock->status == "UNPAID")
                                                    <label class="badge bg-danger"
                                                           style="font-size: 12px">{{ucfirst(strtolower($stock->status))}}</label>
                                                @else
                                                    <label class="badge bg-warning"
                                                           style="font-size: 12px">{{ucfirst(strtolower($stock->status))}}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 text-center mt-5">
                                    <div class="ms-auto">
                                        <a href="{{route('stockIn.pos.edit', $stock->uuid)}}"
                                           class="btn btn-outline-theme btn-lg"><i
                                                class="bi bi-vector-pen fa-lg"></i>
                                            <span class="small">Update</span></a>
                                    </div>
                                </div>
                            </div>
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
        $(document).ready(function () {
            let data = JSON.parse($('#desc').val());
            let desc = data.toString();
            $('#description').text(desc)
        })
    </script>
@endpush
