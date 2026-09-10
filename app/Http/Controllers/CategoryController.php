<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * カテゴリー一覧を表示
     */
    public function index()
    {
        $categories = Category::withCount('tasks')->orderBy('created_at', 'desc')->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * カテゴリー作成フォームを表示
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * カテゴリーを新規作成
     */
    public function store(Request $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'カテゴリーを作成しました。');
    }

    /**
     * カテゴリー詳細を表示
     */
    public function show(string $id)
    {
        $category->load('tasks');

        return view('categories.show', compact('category'));
    }

    /**
     * カテゴリー編集フォームを表示
     */
    public function edit(string $id)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * カテゴリーを更新
     */
    public function update(Request $request, string $id)
    {
        $category->update($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'カテゴリーを更新しました。');
    }

    /**
     * カテゴリーを削除
     */
    public function destroy(string $id)
    {
        //カテゴリーに紐づくタスクがある場合は削除不可
        if ($category->tasks()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'タスクが紐づいているカテゴリーは削除できません。');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'カテゴリーを削除しました。');
    }
}
