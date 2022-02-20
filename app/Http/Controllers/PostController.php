<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        return Post::get();
    }

    public function show(int $id) {
        return Post::findOrFail($id);
    }

    public function store(array $post) {
        return Post::create($post);
    }
}
