<?php

namespace App\View\Components;

use App\Models\Purchase;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\View\Component;

class Notification extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $purchases = Purchase::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // $fromdate =  Carbon::parse(now())->format('Y-m-d H:m:s');
        //   $todate =  Carbon::parse(.'23:59:59')->format('Y-m-d H:m:s');
        // $sales = Purchase::whereBetween('created_at', [$fromdate, $todate])
        // ->where('enable', 1)
        // ->get();
        $purchases = Purchase::where([
            // 'read' => 0,
            'enable' => 1
        ])->get();

        return view('components.notification', [
            'purchases' => $purchases,
        ]);
    }
}