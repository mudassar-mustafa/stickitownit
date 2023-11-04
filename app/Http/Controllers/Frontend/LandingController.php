<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Enums\CommonEnum;
use App\Models\Generation;
use App\Models\PackageSubscription;
use Illuminate\Http\Request;
use App\Contracts\Frontend\LandingContract;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    /**
     * @var LandingContract
     */
    protected $landingRepository;

    public function __construct(LandingContract $landingRepository)
    {
        $this->landingRepository = $landingRepository;
    }

    public function index()
    {
        $features = $this->landingRepository->getFeatures();
        $faqs = $this->landingRepository->getFaqs(2);
        $blogs = $this->landingRepository->getBlogs();
        $stickers = $this->landingRepository->getStickers();
        return view('frontend.pages.index', compact('features', 'faqs', 'blogs', 'stickers'));
    }

    public function faq()
    {
        $faqs = $this->landingRepository->getFaqs();
        return view('frontend.pages.faq', compact('faqs'));
    }

    public function page($slug)
    {
        $page = $this->landingRepository->getPageBySlug($slug);
        return view('frontend.pages.page', compact('page'));
    }

    public function getQuote()
    {
        $countries = $this->landingRepository->getCountries();
        return view('frontend.pages.get-quote', compact('countries'));
    }

    public function getQuoteStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'project' => 'required',
            'material_type' => 'required',
            'width' => 'required',
            'height' => 'required',
            'quantity' => 'required',
        ]);

        $data = $request->except('_token');
        $quote = $this->landingRepository->storeQuote($data);
        return redirect()->route("/")->with([
            "status" => CommonEnum::SUCCESS_STATUS,
            "message" => "Your Quote has been saved successfully.We will contact you shortly."
        ]);
    }

    public function contactUs()
    {
        return view('frontend.pages.contact-us');
    }

    public function contactUsStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        $data = $request->except('_token');
        $contact = $this->landingRepository->storeContact($data);
        return redirect()->route("/")->with([
            "status" => CommonEnum::SUCCESS_STATUS,
            "message" => "Your Query has been saved received.We will contact you shortly."
        ]);
    }

    public function packages()
    {
        $packages = $this->landingRepository->getPackages();
        return view('frontend.pages.packages', compact('packages'));
    }


    public function leonardoApiCallBack(Request $request)
    {
        \Log::info("function hit");
        return "dfdsf";
    }

    public function createGeneration()
    {
        return view('frontend.pages.generation');
    }

    public function storeGeneration(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'project' => 'required',
            'prompt_text' => 'required',
            'no_of_images' => 'required',
        ]);
        $packageSubscription = PackageSubscription::where('user_id', Auth::user()->id)->where('status', 'active')->first();
        if(!empty($packageSubscription) && $packageSubscription->remaing_token > 0){
            $params = $request->except('_token');

            $params['modelId'] = '6bef9f1b-29cb-40c7-b9df-32b51c1f67d3';
            $params['height'] = '512';
            $params['width'] = '512';
            $response = Helper::createGeneration($params);

            if ($response['success'] === false) {
                return response()->json([
                    'error' => $response['data'],
                    'validation' => false,
                    'success' => false,
                    'message' => 'Something Wrong',
                ]);
            } else {
                if(isset($response['data']) && isset($response['data']['sdGenerationJob'])){
                    $generationId = $response['data']['sdGenerationJob']['generationId'];
                    $usedTokens = $response['data']['sdGenerationJob']['apiCreditCost'];
                    Generation::create([
                        'user_id' => Auth::id(),
                        'leonardo_generation_id' => $generationId,
                        'used_tokens' => $usedTokens,
                        'status' => 'pending'
                    ]);
                    $packageSubscription->remaing_token = $packageSubscription->remaing_token - $usedTokens;
                    $packageSubscription->save();
                    return response()->json([
                        'success' => true,
                        'message' => 'Your generation have been created successfully.',
                        'generationId' => $generationId,
                        'usedTokens' => $usedTokens,
                        'remainingToken' => ''
                    ]);
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Your generation was not created try again.',
                        'generationId' => "",
                        'usedTokens' => "",
                        'remainingToken' => ''
                    ]);
                }
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Please subcribe package.',
                'generationId' => "",
                'usedTokens' => "",
                'remainingToken' => ''
            ]);
        }
    }
}
