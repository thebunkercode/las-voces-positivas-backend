<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\PostCreateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class PostsController extends Controller
{
    public function list(Request $request){
        $limit = 5;
        $offset = 5;
        $page = 1;
        if($request->has('page')){
            $page = $request->get('page');
        }
        $totalRows = Post::with('user')->with('comments.user')->count();
        if($request->has('with')){
            $posts = Post::with('user')->with('comments.user')
                ->offset($offset*($page-1))
                ->limit($limit)
                ->get();
        }else{
            $posts = Post::with('user')
                ->offset($offset*($page-1))
                ->limit($limit)
                ->get();
        }
        
        return response()->json([
            'success' => true,
            'rows' => $posts,
            'total' => $totalRows,
            'total_pages' => ceil($totalRows/5)
        ]);
    }
    
    public function create(PostCreateRequest $request){
        $response = [
            'success' => false,
        ];
        $data = $request->all();
        $user = auth()->user();
        $created = Post::create([
            'text' => $data['text'],
            'user_id' => $user->id
        ]);
        if ($created) {
            $response['success'] = true;
            $response['response'] = $created;
        }
        return response()->json($response);
    }
}
