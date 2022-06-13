@extends('layouts.order')
@section('content')

    <div id="content" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">

        <div class="pos card" id="pos">
            <div class="pos-container card-body" style="overflow:hidden">
                <!-- BEGIN pos-menu -->
                <div class="pos-menu">
                    <!-- BEGIN logo -->

                    <div class="logo">
                        <div class="col-6">
                             <span class="menu-icon">
                                <a href="{{route('stock-in.index')}}" class="btn btn-outline-theme btn-md active  mb-2"> <i
                                        class="fas fa-angle-double-left ml-5 text-black"></i></a>
                             </span>
                        </div>
                    </div>
                    <!-- END logo -->
                    <!-- BEGIN nav-container -->
                    <div class="nav-container">
                        <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link  sub-category" href="#"
                                       data-value="*">
                                        <div class="card">
                                            <div class="card-body text-wrap">
                                                All Products
                                            </div>
                                            <x-card-border></x-card-border>
                                        </div>
                                    </a>
                                </li>
                                @foreach($subCategories as $subCategory)
                                    <li class="nav-item">
                                        <a class="nav-link  sub-category" href="#"
                                           data-value="{{$subCategory->id}}">
                                            <div class="card">
                                                <div class="card-body text-wrap">
                                                    {{$subCategory->title}}
                                                </div>
                                                <x-card-border></x-card-border>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <!-- END nav-container -->
                </div>
                <!-- END pos-menu -->

                <!-- BEGIN pos-content -->
                <div class="pos-content X-Overflow-Hidden" style="overflow-x: hidden">
                    <div class="pos-content-container h-100 p-4" data-scrollbar="false" data-height="100%">
                        <div class="row" id="subCategoryProduct">
                            <div class="row allProducts" id="allProducts">
                                @foreach($subCategories as $subCategory)
                                    @foreach($products->where('sub_category_id',$subCategory->id) as $product)
                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 pb-4">
                                            <!-- BEGIN card -->
                                            <div class="card h-100 cartModalButton"
                                                 id="{{$product->id}}-{{$product->title}}">
                                                <div class="card-body h-100 p-1">
                                                    <a href="#" class="pos-product">
                                                        @if($product->image != null)
                                                            <img class="img" height="50%"
                                                                 src="{{asset('storage/images/product/' . $product->image)}}">
                                                        @else
                                                            <img class="img" height="50%"
                                                                 src="{{asset('assets/img/no-image/no-image-available.jpg')}}">
                                                        @endif

                                                        <div class="info">
                                                            <div class="title">{{$product->title}}</div>
                                                            <div class="desc">{{$product->description ?? 'N/A'}}</div>
                                                            {{--                                                            <div class="price">BDT {{$product->price}}</div>--}}
                                                            <div class="quantity"> Available
                                                                : {{ $product->quantity . ' '. $product->unit}}</div>
                                                            <input class="allProductsQuantity" type="text"
                                                                   value="{{ $product->quantity}}" hidden>
                                                        </div>
                                                    </a>
                                                </div>
                                                <x-card-border></x-card-border>
                                            </div>
                                            <!-- END card -->
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END pos-content -->

                <!-- BEGIN pos-sidebar -->
                <form id="editForm " method="POST" action="{{route('stock-in.update',$stock->uuid)}}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="pos-sidebar" id="pos-sidebar">
                        <div class="h-100 d-flex flex-column p-0">

                            <!-- BEGIN pos-sidebar-nav -->
                            <div class="pos-sidebar-nav mt-2">
                                <ul class="nav nav-tabs nav-fill p-0">
                                    <li class="nav-item p-0">
                                        <a class="nav-link active" href="#" data-bs-toggle="tab"
                                           data-bs-target="#newOrderTab">Purchase <span class="required"> *</span><span
                                                id="countOrder" data-value="{{ count($stock->products) }}">({{ count($stock->products) }})</span></a>
                                    </li>
                                    <li class="nav-item p-0">
                                        <a class="nav-link" href="#" data-bs-toggle="tab"
                                           data-bs-target="#vendorTab">Supplier<span class="required"> *</span></a>
                                    </li>
                                    <li class="nav-item p-0">
                                        <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#accountTab">Account<span
                                                class="required"> *</span></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END pos-sidebar-nav -->

                            <!-- BEGIN pos-sidebar-body -->
                            <div class="pos-sidebar-body tab-content" data-scrollbar="true" data-height="100%">
                                <!-- BEGIN #newOrderTab -->
                                <div class="tab-pane fade h-100 show active" id="newOrderTab">
                                        @for($x=0;$x<=count($stock->products)-1;$x++)
                                        <div class="pos-order" style="padding: 5px">
                                            <div class="pos-order-product row mt-2">
                                                <div class="w-100">
                                                    <input class="product_id_val" type="text" value="{{ $stock->products[$x]->id }}"
                                                           hidden>
                                                    <input class="product_title_val" type="text" value="{{ $stock->products[$x]->title }}"
                                                           hidden>
                                                    <div class="d-flex">
                                                        <div class="h6 mb-1" style="width:90%">{{ $stock->products[$x]->title }}</div>
                                                        <div class="mb-3 text-end" style="width:10%">
                                                            <button class="btn  btn-danger remove_field p-0 pt-1"
                                                                    type="button"><i
                                                                    class="bi bi-trash fs-20px lh-1"></i></button>
                                                        </div>
                                                    </div>


                                                    <div class="d-flex align-items-center mb-2 row form-group ">
                                                        <div class="col-md-3">Qty:</div>
                                                        <div class="flex-1 text-end h6 mb-0 input-group text-wrap  ">
                                                            <input type="text" class="form-control product-qty"
                                                                   name="qty" value="{{ $stock->products[$x]->pivot->quantity }}" id="qty-{{$x+1}}">
                                                            <span class="input-group-text"><small>PC</small></span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2 row form-group ">
                                                        <div class="col-md-3">Amount:</div>
                                                        <div class="flex-1 text-end h6 mb-0 input-group text-wrap  ">
                                                            <input type="text" class="form-control amount"
                                                                   oninput="calculate_products_price()" name="amount" id="amount-{{$x+1}}"
                                                                   value="{{ $stock->products[$x]->pivot->amount }}">
                                                            <span class="input-group-text"><small>BDT</small></span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2 row form-group ">
                                                        <div class="col-md-3">Unit Price:</div>
                                                        <div class="flex-1 text-end h6 mb-0 input-group text-wrap  ">
                                                            <input type="text" class="form-control"
                                                                   value="{{ $stock->products[$x]->pivot->amount/$stock->products[$x]->pivot->quantity }}" id="unit_price-{{$x+1}}" readonly>
                                                            <span class="input-group-text"><small>BDT</small></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                </div>
                                <!-- END #newOrderTab -->

                                <!-- BEGIN #orderHistoryTab -->
                                <div class="tab-pane fade h-100" id="vendorTab" style="overflow-x: hidden">
                                    <div
                                        class="h-100  align-items-center justify-content-center text-center  ">
                                        <div class="d-flex align-items-center mb-2 row form-group">
                                            <div class="col-md-4 text-start ms-2">Phone No<span
                                                    class="required"> *</span></div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-8 input-group mt-2">
                                                <span class="input-group-text">+88</span>
                                                <input type="text" class="form-control mr-5" name="phone_number"
                                                       onkeyup="countNumber()"
                                                       id="vendor_phone" value="{{ $stock->vendors->phone_number }}"
                                                       style="max-width: 71%">
                                            </div>
                                            <div class="row text-start">
                                                <span
                                                    class="text-danger ms-2">@error('phone_number'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 row form-group">
                                            <div class="col-md-4 text-start ms-2">Name<span class="required"> *</span>
                                            </div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-8 input-group mt-2">
                                                <input type="text" class="form-control mr-5" name="vendor_name"
                                                       id="vendor_name" value="{{ $stock->vendors->vendor_name }}"
                                                       style="max-width: 95%">
                                            </div>
                                            <div class="row text-start">
                                                <span
                                                    class="text-danger ms-2">@error('vendor_name'){{ $message }}@enderror</span>
                                            </div>
                                            <input type="text" id="vendor_id" value="{{ $stock->vendors->id }}"
                                                   name="vendor_id"
                                                   style="max-width: 95%" hidden>
                                        </div>
                                        <div class="divider">
                                            <div
                                                class="divider-text text-theme">
                                                Address
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 row">
                                            <div class="col-md-4 text-start ms-2">Country<span
                                                    class="required"> *</span></div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-8 input-group mt-2">
                                                <input type="text" class="form-control mr-5"
                                                       name="vendor_address[country]"
                                                       id="vendor_country"
                                                       value="{{ $stock->vendors->vendor_address['country'] }}"
                                                       style="max-width: 95%">
                                            </div>
                                            <div class="row text-start">
                                                <span
                                                    class="text-danger ms-2">@error('vendor_address[country]'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 row">
                                            <div class="col-md-4 text-start ms-2">District<span
                                                    class="required"> *</span></div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-8 input-group mt-2">
                                                <input type="text" class="form-control mr-5"
                                                       name="vendor_address[district]"
                                                       id="vendor_district"
                                                       value="{{ $stock->vendors->vendor_address['district'] }}"
                                                       style="max-width: 95%">
                                            </div>
                                            <div class="row text-start">
                                                <span
                                                    class="text-danger ms-2">@error('vendor_address[district]'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 row">
                                            <div class="col-md-4 text-start ms-2">P.S/Upazila<span
                                                    class="required"> *</span></div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-8 input-group mt-2">
                                                <input type="text" class="form-control mr-5" name="vendor_address[ps]"
                                                       id="vendor_ps"
                                                       value="{{ $stock->vendors->vendor_address['ps'] }}"
                                                       style="max-width: 95%">
                                            </div>
                                            <div class="row text-start">
                                                <span
                                                    class="text-danger ms-2">@error('vendor_address[ps]'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 row">
                                            <div class="col-md-4 text-start ms-2">Zip Code<span
                                                    class="required"> *</span></div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-8 input-group mt-2">
                                                <input type="text" class="form-control mr-5" name="vendor_address[zip]"
                                                       id="vendor_zip"
                                                       value="{{ $stock->vendors->vendor_address['zip'] }}"
                                                       style="max-width: 95%">
                                            </div>
                                            <div class="row text-start">
                                                <span
                                                    class="text-danger ms-2">@error('vendor_address[zip]'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 row">
                                            <div class="col-md-4 text-start ms-2">Address Line<span
                                                    class="required"> *</span></div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-8 input-group mt-2">
                                                <textarea type="text" class="form-control mr-5"
                                                          name="vendor_address[address_line]"
                                                          id="vendor_address_line"
                                                          style="max-width: 95%">{{ $stock->vendors->vendor_address['address_line'] }}</textarea>
                                            </div>
                                            <div class="row text-start">
                                                <span
                                                    class="text-danger ms-2">@error('vendor_address[address_line]'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="divider">
                                            <div
                                                class="divider-text text-theme">
                                                Voucher
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 row">
                                            <div class="col-md-4 text-start ms-2">Voucher Number<span class="required"> *</span>
                                            </div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-8 input-group mt-2">
                                                <input type="text" class="form-control mr-5" name="voucher_number"
                                                       id="voucher_number" value="{{ $stock->voucher_number }}"
                                                       style="max-width: 95%">
                                            </div>
                                            <div class="row text-start">
                                                <span
                                                    class="text-danger ms-2">@error('voucher_number'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END #orderHistoryTab -->

                                <!-- BEGIN #accountTab -->
                                <div class="tab-pane fade " id="accountTab" style="overflow-x: hidden">
                                    <div class="h-100  align-items-center justify-content-center form-group p-2 mt-3">
                                        <div class="d-flex align-items-center mb-2 row form-group">
                                            <div class="col-md-3">VAT</div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-9 input-group flex-nowrap">
                                                <input type="text" class="form-control" id="taxInput"
                                                       oninput="calculate_tax()"
                                                       value="{{ ($accounts->tax * 100)/$accounts->total }}">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 row form-group ">
                                            <div class="col-md-3">Discount</div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-9 input-group text-wrap  ">
                                                <input type="text" class="form-control" name="discount"
                                                       id="discountInput"
                                                       oninput="calculate_discount()" value="{{ $accounts->discount }}">
                                                <span class="input-group-text"><small>BDT</small></span>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-2 row form-group ">
                                            <div class="col-md-3">Cash Paid</div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-9 input-group text-wrap">
                                                <input type="text" class="form-control" id="cashCollect"
                                                       name="cashCollect" value="0"
                                                       oninput="change()">
                                                <span class="input-group-text"><small>BDT</small></span>
                                            </div>
                                            <input type="number" id="prevPaid"
                                                   value="{{ ($accounts->net_total) - ($accounts->due) }}" hidden>
                                        </div>

                                        <div class="mb-3 mt-3"
                                             style="border-top: 1px solid rgba(255, 255, 255, .3); margin-top: 3px"></div>
                                        <div class="d-flex align-items-center mb-2 ">
                                            <div>Subtotal</div>
                                            <div class="flex-1 text-end h6 mb-0" id="subTotal">{{ $accounts->total }}
                                                BDT
                                            </div>
                                            <input type="text" name="total" id="sub_total"
                                                   value="{{ $accounts->total }}" hidden>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <input type="text" class="form-control" name="tax" id="taxValue"
                                                   value="{{ $accounts->tax }}" hidden>
                                            <div>VAT @ <span id="vatPercentage">({{ ($accounts->tax * 100)/$accounts->total }}%)</span>
                                            </div>
                                            <div class="flex-1 text-end h6 mb-0" id="tax">{{ $accounts->tax }} BDT</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div>Changes</div>
                                            <div class="flex-1 text-end h6 mb-0" id="changes">0.00</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div>Paid</div>
                                            <div class="flex-1 text-end h6 mb-0"
                                                 id="showPaid">{{ ($accounts->net_total) - ($accounts->due) }} BDT
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div>Due</div>
                                            <div class="flex-1 text-end h6 mb-0" id="showDue">{{ $accounts->due }}BDT
                                            </div>
                                            <input type="text" class="form-control" name="due" id="due"
                                                   value="{{ $accounts->due }}" hidden>
                                        </div>
                                        <hr/>
                                        <div class="d-flex align-items-center mb-2">
                                            <input type="text" class="form-control" id="totalValue"
                                                   value="{{ $accounts->total }}" hidden>
                                            <div>Total</div>
                                            <div class="flex-1 text-end h4 mb-0"
                                                 id="total">{{ $accounts->net_total }}</div>
                                            <span class="text-end h4 mb-0 ms-2">BDT</span>
                                            <input type="text" class="form-control" name="net_total" id="grandTotal"
                                                   value="{{ $accounts->net_total }}"
                                                   hidden>
                                        </div>
                                        <input id="pro_ids" name="pro_id[]" type="text" value="" hidden/>
                                        <input id="pro_qty" name="pro_qty[]" type="text" value="" hidden/>
                                        <input id="pro_titles" name="pro_title[]" type="text" value="" hidden/>
                                        <input id="pro_price" name="pro_price[]" type="text" value="" hidden/>
                                        <div class="mt-4">
                                            <div class="btn-group d-flex">
                                                <button type="submit" class="btn btn-outline-theme rounded-0 w-150px"
                                                        id="submit">
                                                    <i class="bi bi-send-check fa-lg"></i><br/>
                                                    <span class="small">Submit Order</span>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- END #accountTab -->
                            </div>
                            <!-- END pos-sidebar-body -->
                        </div>
                    </div>
                </form>
                <!-- END pos-sidebar -->
            </div>

            <x-card-border></x-card-border>
        </div>
    </div>


@endsection
@push('customScripts')
    <script src="{{asset('assets/js/jqueryUI/jquery-ui.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.nav li a').click(function (e) {
                $('.nav li a.active').removeClass('active');
                var $this = $(this);
                $this.addClass('active');
                e.preventDefault();
            });
            // console.log()
        })
        $("#editForm").validate({
            errorPlacement: function (error, e) {
                e.parents('.form-group').append(error);
            },
            rules: {
                phone_number: "required",
                vendor_name: "required",
                vendor_address: "required",
                voucher_number: "required",
            },
            messages: {
                phone_number: "Vendor Phone Number is required",
                vendor_name: "Vendor Name is required",
                vendor_address: "This Address field is required",
                voucher_number: "Voucher Number is required",
            }
        });

        var counter = 0;
        var wrapper = $("#newOrderTab"); //Fields wrapper
        let x = Number($('#countOrder').attr('data-value')); //initial text box count

        $('.allProducts').on('click', '.cartModalButton', function (e) { //on add input button click
            let item_id_title = this.id
            let item_id = item_id_title.split("-");
            let item_id_value = item_id[0]
            let productitle = item_id[1]

            counter = 0
            let max_fields = 5000; //maximum input boxes allowed
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(`
                                <div class="pos-order" style="padding: 5px">
                                    <div class="pos-order-product row mt-2">
                                        <div class="w-100">
                                            <input class="product_id_val" type="text" value="` + item_id_value + `" hidden>
                                            <input class="product_title_val" type="text" value="` + productitle + `" hidden>
                                            <div class="d-flex">
                                                <div class="h6 mb-1" style="width:90%">` + productitle + `</div>
                                                <div class="mb-3 text-end" style="width:10%">
                                                   <button class="btn  btn-danger remove_field p-0 pt-1" type="button" ><i class="bi bi-trash fs-20px lh-1"></i></button>
                                                </div>
                                            </div>


                                            <div class="d-flex align-items-center mb-2 row form-group ">
                                                <div class="col-md-3">Qty: </div>
                                                <div class="flex-1 text-end h6 mb-0 input-group text-wrap  ">
                                                    <input type="text" class="form-control product-qty" name="qty" id="qty-`+x+`">
                                                    <span class="input-group-text"><small>PC</small></span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2 row form-group ">
                                                <div class="col-md-3">Amount: </div>
                                                <div class="flex-1 text-end h6 mb-0 input-group text-wrap  ">
                                                    <input type="text" class="form-control amount" oninput="calculate_products_price()" name="amount" id="amount-`+x+`">
                                                    <span class="input-group-text"><small>BDT</small></span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2 row form-group ">
                                                <div class="col-md-3">Unit Price: </div>
                                                <div class="flex-1 text-end h6 mb-0 input-group text-wrap  ">
                                                    <input type="text" class="form-control" id="unit_price-`+x+`" readonly>
                                                    <span class="input-group-text"><small>BDT</small></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`); // add input boxes.
                let y = $('.pos-order').length;
                $('#countOrder').text('(' + y + ')')

            }

            //for product id array

        });

        wrapper.on('click', '.remove_field', function (e) {

            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
            // x--;
            let y = $('.pos-order').length;
            $('#countOrder').text('(' + y + ')')


            calculate_products_price();
            let subTotal = $('#sub_total').val()

            $('#total').text(subTotal)
            $('#totalValue').attr('value', subTotal)
            $('#grandTotal').attr('value', subTotal)

            calculate_tax();
            calculate_discount();
        })

        $(".sub-category").on('click', function (e) {
            let sub_category_id = $(this).attr('data-value');
            fetch(`/order/display-product/${sub_category_id}`)
                .then(res => res.json())
                .then(res => {
                    $("#allProducts").html(res.map((product) =>
                        `<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 pb-4 ">
                                <!-- BEGIN card -->
                                <div class="card h-100 cartModalButton" id="${product.id}-${product.title}">
                                    <div class="card-body h-100 p-1 ">
                                         <a href="#" class="pos-product">` +
                        (product.image != null ?
                                `<img class="img" height="50%" src="{{asset('storage/images/product/${product.image}')}}">`
                                :
                                `<img class="img" height="50%" src="{{asset('assets/img/no-image/no-image-available.jpg')}}">`
                        ) +

                        `<div class="info">
                                                <div class="title"> ${product.title}</div>` +

                        (product.description != null ?
                                `<div class="desc">${product.description}</div>`
                                :
                                `<div class="desc">N/A</div>`
                        ) +
                        `<div class="quantity"> Available
                                                                : ${product.quantity}  ${product.unit}</div>
                                            </div>
                                         </a>
                                    </div>
                                    <x-card-border></x-card-border>
                                </div>
                                <!-- END card -->
                        </div>`));

                })
                .catch(err => {
                    console.log(err)
                })
        })
        $("#newOrderTab").on("keyup", ".amount", function (e) {
            let field_id = $(this).attr('id')
            let id = field_id.split("-", 2)
            let index_no = id[1]
            if ($("#qty-"+index_no).val()) {
                let amount = $("#amount-"+index_no).val();
                let qty = $("#qty-"+index_no).val();
                $("#unit_price-"+index_no).val(amount/qty);
            }
        })
        $("#newOrderTab").on("keyup", ".product-qty", function (e) {
            let field_id = $(this).attr('id')
            let id = field_id.split("-", 2)
            let index_no = id[1]
            if ($("#amount-"+index_no).val()) {
                let amount = $("#amount-"+index_no).val();
                let qty = $("#qty-"+index_no).val();
                $("#unit_price-"+index_no).val(amount/qty);
            }
        })
        function calculate_products_price() {
            let sum = 0;
            $(".amount").each(function () {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            $('#subTotal').text(sum + ' BDT')
            $('#total').text(sum)
            $("#sub_total").attr('value', sum);
            $("#totalValue").attr('value', sum);
            $("#grandTotal").attr('value', sum);

            calculate_tax();
        }

        function calculate_tax() {
            let subTotal = Number($('#sub_total').val())
            let tax = Number($('#taxInput').val())
            let tax_cal = Number(subTotal * tax / 100).toFixed()
            let afterTax = Number(subTotal) + Number(tax_cal)

            $('#vatPercentage').text('(' + tax + '%' + ')')
            $('#tax').text(tax_cal + ' BDT')
            $('#taxValue').attr('value', tax_cal)
            $('#total').text(afterTax)
            $('#totalValue').attr('value', afterTax)

            calculate_discount()
            change()
        }


        function calculate_discount() {
            let total = Number($('#totalValue').val())
            let discount = Number($('#discountInput').val())
            let discount_cal = total - discount
            $('#total').text(discount_cal)
            $('#grandTotal').attr('value', discount_cal)
            change()
        }

        function change() {
            let cash = Number($('#cashCollect').val()) + Number($('#prevPaid').val())
            let grandTotal = Number($('#grandTotal').val())
            $('#showPaid').text(cash + ' BDT')
            // console.log(grandTotal)
            let change = cash - grandTotal
            if (cash === 0) {
                $('#changes').text(0 + ' BDT')
            } else {
                $('#changes').text(change + ' BDT')
            }
            // if (document.getElementById("cashCollect").value === "") {
            //     document.getElementById('submit').disabled = true;
            // } else {
            //     if (document.getElementById("vendor_name").value === "" ||
            //         document.getElementById("voucher_number").value === "" ||
            //         document.getElementById("vendor_address_line").value === "") {
            //
            //         alert("Please fill-up all the required fields of vendor portion");
            //
            //     } else {
            //         document.getElementById('submit').disabled = false;
            //     }
            // }
            due();
        }

        function due() {
            let cash = Number($('#cashCollect').val()) + Number($('#prevPaid').val())
            let grandTotal = Number($('#grandTotal').val())
            // console.log(grandTotal)
            let due = grandTotal - cash
            $('#showDue').text(due + ' BDT')
            $('#due').attr('value', due)
            if (cash > grandTotal) {
                $('#showDue').text(0.00 + ' BDT');
                $('#due').attr('value', 0);
            } else {
                $('#changes').text(0.00 + ' BDT');

            }

        }

        $('#submit').on('click', function () {
            let productId = [];
            let productQty = [];
            let producTitle = [];
            let producPrice = [];

            $('.product_id_val').each(function () {
                productId.push($(this).val())
                $('#pro_ids').val(productId)
            });
            $('.product-qty').each(function () {
                productQty.push($(this).val())
                $('#pro_qty').val(productQty)
            });
            $(".product_title_val").each(function () {
                producTitle.push($(this).val())
                $('#pro_titles').val(producTitle)
            });
            $(".amount").each(function () {
                producPrice.push($(this).val())
                $('#pro_price').val(producPrice)
            });
        });

        function countNumber() {
            if ($("#vendor_phone").val().length === 10) {
                $('#vendor_id').val('');
                $('#vendor_name').val('');
                $('#vendor_country').val('');
                $('#vendor_district').val('');
                $('#vendor_ps').val('');
                $('#vendor_zip').val('');
                $('#vendor_address_line').val('');
            }
        }

        //search customer by input phone Number
        $("#vendor_phone").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('stockIn.vendor')}}",
                    type: 'get',
                    dataType: "json",
                    data: {
                        // _token: CSRF_TOKEN,
                        search: request.term         //search = key
                    },

                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection to field
                $('#vendor_id').val(ui.item.value);
                $('#vendor_phone').val(ui.item.phone);
                $('#vendor_name').val(ui.item.name);
                $('#vendor_country').val(ui.item.country);
                $('#vendor_district').val(ui.item.district);
                $('#vendor_ps').val(ui.item.ps);
                $('#vendor_zip').val(ui.item.zip);
                $('#vendor_address_line').val(ui.item.address_line);
                return false;
            }
        });
    </script>
@endpush
