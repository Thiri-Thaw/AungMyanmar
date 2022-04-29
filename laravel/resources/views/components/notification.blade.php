
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell fa-lg fs-2"></i>
                @php
                    $id = 0;
                @endphp
                @foreach ($purchases as $purchase)
                @php
                $total = 0;
                @endphp
                @foreach ($purchase->purchase_items as $purchase_item)
                @php
                    $total += $purchase_item->price * $purchase_item->quantity;
                @endphp
                @endforeach
                @if(date_diff(new \DateTime(), new \DateTime($purchase->remind_date))->format("%r%a") <= '3' && date_diff(new \DateTime(), new \DateTime($purchase->remind_date))->format("%r%a") >= '0' && $purchase->read == 0 &&
                $total -
                $purchase->paid + (($purchase->tax*$total)/100) - (($purchase->discount*$total)/100) != 0
                )
                @php
                    $id++;
                @endphp
                @endif
                @endforeach
            <span class="badge badge-danger navbar-badge">@if ($id == 0)@else{{$id}}@endif</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" >
            <span class="dropdown-item dropdown-header">{{$id}} Notifications</span>
            <div class="dropdown-divider"></div>
            @foreach ($purchases as $purchase)
            @php
                $total = 0;
            @endphp
            @foreach ($purchase->purchase_items as $purchase_item)
            @php
                $total += $purchase_item->price * $purchase_item->quantity;
            @endphp
            @endforeach
            @if(date_diff(new \DateTime(), new \DateTime($purchase->remind_date))->format("%r%a") <= '3' && date_diff(new \DateTime(), new \DateTime($purchase->remind_date))->format("%r%a") >= '0'&&
            $total-
            $purchase->paid + (($purchase->tax*$total)/100) - (($purchase->discount*$total)/100) != 0
            )

            <a href="{{url('/notiread',$purchase->voucher_id)}}" class="dropdown-item  border-bottom border-bottom-1 border-dark" style="
                word-break: break-all;
            @if( $purchase->read == 0)
                background-color:#d6d6d6;
            @endif">
            @if(date_diff(new \DateTime(), new \DateTime($purchase->remind_date))->format("%r%a") == '0')
            <div style="word-break: break-word;">
                Today is to pay <b>{{$purchase->company->name}}</b><wbr> company!
            </div>
            @else
            <div style="word-break: break-word;">
                {{ date_diff(now(), new \DateTime($purchase->remind_date))->format("%r%a days") }} left to pay <b>{{$purchase->company->name}}</b><wbr> company!
            </div>
            @endif
            <div>
                <span class="text-muted text-sm">{{$purchase->voucher_id}}</span>
                <span class="float-end text-muted text-sm">Left - {{
                $total-
                $purchase->paid + (($purchase->tax*$total)/100) - (($purchase->discount*$total)/100)
                }} Kyats</span>
            </div>
            </a>
            @endif
            @endforeach
        </div>
    </li>

