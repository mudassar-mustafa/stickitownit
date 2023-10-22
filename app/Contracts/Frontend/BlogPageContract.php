<?php

namespace App\Contracts\Frontend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface BlogPageContract
{
    /**
     * @return mixed
     */
    public function getAllBlogs();

    /**
     * @return mixed
     */
    public function getBlogDetail($slug);

    /**
     * @return mixed
     */
    public function getRelatedBlog($blogId, $blogAuthorName);

    /**
     * @return mixed
     */
    public function getBlogCategories();


    
}

