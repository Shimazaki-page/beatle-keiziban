<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ThreadRequest;
use App\Models\Thread;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class RegisterController extends Controller
{
    /**
     * @param CommentRequest $request
     * @return Application|Factory|View
     */
    public function showAddComment(CommentRequest $request)
    {
        $input = array(
            'name' => $request->name,
            'message' => $request->message,
            'thread_id' => $request->thread_id,
            'category_id' => $request->category_id,
        );

        return view('register.comment')->with('input', $input);
    }

    /**
     * @param CommentRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function addComment(CommentRequest $request)
    {
        $category_id = $request->category_id;
        $thread_id = $request->thread_id;

        $image_name=$this->storeImage($request,'comment');

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->contents = $request->message;
        $comment->thread_id = $thread_id;
        $comment->comment_file_path=$image_name;
        $comment->save();

        return redirect(route('thread', ['category' => $category_id, 'thread' => $thread_id,]))
            ->with('add_comment', 'コメントを投稿しました。');
    }

    /**
     * @param ThreadRequest $request
     * @return Application|Factory|View
     */
    public function showAddThread(ThreadRequest $request)
    {
        $input = array(
            'title' => $request->title,
            'name' => $request->name,
            'message' => $request->message,
            'category_id' => $request->category_id,
        );

        return view('register.thread')->with('input', $input);
    }

    /**
     * @param ThreadRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function addThread(ThreadRequest $request)
    {
        $category_id = $request->category_id;

        $image_name=$this->storeImage($request,'thread');

        $thread = new Thread();
        $thread->title = $request->title;
        $thread->contents = $request->message;
        $thread->name = $request->name;
        $thread->category_id = $request->category_id;
        $thread->thread_file_path=$image_name;
        $thread->save();

        return redirect(route('category', ['category' => $category_id,]))
            ->with('add_thread', 'スレッドを作成しました。');
    }

    /**
     * @param $request
     * @param $path
     * @return array|string|string[]|null
     */
    public function storeImage($request, $path)
    {
        if (!empty($request->file('image'))){
            $image_path=$request->file('image')->store('public/'.$path);
            $file_name=str_replace('public/','',$image_path);
        }else{
            $file_name=null;
        }

        return $file_name;
    }
}
