<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\Frontend\CartContract;
use Illuminate\Contracts\View\View;
use App\Services\UtilService;
use App\Http\Enums\CommonEnum;
use Auth;

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
        if (Auth::check() == true) {
            $carts = $this->cartRepository->getAllCart();
        }
        return view('frontend.pages.product.checkout', compact('carts'));
    }


}
