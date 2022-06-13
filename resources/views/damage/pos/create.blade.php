@extends('layouts.damage')
@section('content')
    <div id="content" class="app-content p-3 pb-0">
        <div class="card h-100">
            <div class="card-body" style="overflow:hidden">
                <div class="row">


                    <form id="createForm " method="POST" action="{{route('damage.pos.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row" data-scrollbar="true" data-height="100%">
                            <div class="col-md-9" style="border-right: solid 1px white">
                                <div class="d-flex align-items-center mb-0 row form-group ">
                                    <h4 class="text-center w-100">Create Damage List of Products<span
                                            id="countDamage"></span></h4>
                                    <div class="text-center">
                                        <p class="mb-0">You can register <b class="text-theme">Damaged Products</b> of
                                            same <b
                                                class="text-theme">Stock In</b> at a time.</p>
                                    </div>
                                    {{--                                    <div class="d-block">--}}
                                    {{--                                        <button--}}
                                    {{--                                            class="btn btn-outline-theme btn-md active  mb-2 add-service-row-btn add_field_button float-end"--}}
                                    {{--                                            type="button">Add Row--}}
                                    {{--                                        </button>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="flex-1 text-end h6 mb-0 input-group text-wrap mt-2">
                                    <input type="text" class="form-control bg-white text-black" name="bar_code"
                                           autofocus="autofocus" id="barcode"
                                           placeholder="Click Here Before Scanning The Barcode">
                                    <span class="input-group-text"><small><i
                                                class="bi bi-search"></i></small></span>
                                </div>

                                <div class="d-flex mt-3 text-center" style="border-bottom: 1px solid white">
                                    <h5 style="width: 30%;font-size: 15px">Name</h5>
                                    <h5 style="width: 20%;font-size: 15px">Unit Price<span
                                            class=""><small> ( BDT )</small></span></h5>
                                    <h5 style="width: 20%;font-size: 15px">Quantity<span
                                            class=""><small> ( Unit )</small></span></h5>
                                    <h5 style="width: 20%;font-size: 15px">Amount<span class=""><small> ( BDT )</small></span>
                                    </h5>

                                    <h5 style="width: 10%;font-size: 15px">Action</h5>
                                </div>
                                <div class="" id="damageTab" data-scrollbar="true" data-height="60vh"
                                     style="overflow-x: hidden">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="logo text-end">
                                     <span class="menu-icon">
                                        <a href="{{route('damage.pos.index')}}"
                                           class="btn btn-outline-theme btn-md active  mb-2"> <i
                                                class="fas fa-angle-double-left ml-5 text-black"></i> Back</a>
                                     </span>
                                </div>

                                <div class="pos-sidebar" id="pos-sidebar">
                                    <!-- BEGIN pos-sidebar-header -->

                                    <!-- END pos-sidebar-header -->

                                    <!-- BEGIN pos-sidebar-nav -->

                                    <!-- END pos-sidebar-nav -->

                                    <!-- BEGIN pos-sidebar-body -->
                                    <div class="pos-sidebar-body tab-content" data-scrollbar="true" data-height="100%">

                                        <!-- BEGIN #accountTab -->
                                        <div class="tab-pane  show active" id="accountTab" style="overflow-x: hidden">
                                            <div class="mt-2">
                                                <h5 style="font-size: 15px">Voucher Number <span
                                                        class="required">*</span>
                                                </h5>
                                                <select name="reference_number" class="form-control select2" required>
                                                    <option hidden value=""></option>
                                                    @foreach($stockIns as $stockIn)
                                                        <option value="{{ $stockIn->voucher_number }}">
                                                            {{ $stockIn->voucher_number }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div
                                                class="h-100  align-items-center justify-content-center form-group p-2 mt-3">

                                                <div class="d-flex align-items-center mb-2">
                                                    <div>Total</div>
                                                    <div class="flex-1 text-end h4 mb-0" id="total">0.00</div>
                                                    <span class="text-end h4 mb-0 ms-2">BDT</span>
                                                    <input type="text" class="form-control" name="net_total"
                                                           id="grandTotal" value=""
                                                           hidden>
                                                </div>
                                                <input id="pro_ids" name="pro_id[]" type="text" value="" hidden/>
                                                <input id="pro_qty" name="pro_qty[]" type="text" value="" hidden/>
                                                <input id="pro_titles" name="pro_title[]" type="text" value="" hidden/>
                                                <input id="pro_price" name="pro_price[]" type="text" value="" hidden/>
                                                <div class="mt-4">
                                                    <div class="btn-group d-flex">
                                                        <button type="submit"
                                                                class="btn btn-outline-theme rounded-0 w-150px"
                                                                id="submit">
                                                            <i class="bi bi-send-check fa-lg"></i><br/>
                                                            <span class="small">Submit Damage List</span>
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
                        </div>

                    </form>
                </div>
            </div>
            <x-card-border></x-card-border>
        </div>
    </div>


@endsection
@push('customScripts')
    <script>
        function selectRefresh() {
            $('.select2').select2({
                tags: true,
                placeholder: "Select an Option",
                allowClear: true,
                width: '100%'
            });
        }

        $(":input").keypress(function (event) {

            if (event.which == '10' || event.which == '13') {
                event.preventDefault();
            }

        });
        $(document).ready(function () {
            // $('#countDamage').text(' ( 1 )')
            selectRefresh();
        });

        var counter = 0;
        var wrapper = $("#damageTab"); //Fields wrapper

        let x = 0; //initial text box count
        $("#barcode").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('damage.searchProduct')}}",
                    type: 'get',
                    dataType: "json",
                    data: {
                        search: request.term         //search = key

                    },
                    success: function (data) {
                        let max_fields = 5000; //maximum input boxes allowed
                        // e.preventDefault();
                        if (x < max_fields) { //max input box allowed
                            x++; //text box increment

                            $(wrapper).append(`
                                <div class="pos-order" style="padding: 5px">
                                    <div class="pos-order-product row mt-2">
                                            <div class="w-100 d-flex">
                                                <div class=" me-2 form-group " style="width: 30%">
                            <input class="form-control products" id="product_id-` + x + `" type="text" value="` + data[0].id + `" data-quantity="` + data[0].quantity + `" data-title="` + data[0].title + `" hidden>
                                                <input class="form-control product_title_val"  type="text" value="` + data[0].title + `" readonly>

                                           </div>
                                           <div class=" me-2 form-group " style="width: 20%">
                                                   <input type="text" class="form-control " id="unit_price-` + x + `" name="unit_price" value="` + data[0].unit_price + `" readonly>
                                            </div>
                                            <div class=" me-2 form-group " style="width: 20%">
                                                <input type="number" class="form-control product-qty" id="qty-` + x + `" name="qty" min="1" value="1" oninput="calculate_products_price(this)">
                                            </div>
                                            <div class=" me-2 form-group " style="width: 20%">
                                                    <input type="text" class="form-control amount" id="amount-` + x + `"  name="amount" value="` + data[0].unit_price + `" readonly>
                                            </div>

                                            <div class="mt-1 text-center"  style="width: 10%">
                                                   <button class="btn  btn-danger remove_field p-0 pt-1" type="button" ><i class="bi bi-trash fs-20px lh-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`); // add input boxes.
                            $('#countDamage').text(' ( ' + x + ' )')
                            $("#barcode").val("")
                            selectRefresh();
                            calculate_products_price();
                        }
                    }
                })
                }
            });
        wrapper.on('click', '.remove_field', function (e) {

            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').parent('div').remove();
            x--;
            $('#countDamage').text(' ( ' + x + ' )')

            calculate_products_price();
            let subTotal = $('#sub_total').val()

        })


        // $("#damageTab").on("change", ".products", function (e) {
        //     // console.log('here i am ')
        //     let field_id = $(this).attr('id')
        //     // let unit_price = $(this).find(':selected').data('value');
        //     let available_quantity = $(this).find(':selected').data('quantity');
        //     let id = field_id.split("-", 2)
        //     let index_no = id[1]
        //     // console.log(unit_price)
        //
        //
        //     let product_id = $(this).find(':selected').val();
        //     // console.log(product_id)
        //
        //     if (available_quantity > 0) {
        //         fetch(`/damage/${product_id}/price`)
        //             .then(res => res.json())
        //             .then(res => {
        //                 let unit_price = res.unit_price
        //                 $("#unit_price-" + index_no).val(unit_price);
        //                 $("#amount-" + index_no).val(unit_price);
        //                 calculate_products_price();
        //             })
        //         $("#qty-" + index_no).val(1);
        //     } else {
        //         alert("Doesn't have enough quantity")
        //     }
        // })
        $("#damageTab").on("keyup", ".product-qty", function (e) {
            let field_id = $(this).attr('id')
            let id = field_id.split("-", 2)
            let index_no = id[1]
            let unit_price = Number($("#unit_price-" + index_no).val());
            let available_quantity = Number($("#product_id-" + index_no).data('quantity'));
            let qty = Number($("#qty-" + index_no).val());
            if (qty <= available_quantity) {
                $("#amount-" + index_no).val(unit_price * qty);
                calculate_products_price();
            } else {
                $("#qty-" + index_no).val(available_quantity)
                alert("Can not exit available quantity")
            }
            // console.log($("#product_id-" + index_no).find(':selected').data('quantity'))

        })


        function calculate_products_price() {
            let sum = 0;
            $(".amount").each(function () {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            $('#total').text(sum)
            $("#grandTotal").attr('value', sum);
        }


        $('#submit').on('click', function () {
            let productId = [];
            let productQty = [];
            let producTitle = [];
            let producPrice = [];

            $('.products').each(function () {
                productId.push($(this).val())
                $('#pro_ids').val(productId)
            });
            $('.product-qty').each(function () {
                productQty.push($(this).val())
                $('#pro_qty').val(productQty)
            });
            $(".products").each(function () {
                producTitle.push($(this).data('title'))
                $('#pro_titles').val(producTitle)
            });
            $(".amount").each(function () {
                producPrice.push($(this).val())
                $('#pro_price').val(producPrice)
            });

        });
    </script>
@endpush