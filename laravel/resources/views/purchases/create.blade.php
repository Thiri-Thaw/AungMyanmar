@extends('layouts.app')

@section('content')
<div class="container-fluid" >
    <div class="row p-3">
        <div class="col-7 m-0 p-0 row">
            <div class="col-3">
                <div class="p-2">
                    <h4>Categories</h4>
                    <div class="row category_box">
                        @foreach ($categories as $category)
                        <div class="p-1 col-12">
                            <div class="card category_card" data-id="{{$category->id}}" data-name="{{$category->name}}">
                                <div class=" card-body text-center">
                                    {{$category->name}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="p-2">
                    <div class="d-flex justify-content-between">
                        <h4>Items</h4>
                        <small class="item_header">cat : none</small>
                    </div>
                    <div class="row item_box">
                        @foreach ($items as $item)
                        <div class="col-4 item_card d-none cat_id_{{$item->category_id}}" data-id="{{$item->id}}">
                            <div class="m-2 card" style="height: 90px">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    {{$item->name}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
        <div class="col-5 m-0 p-0">
            <div class="p-2">
                <div class="d-flex justify-content-between mb-2">
                    {{-- <h4 class="col-2">Invoice</h4> --}}
                    <div class="v-id d-flex align-items-center col-6 row">
                            Voucher-id:
                            <input type="text" value="{{$voucher_id}}" class="form-control form-control-sm col-7 ml-2" id="p_voucher_id" readonly>

                    </div>
                    <div class="col-6 d-flex align-items-center">
                     Date: <input type="date" class="form-control form-control-sm ml-2" id="p_date" value="{{date('Y-m-d')}}">
                     {{-- new DateTime('2016-12-12 12:12:12', new DateTimeZone('UTC') --}}
                    </div>
                </div>
                <div class="card selected-sale-items  mb-1">
                    <div class="card-body pt-0 px-0">
                        <table class="table mb-3 table-head-fixed text-center w-100"  id="selected-purchase-items-table">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>action</th>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>1</td>
                                    <td>paung that say</td>
                                    <td>15000</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-minus-circle mr-1"></i> 5 <i class="ml-1 fas fa-plus-circle"></i>
                                        </div>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body px-3 py-1">
                        {{-- <div class="row text-center">
                                <div class="col-6 bg-light border-1 border p-3" style="box-shadow: 0px 0px 2px black">retail</div>
                                <div class="col-6 bg-light border-1 border p-3" style="box-shadow: 0px 0px 2px black">whole</div>
                            </div> --}}
                            <div class="form-group row">
                                <div>
                                    <label for="" class="form-label p-0">Remind Date</label>
                                </div>
                                <input type="date" class="form-control form-control-sm" name="remain-date" id="p_remain_date" required>
                            </div>
                        <div class="form-group row">
                            <div>
                                <label for="" class="form-label p-0">Company</label>
                                <small>
                                    <span class="float-end"><a href="{{route('company.create')}}">Add +</a></span>
                                </small>
                            </div>
                            {{-- <input type="text" class="form-control form-control-sm"> --}}
                            <select name="" id="p_comapny" class="form-select form-select-sm company_select_box">
                                @foreach ($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                                {{-- <option value="">Company</option> --}}
                            </select>
                        </div>
                        <div class="form-group row">
                            <div>
                                <label for="" class="form-label p-0">Remark</label>
                            </div>
                            <textarea class="form-control form-control-sm" style="resize: none" id="p_remark"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card purchase-invoice">
                    <div class="card-body">
                        <table class="table table-borderless mb-3" id="purchaseInvoiceTable">
                            <tbody>
                                @php
                                $subTotal = 0;
                                    // $subTotal += $selectedItem['qty']*$selectedItem['price'];
                                    $tax=0;
                                    $Discount = 0;
                                    $paid = 0;
                                    $total = 0;
                                    $left = 0;
                                @endphp
                                @foreach ($selectedItems as $selectedItem)
                                @php
                                    $subTotal += $selectedItem['qty']*$selectedItem['price'];
                                    $total = $subTotal - $Discount;
                                    $total -=$tax;
                                    $left = $total - $paid;
                                @endphp
                                @endforeach
                                <tr>
                                    <th>Sub Total</th>
                                    <td>
                                        <input id="p_sub_total" type="number" class="form-control form-control-sm" value="{{$subTotal;}}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tax</th>
                                    <td> <input id="p_tax" type="number" class="form-control form-control-sm" value="{{$tax;}}"
                                        @if(Session::get('purchaseitems') == [])
                                            readonly
                                        @endif
                                        > </td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td><input id="p_discount" type="number" class="form-control form-control-sm" value="{{$Discount;}}"
                                        @if(Session::get('purchaseitems') == [])
                                            readonly
                                        @endif
                                        ></td>
                                </tr>
                                <tr class=" border-top border-top-2">
                                    <th>Paid</th>
                                    <td>
                                        <input  id="p_paid" type="number" class="form-control form-control-sm" value="{{$paid;}}"
                                        @if(Session::get('purchaseitems') == [])
                                            readonly
                                        @endif
                                        >

                                    </td>
                                </tr>
                                <tr class=" border-top border-top-2">
                                    <th>Total</th>
                                    <td>
                                        <input  id="p_total" type="number" class="form-control form-control-sm text-bold text-success" value="{{$total;}}" readonly>

                                    </td>
                                </tr>
                                <tr class=" border-top border-top-2">
                                    <th>Left</th>
                                    <td>
                                        <input  id="p_left" type="number" class="form-control form-control-sm text-bold text-success" value="{{$left;}}" readonly>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-outline-danger me-2 cancel-btn">Cancel</button>
                            <form action="" id="purchaseInvoiceForm">
                                <button type="submit" class="btn btn-lg btn-success px-4">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- invioce modal --}}
    {{-- <div class="modal fade" id="invoiceModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-lg btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    {{-- invioce modal --}}
</div>
@endsection
@section('script')
<script>
    var total = 0;
    var tax  = 0;
    var discount  = 0;
    var paid  = 0;
    var left  = 0;
    $('#selected-purchase-items-table').DataTable({
        // "scrollX": false,
        "paging": false
        , "ordering": false
        , "info": false
        , "searching": false
        , ajax: "{{route('getpurchaseselected.item')}}"
        , columns: [
            {data: "DT_RowIndex", name: "DT_RowIndex"}
            , {data: "name", name: "name"}
            , {data: "cat_name", name: "cat_name"}
            , {data: "price", name: "price"}
            , {data: "qty", name: "qty"}
            , {data: "total", name: "total"}
            , {data: "action", name: "action"}
        , ],

    });
    // $('#purchaseInvoiceTable').DataTable();
    $('.category_card').on('click', function() {
        $('.item_box').find('.item_card').addClass('d-none');
        var id = $(this).data('id');
        id = '.cat_id_' + id;
        $('.item_header').text(`cat : ` + $(this).data('name'));
        $('.item_box').find(id).removeClass('d-none');
    })
    $('.item_card').on('click', function() {
        var id = $(this).data('id');
        $.post("{{route('putselected.item')}}", {
                id: id
            }
            , function(data) {
                $('#p_sub_total').val(parseInt($('#p_sub_total').val()) + data.price);
                    total = parseInt($('#p_sub_total').val());
                    tax = (parseInt($('input#p_tax').val())*total)/100;
                    discount = (parseInt($('input#p_discount').val())*total)/100;
                    paid =$('#p_paid').val();
                $('#selected-purchase-items-table').DataTable().ajax.reload(null, false);
                $('#p_total').val(parseInt($('#p_sub_total').val())+ tax - discount);
                $('#p_left').val(parseInt($('#p_sub_total').val())+ tax - discount - paid);
            }
            , "json"
        );
            $('#p_tax').attr('readonly', false);
            $('#p_discount').attr('readonly', false);
            $('#p_paid').attr('readonly', false);

    })
    $(document).on('click', '.remove_select_item', function() {

        var id = $(this).data('id');
        $.post("{{route('removeselected.item')}}", { id: id}
            , function(data) {
                if(data.item.length == 0){
                    $('#p_tax').attr('readonly', true);
                    $('#p_discount').attr('readonly', true);
                    $('#p_paid').attr('readonly', true);
                }
                    total = parseInt($('#p_sub_total').val());
                    tax = (parseInt($('input#p_tax').val())*total)/100;
                    discount = (parseInt($('input#p_discount').val())*total)/100;
                    left =$('#p_left').val();
                $('#p_sub_total').val(parseInt($('#p_sub_total').val()) - data.price);
                $('#p_total').val(parseInt($('#p_sub_total').val())+tax-discount);
                $('#p_left').val(parseInt($('#p_sub_total').val())+tax-discount - $('#p_paid').val());
                $('#selected-purchase-items-table').DataTable().ajax.reload(null, false);
            }
            , "json"
        );
    })
    $('input#p_tax').on('input',function () {
        total = parseInt($('#p_sub_total').val()) ;
        tax = (parseInt($(this).val())*total)/100;
        if($(this).val() == ''){
            tax = 0;
        }
        total += tax - (parseInt($('input#p_discount').val())*total)/100;
        $('#p_total').val(total);
        $('#p_left').val(total - $('#p_paid').val());
        total = parseInt($('#p_sub_total').val());

    })
    $('input#p_discount').on('input',function () {
        total = parseInt($('#p_sub_total').val());
        // console.log(total);
        discount = (parseInt($(this).val())*total)/100;
        if($(this).val() == ''){
            discount = 0;
        }
        total -= discount - (parseInt($('input#p_tax').val())*total)/100;
        $('#p_total').val(total);
        $('#p_left').val(total - $('#p_paid').val());
        total = parseInt($('#p_sub_total').val());

    })
    $('input#p_paid').on('input',function () {
        total = parseInt($('#p_total').val());
        paid = $(this).val();
        if($(this).val() == ''){
            paid = 0;
        }
        left =total - paid;
        $('#p_left').val(left);

    })
    $(document).on('change','input.selected_item_qty',function () {
        var id = $(this).data('id');
        var val = $(this).val();
        $.post("{{route('selected-item-qty.get')}}", {id:id,val:val},
            function (data) {
                console.log(data.all);
                // $(this).focus();
                $('#p_sub_total').val(parseInt($('#p_sub_total').val()) + data.price);
                total = parseInt($('#p_sub_total').val());
                tax = (parseInt($('input#p_tax').val())*total)/100;
                discount = (parseInt($('input#p_discount').val())*total)/100;
                $('#p_total').val(parseInt($('#p_sub_total').val())+tax-discount);
                $('#p_left').val(parseInt($('#p_sub_total').val())+tax-discount - $('#p_paid').val());
                // setTimeout(() => {
                    $('#selected-purchase-items-table').DataTable().ajax.reload(null, false);
                // }, 1000);
            },
            "json"
        );

    })
    $(document).on('change','input.selected_item_price',function () {
        var id = $(this).data('id');
        var val = $(this).val();
        $.post("{{route('selected-item-price.get')}}", {id:id,val:val},
            function (data) {
                // $(this).focus();
                $('#p_sub_total').val(parseInt($('#p_sub_total').val()) + data.price);
                total = parseInt($('#p_sub_total').val());
                tax = (parseInt($('input#p_tax').val())*total)/100;
                discount = (parseInt($('input#p_discount').val())*total)/100;
            console.log(data.all);
                $('#p_total').val(parseInt($('#p_sub_total').val())+tax-discount);
                $('#p_left').val(parseInt($('#p_sub_total').val())+tax-discount - $('#p_paid').val());
                // setTimeout(() => {
                    $('#selected-purchase-items-table').DataTable().ajax.reload(null, false);
                // }, 1000);
            },
            "json"
        );
    })
    $(document).on('submit','#purchaseInvoiceForm',function (e) {
        e.preventDefault();
        $.post("{{route('add.purchase')}}",{
            company:$("select#p_comapny").val(),
            remark:$("textarea#p_remark").val(),
            date:$("#p_date").val(),
            remind_date:$("#p_remain_date").val(),
            voucher_id:$("#p_voucher_id").val(),
            tax : $('#p_tax').val() ,
            discount :$('#p_discount').val(),
            paid :$('#p_paid').val(),
        },
            function (data) {
                // console.log(data.items);
                setTimeout(() => {
                    // console.log(data.all.remind_date != null && data.count > 0 );
                    // console.log();
                    if(data.count > 0 && data.all.remind_date != null){
                        $('#selected-purchase-items-table').DataTable().ajax.reload(null, false);
                        $('#p_total').val(0);
                        $('#p_sub_total').val(0);
                        $('input#p_tax').val(0);
                        $("#p_remain_date").val('');
                        $('input#p_discount').val(0);
                        $("textarea#p_remark").val('');
                        $("input#p_paid").val(0);
                        $("input#p_left").val(0);
                        toastr.success('Items purchased succcessfully!');
                        // location.replace("/")
                        let yes = confirm('print voucher?');
                        if(yes){
                            window.location.replace('list-purchase/'+$("#p_voucher_id").val()+'?print=true');
                        }else{
                            window.location.reload();
                        }
                    }else if(data.count == 0){
                        toastr.error('nothing selected!');
                    }else if(data.all.remind_date == null){
                        toastr.error('Add remind date!');
                    }
                }, 500);

            },
            "json"
        );


    })
    $('.cancel-btn').click(()=>{
            window.location.reload();
        })
</script>
@endsection
