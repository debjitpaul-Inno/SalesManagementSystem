@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Update Offer</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='offer.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h4>Edit Offer From Here</h4>
            <p>You can update <b class="text-theme">Offer</b> information where needed.</p>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <form id="editForm" method="POST" action="{{route('offer.update', $data->uuid)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{--                                @dd($data)--}}
                                {{--                                {{($data->status == "ACTIVE") ? "checked" : ""}}--}}
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="name">
                                                Name</label>
                                            <input type="text" class="form-control" id="title"
                                                   placeholder="Offer Name" name="name"
                                                   value="{{ $data->name ?? '' }}"/>
                                        </div>
                                        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="type">Offer Type<span
                                                    class="required"> *</span></label>
                                            <select class="form-select" id="type" name="type" required>
                                                <option hidden></option>
                                                <option value="FLAT" {{$data->type == "FLAT"  ? 'selected' : ''}}>Flat
                                                    Offer
                                                </option>
                                                <option
                                                    value="BUY_GET" {{($data->type == "BUY_GET") ? "selected" : ""}}>Buy
                                                    & Get Offer
                                                </option>
                                                <option
                                                    value="PRODUCT_WISE" {{($data->type == "PRODUCT_WISE") ? "selected" : ""}}>
                                                    Product Wise Offer
                                                </option>
                                                <option
                                                    value="ORDER_AMOUNT" {{($data->type == "ORDER_AMOUNT") ? "selected" : ""}}>
                                                    Offer on Order Amount
                                                </option>
                                            </select>
                                            <span class="text-danger">@error('type'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 buy_qty" hidden>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="buy_quantity">
                                                Buy Quantity<span class="required"> *</span></label>
                                            <div class="input-group">
                                                <input type="number" min="0" class="form-control" id="buy_quantity"
                                                       placeholder="Buy Quantity" name="buy_quantity"
                                                       value="{{ $data->buy_quantity ?? '' }}"/>
                                                <label class="input-group-text" for="buy_quantity">PC</label>
                                            </div>
                                        </div>
                                        <span class="text-danger">@error('buy_quantity'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 get_qty" hidden>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="get_quantity">
                                                Get Quantity<span class="required"> *</span></label>
                                            <div class="input-group">
                                                <input type="number" min="0" class="form-control" id="get_quantity"
                                                       placeholder="Get Quantity" name="get_quantity"
                                                       value="{{ $data->get_quantity ?? '' }}"/>
                                                <label class="input-group-text" for="get_quantity">PC</label>
                                            </div>
                                        </div>
                                        <span class="text-danger">@error('get_quantity'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 order_amount" hidden>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="order_amount">
                                                Order Amount<span class="required"> *</span></label>
                                            <div class="input-group">
                                                <input type="number" min="0" class="form-control" id="order_amount"
                                                       placeholder="Order Amount" name="order_amount"
                                                       value="{{ $data->order_amount ?? '' }}"/>
                                                <label class="input-group-text" for="amount">BDT</label>
                                            </div>
                                        </div>
                                        <span class="text-danger">@error('order_amount'){{ $message }}@enderror</span>
                                    </div>
                                    <div class=" col-xl-6 offer_policy" hidden>
                                        <input type="text" name="previous_offer" value="{{ $data->offer_on ?? '' }}"
                                               hidden/>
                                        <div class="form-group mb-3" id="offer_policy">
                                            <label for="status"> Offer Policy<span class="required"> *</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="offer_on"
                                                       id="percentage"
                                                       value="PERCENTAGE"
                                                       {{($data->offer_on == "PERCENTAGE") ? "checked" : ""}}
                                                       required>
                                                <label class="form-check-label" for="percentage">Percentage</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="offer_on" id="amount"
                                                       value="AMOUNT" {{($data->offer_on == "AMOUNT") ? "checked" : ""}}
                                                       required>
                                                <label class="form-check-label" for="amount">Cash Amount</label>
                                            </div>
                                            <span class="text-danger">@error('offer_on'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 percentage" hidden>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="percentage">
                                                Discount Percentage<span class="required"> *</span></label>
                                            <div class="input-group">
                                                <input type="number" min="0" class="form-control" id="percentage"
                                                       placeholder="Discount Percentage" name="percentage"
                                                       value="{{ $data->percentage ?? '' }}"/>
                                                <label class="input-group-text" for="percentage">%</label>
                                            </div>
                                        </div>
                                        <span class="text-danger">@error('percentage'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 amount" hidden>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="amount">
                                                Discount Amount<span class="required"> *</span></label>
                                            <div class="input-group">
                                                <input type="number" min="0" class="form-control" id="amount"
                                                       placeholder="Discount Amount" name="amount"
                                                       value="{{ $data->amount ?? '' }}"/>
                                                <label class="input-group-text" for="amount">BDT</label>
                                            </div>

                                        </div>
                                        <span class="text-danger">@error('amount'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6 discount_limit">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="discount_limit">Highest
                                                Discount Amount</label>
                                            <div class="input-group">
                                                <input type="number" min="0" class="form-control" id="discount_limit"
                                                       placeholder="Highest Discount Amount" name="discount_limit"
                                                       value="{{ $data->discount_limit ?? '' }}"/>
                                                <label class="input-group-text" for="discount_limit">BDT</label>
                                            </div>
                                        </div>
                                        <span class="text-danger">@error('discount_limit'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="start_date">Start Date <span
                                                    class="required"> *</span> </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control start_date" name="start_date"
                                                       id="datepicker-component" placeholder="Click to select"
                                                       value="{{ $data->start_date ?? '' }}" readonly/>
                                                <label class="input-group-text" for="datepicker-component"><i
                                                        class="fa fa-calendar"></i></label>
                                            </div>
                                            <span class="text-danger">@error('start_date'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group  mb-3">
                                            <label class="form-label" for="end_date">End Date <span
                                                    class="required"> *</span> </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control end_date " name="end_date"
                                                       id="datepicker" placeholder="Click to select"
                                                       value="{{ $data->end_date ?? '' }}" readonly/>
                                                <label class="input-group-text" for="datepicker"><i
                                                        class="fa fa-calendar"></i></label>
                                            </div>
                                            <span class="text-danger">@error('end_date'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class=" col-xl-6">
                                        <div class="form-group">
                                            <label for="status"> Status<span class="required"> *</span></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                       id="available"
                                                       value="AVAILABLE"
                                                       {{($data->status == "AVAILABLE") ? "checked" : ""}}
                                                       required>
                                                <label class="form-check-label" for="available">Available</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                       id="not_available"
                                                       value="NOT_AVAILABLE"
                                                       {{($data->status == "NOT_AVAILABLE") ? "checked" : ""}}
                                                       required>
                                                <label class="form-check-label" for="not_available">Not
                                                    Available</label>
                                            </div>
                                            <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider  mt-4">
                                    <div class="divider-text bg-theme"><span class="required">* </span> Product
                                        List<span class="required"> *</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 mb-2 text-end">
                                        <span class="check-all border border-theme text-theme">
                                            <span style="margin-right: 20px" class="mt-1">Check All</span> <input
                                                class="form-check-input mx-auto mt-0" type="checkbox" value=""
                                                id="checkAll"/>
                                        </span>
                                    </div>
                                    <div class="col-xl-6 d-flex text-center">
                                        <p style="width: 50%;margin-bottom: -5px">Product</p>
                                        <p style="width: 50%;margin-bottom: -5px">Action</p>
                                    </div>

                                    <div class="col-xl-6 d-flex text-center vanish-div">
                                        <p class="vanish-p" style="width: 50%;margin-bottom: -5px">Product</p>
                                        <p class="vanish-p" style="width: 50%;margin-bottom: -5px">Action</p>
                                    </div>
                                    <div class="divider" style="margin:0 0;">
                                        <div class="divider-text bg-theme"></div>
                                    </div>
                                </div>
                                <div class="row mt-2" id="product_row">
                                    @if(count($products)!==0)
                                        @foreach($products as $product)
                                            <div class="col-xl-6 d-flex text-center" id="per-div">
                                                <p style="width: 50%">{{$product->title ?? ''}}</p>
                                                <input class="form-check-input mx-auto" type="checkbox"
                                                       name="product_id[]" value="{{$product->id}}"
                                                @foreach($selects as $p)
                                                    {{  ($product->id == $p->product_id ? ' checked' : '')}}
                                                    @endforeach
                                                />
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-xl-12 text-center ">
                                            <h2 class="text-danger">No Data Available </h2>

                                        </div>
                                    @endif
                                </div>

                                <div class="col-xl-12 text-center mt-5">
                                    <div class="ms-auto">
                                        <button type="submit" id="submit" class="btn btn-outline-theme btn-lg"><i
                                                class="bi bi-send-check fa-lg"></i>
                                            <span class="small">Submit</span></button>
                                    </div>
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
                type: "required",
                offer_on: "required",
                start_date: "required",
                end_date: "required",
                status: "required",
            },
            messages: {
                type: "Order Type is required",
                offer_on: "Offer Policy is required",
                start_date: "Start Date is required",
                end_date: "End Date is required",
                status: "Status is required",
            }
        });

        $(document).ready(function () {
            var e = document.getElementById("type");
            var strUser = e.value;


            if ($('input[name="buy_quantity"]').val() !== '') {
                $(".buy_qty").removeAttr('hidden');
            }
            if ($('input[name="get_quantity"]').val() !== '') {
                $(".get_qty").removeAttr('hidden');
            }
            if (strUser === "ORDER_AMOUNT") {
                if ($('input[name="order_amount"]').val() !== '') {
                    $(".order_amount").removeAttr('hidden');
                }
            }
            if ($('input[name="previous_offer"]').val() !== '') {
                $(".offer_policy").removeAttr('hidden');
                if ($('input[name="previous_offer"]').val() === "AMOUNT") {
                    // console.log("AMOUNT")
                    if ($('input[name="amount"]').val() === '') {
                        $(".offer_policy").attr("hidden", true);
                    }
                }
                if ($('input[name="previous_offer"]').val() === "PERCENTAGE") {
                    // console.log("PERCENTAGE")
                    if ($('input[name="percentage"]').val() === '') {
                        $(".offer_policy").attr("hidden", true);
                    }
                }
            }
            if ($('input[name="percentage"]').val() !== '') {
                $(".percentage").removeAttr('hidden');
            }
            if ($('input[name="amount"]').val() !== '') {
                $(".amount").removeAttr('hidden');
            }
        })

        $("#type").change(function () {

            $(this).find("option:selected").each(function () {
                $(".buy_qty").attr("hidden", true);
                $(".get_qty").attr("hidden", true);
                $(".order_amount").attr("hidden", true);

                $(".offer_policy").removeAttr("hidden");
                $(".discount_limit").removeAttr("hidden");
                var optionValue = $(this).attr("value");
                if (optionValue === "BUY_GET") {
                    $(".buy_qty").removeAttr('hidden');
                    $(".get_qty").removeAttr('hidden');
                    $(".offer_policy").attr("hidden", true);
                    $(".percentage").attr("hidden", true);
                    $(".amount").attr("hidden", true);
                    $(".discount_limit").attr("hidden", true);
                    $('input[name="offer_on"]').attr('checked', "AMOUNT")
                }
                if (optionValue === "ORDER_AMOUNT") {
                    $(".order_amount").removeAttr('hidden');
                    $(':checkbox').prop('checked', true);
                }
                if (optionValue === "FLAT") {
                    $(':checkbox').prop('checked', true);
                }
            });
        });

        $('#checkAll').click(function (e) {
            $('input:checkbox').prop('checked', this.checked);
        });
        $('input[name="offer_on"]').click(function () {
            let offer_policy = $(this).attr("value");
            if (offer_policy === "PERCENTAGE") {
                $(".amount").attr("hidden", true);
                $(".percentage").removeAttr('hidden');
            } else {
                $(".percentage").attr("hidden", true);
                $(".amount").removeAttr('hidden');
            }
        });
        $('#submit').on('click', function () {
            if ($('input[name="offer_on"]').val() === '') {
                $('input[name="offer_on"]').attr("value", "AMOUNT")
                $('input[name="amount"]').val('')
            }
        })
    </script>
@endpush
