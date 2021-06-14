<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ThreadsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function showCategories()
    {
        $categories = Category::query()->orderBy('id', 'asc')->get();

        return view('top')->with('categories', $categories);
    }

    /**
     * @param Category $category
     * @return Application|Factory|View
     */
    public function showThreadList(Category $category)
    {
        $query = Thread::query()->where('category_id', $category->id);

        if ($query->exists()) {
            $threads = $query->orderBy('created_at', 'desc')->paginate(5);
        } else {
            $threads = null;
        }

        return view('category')->with([
            'category' => $category,
            'threads' => $threads,
        ]);
    }

    /**
     * @param Category $category
     * @param Thread $thread
     * @return Application|Factory|View
     */
    public function showCommentList(Category $category, Thread $thread)
    {
        $query = Comment::query()->where('thread_id', $thread->id);

        if ($query->exists()) {
            $comments = $query->orderBy('created_at', 'asc')->paginate(10);
        } else {
            $comments = null;
        }

        return view('thread')->with([
            'category'=>$category,
            'thread' => $thread,
            'comments' => $comments,
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function searchThreads(Request $request)
    {
        $keyword = $request->input('keyword') ?? null;
        $key = '%' . addcslashes($keyword, '%_\\') . '%';

        $query = Thread::with('category');

        if (!empty($keyword)) {
            $scope = $query->where('title', 'LIKE', $key);
            if ($scope->exists()) {
                $threads = $scope->orderBy('created_at', 'desc')->paginate(5);
            } else {
//                dd($query);
                $threads = $query->orderBy('created_at', 'desc')->paginate(5);
//                $threads=Thread::with('category')->get();
//       検索ワードに引っかからない時、何も表示されない
            }
        } else {
            $threads = $query->orderBy('created_at', 'desc')->paginate(5);
        }

        return view('search')->with([
            'threads' => $threads,
            'keyword' => $keyword,
        ]);
    }
}
