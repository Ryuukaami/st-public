<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Forums as ModelsForums;

class Forums extends Controller
{

    public function showDash()
    {

        $user_id = Auth::id();
        $forums = ModelsForums::where('user_id', $user_id)->latest()->paginate(10);

        $message = null;
        if ($forums->isEmpty()) {
            $message = "You can see your activities here";
        }
        return view('dashboard', compact('forums', 'message'));
    }

    public function ForumsShow()
    {
        $forums = ModelsForums::with(['user'])->latest()->paginate(10);

        return view('forum', compact('forums'));
    }

    public function CreatePosting()
    {
        return view('createPost');
    }

    public function PostingStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $forum = new ModelsForums();
        $forum->title = $validated['title'];
        $forum->content = $validated['content'];
        $forum->user_id = Auth::id();
        $forum->save();

        return redirect()->route('forum.show', $forum)->with('success', 'Forum post created successfully!');
    }

    public function editPost(ModelsForums $forum)
    {
        if (Auth::id() !== $forum->user_id
        ) {
            return redirect()->route('dashboard')
            ->with('error', 'You are not authorized to edit this post.');
        }

        return view('editPost', compact('forum'));
    }

    public function updatePost(Request $request, ModelsForums $forum)
    {
        if (Auth::id() !== $forum->user_id
        ) {
            return redirect()->route('dashboard')
            ->with('error', 'You are not authorized to update this post.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $forum->update([
            'title' => $validated['title'],
            'content' => $validated['content']
        ]);

        return redirect()->route('dashboard')
        ->with('success', 'Post updated successfully!');
    }

    public function deletePost(ModelsForums $forum)
    {
        if (Auth::id() !== $forum->user_id
        ) {
            return redirect()->route('dashboard')
            ->with('error', 'You are not authorized to delete this post.');
        }

        $forum->delete();

        return redirect()->route('dashboard')
        ->with('success', 'Post deleted successfully!');
    }

}
