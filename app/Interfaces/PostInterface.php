<?php

namespace App\interfaces;

use App\Models\Post;
use Illuminate\Http\Request;
interface PostInterface
{
    public function read();

    public function readSinglePost($id);

    public function store(Request $request);

    public function create();

    public function update(Request $request ,$id , Post  $post);

}
