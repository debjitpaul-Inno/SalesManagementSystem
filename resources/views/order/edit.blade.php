@extends('layouts.order')
@section('content')
    <div id="content" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert type="danger" message="{{$error}}"></x-alert>
            @endforeach
        @endif
        <div class="pos card" id="pos">
            <div class="pos-container card-body" style="overflow:hidden">
                <!-- BEGIN pos-menu -->
                <div class="pos-menu">
                    <!-- BEGIN logo -->
                    <div class="logo">
                        <div class="col-6">
                             <span class="menu-icon">
                                <a href="{{route('order.index')}}" class="btn btn-outline-theme btn-md active  mb-2"> <i
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
                                        <a class="nav-link  sub-category" href="#{{$subCategory->title}}"
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
                                            <div class="card h-100 pos withoutSubCatClick">
                                                <div class="card-body h-100 p-1">
                                                    <input class="prodImage" type="text" value="{{$product->image ?? 'null'}}"
                                                           hidden />
                                                    <a href="#" class="pos-product" data-bs-toggle="modal"
                                                       data-bs-target="#modalPosItem">

                                                        @if($product->image != null)
                                                            <img class="img" height="50%"
                                                                 src="{{asset('storage/images/product/' . $product->image)}}">
                                                        @else
                                                            <img class="img" height="50%"
                                                                 src="{{asset('assets/img/no-image/no-image-available.jpg')}}">
                                                        @endif

                                                        <div class="info">
                                                            <div class="productId "><input type="text" class="proId"
                                                                                           value="{{$product->title}}"
                                                                                           hidden/></div>
                                                            <input type="text" class="itemId" value="{{$product->id}}" hidden/>
                                                            <div class="title">{{$product->title}}</div>
                                                            <div class="desc">{{$product->description ?? 'N/A'}}</div>
                                                            <div class="price">BDT {{$product->price}}</div>
                                                            <input class="allProductsPrice" type="text"
                                                                   value="{{ $product->price}}" hidden>
                                                            <div class="quantity"> In Stock
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
                <form id="editForm" method="POST" action="{{route('order.update', $order->uuid)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
{{--                    @dd($order->products)--}}
                    <div class="pos-sidebar" id="pos-sidebar">
                        <div class="h-100 d-flex flex-column p-0">
                            <!-- BEGIN pos-sidebar-nav -->
                            <div class="pos-sidebar-nav mt-2">
                                <ul class="nav nav-tabs nav-fill p-0">
                                    <li class="nav-item p-0">
                                        <a class="nav-link active" href="#" data-bs-toggle="tab"
                                           data-bs-target="#newOrderTab">Order <span id="countOrder" data-value="{{count($order->products)}}">{{'('.count($order->products) .')'}}</span></a>
                                    </li>
                                    <li class="nav-item p-0">
                                        <a class="nav-link" href="#" data-bs-toggle="tab"
                                           data-bs-target="#orderHistoryTab">Customer</a>
                                    </li>
                                    <li class="nav-item p-0">
                                        <a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#accountTab">Account</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END pos-sidebar-nav -->

                            <!-- BEGIN pos-sidebar-body -->
                            <div class="pos-sidebar-body tab-content" data-scrollbar="true" data-height="100%">
                                <!-- BEGIN #newOrderTab -->
                                <!-- Start No order Found art -->
                                <div class="tab-pane fade h-100 show active" id="newOrderTab">
                                    @foreach($order->products as $product)
                                        <div class="pos-order">
                                            <div class="pos-order-product">
                                                <div class="flex-1">
                                                    <input class="product_id_val" type="text" value="{{$product->id}}" data-value="{{$product->price}}" hidden>
                                                    <input class="product_title_val" type="text" value="{{$product->title}}" data-value="{{$product->pivot->quantity}}" hidden>
                                                    <div class="h6 mb-1">{{$product->title}}</div>
                                                    <div class="small">Qty : {{$product->pivot->quantity}}</div>
{{--                                                    <input class="product_quantity_val" type="text" value="` + product_quantity + `" hidden>--}}
                                                    <input class="product_price_val" name="unit_price" type="text" value="{{$product->price}}" hidden>
                                                    <div class="small">Unit Price : {{$product->price}} BDT</div>
                                                    <input class="product_cart_price" type="text"  value="{{$product->price * $product->pivot->quantity}}" hidden>
                                                </div>
                                            </div>
                                            <div class="pos-order-price" style="font-weight: bold">{{$product->pivot->quantity * $product->price}} BDT</div>
                                            <div class="mb-1" >
                                                <button class="btn  btn-danger remove_field p-1" type="button" ><i class="bi bi-trash fs-20px lh-1"></i></button>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                                <!-- End No order Found art -->
                                <!-- END #newOrderTab -->
                                <!-- Start Customer Information -->
                                <div class="tab-pane fade h-100" id="orderHistoryTab">
                                    <div class="h-100  align-items-center justify-content-center text-center ">
                                        <div class="d-flex align-items-center mb-2 row form-group">
                                            <div class="col-md-3 ml-2">Phone No</div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-9 input-group mt-2">
                                                <span class="input-group-text">+88</span>
                                                <input type="text" class="form-control mr-5" name="phone_number" placeholder="type number to search"
                                                       id="customer_phone" value="{{$order->customers->phone_number ?? ''}}" style="max-width: 75%" >
                                            </div>
                                            <span class="text-danger ms-4">@error('phone_number'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 row form-group">
                                            <div class="col-md-3 ml-2">NickName</div>
                                            <div class="flex-1 text-end h6 mb-0 col-md-9 input-group mt-2">
                                                <input type="text" class="form-control mr-5" name="nickname"
                                                       id="customer_name" value="{{$order->customers->nickname ?? ''}}" style="max-width: 95%" >
                                            </div>
                                            <span class="text-danger">@error('nickname'){{ $message }}@enderror</span>
                                        </div>

                                        <div class="row mt-1">
                                            <label for="" class="mt-3" style="width: 38%">Membership Type</label>
                                            <div class="col-md-6 mt-3">
                                                <span class="float-right badge border border-theme text-light" id="membershipType" style="text-decoration: none;font-size: 13px">{{$order->customers->members->membershipTypes->title ?? 'N/A'}}</span>
                                            </div>
                                        </div>

                                        <input type="text" id="customer_id" value="{{$order->customers->id ?? ''}}" name="customer_id"
                                               style="max-width: 95%" hidden>
                                    </div>
                                </div>
                                <!-- End Customer Information -->

                                <!-- BEGIN #accountTab -->
                                <!-- Start Calculation -->

                                <div class="tab-pane fade" id="accountTab">
                                        <div class="h-100  align-items-center justify-content-center form-group p-2 mt-2">
                                            <div class="d-flex align-items-center mb-2 row form-group">
                                                <div class="col-md-3">VAT</div>
                                                <div class="flex-1 text-end h6 mb-0 col-md-9 input-group flex-nowrap">
                                                    <input type="text" class="form-control" name="tax_percentage" id="taxInput" oninput="calculate_tax()"
                                                           value="{{round(($accounts->tax * 100)/$accounts->total)}}">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2 row form-group ">
                                                <div class="col-md-3">Discount</div>
                                                <div class="flex-1 text-end h6 mb-0 col-md-9 input-group text-wrap  ">
                                                    <input type="text" class="form-control" name="discount" id="discountInput"
                                                           oninput="calculate_discount()" value="{{$accounts->discount}}">
                                                    <span class="input-group-text"><small>BDT</small></span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2 row form-group ">
                                                <div class="col-md-3">Cash Paid</div>
                                                <div class="flex-1 text-end h6 mb-0 col-md-9 input-group text-wrap">
                                                    <input type="text" class="form-control" name="cash" id="cashCollect" value="0"
                                                           oninput="change()">
                                                    <span class="input-group-text"><small>BDT</small></span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2 row form-group ">
                                                <div class="col-md-3">Due Payment Date</div>
                                                <div class="flex-1 text-end h6 mb-0 col-md-9 input-group text-wrap">
                                                    <input type="date" class="form-control" name="due_payment_date" id="due_payment_date" value="{{$accounts->due_payment_date ?? 'N/A'}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 mt-3"
                                                 style="border-top: 1px solid rgba(255, 255, 255, .3); margin-top: 3px"></div>
                                            <div class="d-flex align-items-center mb-2 ">
                                                <div>Subtotal</div>
                                                <div class="flex-1 text-end h6 mb-0" id="subTotal">{{$accounts->total}}</div>
                                                <input type="text" name="total" id="sub_total" value="{{$accounts->total}}" hidden>
                                            </div>
                                            <div class="d-flex align-items-center mb-2 ">
                                                <div>Membership Discount @ <span id="memberDiscount">{{'('.round(($accounts->membership_discount*100) / $accounts->total).'%' .')' }}</span></div>
                                                <div class="flex-1 text-end h6 mb-0" id="membershipDiscount">{{$accounts->membership_discount}}</div>
                                                <input type="text" name="membership_discount_percentage"  id="membershipDiscountPercentage" value="{{$order->customers->members->membershipTypes->discount ?? '0'}}" hidden>
                                                <input type="text" name="membership_discount" id="membershipDiscountValue" value="{{$accounts->membership_discount}}" hidden>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <input type="text" class="form-control" name="tax" id="taxValue" value="{{$accounts->tax}}" hidden>
                                                <div>VAT @ <span id="vatPercentage">{{'('.round(($accounts->tax*100) / $accounts->total).'%' .')' }}</span></div>
                                                <div class="flex-1 text-end h6 mb-0" id="tax">{{$accounts->tax}}</div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <div>Rounding (+/-)</div>
                                                <div class="flex-1 text-end h6 mb-0" id="rounding">0.00</div>

                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <div>Changes</div>
                                                <div class="flex-1 text-end h6 mb-0" id="changes">0.00</div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div>Due</div>
                                                <div class="flex-1 text-end h6 mb-0" id="showDue">{{$accounts->due}}</div>
                                                <input type="text" class="form-control" name="due" id="due" value="0" hidden>
                                            </div>
                                            <div class="d-flex align-items-center mt-2">
                                                <div>Previously Paid:</div>
                                                <div class="flex-1 text-end h6 mb-0" id="showPreviousPaid"></div>
                                            </div>
                                            <hr/>
                                            <div class="d-flex align-items-center mb-2">
                                                <input type="text" class="form-control"  id="totalValue" value="{{$accounts->net_total}}" hidden>
                                                <div>Total</div>
                                                <div class="flex-1 text-end h4 mb-0" id="total">{{$accounts->net_total}}</div>
                                                <span class="text-end h4 mb-0  p-1">BDT</span>
                                                <input type="text" class="form-control"  name="net_total" id="grandTotal" value="{{$accounts->net_total}}"  hidden>
                                            </div>
                                            <input type="text" class="form-control" id="paidAmount" value="{{$accounts->net_total - $accounts->due}}" hidden>

                                            <input type="text" class="form-control" name="user_id" value="{{auth()->user()->id}}" readonly hidden>
                                            <input class="product_price_val" id="unit_price" name="unit_price[]" type="text" value="" hidden>
                                            <input id="pro_ids" name="pro_id[]" type="text" value="" hidden/>
                                            <input id="pro_qty" name="pro_qty[]" type="text" value="" hidden/>
                                            <input id="pro_titles" name="pro_title[]" type="text" value="" hidden/>
                                            <div class="mt-1">
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
                                <!-- End Calculation -->
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
    <!-- BEGIN #modalPosItem -->
    <div class="modal modal-pos fade" id="modalPosItem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">
                <div class="card">
                    <div class="card-body p-0">
                        <a href="#" data-bs-dismiss="modal"
                           class="btn-close position-absolute top-0 end-0 m-4 modal_close"></a>
                        <div class="modal-pos-product">
                            <input type="text" id="prodId" hidden>

                            <div class="modal-pos-product-img">
                                <div class="img" style="max-height: 20px" id="productImage"></div>
                            </div>
                            <div class="modal-pos-product-info">
                                <div class="h4 mb-2">
                                    <input type="text" class="itemIdValue" hidden>
                                    <input type="text" class="product_id_value" id="product_id" value="" data-value=""
                                           hidden>
                                    <span id="productTitle"></span>
                                </div>
                                <div class="text-white text-opacity-50 mb-2">
                                    <span id="productDesc"></span>
                                    <input type="text" id="product_desc" hidden>
                                </div>
                                <div class="h4 mb-3">
                                    <span id="productPrice"></span>
                                    <input type="text" id="product_price" hidden>
                                </div>
                                <div class="h4 mb-3">
                                    <input type="text" id="product_quantity" value="" hidden>
                                    <input type="text" id="product_total_price" value="" hidden>
                                </div>
                                <div class="d-flex mb-3">
                                    <button class="btn btn-outline-theme quantityButton" id="minusButton"><i
                                            class="fa fa-minus"></i></button>
                                    <input type="text"
                                           class="form-control w-50px fw-bold mx-2 bg-white bg-opacity-25 border-0 text-center"
                                           min="0" id="quantityValue" name="qty" value="0"/>
                                    <button class="btn btn-outline-theme quantityButton" id="plusButton"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                                {{--                            <hr class="mx-n4" />--}}
                                <hr class="mx-n4"/>
                                <div class="row">
                                    <div class="col-4">
                                        <a href="#" class="btn btn-default h4 mb-0 d-block rounded-0 py-3 modal_close"
                                           data-bs-dismiss="modal">Cancel</a>
                                    </div>
                                    <div class="col-8">
                                        <button href="#"
                                                class="btn btn-success d-flex justify-content-center align-items-center rounded-0 py-3 h4 m-0"
                                                id="cartModalButton" data-bs-toggle="modal"
                                                data-bs-target="#modalPosItem">Add to cart <i
                                                class="bi bi-plus fa-2x ms-2 my-n3"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-card-border></x-card-border>
                </div>
            </div>
        </div>
    </div>
    <!-- END #modalPosItem -->
@endsection
@push('customScripts')
    <script src="{{asset('assets/js/jqueryUI/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#showPreviousPaid').text($('#paidAmount').val())
            //function for sidebar active
            $('.nav li a').click(function (e) {
                $('.nav li a.active').removeClass('active');
                var $this = $(this);
                $this.addClass('active');
                e.preventDefault();
            });
        })

        //search customer by input phone Number
        $("#customer_phone").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('order.client')}}",
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
                $('#customer_phone').val(ui.item.phone);
                $('#customer_name').attr('value',ui.item.label);
                $('#customer_id').attr('value', ui.item.value);
                $('#membershipType').text(ui.item.membershipType);
                $('#membershipDiscountPercentage').attr('value',ui.item.membershipDiscount);
                $('#memberDiscount').text('(' + ui.item.membershipDiscount + '%' + ')')
                if($('#membershipDiscountPercentage').val() !== 0){
                    calculate_tax()
                }
                return false;
            }

        });
        $('#customer_phone').on('keyup', function (){
            let phone =  $('#customer_phone').val()
            if (phone.length <= 10){
                $('#customer_name').attr('value', '')
                $('#customer_id').attr('value', '')
                $('#membershipDiscountPercentage').attr('value', '')
                $('#membershipDiscountValue').attr('value', '')
                $('#membershipType').text('')
            }
        })
        //append product when click subcategory from pos sidebar
        $(".sub-category").on('click', function (e) {

            let sub_category_id = $(this).attr('data-value');
            // console.log(sub_category_id)
            fetch(`/order/display-product/${sub_category_id}`)
                .then(res => res.json())
                .then(res => {
                    $("#subCategoryProduct").html(res.map((product) =>
                        `<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 pb-4 ">
                                <!-- BEGIN card -->
                                <div class="card h-100 pos">
                                    <div class="card-body h-100 p-1 ">
                                    <input class="prodImage" type="text"  value="${product.image}" hidden/>
                                         <a href="#" class="pos-product" data-bs-toggle="modal" data-bs-target="#modalPosItem">` +
                        (product.image != null ?
                                `<img class="img" height="50%" src="{{asset('storage/images/product/${product.image}')}}">`
                                :
                                `<img class="img" height="50%" src="{{asset('assets/img/no-image/no-image-available.jpg')}}">`
                        ) +

                        `<div class="info">
                                    <div class="productId "><input type="text" class="proId" value="${product.title}" hidden /></div>
                                    <div class="title"> ${product.title}</div>` +

                        (product.description != null ?
                                `<div class="desc">${product.description}</div>`
                                :
                                `<div class="desc">N/A</div>`
                        ) +
                        ` <input type="text" class="item_id" value="${product.id}"  hidden/>
                                                              <div class="price">BDT ${product.price}</div>
                                                             <input type="text" class="productPrice" value="${product.price}"  hidden/>
                                                            <input class="quantityValueOnly" type="text" value="${product.quantity}" hidden/>
                                                            <div class="quantity">In Stock : ${product.quantity}  ${product.unit}</div>
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

        //append value in modal when clicking from all products
        $('.withoutSubCatClick').on('click', function (e) {

            let id = $(this).children('div').find('.itemId').val()
            let titleValue = $(this).children('div').find('.proId').val();
            let priceValue = $(this).children('div').find('.allProductsPrice').val();
            let quantity = $(this).children('div').find('.allProductsQuantity').val();

            $('.itemIdValue').attr('value', id)
            $('.product_id_value').attr('value', titleValue)
            $('.product_id_value').attr('data-value', priceValue)
            $('#product_quantity').attr('value', quantity)
        })



        var wrapper = $("#newOrderTab"); //Fields wrapper
        let x = Number($('#countOrder').attr('data-value')); //initial text box count
        //start function for Add to cart modal
        $('#cartModalButton').on('click', function (e) { //on add input button click
            $('.noOrder').hide()
            let item_id_value = $('.itemIdValue').attr('value')
            let productitle = $('.product_id_value').attr('value');
            let producPrice = ($('.product_id_value').attr('data-value'))
            let product_total_price = ($('#product_total_price').val())
            let product_quantity = Number($('#quantityValue').val())

            if (product_quantity > 0) {
                counter = 0
                $('#quantityValue').attr('value', 0)
                $('#product_total_price').attr('value', 0)
                $("#minusButton").show()
                $("#plusButton").show()

                let max_fields = 500; //maximum input boxes allowed

                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(`
                                <div class="pos-order">
                                    <div class="pos-order-product">
                                        <div class="flex-1">
                                            <input class="product_id_val" type="text" value="` + item_id_value + `" data-value="` + producPrice + `" hidden>
                                            <input class="product_title_val" type="text" value="` + productitle + `" data-value="` + product_quantity + `" hidden>
                                            <div class="h6 mb-1">` + productitle + `</div>
                                            <div class="small">Qty : ` + product_quantity + `</div>
                                            <input class="product_quantity_val" type="text" value="` + product_quantity + `" hidden>

                                            <div class="small">Unit Price : ` + producPrice + ` BDT</div>
                                            <input class="product_cart_price" type="text" id="` + x + `" value="` + product_total_price + `" hidden>
                                        </div>
                                    </div>
                                    <div class="pos-order-price" style="font-weight: bold">`+ product_total_price +` BDT</div>
                                        <div class="mb-1" >
                                            <button class="btn  btn-danger remove_field p-1" type="button" ><i class="bi bi-trash fs-20px lh-1"></i></button>
                                        </div>

                                </div>`); // add input boxes.
                    $('#countOrder').text('(' + x + ')')
                }
            } else {
                alert("Please select minimum quantity to add into the cart.");
            }


            calculate_products_price();
            let subTotal = $('#sub_total').val()

            $('#total').text(subTotal + ' BDT')
            $('#totalValue').attr('value', subTotal)
            $('#grandTotal').attr('value', subTotal)
            calculate_tax();
        });
        //remove on icon click from order card
        wrapper.on('click', '.remove_field', function (e) {

            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
            $('#countOrder').text('(' + x + ')')

            calculate_products_price();
            let subTotal = $('#sub_total').val()

            $('#total').text(subTotal)
            $('#totalValue').attr('value', subTotal)
            $('#grandTotal').attr('value', subTotal)
            calculate_tax();
        })

        var counter = 0;
        let preQty = $('#quantityValue').val()
        let givenQtyByPlus=0;

        //increasing the quantity by (+) click
        $("#plusButton").click(function () {
            let productPrice = Number($('.product_id_value').attr('data-value'))
            $("#minusButton").show()
            counter++;
            // console.log(counter)
            let quantity = Number($('#product_quantity').val())
            if (preQty > 0){
                // console.log('if')
                // $('#quantityValue').attr('value', counter);
                givenQtyByPlus = Number($('#quantityValue').val()) + 1
                $('#quantityValue').val(givenQtyByPlus);
                $('#quantityValue').attr('value',givenQtyByPlus);

                if (quantity >= givenQtyByPlus) {
                    let x = givenQtyByPlus * productPrice
                    $('#product_total_price').attr('value', x)
                } else {
                    // $('#quantityValue').attr('value', counter - 1)
                    $("#plusButton").hide()
                    alert("Can't Exceed Maximum Quantity");
                }
            }
            else {
                // counter++;
                let quantity = Number($('#product_quantity').val())
                $('#quantityValue').attr('value', counter);
                console.log(counter)
                let productPrice = Number($('.product_id_value').attr('data-value'))
                if (quantity >= counter) {
                    let x = counter * productPrice
                    $('#product_total_price').attr('value', x)
                }
            }
        });

        $('#quantityValue').on('input', function (){
            let quantity = Number($('#product_quantity').val())
            let givenQty = Number($('#quantityValue').val())
            $('#quantityValue').attr('value', givenQty)
            preQty = givenQty
            let productPrice = Number($('.product_id_value').attr('data-value'))
            if (quantity >= givenQty) {
                let x = givenQty * productPrice
                $('#product_total_price').attr('value', x)
                $("#cartModalButton").attr('disabled', false)
                $("#plusButton").show()
            } else {
                // $('#quantityValue').attr('value', counter - 1)
                $("#plusButton").hide()
                $("#cartModalButton").attr('disabled', 'disabled')
                alert("Can't Exceed Maximum Quantity");
            }

        })
        //decreasing the quantity by (-) click
        $("#minusButton").click(function () {
            $("#plusButton").show()
            let quantity = Number($('#quantityValue').val()) - 1
            if (quantity > 0) {
                $('#quantityValue').attr('value', quantity);
                $('#quantityValue').val(quantity);
                // $('#quantityValue').val(quantity)
                let productPrice = Number($('.product_id_value').attr('data-value'))
                let x = quantity * productPrice
                $('#product_total_price').attr('value', x)
            } else {
                counter = 1
                $("#minusButton").hide()
                alert("Enter Minimum Quantity");
            }
        });
        //clear value when click x on modal or cancel
        $('.modal_close').on('click', function () {
            counter = 0
            $('#quantityValue').attr('value', 0)
            $('#product_total_price').attr('value', 0)
            $("#minusButton").show()
            $("#plusButton").show()
        })


        //append value in modal when click from sub category
        $('#subCategoryProduct').on("click", ".pos", function (e) {
            e.preventDefault();
            let idValue = $(this).children('div').find('.item_id').val();
            let titleValue = $(this).children('div').find('.proId').val();
            let title = $(this).children('div').find('.title').text();
            let desc = $(this).children('div').find('.desc').text();
            let price = $(this).children('div').find('.price').text();
            let priceValue = $(this).children('div').find('.productPrice').val();
            let quantity = $(this).children('div').find('.quantityValueOnly').val();
            let image = $(this).children('div').find('.prodImage').val();


            $('.itemIdValue').attr('value', idValue)
            $('.product_id_value').attr('value', titleValue)
            $('.product_id_value').attr('data-value', priceValue)
            $('#productTitle').text(title)
            $('#product_desc').val(desc)
            $('#productDesc').text(desc)
            $('#product_price').val(price)
            $('#product_quantity').attr('value', quantity)
            $('#productPrice').text(price)
            if (image !== 'null') {
                $('#productImage').css("background-image", "url(/storage/images/product/" + image + ")")
            } else {
                $('#productImage').css("background-image", "url(/assets/img/no-image/no-image-available.jpg")
            }
        })

        //calculate product price
        function calculate_products_price() {
            let sum = 0;
            $(".product_cart_price").each(function () {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });

            $('#subTotal').text(sum + ' BDT')
            $("#sub_total").attr('value', sum);
        }
        //calculate tax
        function calculate_tax() {

            let subTotal = Number($('#sub_total').val())
            let tax = Number($('#taxInput').val())
            let tax_cal = Number(subTotal * tax / 100)

            let rounding = Number(tax_cal.toFixed())
            let roundValue = rounding - tax_cal

            let afterTax = Number(subTotal) + Number(rounding)

            $('#vatPercentage').text('(' + tax + '%' + ')')
            $('#tax').text(tax_cal + ' BDT')
            $('#taxValue').attr('value', rounding)
            $('#total').text(afterTax)
            $('#totalValue').attr('value', afterTax)
            $('#rounding').text(roundValue.toFixed(2) + ' BDT')
            calculate_membership_discount()
            calculate_discount()
            change()
        }


        //calculate discount
        function calculate_discount() {
            let total = Number($('#totalValue').val())
            let discount = Number($('#discountInput').val())
            let discount_cal = total - discount

            $('#total').text(discount_cal)
            $('#grandTotal').attr('value', discount_cal)

            if (total === 0){
                $('#total').text(0)
                $('#totalValue').attr('value', 0)
            }
            change()
        }
        //calculate change
        function change() {
            let cash = Number($('#cashCollect').val()) + Number($('#paidAmount').val())
            let grandTotal = Number($('#grandTotal').val())
            let change = cash - grandTotal
            // console.log(change)
            if (cash === 0) {
                $('#changes').text(0 + ' BDT')
            } else {
                $('#changes').text(change + ' BDT')
            }
            if (document.getElementById("cashCollect").value === "") {
                document.getElementById('submit').disabled = true;
            } else {
                document.getElementById('submit').disabled = false;
            }
            due();
        }

        function dueForMembership(){
            let cash = Number($('#cashCollect').val())
            let grandTotal = Number($('#grandTotal').val())
            let due = grandTotal - cash
            $('#showDue').text(due + ' BDT')
            $('#due').attr('value', due)
            if (cash > grandTotal) {
                $('#showDue').text(0.00 + ' BDT');
                $('#due').attr('value', 0);
            } else {
                $('#changes').text(0.00 + ' BDT');
            }
            calculate_discount()
        }

        //calculate due
        function due() {
            let cash = Number($('#cashCollect').val())
            let grandTotal = Number($('#grandTotal').val()) - Number($('#paidAmount').val())
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
        //value append in textarea when clicking submit
        // var obj = {};
        $('#submit').on('click', function () {

            let productQty = [];
            let producTitle = [];

            $('.product_title_val').each(function () {
                productQty.push($(this).attr('data-value'))
                producTitle.push($(this).val())
                $('#pro_titles').val(producTitle)
                $('#pro_qty').val(productQty)
            });
            // $(".product_title_val").each(function (title, quantity) {
            //     // $.each(data.news, function (i, news) {
            //
            //     let productTitle = $(this).attr('value');
            //     let productQuantity = $(this).attr('data-value');
            //     if(Object.values(obj).includes(obj[productTitle]) === true){
            //         let value = obj[productTitle];
            //         let y = Number(value) + Number(productQuantity)
            //         obj[productTitle] = y;
            //     }else{
            //         obj[productTitle] = productQuantity;
            //     }
            // });
            // // console.log(obj)
            // let data = JSON.stringify(obj)
            // let regexp = /[^a-zA-Z: 0-9-,]/g;
            // if (data.match(regexp)) {
            //     $('#description').val(data.replace(regexp, ' '))
            // }

            //for keeping product id array
            let productId = [];
            let productPrice = [];
            $('.product_id_val').each(function () {
                productId.push($(this).val())
                productPrice.push($(this).attr('data-value'))
                $('#pro_ids').val(productId)
                $('#unit_price').val(productPrice)
            });
        });

        function calculate_membership_discount(){
            let subTotal = Number($('#sub_total').val())
            let membershipDiscount = Number($('#membershipDiscountPercentage').val())
            let calculatedDiscount = Number(subTotal * membershipDiscount / 100).toFixed()
            let afterTax =  Number($('#totalValue').val())
            let membershipDiscount_cal = afterTax - calculatedDiscount

            $('#membershipDiscount').text(calculatedDiscount + ' BDT')
            $('#membershipDiscountValue').attr('value',calculatedDiscount)
            $('#total').text(membershipDiscount_cal)
            $('#totalValue').attr('value', membershipDiscount_cal)
            $('#grandTotal').attr('value', membershipDiscount_cal)
            dueForMembership()

            if (total === 0){
                $('#total').text(0)
                $('#grandTotal').attr('value', 0)
            }
        }
    </script>
@endpush
