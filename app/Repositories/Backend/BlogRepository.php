<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\BlogContract;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogPhoto;
use App\Models\Tag;

use App\Traits\UploadFile;

class BlogRepository extends BaseRepository implements BlogContract
{
    use UploadFile;

    protected $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBlog(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findBlogById(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createBlog(array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        $categories = $params['categories'];
        $tags = $params['tags'];
        $media_blog_id = $params['media_blog_id'];
        unset($params['categories']);
        unset($params['tags']);
        unset($params['media_blog_id']);
        $blog = $this->create($params);
        $blog->categories()->sync($categories);
        $blog->tags()->sync($tags);
        BlogPhoto::whereBlogId($media_blog_id)->update(['blog_id' => $blog->id]);
        return $blog;

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBlog($id, array $params)
    {
        $params['slug'] = \Str::slug(strtolower($params['name']));
        $categories = $params['categories'];
        $tags = $params['tags'];
        unset($params['categories']);
        unset($params['tags']);

        $blog = $this->find($id);

        $blog->categories()->sync($categories);
        $blog->tags()->sync($tags);
        return $this->update($params, $id);

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteBlog($id)
    {
        return $this->delete($id);
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return BlogCategory::where('status', 'active')->get();
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return Tag::where('status', 'active')->get();
    }

    /**
     * @return mixed
     */
    function uploadImages(array $params)
    {

        $image = $params['file'];
        $name_new = $image->getClientOriginalName();
        $fileName = $this->upload($image, 'blogs/images');
        if (session()->has('blog_id') && !is_null(session()->get('blog_id'))) {
            $blog_id = session()->get('blog_id');
        }

        BlogPhoto::create([
            'blog_id' => $blog_id,
            'name' => $name_new,
            'fileName' => $fileName,
            'order' => 1,
        ]);

        return response()->json(['success' => $fileName]);
    }

    /**
     * @return mixed
     */
    function fetch($id)
    {
        $images = BlogPhoto::whereBlogId($id)->orderBy('order', 'asc')->get();

        $output = '<div class="row"><ul class="nav nav-pills source-code">';

        foreach ($images->chunk(5) as $imageData) {
            $output .= '<div class="col-md-1"></div>';
            foreach ($imageData as $image) {

                $output .= '<div class="col-md-2">
                    <li id="image_li_' . $image->id . '"
                        class="ui-sortable-handle mr-2 mt-2">
                        <div  class="custom-control custom-checkbox image-checkbox">
                        <div class="col-md-12">
                         <input type="checkbox"
                               class="custom-control-input"
                               id="ck' . $image->id . '"
                               data-id="' . $image->id . '"
                               data-image="' . $image->filename . '"
                        >
</div>
                        <div class="col-md-12">
                             <label
                            class="custom-control-label"
                            for="ck' . $image->id . '">
                            <a href="javascript:void(0);"
                               class="img-link" style="cursor: move">
                                <img
                                    src="' . asset('storage/uploads/blogs/images/' . $image->filename) . '"
                                    alt=""
                                    class="img-thumbnail"
                                    width="175"
                                    height="175"
                                    style="height:175px;"/>
                                <button type="button"
                                        class="btn btn-link btn btn-primary remove_image"
                                        id="' . $image->id . '" data-name="' . $image->filename . '">
                                            Remove
                                </button>
                            </a>
                            </label>
</div>


                        </div>
                    </li>
                </div>';
            }
            $output .= '<div class="col-md-1"></div>';
        }
        $output .= ' </ul></div>';
        return $output;
    }

    /**
     * @return mixed
     */
    function deleteMedia(array $params)
    {
        BlogPhoto::where('id', (int)$params['id'])->delete();
        if ($params['name']) {
            \File::delete(public_path('storage/uploads/blogs/images/' . $params['name']));
        }

        return true;
    }
}
