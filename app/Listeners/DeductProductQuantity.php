<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Throwable;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
      $order = $event->order;

      try{
          foreach($order->products as $product) {
            $product->decrement('quantity', $product->order_item->quantity);
            // Product::where('id' . '=', $item->product_id)
            //         ->update([
            //             'quantity' => DB::raw("quantity -  {$item->quantity}"),
            //         ]);
          } 
        }catch(Throwable $e){
          
        } 
    }
}
