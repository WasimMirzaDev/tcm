<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CombinedOrder;
use App\Models\CustomerPackage;
use App\Models\SellerPackage;
use Session;
use Auth;

class WalletController extends Controller
{
    public function pay(){
        if(Session::has('payment_type')){
            if(Session::get('payment_type') == 'cart_payment'){
                $user = Auth::user();
                $combined_order = CombinedOrder::findOrFail(Session::get('combined_order_id'));
                if ($user->balance >= $combined_order->grand_total) {
                    $user->balance -= $combined_order->grand_total;
                    $user->save();
                    return (new CheckoutController)->checkout_done($combined_order->id, null);
                }
                if ($user->balance <= $combined_order->grand_total) {
                    $remain=$combined_order->grand_total-$user->balance;
                    $user->balance=0;
                    $user->save();
                $decorator = __NAMESPACE__ . '\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', 'paypal'))) . "Controller";
                // if (class_exists($decorator)) {
                //     return 'g';
                    return (new $decorator)->pay($remain);
                // }
                
                    // return (new CheckoutController)->checkout_done($combined_order->id, null);
                }
            }
            elseif (Session::get('payment_type') == 'customer_package_payment') {
                $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);
                $amount = $customer_package->amount;
            }
            elseif (Session::get('payment_type') == 'seller_package_payment') {
                $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);
                $amount = $seller_package->amount;
            }
        }
    }
}
