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
        $states = [];
        $cities = [];
        $user = null;
        if (Auth::check() == true) {
            $carts = $this->cartRepository->getAllCart();
            $user = Auth::user();
            if(isset($user->country_id)){
                $states = $this->cartRepository->getStates($user->country_id);
            }

            if(isset($user->state_id)){
                $cities = $this->cartRepository->getCities($user->state_id);
            }
        }
        $countries = $this->cartRepository->getAllCountries();

        return view('frontend.pages.product.checkout', compact('carts', 'user', 'countries', 'states', 'cities'));
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
            if($data['checkOutType'] == "Sale"){
                $carts = $this->cartRepository->getAllCart();
                foreach ($carts as $key => $cart) {
                    $Amt += $cart->product_attribute_group_detail->price;
                }
                $description = "Sticker Purchase";
            }else if($data['checkOutType'] == "Package"){
                $Amt = Session::get('packagePrice');
                $description = "Buy ".Session::get('packageName')." Package";
            }

            $token = $data['stripeToken'];
            try {
                $Amt = round($Amt, 2);
                $Amt = $Amt * 100;
                Stripe\Stripe::setApiKey(config('app.stripe')['STRIPE_SECRET']);
                $obj = Stripe\Charge::create ([
                    "amount" => $Amt,
                    "currency" => "USD",
                    "source" => $token,
                    "description" => $description,
                ]);
                $data['transaction_id'] = $obj['id'];
                $data['transaction_slip_url'] = $obj['receipt_url'];
                $data['paymentMethod'] = "stripe";
                $invoice_number = $this->cartRepository->createNewOrder($data);

                return Redirect::route('thank-you.index',$invoice_number);
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

    public function getStates(Request $request, UtilService $utilService){
        $states = $this->cartRepository->getStates($request->country_id);
        return $utilService->makeResponse(200, "States get successfully", $states, CommonEnum::SUCCESS_STATUS);
    }

    public function getCities(Request $request, UtilService $utilService){
        $cities = $this->cartRepository->getCities($request->state_id);
        return $utilService->makeResponse(200, "Cities get successfully", $cities, CommonEnum::SUCCESS_STATUS);
    }

    public function thankYou($id)
    {
        $order = $this->cartRepository->getOrders($id);
        return view('frontend.pages.product.thank-you', compact('order'));
    }

    public function addToCartPackage(
        Request $request,
        UtilService $utilService
        ){
            Session::put('packageId', $request->packageId);
            Session::put('packagePrice', $request->packagePrice);
            Session::put('packageName', $request->packageName);
            Session::put('packageType', $request->packageType);
            Session::put('packageToken', $request->packageToken);
            Session::put('status', "package");
        return $utilService->makeResponse(200, "Package add in cart successfully", [], CommonEnum::SUCCESS_STATUS);
    }


}
