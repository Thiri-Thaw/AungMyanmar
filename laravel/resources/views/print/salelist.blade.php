@extends('layouts.app')
@section('content')

<div class="container" >
    {{-- style="margin-top: 300px" --}}
    <style>
        @media print{
            @page{
                size: 2480px 3508px;
            }
        }
        tbody tr{
            border-bottom: #000 1px dotted;
            /* padding:200px; */
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
        <p>Vouncher:{{$sales->voucher_id}}</p>
        <p>Customer:{{$sales->customer->name}}</p>
    </div>
    <table class="col-5 px-4" style="font-size: 20px;" id="" width="50%" cellspacing="0" >
        <thead>
            <tr>
                {{-- <th scope="col">#</th>
                <th scope="col">အမျိုးအမည်</th>
                <th scope="col">ပစ္စည်းကုဒ်</th> --}}
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
                @foreach ($sale_details as $sale_detail)
                    @php
                        $total +=$sale_detail->sale_price * $sale_detail->quantity;
                        ++$id;
                    @endphp
                    <tr>
                        {{-- <td>{{$id}}</td>
                        <td>{{$sale_detail->category->name}}</td>
                        <td>{{$sale_detail->item->code}}</td> --}}
                        <td>{{$sale_detail->item->name}}</td>
                        <td>{{$sale_detail->sale_price}}</td>
                        <td>{{$sale_detail->quantity}}</td>
                        <td>{{$sale_detail->sale_price * $sale_detail->quantity}}</td>
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
                    {{-- <td></td>
                    <td></td>
                    <td></td> --}}
                    <td></td>
                    <td></td>
                    <td >Tax</td>
                    <td>{{$sales->tax}} %</td>
                </tr>
                <tr>
                    {{-- <td></td>
                    <td></td>
                    <td></td> --}}
                    <td></td>
                    <td></td>
                    <td >Discount</td>
                    <td>{{$sales->discount}} %</td>
                </tr>
                <tr>
                    {{-- <td></td>
                    <td></td>
                    <td></td> --}}
                    <td></td>
                    <td></td>
                    <td >စုစုပေါင်း</td>
                    <td>{{$total = $total -($sales->discount*$total)/100 + ($sales->tax*$total)/100 }}</td>
                </tr>
                {{-- <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td >Net Total</td>
                    <td>{{$total = $total -($sales->discount*$total)/100 + ($sales->tax*$total)/100 }} MMK</td>
                </tr> --}}
                <tr>
                    {{-- <td></td>
                    <td></td>
                    <td></td> --}}
                    <td></td>
                    <td></td>
                    <td >ပေးငွေ</td>
                    <td>{{$sales->paid_amount}}</td>
                </tr>
                <tr>
                    {{-- <td></td>
                    <td></td>
                    <td></td> --}}
                    <td></td>
                    <td></td>
                    <td >ကျန်ငွေ</td>
                    <td>{{$total - $sales->paid_amount}}</td>
                </tr>
        </tfoot>
    </table>
    {{-- {{$id}} --}}
</div>

@endsection

@section('script')
<script>
    $('.main-sidebar').remove();
    $('.main-header').remove();
$(document).ready(function () {
    setTimeout(() => {
        window.print();
        window.location.replace('../salelist-view/'+'{{$sales->id}}');
    }, 1500);
 })

</script>
{{-- $(document).ready(function(){
    $('#myTable').DataTable({"orderFixed": [ 1, 'desc' ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend:'excel',
                // exportOptions: {
                // columns: [0, 1, 2, 3, 4, 5, 6, 7]
                // },
            },
        {
            extend: 'print',
            title: '{{$purchases->voucher_id}}',
            customize: function ( win ) {
                $(win.document.body)
                    .css( 'font-size', '10pt' )

                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    // .css( 'margin-top', '500px' );
            }
        }
    ]
    })
    $(document).find('.buttons-print').click();
    setTimeout(() => {
        window.location.replace('../list-purchase/'+'{{$purchases->voucher_id}}');
    }, 1500);






    // $.print("#myTable");

    // window.html2canvas = html2canvas;
    // window.jsPDF = window.jspdf.jsPDF;
    // var doc = new jsPDF();
    // var source = window.document.getElementsByTagName("body")[0];
    // doc.fromHTML(
    //     source,
    //     15,
    //     15,
    //     {
    //     'width': 180,'elementHandlers': elementHandler
    //     });

    // doc.save();





}); --}}
{{-- $('#print').printPage();
window.html2canvas = html2canvas;
    window.jsPDF = window.jspdf.jsPDF;

    html2canvas(document.querySelector("#table"),{
        allowTaint:true,
        useCORS:true,
        scale:1
    }).then(canvas => {
        document.body.appendChild(canvas)

        var doc = new jsPDF()
        doc.setFont('Arial')
        doc.setFontSize(1)
        doc.save()
    });

alert(); --}}
<script>
    // $(document).ready(function () {
    //     alert();var element = document.getElementById('table');
    // html2pdf(element);
    //         html2pdf(element, {
    //     margin:       10,
    //     filename:     'myfile.pdf',
    //     image:        { type: 'jpeg', quality: 0.98 },
    //     html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
    //     jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    //     });
    // });

</script>
@endsection
