<?php

namespace App\Contracts\Frontend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface LandingContract
{
    /**
     * @return mixed
     */
    public function getPackages();

    /**
     * @return mixed
     */
    public function getFeatures();

    /**
     * @return mixed
     */
    public function getFaqs();

    /**
     * @return mixed
     */
    public function getBlogs();

    /**
     * @return mixed
     */
    public function getStickers();

    /**
     * @return mixed
     */
    public function getPageBySlug($slug);

    /**
     * @return mixed
     */
    public function getCountries();

    /**
     * @return mixed
    */
    public function storeQuote(array $params);

    /**
     * @return mixed
    */
    public function storeContact(array $params);

    
}

