@extends('layouts.order')
@section('content')
    <div id="content" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">
        @if(session('success'))
            <x-alert type="success" message="{{session('success')}}"></x-alert>
        @endif
        <div class="card h-100">
            <div class="card-body p-2" style="overflow:hidden">
                <div class="row">
                    <form id="createForm " method="POST" action="{{route('order.pos.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row" data-scrollbar="true" data-height="100%">
                            <div class="col-md-8" style="border-right: solid 1px white" >
                                <div class="d-flex align-items-center mb-4 row form-group ">
                                    <div class="logo col-sm-3 col-md-1 mt-2">
                                     <span class="menu-icon">
                                        <a href="{{route('order.pos.index')}}"
                                           class="btn btn-outline-theme btn-md active  mb-2"> <i
                                                class="fas fa-angle-double-left ml-5 text-black"></i></a>
                                     </span>
                                    </div>
                                    <div class="flex-1 text-end h6 mb-0 input-group text-wrap col-sm-9">
                                        <input type="text" class="form-control bg-white text-black" name="bar_code"
                                               autofocus="autofocus"  id="barcode" placeholder="Click Here Before Scanning The Barcode">
                                        <span class="input-group-text"><small><i
                                                    class="bi bi-search"></i></small></span>
                                    </div>
                                </div>
                                <h4 class="text-center" style="border:solid 1px white">Order List <span id="countOrder"></span></h4>

                                <div class="d-flex mt-3" style="border-bottom: 1px solid white">
                                    <h6  style="width: 24%" class="text-center">Name</h6>
                                    <h6  style="width: 15%" class="ms-2 text-center">Available<span class=""><small> (In PC)</small></span></h6>
                                    <h6  style="width: 15%" class="ms-2 text-center">Unit Price<span class=""><small> (BDT)</small></span></h6>
                                    <h6  style="width: 15%" class="ms-2 text-center">Quantity<span class=""><small> (In PC)</small></span></h6>
                                    <h6  style="width: 15%" class="ms-2 text-center">Amount<span class=""><small> (BDT)</small></span></h6>
                                    <h6  style="width: 10%" class="ms-4 text-center">Action</h6>
                                </div>
                                <!-- BEGIN #newOrderTab -->
                                <div class="" id="newOrderTab" data-scrollbar="true" data-height="70vh"  style="overflow-x: hidden"></div>
                                <!-- END #newOrderTab -->
                            </div>


                            <div class="col-md-4" >
                                <div class="pos-sidebar" id="pos-sidebar" >
                                    <!-- BEGIN pos-sidebar-nav -->
                                    <div class="pos-sidebar-nav">
                                        <ul class="nav nav-tabs nav-fill p-0">
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
                                    <div class="pos-sidebar-body tab-content"  data-scrollbar="true" data-height="100%">
                                        <!-- BEGIN #orderHistoryTab -->

                                        <!-- Start Customer Information -->
                                        <div class="tab-pane fade h-100" id="orderHistoryTab">
                                            <div class="h-100  align-items-center justify-content-center text-center">
                                                <div class="d-flex align-items-center mb-2 row form-group">
                                                    <div class="col-md-3 ml-2">Phone No</div>
                                                    <div class="flex-1 text-end h6 mb-0 col-md-9 input-group mt-2">
                                                        <span class="input-group-text">+88</span>
                                                        <input type="text" class="form-control mr-5" name="phone_number" placeholder="type number to search"
                                                               id="customer_phone" value="" style="max-width: 75%" >
                                                    </div>
                                                    <span class="text-danger ms-4">@error('phone_number'){{ $message }}@enderror</span>
                                                </div>
                                                <div class="d-flex align-items-center mb-2 row form-group">
                                                    <div class="col-md-3 ml-2">NickName</div>
                                                    <div class="flex-1 text-end h6 mb-0 col-md-9 input-group mt-2">
                                                        <input type="text" class="form-control mr-5" name="nickname"
                                                               id="customer_name" value="" style="max-width: 92%" >
                                                    </div>
                                                    <span class="text-danger">@error('nickname'){{ $message }}@enderror</span>
                                                </div>

                                                <div class="row mt-1">
                                                    <label for="" class="mt-3" style="width: 38%">Membership Type</label>
                                                    <div class="col-md-6 mt-3">
                                                        <span class="float-right badge border border-theme text-light" id="membershipType" style="text-decoration: none;font-size: 13px">N/A</span>
                                                    </div>
                                                </div>

                                                <input type="text" id="customer_id" value="" name="customer_id"
                                                       style="max-width: 95%" hidden>
                                            </div>

                                        </div>
                                        <!-- END #orderHistoryTab -->
                                        <!-- End Customer Information -->

                                        <!-- BEGIN #accountTab -->
                                        <!-- Start Calculation -->
                                        <div class="tab-pane show active"  id="accountTab">
                                            <div class="h-100  align-items-center justify-content-center form-group p-2 mt-2 ">
                                                <div class="d-flex align-items-center mb-2 row form-group">
                                                    <div class="col-md-3">VAT</div>
                                                    <div class="flex-1 text-end h6 mb-0 col-md-9 input-group flex-nowrap">
                                                        <input type="text" class="form-control" name="tax_percentage" id="taxInput" oninput="calculate_tax()"
                                                               value="0">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-2 row form-group ">
                                                    <div class="col-md-3">Discount</div>
                                                    <div class="flex-1 text-end h6 mb-0 col-md-9 input-group text-wrap  ">
                                                        <input type="text" class="form-control" id="discountInput"
                                                               oninput="calculate_discount()" value="0">
                                                        <span class="input-group-text"><small>BDT</small></span>
                                                    </div>
                                                </div>
                                                <div><input type="text" id="allOverDiscount" name="discount" value="0" hidden></div>
                                                <div class="d-flex align-items-center mb-2 row form-group ">
                                                    <div class="col-md-3">Cash Paid</div>
                                                    <div class="flex-1 text-end h6 mb-0 col-md-9 input-group text-wrap">
                                                        <input type="text" class="form-control" name="cash" id="cashCollect" value=""
                                                               oninput="change()">
                                                        <span class="input-group-text"><small>BDT</small></span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-2 row form-group ">
                                                    <div class="col-md-3" style="font-size: 13px">Due Pay Date</div>
                                                    <div class="flex-1 text-end h6 mb-0 col-md-9 input-group text-wrap">
                                                        <input type="date" class="form-control" name="due_payment_date" id="due_payment_date" value="">
                                                    </div>
                                                </div>

                                                <div class="mb-3 mt-3" style="border-top: 1px solid rgba(255, 255, 255, .3); margin-top: 3px"></div>
                                                <div class="d-flex align-items-center mb-1" style="font-size: 12px">
                                                    <div>Subtotal</div>
                                                    <div class="flex-1 text-end h6 mb-0" id="subTotal">0.00</div>
                                                    <input type="text" name="total" id="sub_total" value="" hidden>
                                                </div>

                                                <div class="d-flex align-items-center mb-1" style="font-size: 12px">
                                                    <div>Membership Discount @ <span id="memberDiscount"></span></div>
                                                    <div class="flex-1 text-end h6 mb-0" id="membershipDiscount">0.00</div>
                                                    <input type="text" name="membership_discount_percentage"  id="membershipDiscountPercentage" value="0" hidden>
                                                    <input type="text" name="membership_discount" id="membershipDiscountValue" value="0" hidden>
                                                </div>

                                                <div class="d-flex align-items-center mb-1" style="font-size: 12px;">
                                                    <input class="form-control" type="text" value="" id="offerOnOrderDiscount"  hidden>
                                                    <div class="blinkForOrderAmount" id="onOrder">Offer On Order Amount </div>
                                                    <div class="flex-1 text-end h6 mb-0 blinkForOrderAmount" id="offerOnOrderDisc" >0.00</div>
                                                </div>

                                                <div class="d-flex align-items-center mb-1" style="font-size: 12px">
                                                    <input type="text" id="buyGetDiscount" value="0" hidden>
                                                    <div id="onBuyGet" class="blinkForBuyGet">Offer on BUY & GET</div>
                                                    <div class="flex-1 text-end h6 mb-0 blinkForBuyGet" id="buyGetDisc" >0.00</div>
                                                </div>
                                                <div class="d-flex align-items-center mb-1" style="font-size: 12px">
                                                    <input type="text" id="flatDiscount" value="0" hidden>
                                                    <div id="flat" class="blink">Flat Discount</div>
                                                    <div class="flex-1 text-end h6 mb-0 blink" id="flatDisc">0.00</div>
                                                </div>

                                                <div class="d-flex align-items-center mb-1" style="font-size: 12px">
                                                    <input type="text" class="form-control" name="tax" id="taxValue" value="0" hidden>
                                                    <div>VAT @ <span id="vatPercentage"></span></div>
                                                    <div class="flex-1 text-end h6 mb-0" id="tax">0.00</div>
                                                </div>
                                                <div class="d-flex align-items-center mb-1" style="font-size: 12px">
                                                    <div>Rounding (+/-)</div>
                                                    <div class="flex-1 text-end h6 mb-0" id="rounding">0.00</div>
                                                </div>
                                                <div class="d-flex align-items-center mb-1" style="font-size: 12px">
                                                    <div>Changes</div>
                                                    <div class="flex-1 text-end h6 mb-0" id="changes">0.00</div>
                                                </div>
                                                <div class="d-flex align-items-center" style="font-size: 12px">
                                                    <div>Due</div>
                                                    <div class="flex-1 text-end h6 mb-0" id="showDue">0.00</div>
                                                    <input type="text" class="form-control" name="due" id="due" value="0" hidden>
                                                </div>
                                                <hr/>
                                                <div class="d-flex align-items-center mb-2">
                                                    <input type="text" class="form-control"  id="totalValue" value="" hidden>
                                                    <h5>Total Payable</h5>
                                                    <div class="flex-1 text-end h4 mb-0" id="total">0.00</div>
                                                    <span class="text-end h4 mb-0  p-1">BDT</span>
                                                    <input type="text" class="form-control"  name="net_total" id="grandTotal" value=""  hidden>
                                                </div>

                                                <input type="text" class="form-control" name="user_id"
                                                       value="{{auth()->user()->id}}" readonly hidden>
                                                <input id="pro_ids" name="pro_id[]" type="text" value="" hidden/>
                                                <input class="product_price_val" id="unit_price" name="unit_price[]" type="text" value="" hidden>
                                                <input id="pro_qty" name="pro_qty[]" type="text" value="" hidden/>
                                                <input id="pro_titles" name="pro_title[]" type="text" value="" hidden/>
                                                {{--                                                <div class="mt-2">--}}
                                                <div class="login-box">
                                                    <button type="submit" class="btn rounded-2" id="submit" disabled>
                                                        Submit Order
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                        <i class="bi bi-sd-card-fill fa-lg"></i>
                                                        <button class="btn rounded-1 w-150" disabled></button>
                                                    </button>
                                                </div>

                                                {{--                                                    <div class="btn-group d-flex">--}}
                                                {{--                                                        <button type="submit" class="btn btn-outline-theme rounded-0 w-150px"--}}
                                                {{--                                                                id="submit" disabled>--}}
                                                {{--                                                            <i class="bi bi-send-check fa-lg"></i><br/>--}}
                                                {{--                                                            <span class="small">Submit Order</span>--}}
                                                {{--                                                        </button>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>

                                        <!-- END #accountTab -->
                                        <!-- End Calculation -->
                                    </div>

                                    <!-- END pos-sidebar-body -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <x-card-border></x-card-border>
        </div>
    </div>



@endsection
@push('customScripts')
    <script src="{{asset('assets/js/jqueryUI/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            //function for right sidebar active
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
                $("#membershipType").text(ui.item.membershipType);
                $("#membershipDiscountPercentage").attr('value',ui.item.membershipDiscount);
                $('#memberDiscount').text('(' + ui.item.membershipDiscount + '%' + ')')
                if($('#membershipDiscountPercentage').val() !== 0){
                    // calculate_membership_discount()
                    calculate_tax()
                }
                return false;
            }
        });

        $(":input").keypress(function(event){
            if (event.which == '10' || event.which == '13') {
                event.preventDefault();
            }
        });
        var wrapper = $("#newOrderTab"); //Fields wrapper
        let x = 0; //initial text box count
        let inOrderOffer=0;
        let maxOrderAmount=0;
        let percentageCal = 0;
        let offerOn=''
        let dataClone=[''];                     //cloning for buy & get offer
        let z = 500;                            //taking this variable for making an unique id which is product is cloned for BUY & GET offer
        let count =0;                           //counting to remove access row for buy & get offer
        let totalFlatDiscount=0;                //summation all flat discount & product wise discount amount
        $("#barcode").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('order.searchProduct')}}",
                    type: 'get',
                    dataType: "json",
                    data: {
                        search: request.term         //search = key
                    },
                    success: function (data) {
                        dataClone.push(data)
                        let max_fields = 500; //maximum input boxes allowed
                        // e.preventDefault();
                        if (x < max_fields) { //max input box allowed
                            x++; //text box increment
                            $(wrapper).append(`
                                <div class="pos-order" style="padding: 5px">
                                    <div class="pos-order-product row mt-2">
                                        <div class="w-100 d-flex">
                                            <input class="product_id_val" id="product_id_val-${x}" type="text"  value="` + data[0].id + `" data-value="` + data[0].price + `"  hidden>
                                             <div class=" form-group " style="width: 24%">
                                                    <input class="form-control product_title_val" type="text" value="` + data[0].title + `" >
                                            </div>
                                            <div class=" ms-3 form-group " style="width: 15%">
                                                   <input type="text" id="product_quantity-${x}" class="form-control" value="` + data[0].quantity + `"  readonly>
                                            </div>
                                            <div class=" ms-3 form-group " style="width: 15%">
                                                   <input type="text" class="form-control" id="unitPrice-${x}" value="` + data[0].price + `" readonly>
                                            </div>
                                            <div class=" ms-3 form-group " style="width: 15%">
                                                   <input class="form-control product_quantity_val" id="quantityValue-${x}" type="text" value="1">
                                            </div>
                                            <div class=" ms-4 form-group" style="width: 15%">
                                                 <input class="form-control product_cart_price" type="text" value="" id="perProductPrice-${x}" data-flat="`+ data[0].offer_type +`" data-flatAfterDiscount="`+ data[0].after_discount +`" data-buyqty="`+ data[0].buy_quantity +`" data-getqty="`+ data[0].get_quantity +`" data-discount="` + data[0].discount_amount + `" data-value="` + data[0].highest_discount + `" data-order="`+ data[0].order_amount +`" data-offerOn="`+ data[0].offer_on +`" readonly>
                                            </div>
                                             <div class="mt-1 ms-3 text-center"  style="width: 10%">
                                                   <button class="btn  btn-danger remove_field p-0 pt-1" type="button" ><i class="bi bi-trash fs-20px lh-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`)
                            // if (Object.keys(data[0]).length)

                            // add input boxes.
                            let y = $('.pos-order').length;
                            $('#countOrder').text('(' + y + ')')
                            $("#barcode").val("")

                            let getQuantity=0;
                            let getQuantitySum=0;

                            //when default quantity 1
                            $('.product_quantity_val').ready(function () {
                                let field_id = "quantityValue-"+x
                                let id = field_id.split("-", 2)
                                let index_no = id[1]
                                let productId = $('#product_id_val-' +index_no).val()
                                let hasQuantity = Number($('#product_quantity-' +index_no).val())
                                let quantity =  Number($('#quantityValue-' + index_no).val())
                                let buyQuantity = Number($('#perProductPrice-' + index_no).attr('data-buyqty'))
                                if(quantity > buyQuantity && quantity % buyQuantity === 0){
                                    getQuantity = quantity/buyQuantity;
                                }else {
                                    getQuantity = Number($('#perProductPrice-' + index_no).attr('data-getqty'))
                                }
                                let price = Number($("#unitPrice-" + index_no).attr('value'))
                                if (hasQuantity >= quantity) {
                                    let total = quantity * price
                                    $("#perProductPrice-" + index_no).val(total)
                                    calculate_products_price();
                                    let subTotal = $('#sub_total').val()
                                    $('#total').text(subTotal)
                                    $('#totalValue').attr('value', subTotal)
                                    $('#grandTotal').attr('value', subTotal)
                                    $(".product_cart_price").attr('disabled', false)
                                    calculate_tax();

                                    // when products has flat or product wise offer//
                                    if ($('#perProductPrice-' + index_no).attr('data-flat') === 'FLAT' || $('#perProductPrice-' + index_no).attr('data-flat') === 'PRODUCT_WISE'){
                                        let flatDiscountAmount = $('#perProductPrice-' + index_no).attr('data-flatAfterDiscount')
                                        totalFlatDiscount+=Number(flatDiscountAmount)
                                        $('#flatDisc').text(totalFlatDiscount + ' BDT')
                                        $('#flatDiscount').attr('value', totalFlatDiscount)
                                        calculate_tax()
                                        if ($('#flatDiscount').val() !== '0'){
                                            $('#flat').css("color", "yellow")
                                            $('#flatDisc').css("color", "yellow")
                                            $('.blink').each(function() {
                                                var elem = $(this);
                                                var count = 1;
                                                var intervalId = setInterval(function() {
                                                    if (elem.css('visibility') == 'hidden') {
                                                        elem.css('visibility', 'visible');
                                                        if (count++ === 3) {
                                                            clearInterval(intervalId);
                                                        }
                                                    } else {
                                                        elem.css('visibility', 'hidden');
                                                    }
                                                }, 150);
                                            });
                                        }
                                    }

                                    //which has BUY & GET offer
                                    if($('#perProductPrice-' + index_no).attr('data-buyqty') !== 'undefined'){
                                        if(quantity === buyQuantity || quantity % buyQuantity === 0 && quantity !== 0){
                                            count++
                                            z++;
                                            wrapper.append(`
                                                <div class="po" style="padding: 5px">
                                                    <div class="pos-order-product row mt-2">
                                                        <div class="w-100 d-flex">
                                                            <input class="product_id_val" type="text" id="forRemove-${productId}"  value="` + dataClone[index_no][0].id + `" data-value="` + dataClone[index_no][0].price + `"  hidden>
                                                             <div class=" form-group " style="width: 24%">
                                                                    <input class="form-control product_title_val" type="text" value="` + dataClone[index_no][0].title + `" >
                                                            </div>
                                                            <div class=" ms-3 form-group " style="width: 15%">
                                                                   <input type="text" id="clone_product_quantity-${z}" class="form-control" value="` + dataClone[index_no][0].quantity + `"  readonly>
                                                            </div>
                                                            <div class=" ms-3 form-group " style="width: 15%">
                                                                   <input type="text" class="form-control" id="cloneUnitPrice-${z}" value="` + dataClone[index_no][0].price + `" readonly>
                                                            </div>
                                                            <div class=" ms-3 form-group " style="width: 15%">
                                                                   <input class="form-control product_quantity_val buyGet" id="cloneQuantityValue-${z}" type="text" value="${getQuantity}" readonly>
                                                            </div>
                                                            <div class=" ms-4 form-group" style="width: 15%">
                                                                 <input class="form-control product_cart_price buyGetOffer" type="text" value="" id="clonePerProductPrice-${z}" data-buyqty="`+ dataClone[index_no][0].buy_quantity +`" data-getqty="`+ dataClone[index_no][0].get_quantity +`" data-discount="` + dataClone[index_no][0].discount_amount + `" data-value="` + dataClone[index_no][0].highest_discount + `" data-order="`+ dataClone[index_no][0].order_amount +`" data-offerOn="`+ dataClone[index_no][0].offer_on +`" readonly>
                                                            </div>
                                                            <div class="ms-3 text-center"  style="width: 10%; font: bold; color: greenyellow; font-size: 10px">
                                                                   <small>PRODUCT FROM BUY & GET OFFER </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>`)

                                            $('.buyGet').ready(function () {
                                                let field_id = "cloneQuantityValue-"+z
                                                let id = field_id.split("-", 2)
                                                let index_no = id[1]
                                                let quantity = $('#cloneQuantityValue-'+ index_no).val()
                                                let price = $("#cloneUnitPrice-" + index_no).attr('value')
                                                let total = quantity * price
                                                $("#clonePerProductPrice-" + index_no).val(total)

                                                calculate_products_price();
                                                let subTotal = $('#sub_total').val()
                                                $('#total').text(subTotal)
                                                $('#totalValue').attr('value', subTotal)
                                                $('#grandTotal').attr('value', subTotal)

                                                $(".buyGetOffer").each(function () {
                                                    if (!isNaN(this.value) && this.value.length != 0) {
                                                        getQuantitySum += parseFloat(this.value);
                                                        $('#buyGetDiscount').attr('value',getQuantitySum )
                                                        $('#buyGetDisc').text(getQuantitySum + ' BDT')
                                                    }
                                                });
                                                //change color
                                                if ($('#buyGetDiscount').val() !== '0'){
                                                    $('#onBuyGet').css("color", "yellow")
                                                    $('#buyGetDisc').css("color", "yellow")

                                                    $('.blinkForBuyGet').each(function() {
                                                        var elem = $(this);
                                                        var count = 1;
                                                        var intervalId = setInterval(function() {
                                                            if (elem.css('visibility') == 'hidden') {
                                                                elem.css('visibility', 'visible');
                                                                if (count++ === 3) {
                                                                    clearInterval(intervalId);
                                                                }
                                                            } else {
                                                                elem.css('visibility', 'hidden');
                                                            }
                                                        }, 150);
                                                    });
                                                }
                                                calculate_tax();
                                            })
                                        }
                                    }

                                    //when already product prices exceeds maximum order amount before appending without offer product
                                    if ($("#perProductPrice-" + index_no).attr('data-order') === 'undefined' && inOrderOffer > maxOrderAmount){
                                        if (offerOn === 'PERCENTAGE'){
                                            let afterOffer = Number(subTotal) - Number(percentageCal)
                                            $('#total').text(afterOffer)
                                            $('#totalValue').attr('value', afterOffer)
                                            $('#grandTotal').attr('value', afterOffer)
                                            $('#offerOnOrderDisc').text(percentageCal + ' BDT')
                                            $('#offerOnOrderDiscount').attr('value',percentageCal)
                                            calculate_tax()
                                        }else {
                                            let afterOffer = Number(subTotal) - Number($(".offerOnOrder").attr('data-value'))
                                            $('#total').text(afterOffer)
                                            $('#totalValue').attr('value', afterOffer)
                                            $('#grandTotal').attr('value', afterOffer)
                                            $('#offerOnOrderDisc').text($(".offerOnOrder").attr('data-value') + ' BDT')
                                            $('#offerOnOrderDiscount').attr('value',$(".offerOnOrder").attr('data-value'))
                                            calculate_tax()
                                        }
                                    }
                                    //when product has offer on order amount only
                                    if ($("#perProductPrice-" + index_no).attr('data-order') !== 'undefined'){
                                        offerOn = $("#perProductPrice-" + index_no).attr('data-offeron')
                                        maxOrderAmount= $("#perProductPrice-" + index_no).attr('data-order')
                                        $("#perProductPrice-" + index_no).addClass('offerOnOrder')
                                        $("#perProductPrice-" + index_no).each(function () {
                                            if (!isNaN(this.value) && this.value.length !== 0) {
                                                inOrderOffer = Number(inOrderOffer) + parseFloat(this.value);
                                                if (inOrderOffer > maxOrderAmount){
                                                    offerOnOrder();
                                                    calculate_tax();
                                                }
                                            }
                                        })
                                    }
                                } else {
                                    alert("Can't Exceed Maximum Quantity");
                                    $(".product_cart_price").attr('disabled', 'disabled')
                                }
                            })
                        }
                    },
                });
            },
        });
        console.log(inOrderOffer)


        wrapper.on('click', '.remove_field', function (e) {
            let newSum=0
            let getQuantitySum=0;
            e.preventDefault();
            //removed which has flat or product wise offer//
            if($(this).parent('div').prev('div').children('input').attr('data-flatAfterDiscount') !== 'undefined'){
                let flatDiscountAmount = $(this).parent('div').prev('div').children('input').attr('data-flatAfterDiscount')
                totalFlatDiscount -= Number(flatDiscountAmount)
                $('#flatDisc').text(totalFlatDiscount + ' BDT')
                $('#flatDiscount').attr('value', totalFlatDiscount)
                calculate_tax()
                //change color//
                if ($('#flatDiscount').val() === '0'){
                    $('#flat').css("color", "#ffffffbf")
                    $('#flatDisc').css("color", "#ffffffbf")
                }
            }

            //when removing actual product also removing corresponding product which has get offer depends on buy quantity
            let productId= $(this).parent('div').parent('div').children('input').val()
            if ($(this).parent('div').prev('div').children('input').attr('data-buyqty') !== 'undefined'){
                $('#forRemove-' + productId).parent('div').parent('div').parent('div').remove()
                $(".buyGetOffer").each(function () {
                    if (!isNaN(this.value) && this.value.length != 0) {
                        getQuantitySum += parseFloat(this.value);
                        $('#buyGetDiscount').attr('value',getQuantitySum )
                        $('#buyGetDisc').text(getQuantitySum + ' BDT')
                    }
                })
                if($(".buyGetOffer").length === 0){
                    $('#buyGetDiscount').attr('value',0 )
                    $('#buyGetDisc').text(0+ ' BDT')
                }
                calculate_tax()
                if ($('#buyGetDiscount').val() === '0'){
                    $('#onBuyGet').css("color", "#ffffffbf")
                    $('#buyGetDisc').css("color", "#ffffffbf")
                }
            }
            $(this).parent('div').parent('div').parent('div').parent('div').remove();

            let y = $('.pos-order').length;
            $('#countOrder').text('(' + y + ')')

            calculate_products_price();
            //new
            $(".offerOnOrder").each(function () {
                newSum += parseFloat(this.value);
            })
            //calculation after remove which has offer on order amount
            if ($(this).closest('div').prev('div').children('input').hasClass('offerOnOrder')){
                let subTotal = $('#sub_total').val()
                // if (newSum < inOrderOffer){
                if (newSum > maxOrderAmount ){
                    let afterPer=0;
                    let orderSum=0;
                    let offerOn = $(".offerOnOrder").attr('data-offeron')
                    let highestDis = Number($(".offerOnOrder").attr('data-value'))

                    $(".offerOnOrder").each(function () {
                        orderSum += parseFloat(this.value);
                        if (offerOn === 'PERCENTAGE'){
                            let per= $(".offerOnOrder").attr('data-discount')
                            afterPer= (orderSum * per /100).toFixed()
                        }else {
                            afterPer = $(".offerOnOrder").attr('data-discount')

                        }
                    })
                    let newGrandTotal=0;
                    if (afterPer > highestDis){
                        newGrandTotal = subTotal - highestDis
                    }else{
                        newGrandTotal = subTotal - afterPer
                    }
                    $('#total').text(newGrandTotal)
                    $('#totalValue').attr('value', newGrandTotal)
                    $('#grandTotal').attr('value', newGrandTotal)
                    $('#memberDiscount').text('(' + 0 + '%' + ')')
                    $('#offerOnOrderDisc').text(afterPer + ' BDT')
                    $('#offerOnOrderDiscount').attr('value',afterPer)

                    // calculate_membership_discount()
                    calculate_tax();
                }else {
                    $('#total').text(subTotal)
                    $('#totalValue').attr('value', subTotal)
                    $('#grandTotal').attr('value', subTotal)
                    $('#memberDiscount').text('(' + 0 + '%' + ')')
                    $('#offerOnOrderDisc').text(0 + ' BDT')
                    $('#offerOnOrderDiscount').attr('value',0)

                    // calculate_membership_discount()
                    calculate_tax();
                }
                if ($('#offerOnOrderDiscount').val() === '0'){
                    $('#onOrder').css("color", "#ffffffbf")
                    $('#offerOnOrderDisc').css("color", "#ffffffbf")
                }
                // }
            }else {
                if (newSum < maxOrderAmount){
                    let subTotal = $('#sub_total').val()
                    $('#total').text(subTotal)
                    $('#totalValue').attr('value', subTotal)
                    $('#grandTotal').attr('value', subTotal)
                    $('#memberDiscount').text('(' + 0 + '%' + ')')
                    $('#offerOnOrderDisc').text(0 + ' BDT')
                    $('#offerOnOrderDiscount').val(0)
                    calculate_tax();
                }else {
                    let subTotal = $('#sub_total').val()
                    let afterPer=0;
                    let orderSum=0;
                    let offerOn = $(".offerOnOrder").attr('data-offeron')
                    let highestDis = Number($(".offerOnOrder").attr('data-value'))
                    $(".offerOnOrder").each(function () {
                        orderSum += parseFloat(this.value);
                        if (offerOn === 'PERCENTAGE'){
                            let per= $(".offerOnOrder").attr('data-discount')
                            afterPer= (orderSum * per /100).toFixed()
                        }else {
                            afterPer = $(".offerOnOrder").attr('data-discount')
                        }
                    })
                    let newGrandTotal=0;
                    if (afterPer > highestDis){
                        newGrandTotal = subTotal - highestDis
                        $('#offerOnOrderDiscount').attr('value',highestDis)
                    }else{
                        newGrandTotal = subTotal - afterPer
                        $('#offerOnOrderDiscount').attr('value',afterPer)
                    }

                    $('#total').text(newGrandTotal)
                    $('#totalValue').attr('value', newGrandTotal)
                    $('#grandTotal').attr('value', newGrandTotal)
                    $('#memberDiscount').text('(' + 0 + '%' + ')')

                    // calculate_membership_discount()
                    //change color//
                    if ($('#offerOnOrderDiscount').val() === '0'){
                        $('#onOrder').css("color", "#ffffffbf")
                        $('#offerOnOrderDisc').css("color", "#ffffffbf")
                    }
                    calculate_tax();
                }
            }
            if($('.offerOnOrder').length === 0){
                inOrderOffer=0;
            }
        })

        $("#newOrderTab").on("input", ".product_quantity_val", function (e) {
            let getQuantity=0;
            let getQuantitySum=0;

            let field_id = $(this).attr('id')
            let id = field_id.split("-", 2)
            let index_no = id[1]

            let productId = $('#product_id_val-' +index_no).val()
            let hasQuantity = Number($('#product_quantity-' +index_no).val())
            let quantity = Number($('#quantityValue-' + index_no).val())
            let buyQuantity = Number($('#perProductPrice-' + index_no).attr('data-buyqty'))

            if(quantity > buyQuantity && quantity % buyQuantity === 0){
                getQuantity = quantity/buyQuantity;
            }else {
                getQuantity = Number($('#perProductPrice-' + index_no).attr('data-getqty'))
            }

            let price = $("#unitPrice-" + index_no).attr('value')
            if (hasQuantity >= quantity) {
                let total = quantity * price
                $("#perProductPrice-" + index_no).val(total)
                // $("#perProductPrice-" + index_no).attr('value', total)
                calculate_products_price();
                let subTotal = $('#sub_total').val()
                $('#total').text(subTotal)
                $('#totalValue').attr('value', subTotal)
                $('#grandTotal').attr('value', subTotal)
                $(".product_cart_price").attr('disabled', false)

                calculate_tax();

                //which has BUY & GET offer
                if($('#perProductPrice-' + index_no).attr('data-buyqty') !== 'undefined'){
                    if(quantity === buyQuantity || quantity % buyQuantity === 0 && quantity !== 0){
                        count++
                        if(count > 1){
                            //to remove the exact clone div which original product quantity changed//
                            $('#forRemove-' + productId).parent('div').parent('div').parent('div').remove()
                            calculate_tax()
                        }
                        z++;
                        wrapper.append(`
                                <div class="po" style="padding: 5px">
                                    <div class="pos-order-product row mt-2">
                                        <div class="w-100 d-flex">
                                            <input class="product_id_val" type="text" id="forRemove-${productId}"  value="` + dataClone[index_no][0].id + `" data-value="` + dataClone[index_no][0].price + `"  hidden>
                                             <div class=" form-group " style="width: 24%">
                                                    <input class="form-control product_title_val" type="text" value="` + dataClone[index_no][0].title + `" >
                                            </div>
                                            <div class=" ms-3 form-group " style="width: 15%">
                                                   <input type="text" id="clone_product_quantity-${z}" class="form-control" value="` + dataClone[index_no][0].quantity + `"  readonly>
                                            </div>
                                            <div class=" ms-3 form-group " style="width: 15%">
                                                   <input type="text" class="form-control" id="cloneUnitPrice-${z}" value="` + dataClone[index_no][0].price + `" readonly>
                                            </div>
                                            <div class=" ms-3 form-group " style="width: 15%">
                                                   <input class="form-control product_quantity_val buyGet" id="cloneQuantityValue-${z}" type="text" value="${getQuantity}" readonly>
                                            </div>
                                            <div class=" ms-4 form-group" style="width: 15%">
                                                 <input class="form-control product_cart_price buyGetOffer" type="text" value="" id="clonePerProductPrice-${z}" data-buyqty="`+ dataClone[index_no][0].buy_quantity +`" data-getqty="`+ dataClone[index_no][0].get_quantity +`" data-discount="` + dataClone[index_no][0].discount_amount + `" data-value="` + dataClone[index_no][0].highest_discount + `" data-order="`+ dataClone[index_no][0].order_amount +`" data-offerOn="`+ dataClone[index_no][0].offer_on +`" readonly>
                                            </div>
                                            <div class="ms-3 text-center"  style="width: 10%; font: bold; color: greenyellow; font-size: 10px">
                                                   <small>PRODUCT FROM BUY & GET OFFER </small>

                                            </div>
                                        </div>
                                    </div>
                                </div>`)

                        $('.buyGet').ready(function () {
                            let field_id = "cloneQuantityValue-"+z
                            let id = field_id.split("-", 2)
                            let index_no = id[1]
                            let quantity = $('#cloneQuantityValue-'+ index_no).val()
                            let price = $("#cloneUnitPrice-" + index_no).attr('value')

                            let total = quantity * price
                            $("#clonePerProductPrice-" + index_no).val(total)

                            calculate_products_price();
                            let subTotal = $('#sub_total').val()
                            $('#total').text(subTotal)
                            $('#totalValue').attr('value', subTotal)
                            $('#grandTotal').attr('value', subTotal)

                            $(".buyGetOffer").each(function () {
                                if (!isNaN(this.value) && this.value.length != 0) {
                                    getQuantitySum += parseFloat(this.value);
                                    $('#buyGetDiscount').attr('value',getQuantitySum )
                                    $('#buyGetDisc').text(getQuantitySum + ' BDT')
                                }
                            });
                            calculate_tax();

                            //change color//
                            if ($('#buyGetDiscount').val() !== '0'){
                                $('#onBuyGet').css("color", "yellow")
                                $('#buyGetDisc').css("color", "yellow")
                                $('.blinkForBuyGet').each(function() {
                                    var elem = $(this);
                                    var count = 1;
                                    var intervalId = setInterval(function() {
                                        if (elem.css('visibility') == 'hidden') {
                                            elem.css('visibility', 'visible');
                                            if (count++ === 3) {
                                                clearInterval(intervalId);
                                            }
                                        } else {
                                            elem.css('visibility', 'hidden');
                                        }
                                    }, 150);
                                });
                            }
                        })
                    }
                }
                //which has offer on order amount
                if ($("#perProductPrice-" + index_no).attr('data-order') !== 'undefined' ){
                    maxOrderAmount= $("#perProductPrice-" + index_no).attr('data-order')
                    $("#perProductPrice-" + index_no).addClass('offerOnOrder')
                    inOrderOffer=0;
                    $(".offerOnOrder").each(function (){
                        inOrderOffer += parseFloat(this.value)
                    })

                    if (!isNaN(inOrderOffer) && inOrderOffer.length !== 0) {
                        if (inOrderOffer > maxOrderAmount){
                            let subTotal = $('#sub_total').val()
                            let offerOn = $("#perProductPrice-" + index_no).attr('data-offerOn')
                            let discount = Number($("#perProductPrice-" + index_no).attr('data-value'))

                            if (offerOn === 'PERCENTAGE'){
                                let afterOffer=0;
                                let offerPercentage = Number($("#perProductPrice-" + index_no).attr('data-discount'))
                                percentageCal = Number((offerPercentage * inOrderOffer / 100).toFixed())
                                if (percentageCal > discount){
                                    afterOffer = subTotal - discount
                                    $('#offerOnOrderDisc').text(discount + ' BDT')
                                    $('#offerOnOrderDiscount').attr('value',discount)
                                }else{
                                    afterOffer = subTotal - percentageCal
                                    $('#offerOnOrderDisc').text(percentageCal + ' BDT')
                                    $('#offerOnOrderDiscount').attr('value',percentageCal)
                                }
                                $('#total').text(afterOffer)
                                $('#totalValue').attr('value', afterOffer)
                                $('#grandTotal').attr('value', afterOffer)

                            }else {
                                let offerAmount = Number($("#perProductPrice-" + index_no).attr('data-discount'))
                                let afterOffer = subTotal - offerAmount
                                $('#total').text(afterOffer)
                                $('#totalValue').attr('value', afterOffer)
                                $('#grandTotal').attr('value', afterOffer)
                                $('#offerOnOrderDisc').text(offerAmount + ' BDT')
                                $('#offerOnOrderDiscount').attr('value',offerAmount)
                            }
                            calculate_tax()
                        }else{
                            $('#offerOnOrderDisc').text(0 + ' BDT')
                            $('#offerOnOrderDiscount').attr('value',0)
                            calculate_tax()
                        }

                        //change color//
                        if ($('#offerOnOrderDiscount').val() !== '0'){
                            $('#onOrder').css("color", "yellow")
                            $('#offerOnOrderDisc').css("color", "yellow")

                            $('.blinkForOrderAmount').each(function() {
                                var elem = $(this);
                                var count = 1;
                                var intervalId = setInterval(function() {
                                    if (elem.css('visibility') == 'hidden') {
                                        elem.css('visibility', 'visible');
                                        if (count++ === 3) {
                                            clearInterval(intervalId);
                                        }
                                    } else {
                                        elem.css('visibility', 'hidden');
                                    }
                                }, 150);
                            });
                        }else {
                            $('#onOrder').css("color", "#ffffffbf")
                            $('#offerOnOrderDisc').css("color", "#ffffffbf")
                        }
                    }
                }
            } else {
                alert("Can't Exceed Maximum Quantity");
                $(".product_cart_price").attr('disabled', 'disabled')
            }
        })

        $('#customer_phone').on('keyup', function (){
            let phone =  $('#customer_phone').val()
            if (phone.length <= 10){
                $('#customer_name').attr('value', '')
                $('#customer_id').attr('value', '')
                $('#membershipDiscountPercentage').attr('value', '')
                $('#membershipType').text('')
            }
        })

        // calculate product price
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
            let afterTax = 0;
            let subTotal = Number($('#sub_total').val())
            let tax = Number($('#taxInput').val())
            let tax_cal = Number(subTotal * tax / 100)
            let rounding = Number(tax_cal.toFixed())
            let roundValue = rounding - tax_cal
            afterTax = Number(subTotal) + Number(rounding)
            $('#vatPercentage').text('(' + tax + '%' + ')')
            $('#tax').text(tax_cal + ' BDT')
            $('#taxValue').attr('value', rounding)
            $('#totalValue').attr('value', afterTax)
            $('#total').text(afterTax)
            $('#rounding').text(roundValue.toFixed(2) + ' BDT')
            calculate_discount()
        }

        //calculate discount
        function calculate_discount() {
            let discount_cal = 0
            let total = Number($('#totalValue').val())
            let discount = Number($('#discountInput').val())
            let buyGetDiscount= $('#buyGetDiscount').val()
            let offerOnOrderDiscount= $('#offerOnOrderDiscount').val()
            let flatDiscount = $('#flatDiscount').val()

            let membershipDiscount = Number($('#membershipDiscountPercentage').val())
            let calculatedDiscount = Number(total * membershipDiscount / 100).toFixed()
            $('#membershipDiscount').text(calculatedDiscount + ' BDT')
            $('#membershipDiscountValue').attr('value',calculatedDiscount)


            let allOverDiscount = Number(discount) + Number(buyGetDiscount) + Number(offerOnOrderDiscount) + Number(flatDiscount)
            discount_cal = Number(total) - (Number(allOverDiscount) + Number(calculatedDiscount))

            $('#total').text(discount_cal)
            $('#allOverDiscount').attr('value', allOverDiscount)
            $('#grandTotal').attr('value', discount_cal)
            if (total === 0){
                $('#total').text(0)
                $('#totalValue').attr('value', 0)
            }
            change()
        }
        //calculate change
        function change() {

            let cash = Number($('#cashCollect').val())
            let grandTotal = Number($('#grandTotal').val())
            let change = cash - grandTotal
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


        // function dueForMembership(){
        //     let cash = Number($('#cashCollect').val())
        //     let grandTotal = Number($('#grandTotal').val())
        //     let due = grandTotal - cash
        //     $('#showDue').text(due + ' BDT')
        //     $('#due').attr('value', due)
        //     if (cash > grandTotal) {
        //         $('#showDue').text(0.00 + ' BDT');
        //         $('#due').attr('value', 0);
        //     } else {
        //         $('#changes').text(0.00 + ' BDT');
        //     }
        // }

        //calculate due
        function due() {
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
        }

        function offerOnOrder(){

            let field_id = "perProductPrice-"+x
            let id = field_id.split("-", 2)
            let index_no = id[1]
            let subTotal = $('#sub_total').val()
            offerOn = $("#perProductPrice-" + index_no).attr('data-offerOn')
            let discount = Number($("#perProductPrice-" + index_no).attr('data-value'))
            if (offerOn === 'PERCENTAGE'){
                let afterOffer=0;
                let offerPercentage = Number($("#perProductPrice-" + index_no).attr('data-discount')) //the percentage value
                percentageCal = Number((offerPercentage * inOrderOffer / 100).toFixed())
                if (percentageCal > discount){
                    afterOffer = subTotal - discount
                    $('#offerOnOrderDisc').text(discount + ' BDT')
                    $('#offerOnOrderDiscount').attr('value',discount)
                }else{
                    afterOffer = subTotal - percentageCal
                    $('#offerOnOrderDisc').text(percentageCal + ' BDT')
                    $('#offerOnOrderDiscount').attr('value',percentageCal)
                }

                $('#total').text(afterOffer)
                $('#totalValue').attr('value', afterOffer)
                $('#grandTotal').attr('value', afterOffer)

            }else {
                let offerAmount = Number($("#perProductPrice-" + index_no).attr('data-discount')) //the fixed amount
                let afterOffer = subTotal - offerAmount
                $('#total').text(afterOffer)
                $('#totalValue').attr('value', afterOffer)
                $('#grandTotal').attr('value', afterOffer)
                $('#offerOnOrderDisc').text(offerAmount + ' BDT')
                $('#offerOnOrderDiscount').attr('value', offerAmount)
            }
            //change color
            if ($('#offerOnOrderDiscount').val() !== '0'){
                $('#onOrder').css("color", "yellow")
                $('#offerOnOrderDisc').css("color", "yellow")

                $('.blinkForOrderAmount').each(function() {
                    var elem = $(this);
                    var count = 1;
                    var intervalId = setInterval(function() {
                        if (elem.css('visibility') == 'hidden') {
                            elem.css('visibility', 'visible');
                            if (count++ === 3) {
                                clearInterval(intervalId);
                            }
                        } else {
                            elem.css('visibility', 'hidden');
                        }
                    }, 150);
                });
            }
        }

        $('#submit').on('click', function () {
            let productQty = [];
            let productTitle = [];
            $('.product_title_val').each(function () {
                productTitle.push($(this).val())
                $('#pro_titles').val(productTitle)
            });
            $('.product_quantity_val').each(function () {

                productQty.push($(this).val())
                $('#pro_qty').val(productQty)
            })

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






        // function calculate_membership_discount(){
        //
        //     let total = Number($('#sub_total').val())
        //     let membershipDiscount = Number($('#membershipDiscountPercentage').val())
        //     let calculatedDiscount = Number(total * membershipDiscount / 100).toFixed()
        //     let membershipDiscount_cal = total - calculatedDiscount
        //
        //     $('#membershipDiscount').text(calculatedDiscount + ' BDT')
        //     $('#membershipDiscountValue').attr('value',calculatedDiscount)
        //     $('#total').text(membershipDiscount_cal)
        //     $('#totalValue').attr('value', membershipDiscount_cal)
        //     $('#grandTotal').attr('value', membershipDiscount_cal)
        //     dueForMembership()
        //
        //
        //     $('#taxInput').on('keyup', function (){
        //         let subTotal = Number($('#sub_total').val())
        //         let tax = Number($('#taxInput').val())
        //         let tax_cal = Number(subTotal * tax / 100)
        //         let rounding = Number(tax_cal.toFixed())
        //         let roundValue = rounding - tax_cal
        //         let afterTax = Number(membershipDiscount_cal) + Number(rounding)
        //
        //         $('#vatPercentage').text('(' + tax + '%' + ')')
        //         $('#tax').text(tax_cal + ' BDT')
        //         $('#taxValue').attr('value', rounding)
        //         $('#total').text(afterTax)
        //         $('#totalValue').attr('value', afterTax)
        //         $('#grandTotal').attr('value', afterTax)
        //         $('#rounding').text(roundValue.toFixed(2) + ' BDT')
        //         dueForMembership()
        //     })
        //     $('#cashCollect').on('keyup', function (){
        //
        //         let cash = Number($('#cashCollect').val())
        //         let grandTotal = Number($('#grandTotal').val())
        //         let change = cash - grandTotal
        //         if (cash === 0) {
        //             $('#changes').text(0 + ' BDT')
        //         } else {
        //             $('#changes').text(change + ' BDT')
        //         }
        //         if (document.getElementById("cashCollect").value === "") {
        //             document.getElementById('submit').disabled = true;
        //         } else {
        //             document.getElementById('submit').disabled = false;
        //         }
        //         dueForMembership()
        //     })
        //
        //     if (total === 0){
        //         $('#total').text(0)
        //         $('#grandTotal').attr('value', 0)
        //     }
        // }

        // $('#buyGetDiscount').ready(function (){
        //     console.log('in')
        //
        // })

    </script>
@endpush
