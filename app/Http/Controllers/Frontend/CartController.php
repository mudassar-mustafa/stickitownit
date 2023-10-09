<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\Frontend\CartContract;
use Illuminate\Contracts\View\View;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Auth;
use Stripe;
use Session;
use Redirect;

class CartController extends Controller
{

    /**
     * @var CartContract
     */
    protected $cartRepository;

    public function __construct(CartContract $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function cart()
    {
        $carts = [];
        if (Auth::check() == true) {
            $carts = $this->cartRepository->getAllCart();
        }

        return view('frontend.pages.product.cart', compact('carts'));
    }

    /**
     * @param Request $request
     * @param UtilService $utilService
     * @return JsonResponse
     */
    public function removeToCart(Request $request, UtilService $utilService)
    {
        $status = $this->cartRepository->removeToCart($request->cartId);

        return $utilService->makeResponse(200, "Cart item deleted successfully", $status, CommonEnum::SUCCESS_STATUS);
    }

    public function checkout()
    {
        $carts = [];
        $user = null;
        if (Auth::check() == true) {
            $carts = $this->cartRepository->getAllCart();
            $user = Auth::user();
        }
        return view('frontend.pages.product.checkout', compact('carts', 'user'));
    }

    public function placeOrder(Request $request, UtilService $utilService)
    {
        $data = $request->except('_token');

        if(!isset($data['stripeToken'])){
            return $this->responseRedirectBack('Order Already Placed', 'error', true, true); 
        }else{
            $token='';
            $description='';
            $Amt=0;
            $Invoice_id=0;
            $status='';
            $carts = $this->cartRepository->getAllCart();
            foreach ($carts as $key => $cart) {
                $Amt += $cart->product_attribute_group_detail->price; 
            }
            $description = "Sticker Purchase";
            $token = $data['stripeToken'];
            try {
                $Amt = round($Amt, 2);
                $Amt = $Amt * 100;
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $obj = Stripe\Charge::create ([
                        "amount" => $Amt,
                        "currency" => "USD",
                        "source" => $token,
                        "description" => $description,
                ]);
                return $obj;
                //$invoice_number = $this->CartRepository->createNewOrder($data,$Invoice_id);
                //return Redirect::route('front.checkout.thank-you',$invoice_number);
            } catch(\Stripe\Exception\CardException $e) {
                return $utilService->logErrorAndRedirectToBack('placeOrder', $e->getError()->message);
            } catch (\Stripe\Exception\RateLimitException $e) {
                return $utilService->logErrorAndRedirectToBack('placeOrder', "Too many requests made to the API too quickly");
                // Too many requests made to the API too quickly
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                return $utilService->logErrorAndRedirectToBack('placeOrder', $e->getError()->message);
                // Invalid parameters were supplied to Stripe's API
            } catch (\Stripe\Exception\AuthenticationException $e) {
                return $utilService->logErrorAndRedirectToBack('placeOrder', "Authentication with Stripe\'s API failed");
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                return $utilService->logErrorAndRedirectToBack('placeOrder', "Network communication with Stripe failed");
                // Network communication with Stripe failed
            } catch (\Stripe\Exception\ApiErrorException $e) {
                return $utilService->logErrorAndRedirectToBack('placeOrder', "Error");
                // Display a very generic error to the user, and maybe send
                // yourself an email
            }
        }

        return redirect()->route("backend.pages.product.index")->with([
            "status" => CommonEnum::SUCCESS_STATUS,
            "message" => "Product has been deleted successfully."
        ]);
    }

    public function stripepayment(){
        $params = Session::get('paypal_cart_attribute');
        if(!isset($params['stripeToken'])){
            return $this->responseRedirectBack('Order Already Placed', 'error', true, true); 
        }else{
            $token='';
            $description='';
            $Amt=0;
            $Invoice_id=0;
            $status='';
            try {
                $Amt = round($Amt, 2);
                $Amt = $Amt * 100;
                Stripe\Stripe::setApiKey(config('services.stripe.secret'));
                Stripe\Charge::create ([
                        "amount" => $Amt,
                        "currency" => "USD",
                        "source" => $token,
                        "description" => $description,
                ]);
                $invoice_number = $this->CartRepository->createNewOrder($params,$Invoice_id);
                return Redirect::route('front.checkout.thank-you',$invoice_number);
            } catch(\Stripe\Exception\CardException $e) {
                // Since it's a decline, \Stripe\Exception\CardException will be caught
                return $this->responseRedirectBack($e->getError()->message, 'error', true, true); 
            } catch (\Stripe\Exception\RateLimitException $e) {
                return $this->responseRedirectBack('Too many requests made to the API too quickly', 'error', true, true); 
                // Too many requests made to the API too quickly
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                return $this->responseRedirectBack($e->getError()->message, 'error', true, true);
                // Invalid parameters were supplied to Stripe's API
            } catch (\Stripe\Exception\AuthenticationException $e) {
                return $this->responseRedirectBack('Authentication with Stripe\'s API failed', 'error', true, true);
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                return $this->responseRedirectBack('Network communication with Stripe failed', 'error', true, true);
                // Network communication with Stripe failed
            } catch (\Stripe\Exception\ApiErrorException $e) {
                return $this->responseRedirectBack('Error', 'error', true, true);
                // Display a very generic error to the user, and maybe send
                // yourself an email
            }
        }
        
    }


}
