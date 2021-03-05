<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{

    // query = SELECT posts.id,posts.title,SUM(post_views.views) AS totalviews
    // FROM posts
    
    // INNER JOIN post_views ON post_views.post_id = posts.id
    // WHERE (post_views.created_at>'2021-03-03')
    // group BY posts.id ORDER BY(totalviews) DESC;
    public function index(Request $request)
    {



        if($request->keyword){
        
            $posts = Post::where(
                    'title', 'like', "%".$request->keyword."%"
                )->paginate(10);
            $posts->withPath('?keyword=' . $request->keyword);
        }else{
            $posts = Post::orderBy('created_at','DESC')->paginate(9);
        }

        $twoDayAgo = Carbon::now()->subDays(2)->format('Y-m-d h:i:s');
        $postOrderViews = DB::table('posts')
            ->join('post_views', 'posts.id', '=', 'post_views.post_id')
            ->select('posts.id', DB::raw('SUM(post_views.views) as totalViews'))
            ->where('post_views.created_at','>',$twoDayAgo)
            ->groupBy('posts.id')
            ->orderBy('totalViews','DESC')
            ->take(10)->get();

        $allPosts = Post::orderby('id')->get();


        return view('home', [
            'posts' => $posts,
            'keyword' => $request->keyword,
            'allPosts'=> $allPosts,
            'postOrderViews'=>$postOrderViews
        ]);
    }



}