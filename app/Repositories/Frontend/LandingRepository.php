<?php

namespace App\Repositories\Frontend;

use App\Models\Package;
use App\Contracts\Frontend\LandingContract;
use Auth;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\FAQ;
use App\Models\Feature;
use App\Models\Page;
use App\Models\Quote;
use App\Models\Sticker;

class LandingRepository extends BaseRepository implements LandingContract
{
    protected $model;

    public function __construct(Package $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getPackages(){
        return Package::where('status', 'active')->where('name', '!=', 'free')->get();
    }

    /**
     * @return mixed
     */
    public function getFeatures(){
        return Feature::orderBy('id', 'asc')->get(['id', 'name', 'short_description', 'image']);
    }

     /**
     * @return mixed
     */
    public function getFaqs($limit = null){
        $faqs = FAQ::whereStatus('active')->orderBy('id', 'asc');
        if($limit != null){
            $faqs = $faqs->inRandomOrder()->take($limit);    
        }
        $faqs = $faqs->get(['name', 'short_description']);
        return $faqs;
    }

    /**
     * @return mixed
     */
    public function getBlogs(){
        return Blog::whereStatus('active')->orderBy('id', 'asc')->get(['id', 'name', 'title', 'slug', 'image', 'created_at', 'author_name']);
    }

    /**
     * @return mixed
     */
    public function getStickers(){
        return Sticker::whereStatus('active')->orderBy('id', 'asc')->get(['image']);
    }

    /**
     * @return mixed
     */
    public function getPageBySlug($slug){
        return Page::where([
            'slug' => $slug,
            'status' => 'active'
        ])->first();
    }

    /**
     * @return mixed
     */
    public function getCountries(){
        return Country::whereStatus('active')->orderBy('name', 'asc')->get(['name']);
    }

    /**
     * @return mixed
    */
    public function storeQuote(array $params){
        
        $quote =  Quote::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'phone' => $params['phone'],
            'country' => $params['country'],
            'company' => $params['company'],
            'website' => $params['website'],
            'project' => $params['project'],
            'material_type' => $params['material_type'],
            'width' => $params['width'],
            'height' => $params['height'],
            'quantity' => $params['quantity'],
            'file' => $params['file'],
            'message' => $params['message']
        ]);

        return $quote;
    }

    /**
     * @return mixed
    */
    public function storeContact(array $params){
        
        $contact =  ContactUs::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'message' => $params['message']
        ]);

        return $contact;
    }

}
