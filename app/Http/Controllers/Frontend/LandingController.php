<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Enums\CommonEnum;
use Illuminate\Http\Request;
use App\Contracts\Frontend\LandingContract;
use App\Helpers\Helper;
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
        $faqs = $this->landingRepository->getFaqs();
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

    public function leonardoApi()
    {
        $params = [];
        $params['height'] = 512;
        $params['modelId'] = '6bef9f1b-29cb-40c7-b9df-32b51c1f67d3';
        $params['prompt'] = 'An oil painting of a cat';
        $params['width'] = 512;
        $params['num_images'] = 1;
        $data = Helper::createGeneration($params);
        return $data;
    }

    public function leonardoApiCallBack()
    {
        \Log::info("function hit");
        return "dfdsf";
    }
}
