<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentsRequest;
use App\Http\Requests\Admin\UpdateCommentsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CommentsController extends Controller
{
    public function submit(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);
        
        //Create New Comment
        $comment = new Comment;
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->comments = $request->input('comments');
        //Save Comment
        $comment->save();

        //Redirect
        return redirect('/')->with('success', 'Message Sent');
    }

    /**
     * Display a listing of Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('comment_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('comment_delete')) {
                return abort(401);
            }
            $comments = Comment::onlyTrashed()->get();
        } else {
            $comments = Comment::all();
        }

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating new Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('comment_create')) {
            return abort(401);
        }
        return view('admin.comments.create');
    }

    /**
     * Store a newly created Comment in storage.
     *
     * @param  \App\Http\Requests\StoreCommentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentsRequest $request)
    {
        if (! Gate::allows('comment_create')) {
            return abort(401);
        }
        $comment = Comment::create($request->all());



        return redirect()->route('admin.comments.index');
    }


    /**
     * Show the form for editing Comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('comment_edit')) {
            return abort(401);
        }
        $comment = Comment::findOrFail($id);

        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update Comment in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentsRequest $request, $id)
    {
        if (! Gate::allows('comment_edit')) {
            return abort(401);
        }
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());



        return redirect()->route('admin.comments.index');
    }


    /**
     * Display Comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('comment_view')) {
            return abort(401);
        }
        $comment = Comment::findOrFail($id);

        return view('admin.comments.show', compact('comment'));
    }


    /**
     * Remove Comment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('comment_delete')) {
            return abort(401);
        }
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.comments.index');
    }

    /**
     * Delete all selected Comment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('comment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Comment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Comment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('comment_delete')) {
            return abort(401);
        }
        $comment = Comment::onlyTrashed()->findOrFail($id);
        $comment->restore();

        return redirect()->route('admin.comments.index');
    }

    /**
     * Permanently delete Comment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('comment_delete')) {
            return abort(401);
        }
        $comment = Comment::onlyTrashed()->findOrFail($id);
        $comment->forceDelete();

        return redirect()->route('admin.comments.index');
    }
}
