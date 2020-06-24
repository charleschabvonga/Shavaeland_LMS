<?php

namespace App\Http\Controllers\Api\V1;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentsRequest;
use App\Http\Requests\Admin\UpdateCommentsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CommentsController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function show($id)
    {
        return Comment::findOrFail($id);
    }

    public function update(UpdateCommentsRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        

        return $comment;
    }

    public function store(StoreCommentsRequest $request)
    {
        $comment = Comment::create($request->all());
        

        return $comment;
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return '';
    }
}
