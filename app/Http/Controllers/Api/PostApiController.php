<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index(Request $request){
     
        $perPage = $request->query('per_page', 10);
        //andiamo ad usare with per estendere anche le relazioni
        $posts = Post::with(['teams', 'category'])
            ->latest()
            ->paginate($perPage);

        return response()->json(
            [
                "success" => true,
                "data" =>  $posts
            ]
        );
    }


    public function show(Post $post){

        $post->load("category", "teams");

        return response()->json(
            [
                "success"=> true,
                "data" => $post
            ]
            );
    }
}
