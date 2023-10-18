<?php

namespace App\Repositories\Frontend;

use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\ProductAttributeValueGroup;
use App\Models\AttributeValue;
use App\Models\ProductAttributeGroup;
use App\Models\Cart;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderSaleDetail;
use App\Models\OrderPackageDetail;
use App\Models\PackageSubscription;
use App\Contracts\Frontend\CartContract;
use Auth;
use Illuminate\Support\Facades\Mail;
use Session;

class CartRepository extends BaseRepository implements CartContract
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getAllCart(){
        return Cart::with(['user:id,name', 'product_attribute_group_detail:id,product_id,main_image,short_description,quantity,price', 'product_attribute_group_detail.product:id,title,slug'])->where('user_id', Auth::user()->id)->get();
    }

    public function removeToCart($cartId){
        $status = true;
        Cart::where('id', $cartId)->delete();
        return $status;
    }

    public function getAllCountries(){
        return Country::where('status', 'active')->get();
    }

    public function getStates($countryId){
        $states =  State::where('status', 'active');
        if($countryId != 0){
            $states = $states->where('country_id', $countryId);
        }

        $states = $states->get();
        return $states;
    }

    public function getCities($stateId){
        $cities =  City::where('status', 'active');
        if($stateId != 0){
            $cities = $cities->where('state_id', $stateId);
        }

        $cities = $cities->get();
        return $cities;
    }

    public function createNewOrder(array $data){
        $invoiceNumber = 0;
        if($data['checkOutType'] == "Sale"){
            $invoiceNumber = $this->saleCart($data);
        }else if($data['checkOutType'] == "Package"){
            $invoiceNumber = $this->packageCart($data);
        }
        return $invoiceNumber;

    }

    public function saleCart(array $data){
        $getAllSeller = Cart::where('user_id', Auth::user()->id)->groupBy('seller_id')->pluck('seller_id')->toArray();
        $invoiceNumber = Order::max('invoice_number');
        $invoiceNumber = $invoiceNumber != null ? $invoiceNumber + 1 : 1;

        if (!empty($getAllSeller)) {
            foreach ($getAllSeller as $key => $sellerId) {
                $carts = Cart::where('user_id', Auth::user()->id)->where('seller_id', $sellerId)->get();
                if(!empty($carts)){
                    $order = new Order;
                    $order->invoice_number = $invoiceNumber;
                    $order->order_type = $data['checkOutType'];
                    $order->order_status = "pending";
                    $order->payment_status = "completed";
                    $order->order_date = date('Y-m-d H:i:s');
                    $order->order_paid_date = date('Y-m-d H:i:s');
                    $order->buyer_id = Auth::user()->id;
                    $order->seller_id = $sellerId;
                    $order->payment_method = $data['paymentMethod'];
                    if(isset($data['transaction_id'])){
                        $order->transaction_id = $data['transaction_id'];
                    }
                    if(isset($data['transaction_slip_url'])){
                        $order->transaction_slip_url = $data['transaction_slip_url'];
                    }
                    if(isset($data['notes'])){
                        $order->notes = $data['notes'];
                    }
                    $order->billing_name = $data['name'];
                    $order->billing_email = $data['email'];
                    $order->billing_phone = $data['phone_number'];
                    $order->billing_zip_code = $data['zip_code'];
                    $order->billing_country_id = $data['country_id'];
                    $order->billing_city_id = $data['city_id'];
                    $order->billing_state_id = $data['state_id'];
                    $order->billing_address = $data['address'];
                    $order->save();

                    $orderTotalAmt = 0;

                    foreach ($carts as $key => $cart) {
                        $orderTotalAmt += $cart->product_attribute_group_detail->price;
                        $orderSaleDetail = new OrderSaleDetail;
                        $orderSaleDetail->order_id = $order->id;
                        $orderSaleDetail->product_attribute_group_id = $cart->product_attribute_group_id;
                        $orderSaleDetail->qty = $cart->qty;
                        $orderSaleDetail->price = $cart->product_attribute_group_detail->price;
                        $orderSaleDetail->shipping = $cart->shipping_amount;
                        $orderSaleDetail->order_status = $order->order_status;
                        $orderSaleDetail->product_title =  $cart->product_attribute_group_detail->product->title;
                        $orderSaleDetail->product_short_description =  $cart->product_attribute_group_detail->short_description;
                        $orderSaleDetail->product_type =  $cart->product_attribute_group_detail->product->product_type;
                        $orderSaleDetail->product_image =  $cart->product_attribute_group_detail->main_image;
                        $orderSaleDetail->shipping_name = $data['name'];
                        $orderSaleDetail->shipping_email = $data['email'];
                        $orderSaleDetail->shipping_phone = $data['phone_number'];
                        $orderSaleDetail->shipping_zip_code = $data['zip_code'];
                        $orderSaleDetail->shipping_country_id = $data['country_id'];
                        $orderSaleDetail->shipping_city_id = $data['city_id'];
                        $orderSaleDetail->shipping_state_id = $data['state_id'];
                        $orderSaleDetail->shipping_address = $data['address'];
                        $orderSaleDetail->save();
                    }

                    $order->order_total_amount = $orderTotalAmt;
                    $order->save();

                    Cart::where('user_id', Auth::user()->id)->where('seller_id', $sellerId)->delete();
                    Mail::to($order->billing_email)->send(new OrderMail($order));
                    Mail::to('stickitownit@gmail.com')->send(new OrderMail($order));
                }
            }
        }
        return $invoiceNumber;
    }

    public function packageCart(array $data){
        $invoiceNumber = Order::max('invoice_number');
        $invoiceNumber = $invoiceNumber != null ? $invoiceNumber + 1 : 1;

        $order = new Order;
        $order->invoice_number = $invoiceNumber;
        $order->order_type = $data['checkOutType'];
        $order->order_status = "completed";
        $order->payment_status = "completed";
        $order->order_date = date('Y-m-d H:i:s');
        $order->order_paid_date = date('Y-m-d H:i:s');
        $order->buyer_id = Auth::user()->id;
        $order->payment_method = $data['paymentMethod'];
        if(isset($data['transaction_id'])){
            $order->transaction_id = $data['transaction_id'];
        }
        if(isset($data['transaction_slip_url'])){
            $order->transaction_slip_url = $data['transaction_slip_url'];
        }
        $order->order_total_amount = Session::get('packagePrice');
        $order->save();


        $orderPackageDetail = new OrderPackageDetail;
        $orderPackageDetail->order_id = $order->id;
        $orderPackageDetail->package_id = Session::get('packageId');
        $orderPackageDetail->package_name = Session::get('packageName');
        $orderPackageDetail->package_type = Session::get('packageType');
        $orderPackageDetail->token = Session::get('packageToken');
        $orderPackageDetail->save();

        $packageSubscription =  PackageSubscription::where('user_id', Auth::user()->id)->first();
        if(!empty($packageSubscription)){
            $packageSubscription->status = 'expired';
            $packageSubscription->save();
        }
        $startDate = date('Y-m-d H:i:s');
        $endDate = date('Y-m-d H:i:s');
        if(Session::get('packageType') == "weekly"){
            $endDate = date('Y-m-d H:i:s', strtotime($startDate. ' + 7 day'));
        }else if(Session::get('packageType') == "monthly"){
            $endDate = date('Y-m-d H:i:s', strtotime($startDate. ' + 1 month'));
        }else if(Session::get('packageType') == "quartely"){
            $endDate = date('Y-m-d H:i:s', strtotime($startDate. ' + 6 month'));
        }else if(Session::get('packageType') == "yearly"){
            $endDate = date('Y-m-d H:i:s', strtotime($startDate. ' + 1 year'));
        }
        $packageSubscription = new PackageSubscription;
        $packageSubscription->user_id = Auth::user()->id;
        $packageSubscription->package_id = Session::get('packageId');
        $packageSubscription->package_name = Session::get('packageName');
        $packageSubscription->package_type = Session::get('packageType');
        $packageSubscription->token = Session::get('packageToken');
        $packageSubscription->remaing_token = Session::get('packageToken');
        $packageSubscription->start_date = $startDate;
        $packageSubscription->end_date = $endDate;
        $packageSubscription->status = "active";
        $packageSubscription->save();

        Session::forget('packageId');
        Session::forget('packagePrice');
        Session::forget('packageName');
        Session::forget('packageToken');
        Session::forget('status');
        Mail::to(Auth::user()->email)->send(new OrderMail($order));
        Mail::to('stickitownit@gmail.com')->send(new OrderMail($order));
        return $invoiceNumber;

    }

    public function getOrders($id){
        return Order::where('invoice_number', $id)->first();
    }

}
