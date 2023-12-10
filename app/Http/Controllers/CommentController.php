<?php

namespace App\Http\Controllers;

use App\Http\Requests\Commentss\CommentCreateRequest;
use App\Http\Requests\Posts\PostCreateRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(CommentCreateRequest $request){
            $response = [
                'success' => false,
            ];

            $data = $request->all();
            $user = auth('sanctum')->user();

            $created = Comment::create([
                'comment' => $data['comment'],
                'post_id' => $data['post_id'],
                'user_id' => $user->id,
                'status' => 1
            ]);
            if ($created) {
                $response['success'] = true;
                $response['response'] = $created;
            }
            return response()->json($response);
        }
}
