<?php

namespace App\Http\Controllers;


use App\Models\Like;
use App\Models\Post;
use App\Models\PostView;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $posts = Post::with("user")->where("user_id", auth()->id())->get();

        foreach ($posts as $post) {
            $post->isLiked = Like::where("user_id", auth()->id())->where("post_id", $post->id)->exists();
            $post->isViewed = PostView::where("user_id", auth()->id())->where("post_id", $post->id)->exists();
            $post->likes_count = Like::where("post_id", $post->id)->count();
            $post->views_count = PostView::where("post_id", $post->id)->count();
        }

        return view('profile.index', compact('posts'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $data = request()->validate([
            'name' => 'required|string'
        ]);
        $user->update($data);

        return redirect()->route('profile.index');
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();

        User::where("id", $user->id)->update([
            "avatar_url" => $request->avatar_url
        ]);
    }
}
