@extends('layouts.app')
@section('content')

<div class="container"  >
    <style>
        @media print{
            @page{
                size: 2480px 3508px;
            }
        }
        tbody tr{
            border-bottom: #000 1px dotted;
        }
    </style>
    <div class="text-center col-5 px">
        <h4 class="mb-3">ဒေါ်ချော(ဇီးကုန်းမြို့) သား ကိုအောင်ရဲဇော် </h4>
        <h3 class="mb-3">
        <strong>
            ပစ်တိုင်းထောင်
        </strong>
        </h3>
        <h3 class="mb-3">စိုက်ပျိုးရေးဆေးအမျိုးမျိုး </h3>
           <h3> နှင့် </h3>
        <h3> ဓါတ်မြေဩဇာရောင်း၀ယ်ရေး</h3>

        <div class="mt-2 " style="border: #000 1px solid;padding:15px;font-size: 50px;">

            <h5 class="m-2"> ဆိုင်(၁) နန်းတော်တောင်ဘက်တိုက်တန်း ၊ ရွှေဘိုမြို့။</h5>
            <h5 class="m-2">ဆိုင်(၂) အောင်ချမ်းသာစျေးအနီး ၊ ဆိပ်ခွန်လမ်းထွက် ၊ ရွှေဘိုမြို့။</h5>
            <h5>
                ၀၉-၄၂၈၉၃၇၃၇၈ ၊ ၀၉-၄၀၀၄၆၅၄၃၆ ၊ ၀၉-၇၈၁၆၁၆၁၅၃ ၊ ၀၉-၉၇၉၅၂၀၉၈၄
            </h5>
        </div>

    </div>
    {{-- style="margin-top: 300px" --}}
    <div class="d-flex justify-content-end col-5 px-">
        <p>Date:{{Date('d/m/Y')}}</p>
    </div>
    <div class="d-flex justify-content-between mb-2 col-5 px">
        <p>Vouncher:{{$purchases->voucher_id}}</p>
        <p>Company:{{$purchases->company->name}}</p>
    </div>
    <table class="col-5 px-4" style="font-size: 20px;" id="" width="50%" cellspacing="0" >
        <thead>
            <tr>
                <th scope="col">ပစ္စည်းအမည်</th>
                <th scope="col">ရောင်းစျေး</th>
                <th scope="col">နှုန်း</th>
                <th scope="col">သင့်ငွေ</th>
            </tr>
        </thead>
        <tbody>
                @php
                    $id = 0;
                    $total = 0;
                @endphp
                @foreach ($purchase_items as $purchase_item)
                    @php
                        $total +=$purchase_item->price * $purchase_item->quantity;
                        ++$id;
                    @endphp
                    <tr>
                        <td>{{$purchase_item->items->name}}</td>
                        <td>{{$purchase_item->price}}</td>
                        <td>{{$purchase_item->quantity}}</td>
                        <td>{{$purchase_item->price * $purchase_item->quantity}}</td>
                    </tr>
                @endforeach
        </tbody>
        <tfoot>

            <tr style= "border-top:3px solid #000;">
                <td></td>
                <td></td>
                <td >Total</td>
                <td>{{$total}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td >Tax</td>
                <td>{{$purchases->tax}} %</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td >Discount</td>
                <td>{{$purchases->discount}} %</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td >စုစုပေါင်း</td>
                <td>{{$total = $total -($purchases->discount*$total)/100 + ($purchases->tax*$total)/100 }} </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td >ပေးငွေ</td>
                <td>{{$purchases->paid}} </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td >ကျန်ငွေ</td>
                <td>{{$total - $purchases->paid}} </td>
            </tr>
        </tfoot>
    </table>
</div>

@endsection

@section('script')
<script>
    $('.main-sidebar').remove();
    $('.main-header').remove();
$(document).ready(function () {
    setTimeout(() => {
        window.print();
        window.location.replace('../list-purchase/'+'{{$purchases->voucher_id}}');
    }, 1500);
 })

</script>
@endsection
