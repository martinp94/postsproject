<?php

namespace App\Http\ViewComposers;

use App\Post;
use Illuminate\View\View;
use App\Repositories\PostRepository;

class PostsComposer 
{
	/**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $posts;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Post $model)
    {
        // Dependencies automatically resolved by service container...
        $this->posts = new PostRepository($model);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('postsAll', $this->posts->all());
    }
}