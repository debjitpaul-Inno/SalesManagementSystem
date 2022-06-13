@extends('layouts.damage')
@section('content')
    <div id="content" class="app-content p-3 pb-0">
        <div class="card h-100">
            <div class="card-body" style="overflow:hidden">
                <div class="row">


                    <form id="createForm " method="POST" action="{{route('damage.update', $damage->uuid)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
{{--                        @dd($damage->products[0]->pivot)--}}
                        <div class="row" data-scrollbar="true" data-height="100%">
                            <div class="col-md-9" style="border-right: solid 1px white">
                                <div class="d-flex align-items-center mb-0 row form-group ">
                                    <h4 class="text-center w-100">Update Damage List of Products (<span
                                            id="countDamage">  {{count($damage->products)}} </span>)</h4>
                                    <div class="text-center">
                                        <p class="mb-0">You can update registered <b class="text-theme">Damaged Products</b> of
                                            same <b class="text-theme">Stock In</b> at a time.</p>
                                    </div>

                                    <div class="d-block">
                                        <button
                                            class="btn btn-outline-theme btn-md active  mb-2 add-service-row-btn add_field_button float-end"
                                            type="button">Add Row
                                        </button>
                                    </div>
                                </div>


                                <div class="d-flex mt-1 text-center" style="border-bottom: 1px solid white">
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
{{--                                    @foreach($damage->products as $damage)--}}
                                    @for($x=0;$x<=count($damage->products)-1;$x++)
                                    <div class="pos-order" style="padding: 5px">
                                        <div class="pos-order-product row mt-2">
                                            <div class="w-100 d-flex">
                                                <div class=" me-2 form-group " style="width: 30%">
                                                    <select name="product_id[]" id="product_id-{{$x+1}}"
                                                            class="form-control select2 products ">
                                                        <option hidden value=""></option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                    data-quantity="{{ $product->quantity }}" data-title="{{ $product->title }}" {{$damage->products[$x]->pivot->product_id == $product->id ? 'selected' : ''}}>
                                                                {{ $product->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class=" me-2 form-group " style="width: 20%">
                                                    <input type="text" class="form-control" value="{{$damage->products[$x]->pivot->amount/$damage->products[$x]->pivot->quantity}}" id="unit_price-{{$x+1}}"
                                                           name="unit_price" readonly>
                                                </div>
                                                <div class=" me-2 form-group " style="width: 20%">
                                                    <input type="number" class="form-control product-qty" id="qty-{{$x+1}}" value="{{$damage->products[$x]->pivot->quantity}}"
                                                           name="qty" min="1" oninput="calculate_products_price(this)">
                                                </div>
                                                <div class=" me-2 form-group " style="width: 20%">
                                                    <input type="text" class="form-control amount" value="{{$damage->products[$x]->pivot->amount}}" id="amount-{{$x+1}}"
                                                           name="amount" readonly>
                                                </div>

                                                <div class="mt-1 text-center" style="width: 10%">
                                                    <button class="btn  btn-danger remove_field p-0 pt-1" type="button">
                                                        <i class="bi bi-trash fs-20px lh-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="logo text-end">
                                     <span class="menu-icon">
                                        <a href="{{route('damage.index')}}"
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
                                                        <option value="{{ $stockIn->voucher_number }}" {{$damage->reference_number == $stockIn->voucher_number ? 'selected' : ''}}>
                                                            {{ $stockIn->voucher_number }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div
                                                class="h-100  align-items-center justify-content-center form-group p-2 mt-3">

                                                <div class="d-flex align-items-center mb-2">
                                                    <div>Total</div>
                                                    <div class="flex-1 text-end h4 mb-0" id="total">{{$damage->total_amount}}</div>
                                                    <span class="text-end h4 mb-0 ms-2">BDT</span>
                                                    <input type="text" class="form-control" name="net_total"
                                                           id="grandTotal" value="{{$damage->total_amount}}"
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

        $(document).ready(function () {
            // $('#countDamage').text(' ( 1 )')
            selectRefresh();
            // console.log($('#countDamage').text())
        });

        var counter = 1;
        var wrapper = $("#damageTab"); //Fields wrapper
        let add_button = $(".add_field_button"); //Add button ID

        let x = $('#countDamage').text(); //initial text box count
        $(add_button).click(function (e) { //on add input button click
            counter = 1
            let max_fields = 5000; //maximum input boxes allowed
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(`
                                <div class="pos-order" style="padding: 5px">
                                    <div class="pos-order-product row mt-2">
                                            <div class="w-100 d-flex">
                                                <div class=" me-2 form-group " style="width: 30%">
                                                 <select name="product_id[]" id="product_id-` + x + `" class="form-control select2 products">
                                                        <option hidden value=""></option>
                                                    @foreach($products as $product)
                <option value="{{ $product->id }}" data-quantity="{{ $product->quantity }}" data-title="{{ $product->title }}">
                                                                                                    {{ $product->title }}
                </option>
@endforeach
                </select>
           </div>
           <div class=" me-2 form-group " style="width: 20%">
                   <input type="text" class="form-control " id="unit_price-` + x + `" name="unit_price" readonly>
                                            </div>
                                            <div class=" me-2 form-group " style="width: 20%">
                                                <input type="number" class="form-control product-qty" id="qty-` + x + `" name="qty" min="1" oninput="calculate_products_price(this)">
                                            </div>
                                            <div class=" me-2 form-group " style="width: 20%">
                                                    <input type="text" class="form-control amount" id="amount-` + x + `"  name="amount" readonly>
                                            </div>

                                            <div class="mt-1 text-center"  style="width: 10%">
                                                   <button class="btn  btn-danger remove_field p-0 pt-1" type="button" ><i class="bi bi-trash fs-20px lh-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`); // add input boxes.
                $('#countDamage').text(' '+x+' ')
                $("#barcode").val("")
                selectRefresh();
                calculate_products_price();
            }


        });
        wrapper.on('click', '.remove_field', function (e) {

            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').parent('div').remove();
            x--;
            $('#countDamage').text( ' '+ x + ' ')

            calculate_products_price();
            let subTotal = $('#sub_total').val()

        })


        $("#damageTab").on("change", ".products", function (e) {
            // console.log('here i am ')
            let field_id = $(this).attr('id')
            // let unit_price = $(this).find(':selected').data('value');
            let available_quantity = $(this).find(':selected').data('quantity');
            let id = field_id.split("-", 2)
            let index_no = id[1]
            // console.log(unit_price)


            let product_id = $(this).find(':selected').val();
            // console.log(product_id)

            if (available_quantity > 0) {
                fetch(`/damage/${product_id}/price`)
                    .then(res => res.json())
                    .then(res => {
                        let unit_price = res.unit_price
                        $("#unit_price-" + index_no).val(unit_price);
                        $("#amount-" + index_no).val(unit_price);
                        calculate_products_price();
                    })
                $("#qty-" + index_no).val(1);
            } else {
                alert("Doesn't have enough quantity")
            }
        })
        $("#damageTab").on("keyup", ".product-qty", function (e) {
            let field_id = $(this).attr('id')
            let id = field_id.split("-", 2)
            let index_no = id[1]
            let unit_price = Number($("#unit_price-" + index_no).val());
            let available_quantity = Number($("#product_id-" + index_no).find(':selected').data('quantity'));
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
                productId.push($(this).find(':selected').val())
                $('#pro_ids').val(productId)
            });
            $('.product-qty').each(function () {
                productQty.push($(this).val())
                $('#pro_qty').val(productQty)
            });
            $(".products").each(function () {
                producTitle.push($(this).find(':selected').data('title'))
                $('#pro_titles').val(producTitle)
            });
            $(".amount").each(function () {
                producPrice.push($(this).val())
                $('#pro_price').val(producPrice)
            });

        });
    </script>
@endpush
