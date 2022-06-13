
@extends('layouts.order')
@section('content')
    <div id="content" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert type="danger" message="{{$error}}"></x-alert>
            @endforeach
        @endif
        <div class="card h-100 " >
            <div class="card-body p-2" style="overflow:hidden">
                <div class="row">
                    <form id="createForm " method="POST" action="{{route('order.pos.update', $order->uuid)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                               id="barcode" autofocus="autofocus" placeholder="Click Here Before Scanning The Barcode">
                                        <span class="input-group-text"><small><i
                                                    class="bi bi-search"></i></small></span>
                                    </div>
                                </div>
                                <h4 class="text-center" style="border:solid 1px white">Order List <span id="countOrder" data-value="{{count($order->products)}}">{{'('.count($order->products) .')'}}</span></h4>

                                <div class="d-flex mt-3" style="border-bottom: 1px solid white">
                                    <h6  style="width: 24%" class="text-center">Name</h6>
                                    <h6  style="width: 15%" class="ms-2 text-center">Available<span class=""><small> (In PC)</small></span></h6>
                                    <h6  style="width: 15%" class="ms-2 text-center">Unit Price<span class=""><small> (BDT)</small></span></h6>
                                    <h6  style="width: 15%" class="ms-2 text-center">Quantity<span class=""><small> (In PC)</small></span></h6>
                                    <h6  style="width: 15%" class="ms-2 text-center">Amount<span class=""><small> (BDT)</small></span></h6>
                                    <h6  style="width: 10%" class="ms-4 text-center">Action</h6>
                                </div>
                                <!-- BEGIN #newOrderTab -->
                                <div class="" id="newOrderTab" data-scrollbar="true" data-height="70vh"  style="overflow-x: hidden">
                                    <div class="pos-order" style="padding: 5px">
                                        <div class="pos-order-product row mt-2">

                                            @for($x=0;$x<=count($order->products)-1;$x++)
                                                <div class="w-100 d-flex mb-3 previousData">
                                                    <input class="product_id_val" type="text"  value="{{$order->products[$x]->id}}" data-value="{{$order->products[$x]->price}}" id="unitPrice-{{$x+1}}" hidden>
                                                    <div class="form-group " style="width: 24%">
                                                        <input class="form-control product_title_val" type="text" value="{{$order->products[$x]->title}}" >
                                                    </div>
                                                    <div class=" ms-3 form-group " style="width: 15%">
                                                        <input type="text" id="product_quantity-{{$x+1}}" class="form-control" value="{{$order->products[$x]->quantity}}" readonly>
                                                    </div>
                                                    <div class=" ms-3 form-group " style="width: 15%">
                                                        <input type="text" class="form-control" value="{{$order->products[$x]->price}}" readonly>
                                                    </div>

                                                    <div class=" ms-3 form-group " style="width: 15%">
                                                        <input class="form-control product_quantity_val" id="quantityValue-{{$x+1}}" type="text" value="{{$order->products[$x]->pivot->quantity}}" >
                                                    </div>
                                                    <div class=" ms-4 form-group " style="width: 15%">
                                                        <input class="form-control product_cart_price" type="text" value="{{$order->products[$x]->price * $order->products[$x]->pivot->quantity}}" id="perProductPrice-{{$x+1}}" readonly>
                                                    </div>
                                                    <div class="mt-1 ms-3 text-center"  style="width: 10%">
                                                        <button class="btn  btn-danger remove_field p-0 pt-1" type="button" ><i class="bi bi-trash fs-20px lh-1"></i></button>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
{{--                                    <h4 class="text-center" style="background-color: #002a80; border-radius: 3px">New Order</h4>--}}
                                </div>
                                <!-- END #newOrderTab -->
                            </div>
                            <div class="col-md-4">
                                <div class="pos-sidebar" id="pos-sidebar">
                                    <div class="h-100 d-flex flex-column p-0">
                                        <!-- BEGIN pos-sidebar-nav -->
                                        <div class="pos-sidebar-nav">
                                            <ul class="nav nav-tabs nav-fill p-0">
                                                <li class="nav-item p-0">
                                                    <a class="nav-link" href="#" data-bs-toggle="tab"
                                                       data-bs-target="#orderHistoryTab">Customer </a>
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
                                            <div class="tab-pane fade show active" id="accountTab" data-scrollbar="true" data-height="87vh"  style="overflow-x: hidden">
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
                                                        <div class="flex-1 text-end h6 mb-0" id="subTotal">{{$accounts->total}} BDT</div>
                                                        <input type="text" name="total" id="sub_total" value="{{$accounts->total}}" hidden>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2 ">
                                                        <div>Membership Discount @ <span id="memberDiscount">{{'('.round(($accounts->membership_discount*100) / $accounts->total).'%' .')' }}</span></div>
                                                        <div class="flex-1 text-end h6 mb-0" id="membershipDiscount">{{$accounts->membership_discount}} BDT</div>
                                                        <input type="text" name="membership_discount_percentage"  id="membershipDiscountPercentage" value="{{$order->customers->members->membershipTypes->discount ?? '0'}}" hidden>
                                                        <input type="text" name="membership_discount" id="membershipDiscountValue" value="{{$accounts->membership_discount}}" hidden>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <input type="text" class="form-control" name="tax" id="taxValue" value="{{$accounts->tax}}" hidden>
                                                        <div>VAT @ <span id="vatPercentage">{{'('.round(($accounts->tax*100) / $accounts->total).'%' .')' }}</span></div>
                                                        <div class="flex-1 text-end h6 mb-0" id="tax">{{$accounts->tax}} BDT</div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div>Rounding (+/-)</div>
                                                        <div class="flex-1 text-end h6 mb-0" id="rounding">0.00 BDT</div>

                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div>Changes</div>
                                                        <div class="flex-1 text-end h6 mb-0" id="changes">0.00 BDT</div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <div>Due</div>
                                                        <div class="flex-1 text-end h6 mb-0" id="showDue">{{$accounts->due}} BDT</div>
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
                                                            <button type="submit" class="btn btn-outline-theme rounded-0 w-150px mb-2"
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
            //function for sidebar active
            $('#showPreviousPaid').text($('#paidAmount').val() + ' BDT')
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

        $(":input").keypress(function(event){

            if (event.which == '10' || event.which == '13') {
                event.preventDefault();
            }

        });

        var total = $('.previousData').length;
        var wrapper = $("#newOrderTab"); //Fields wrapper
        let x = total; //initial text box count
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
                        console.log(data)
                        let max_fields = 500; //maximum input boxes allowed

                        // e.preventDefault();
                        if (x < max_fields) { //max input box allowed
                            x++; //text box increment
                            $(wrapper).append(`
                                <div class="pos-order" style="padding: 5px">
                                    <div class="pos-order-product row">
                                        <div class="w-100 d-flex">
                                            <input class="product_id_val" type="text"  value="` + data[0].id + `" data-value="` + data[0].price + `" id="unitPrice-${x}" hidden>
                                             <div class=" form-group " style="width: 24%">
                                                    <input class="form-control product_title_val" type="text" value="` + data[0].title + `" >
                                            </div>
                                            <div class=" ms-3 form-group " style="width: 15%">
                                                   <input type="text" id="product_quantity-${x}" class="form-control" value="` + data[0].quantity + `" readonly>
                                            </div>
                                            <div class=" ms-3 form-group " style="width: 15%">
                                                   <input type="text" class="form-control" value="` + data[0].price + `" readonly>
                                            </div>
                                            <div class=" ms-3 form-group " style="width: 15%">
                                                   <input class="form-control product_quantity_val default_quantity" id="quantityValue-${x}" type="text" value="1" >
                                            </div>
                                            <div class=" ms-4 form-group " style="width: 15%">
                                                 <input class="form-control product_cart_price" type="text" value="" id="perProductPrice-${x}" readonly>
                                            </div>
                                             <div class="mt-1 ms-3 text-center"  style="width: 10%">
                                                   <button class="btn  btn-danger remove_field p-0 pt-1" type="button" ><i class="bi bi-trash fs-20px lh-1"></i></button>
                                            </div>

                                        </div>
                                    </div>


                               </div>
`); // add input boxes.
                            let y = $('.pos-order').length;
                            $('#countOrder').text('(' + y + ')')

                            $("#barcode").val("")

                            //when default quantity 1
                            $('.product_quantity_val').ready(function () {
                                let field_id = "quantityValue-"+x
                                let id = field_id.split("-", 2)
                                let index_no = id[1]
                                let hasQuantity = Number($('#product_quantity-' +index_no).val())
                                let quantity = Number($('#quantityValue-' +index_no).val())
                                console.log(quantity)
                                let price = $("#unitPrice-" + index_no).attr('data-value')
                                if (hasQuantity >= quantity) {
                                    let total = quantity * price
                                    $("#perProductPrice-" + index_no).val(total)
                                    $("#perProductPrice-" + index_no).attr('value', total)
                                    calculate_products_price();
                                    let subTotal = $('#sub_total').val()

                                    $('#total').text(subTotal)
                                    $('#totalValue').attr('value', subTotal)
                                    $('#grandTotal').attr('value', subTotal)
                                    $(".product_cart_price").attr('disabled', false)

                                    calculate_membership_discount()
                                    calculate_tax();
                                    calculate_discount();
                                } else {
                                    alert("Can't Exceed Maximum Quantity");
                                    $(".product_cart_price").attr('disabled', 'disabled')
                                }
                            })

                        }
                    }
                });
            },
        });
        wrapper.on('click', '.remove_field', function (e) {

            e.preventDefault();
            $(this).parent('div').parent('div').remove();

            let y = $('.pos-order').length;
            $('#countOrder').text('(' + y + ')')


            calculate_products_price();
            let subTotal = $('#sub_total').val()

            $('#total').text(subTotal)
            $('#totalValue').attr('value', subTotal)
            $('#grandTotal').attr('value', subTotal)
            $('#memberDiscount').text('(' + 0 + '%' + ')')
            calculate_membership_discount()
            calculate_tax();
            calculate_discount();
        })
        $('.previousData').each(function(index) {
        });
        $("#newOrderTab").on("input", ".product_quantity_val", function (e) {
            let field_id = $(this).attr('id')
            let id = field_id.split("-", 2)
            let index_no = id[1]
            let hasQuantity = Number($('#product_quantity-' +index_no).val())
            let quantity =  Number($('#quantityValue-' + index_no).val())
            let price = $("#unitPrice-" + index_no).attr('data-value')

            if (hasQuantity >= quantity) {
                let total = quantity * price

                $("#perProductPrice-" + index_no).val(total)
                $("#perProductPrice-" + index_no).attr('value', total)
                calculate_products_price();
                let subTotal = $('#sub_total').val()

                $('#total').text(subTotal)
                $('#totalValue').attr('value', subTotal)
                $('#grandTotal').attr('value', subTotal)
                $(".product_cart_price").attr('disabled', false)

                calculate_membership_discount()
                calculate_tax();
                calculate_discount();
            } else {
                alert("Can't Exceed Maximum Quantity");
                $(".product_cart_price").attr('disabled', 'disabled')
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
