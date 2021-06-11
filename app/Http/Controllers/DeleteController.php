<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DeleteController extends Controller
{
    /**
     * @param $category_id
     * @param Thread $thread
     * @return Application|Factory|View
     */
    public function showDeleteThread($category_id, Thread $thread)
    {
        return view('delete.thread')->with([
            'category_id' => $category_id,
            'thread' => $thread,
        ]);
    }

    /**
     * @param Category $category
     * @param $thread_id
     * @return Application|Factory|View
     */
    public function deleteThread(Category $category, $thread_id)
    {
        Thread::destroy($thread_id);

        return redirect(route('category', ['category' => $category->id,]))
            ->with('delete_thread', 'スレッドを削除しました。');
    }

    /**
     * @param $thread_id
     * @param Comment $comment
     * @return Application|Factory|View
     */
    public function showDeleteComment($thread_id, Comment $comment)
    {
        return view('delete.comment')->with([
            'thread_id' => $thread_id,
            'comment' => $comment,
        ]);
    }

    /**
     * @param Thread $thread
     * @param $comment_id
     * @return Application|Factory|View
     */
    public function deleteComment(Thread $thread, $comment_id)
    {
        Comment::destroy($comment_id);

        return redirect(route('thread', [
            'category' => $thread->category_id,
            'thread' => $thread->id,
        ]))->with('delete_comment', 'コメントを削除しました。');
    }
}
