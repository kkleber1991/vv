<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Posts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $title;
    public $content;
    public $excerpt;
    public $image;
    public $status = 'draft';
    public $postId;
    public $isEditing = false;

    protected $rules = [
        'title' => 'required|min:6',
        'content' => 'required',
        'excerpt' => 'nullable',
        'image' => 'nullable|image|max:1024',
        'status' => 'required|in:draft,published'
    ];

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'status' => $this->status,
            'user_id' => auth()->id(),
            'published_at' => $this->status === 'published' ? now() : null,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('posts', 'public');
        }

        if ($this->isEditing) {
            $post = Post::find($this->postId);
            $post->update($data);
        } else {
            Post::create($data);
        }

        $this->reset();
        session()->flash('message', 'Post salvo com sucesso!');
    }

    public function edit(Post $post)
    {
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->excerpt = $post->excerpt;
        $this->status = $post->status;
        $this->isEditing = true;
    }

    public function delete(Post $post)
    {
        $post->delete();
        session()->flash('message', 'Post excluído com sucesso!');
    }

    public function render()
    {
        return view('livewire.admin.posts', [
            'posts' => Post::orderBy('created_at', 'desc')->paginate(10)
        ])->layout('layouts.app');
    }
} 