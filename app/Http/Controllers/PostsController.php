<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;


class PostsController extends Controller
{
    public function show($id) {

        auth()->loginUsingId(7);

        $post = Post::findOrFail($id);

        /*if ($this->authorize('edit-post', $post)){
            return 'denied';
        }*/
/*
        if (Gate::denies('show-post', $post)){
            return 'denied';
        }
*/
        return View('post', compact('post'));
    }
}
