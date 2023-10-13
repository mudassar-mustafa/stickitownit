<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Enums\CommonEnum;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\FAQ;
use App\Models\Feature;
use App\Models\Page;
use App\Models\Quote;
use App\Models\Sticker;
use Illuminate\Http\Request;
use App\Traits\UploadFile;
use App\Contracts\Frontend\LandingContract;

class LandingController extends Controller
{
    use UploadFile;

    /**
     * @var CartContract
     */
    protected $landingRepository;

    public function __construct(LandingContract $landingRepository)
    {
        $this->landingRepository = $landingRepository;
    }

    public function index()
    {
        $features = Feature::orderBy('id', 'asc')->get(['id', 'name', 'short_description', 'image']);
        $faqs = FAQ::whereStatus('active')->orderBy('id', 'asc')->get(['name', 'short_description']);
        $blogs = Blog::whereStatus('active')->orderBy('id', 'asc')->get(['id', 'name', 'title', 'slug', 'image', 'created_at', 'author_name']);
        $stickers = Sticker::whereStatus('active')->orderBy('id', 'asc')->get(['image']);
        return view('frontend.pages.index', compact('features', 'faqs', 'blogs', 'stickers'));
    }

    public function faq()
    {
        $faqs = FAQ::whereStatus('active')->orderBy('id', 'asc')->get(['name', 'short_description']);
        return view('frontend.pages.faq', compact('faqs'));
    }

    public function page($slug)
    {
        $page = Page::where([
            'slug' => $slug,
            'status' => 'active'
        ])->first();
        return view('frontend.pages.page', compact('page'));
    }

    public function getQuote()
    {
        $countries = Country::whereStatus('active')->orderBy('name', 'asc')->get(['name']);
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
        $file = null;
        if ($request->has('file')) {
           $file =  $this->upload($request->file, 'quotes');
        }
        Quote::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'company' => $request->company,
            'website' => $request->website,
            'project' => $request->project,
            'material_type' => $request->material_type,
            'width' => $request->width,
            'height' => $request->height,
            'quantity' => $request->quantity,
            'file' => $file,
            'message' => $request->message
        ]);
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
        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);
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
}
