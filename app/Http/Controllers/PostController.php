<?php

namespace App\Http\Controllers;


use App\Models\Like;
use App\Models\Post;
use App\Models\PostView;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function posts()
    {
        $posts = $this->getPosts()->sortByDesc("created_at");

        return view("post.posts", compact("posts"));
    }

    public function getPosts()
    {
        $posts = Post::with("user")->get();

        foreach ($posts as $post) {
            $post->isLiked = Like::where("user_id", auth()->id())->where("post_id", $post->id)->exists();
            $post->isFavorite = Like::where("user_id", auth()->id())->where("post_id", $post->id)->exists();
            $post->isViewed = PostView::where("user_id", auth()->id())->where("post_id", $post->id)->exists();
            $post->likes_count = Like::where("post_id", $post->id)->count();
        }
        return $posts;
    }

    public function create()
    {
        return view("post.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "content_data.blocks" => "required",
        ]);

        $newRequest = new Post([
            "content_data" => json_encode($request->content_data),
            "user_id" => auth()->id(),
            "views_count" => 0,
        ]);
        $newRequest->save();

        return $newRequest;
    }

    public function toggleLike(Request $request)
    {
        $like = Like::where("user_id", auth()->id())->where("post_id", $request->post_id)->first();

        if ($like) $like->delete();
        else {
            $like = new Like();
            $like->user_id = auth()->id();
            $like->post_id = $request->post_id;
            $like->save();
        }

        return redirect()->back();
    }

    public function addView(Request $request)
    {
        if (!PostView::where("user_id", auth()->id())->where("post_id", $request->post_id)->exists()) {
            $view = new PostView();
            $view->user_id = auth()->id();
            $view->post_id = $request->post_id;
            $view->save();

            $post = Post::find($request->post_id);
            $post->views_count += 1;
            $post->save();
        }
    }

    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
    }

    public function popular()
    {
        $posts = $this->getPosts();

        $posts = $posts->sortByDesc(function ($post) {
            return $post->likes_count;
        })->take(5);

        return view("post.popular", compact("posts"));
    }
}
