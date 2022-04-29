@extends('layouts.app')

@section('content')

<div class="row p-3">
    <div class="col-8 m-0 p-0 row">
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
                    <h4>Sale Items</h4>
                    <!-- <small class="item_header">cat : none</small> -->
                </div>
                <div class="row item_box" id='itemlist'>
                     @foreach ($items as $item)
                    <div class="col-4 item_card " data-id="{{$item->id}}" data-name="{{$item->name}}"
                    data-catid="{{$item->category_id}}" data-catname="{{$item->category->name}}" data-retail="{{$item->retail_price}}">
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
    <div class="col-4 m-0 p-0">
        <div class="p-2">

            <form action="{{ route('sale.update',$sale->id) }}" method="post">
                @csrf
                <div class="d-flex justify-content-between mb-2">
                    <!-- <h4 class="col-2">Invoice</h4> -->
                      <div class="d-flex align-items-center col-6 row">
                         Voucher-Id: <input type="text" name="voucher_id" class="form-control form-control-sm ml-2" value="{{ $sale->voucher_id }}" readonly>
                      </div>
                      <div class="col-6 d-flex align-items-center">
                         Date: <input type="date" name="sale_date" class="form-control form-control-sm ml-2"  value="{{ $sale->sale_date }}">
                      </div>
                </div>
            <div class="card selected-sale-items">
                <div class="card-body pt-0 px-0">
                    <table class="table mb-3 table-head-fixed text-center w-100" id="selected-sale-items-table">
                        <thead>

                            <th>Item</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>action</th>
                        </thead>
                        <tbody id='saleitem'>
                            @php $items = []; @endphp
                        @foreach($sale_details as $detail)
                            @php
                                $items[] = array('id'=>$detail->item_id,
                                'name'=>$detail->item->name,'catid'=>$detail->category_id,'catname'=>$detail->category->name,'price'=>$detail->sale_price,'retail'=>$detail->item->retail_price,'whole'=>$detail->item->wholesale_price,'qty'=>$detail->quantity,'total'=>($detail->quantity * $detail->sale_price),'saledetail'=>$detail->id);
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <div id='getitems' data-items="{{json_encode($items)}}"></div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">

                    <div class="form-group row">
                        <div>
                            <label for="" class="form-label p-0">Customer</label>
                            <small>
                                <!-- <span class="float-end"><a href="{{route('customer.create')}}">Add +</a></span> -->
                            </small>
                        </div>
                        {{-- <input type="text" class="form-control form-control-sm"> --}}
                        <select name="customer_id" id="customer_id" class="form-select form-select-sm">
                        <!-- <option value="1" selected>Default Customer</option> -->
                            @foreach ($customers as $customer)
                            <option value="{{$customer->id}}" type="{{$customer->sale_type}}" @php if($customer->id== $sale->customer_id)echo "selected" @endphp >{{$customer->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row">
                        <div>
                            <label for="" class="form-label p-0">Remark</label>
                        </div>
                         <input type="text" class="form-control form-control-sm" name="remark">
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Sub Total</th>
                                <td id='subtotal'><input type="hidden" name="subtotal"></td>
                            </tr>
                            <tr>
                                <th>Tax%</th>
                                <td><input type="text" name="tax" id="tax" class="form-control form-control-sm" value="{{$sale->tax}}"></td>
                            </tr>
                            <tr>
                                <th>Discount%</th>
                                <td><input type="text" name="discount" id="discount" class="form-control form-control-sm" value="{{$sale->discount}}"></td>
                            </tr>
                            <tr>
                                <th>Net Amount</th>
                                <td id="netamount"></td>
                            </tr>
                            <tr>
                                <th>Paid</th>
                                <td><input type="text" name="paidamount" id="paidamount" class="form-control form-control-sm" required  value="{{$sale->paid_amount}}"></td>
                            </tr>
                            <tr>
                                <th>Left</th>
                                <td id="leftamount"><input type="hidden" name="leftamount"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr class=" border-top border-top-2">
                                <th>Total</th>
                                <td class="text-success text-bold">1550</td>
                            </tr> -->
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <input type="reset" class="btn btn-outline-danger me-2" value="Cancel">
                        <input type="submit" class="btn btn-lg btn-success px-4" value="Update">
                        {{-- <button class="btn btn-light text-cyan float-end d-flex justify-content-center align-items-center">
                            print <i class="ms-1 fas fa-print float-end"></i>
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
@section('script')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <script>
        $(document).ready(function(){
            if($.cookie('back')=='back'){
                saleitem()
                $.cookie('back','')
            }else{
            $items = $('#getitems').data('items')
            $items = $items
            $tax = $('#tax').val()
            $discount = $('#discount').val()
            $paidamount = $('#paidamount').val()
            $leftamount = $('#leftamount').val()
            console.log($items);
            $.cookie('items', JSON.stringify($items))
            $.cookie('tax', $tax)
            $.cookie('discount', $discount)
            $.cookie('paidamount', $paidamount)
            $.cookie('leftamount', $leftamount)
            $customer = $('option:selected', '#customer_id').attr('type');
            $.cookie('customer', $customer)
            console.log('Customer :'+$.cookie('customer'));
            saleitem()
            }
        })
        // $('#selected-sale-items-table').DataTable({
        //     "paging":   false,
        //     "ordering": false,
        //     "info":     false,
        //     "searching": false,
        //
        //         columns:[
        //                  {data:"DT_RowIndex",name:"DT_RowIndex"},
        //                  {data:"name",name:"name"},
        //                  {data:"price",name:"price"},
        //                  {data:"qty",name:"qty"},
        //                  {data:"action",name:"action"},
        //              ]

        // });
        $('.category_card').on('click',function(){
            // $('.item_box').find('.item_card').addClass('d-none');
            // var id = $(this).data('id');
            // id = '.cat_id_'+id;
            // $('.item_header').text(`cat : `+$(this).data('name'));
            // $('.item_box').find(id).removeClass('d-none');
            $cat_id = $(this).data('id');

            // $arr2 = ["Saab1", "Volvo1", "BMW1"];
                $('#itemlist').html('');
                $html='';
                $.get('/getselectedCat/',   // url
                {cat_id: $cat_id }, // data to be submit
                function(data, status, jqXHR) {// success callback
                            // $('p').append('status: ' + status + ', data: ' + data);
                            console.log(data.dt)
                            for($i=0;$i<data.dt.length;$i++){
                                $html=$html+'<div class="col-4 item_card  " data-id="'+
                                data.dt[$i].id+'" data-name="'+data.dt[$i].name+'" data-catid="'+data.dt[$i].catid+'" data-catname="'+data.dt[$i].catname+'"'+
                                ' data-retail="'+data.dt[$i].retail+'" data-whole="'+data.dt[$i].whole+'">'+
                                    '<div class="m-2 card" style="height: 90px">'+
                                    '<div class="card-body d-flex justify-content-center align-items-center">'+
                                    data.dt[$i].name+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                            }
                            $('#itemlist').html($html);
                    })


        })
        $(document).on('click','.item_card',function(){
            $id = $(this).data('id');
            $name = $(this).data('name');
            $retail = $(this).data('retail');
            $whole = $(this).data('whole');
            $catid = $(this).data('catid');
            $catname = $(this).data('catname');
            $qty =1;
            $price =$whole;
            $customer = $.cookie('customer');
            if($customer=='retail')
            {
                $price = $retail;
            }

            $total = $qty*$price;
            // $temp =[{'id':$id,'name':$name,'qty':$qty}]
            // $temp = JSON.stringify($temp);
            // console.log($temp)
            $check = false;
            for($i=0;$i<$items.length;$i++){
                    $.cookie('items', JSON.stringify([]))
                    if($items[$i].id==$id){

                        $check = true;
                    }
            }
            if($check){
                for($i=0;$i<$items.length;$i++){
                    $.cookie('items', JSON.stringify([]))
                    if($items[$i].id==$id){
                        // $id = $items[$i].id;
                        // $name = $items[$i].name;
                        $items[$i].qty = parseInt($items[$i].qty) + 1;
                        $items[$i].total = parseInt($items[$i].qty) * $items[$i].price;
                        // $items[$i] = '';
                        // $.removeCookie($items[0]);
                        //  console.log($items)

                    }
                }
            }else{
                $items.push({'id':$id,'name':$name, 'catid':$catid, 'catname':$catname, 'price':$price, 'retail':$retail,'whole':$whole,'qty':$qty,'total':$total});
                // $items=$temp
            }
            $.cookie('items', JSON.stringify($items))


             console.log($.cookie('items'));



            saleitem()

            // console.log($.cookie('items'))


        })
        $(document).on('click','.remove_select_item',function(){
            $id = $(this).data('id');
            $items = $.parseJSON($.cookie("items"));

            for($i=0;$i<$items.length;$i++){
                    $.cookie('items', JSON.stringify([]))
                    if($items[$i].id==$id){
                        // $id = $items[$i].id;
                        // $name = $items[$i].name;
                        var removeItem =$items[$i];
                        $items = $.grep($items, function(value) {
                                return value != removeItem;
                            });
                        // $items[$i] = '';
                        // $.removeCookie($items[0]);

                    }
                }
                $.cookie('items', JSON.stringify($items))

                saleitem()


            // console.log($.cookie('items'))
        })
        $(document).on('change','#customer_id',function(){
            $customer = $('option:selected', this).attr('type');
            $.cookie('customer',$customer)
            $items = $.parseJSON($.cookie("items"));

            for($i=0;$i<$items.length;$i++){
                    // $.cookie('items', JSON.stringify([]))
                    $items[$i].price = $items[$i].retail;
                    if($customer != 'retail'){
                        $items[$i].price = $items[$i].whole;
                    }

                    $total =$items[$i].qty*$items[$i].price;
                        $items[$i].total = $total;
                        console.log($total)
                }
                $.cookie('items', JSON.stringify($items))

                saleitem();
        })
        $(document).on('change','.saleprice',function(){
            $value = $(this).val();
            $id = $(this).data('id');
            $items = $.parseJSON($.cookie("items"));

            for($i=0;$i<$items.length;$i++){
                    // $.cookie('items', JSON.stringify([]))
                    if('price-'+$items[$i].id==$id){
                        // $id = $items[$i].id;
                        // $name = $items[$i].name;
                        $total =$items[$i].qty*$value;
                        $items[$i].price = $value;
                        $items[$i].total = $total;
                        // $items[$i] = '';
                        // $.removeCookie($items[0]);
                        $(this).parent().next().next().html($total);

                    }
                }
                $.cookie('items', JSON.stringify($items))

                finalsale();
        })

        $(document).on('change','.saleqty',function(){
            $value = $(this).val();
            $id = $(this).data('id');
            $items = $.parseJSON($.cookie("items"));

            for($i=0;$i<$items.length;$i++){
                    $.cookie('items', JSON.stringify([]))
                    if('qty-'+$items[$i].id==$id){
                        // $id = $items[$i].id;
                        // $name = $items[$i].name;
                        $total =$items[$i].price*$value;
                        $items[$i].qty = $value;
                        $items[$i].total = $total;
                        // $items[$i] = '';
                        // $.removeCookie($items[0]);
                        $(this).parent().next().html($total);

                    }
                }
                $.cookie('items', JSON.stringify($items))
                finalsale();
                // console.log($.cookie('items'))
        })

        $(document).on('keyup','#tax',function(){
            $value = $(this).val();
            $.cookie('tax', $value);
            saleitem()

        })

        $(document).on('keyup','#discount',function(){
            $value = $(this).val();
            $.cookie('discount', $value);
            saleitem()

        })

        $(document).on('keyup','#paidamount',function(){
            $value = $(this).val();
            $.cookie('paidamount', $value);
            saleitem()

        })

        function saleitem()
        {
            $items = $.parseJSON($.cookie("items"));
            $subtotal =0;
            $html='';
            for($i=0;$i<$items.length;$i++){
                $html =$html+'<tr><td><input type="hidden" name="saledetail[]" value="'+$items[$i].saledetail+'"><input type="hidden" name="itemid[]" value="'+$items[$i].id+'">'+$items[$i].name+'</td>'+
                                '<td><input type="hidden" min="0" name="catid[]" id="" data-catid="'+$items[$i].catid+'" value="'+$items[$i].catid+'" style="width:60px">'+$items[$i].catname+'</td>'+
                                '<td><input type="number" min="0" name="price[]" id="" class="saleprice" data-id="price-'+$items[$i].id+'" value="'+$items[$i].price+'" style="width:80px"></td>'+
                                '<td><input type="number" min="1" name="qty[]" data-id="qty-'+$items[$i].id+'" id="" class="saleqty" value="'+$items[$i].qty+'" style="width:60px"></td>'+
                                '<td>'+$items[$i].total+'</td>'+
                                '<td>'+
                                    '<a><i class="fas fa-minus-circle text-danger mr-1 remove_select_item" data-id="'+$items[$i].id+'"></i></a>'+
                                '</td>'+
                            '</tr>';

                            // $subtotal=$subtotal+$items[$i].total
            }
            $('#saleitem').html($html);
            finalsale();
        }
        function finalsale()
        {

            $items = $.parseJSON($.cookie("items"));
            $subtotal =0;
            $html='';
            for($i=0;$i<$items.length;$i++){
                $subtotal=$subtotal+$items[$i].total
            }
            $tax = $.cookie("tax");
            $paidamount = $.cookie("paidamount");
            $discount = $.cookie("discount");
            $leftamount = $.cookie("leftamount");
            if($subtotal!=0){
                $leftamount = parseInt($subtotal);
            }

            if($tax!=0 && $discount!=0)
            {
                // $leftamount = parseInt($subtotal);
                $leftamount = parseInt($leftamount) + (parseInt(($leftamount*$tax)/100) - parseInt(($leftamount*$discount)/100));
            }else if($tax!=0){
                $leftamount = parseInt($leftamount) + parseInt(($leftamount*$tax)/100);
            }else if($discount!=0){
                $leftamount = parseInt($leftamount) - parseInt(($leftamount*$discount)/100);
            }

            $netamount = $leftamount;

            // if($tax!=0){
            //     $leftamount = $leftamount + (($leftamount*$tax)/100);
            // }
            // if($discount!=0){
            //     $leftamount = $leftamount - (($leftamount*$discount)/100);
            // }

            if($paidamount!=0){
                $leftamount = $leftamount - $paidamount;
            }
            $sub = '<input type="hidden" name="subtotal" class="form-control form-control-sm" value="'+$subtotal+'">'+$subtotal
            $left = '<input type="hidden" name="leftamount" class="form-control form-control-sm" value="'+$leftamount+'">'+$leftamount
            $net = '<input type="hidden" name="netamount"  class="form-control form-control-sm" value="'+$netamount+'">'+$netamount

            $('#subtotal').html($sub)
            $('#netamount').html($net)
            $('#leftamount').html($left)

            // $.cookie("leftamount",$leftamount);
            // console.log($items)
        }
    </script>
@endsection

