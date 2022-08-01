<?php

namespace App\Http\Livewire\Admin\Blog\Posts;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateBlogPost extends Component
{
    use WithFileUploads;

    public $state = [];
    public $featured_image;

    public function create()
    {
        $validateData = Validator::make($this->state, [
            'blog_category_id' => 'required|numeric',
            'post_title' => 'required|string|max:250',
            'status' => 'required|numeric',
            'post_details' => 'required|string',
            'meta_title' => 'nullable|string|max:250',
            'meta_keywords' => 'nullable|string|max:250',
            'meta_description' => 'nullable|string',
        ], [
            'blog_category_id.required' => 'The blog category field is required.'
        ])->validate();

        $validateData['created_by'] = Auth::user()->id;
        $validateData['post_slug'] = toFormattedSlug($this->state['post_title']);

        if ($this->featured_image) {
            $validateData['featured_image'] = $this->featured_image->store('/', 'blog_featured_image');
        } else {
            $validateData['featured_image'] = '';
        }

        try {
            BlogPost::query()->create($validateData);

            $this->dispatchBrowserEvent('success', ['message' => 'Post created successfully.']);
            return redirect()->route('admin.blog.posts');
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['message' => "Operation failed!"]);
            return redirect()->back();
        }
    }

    public function render()
    {
        $categories = BlogCategory::query()->orderBy('name')->get(['id', 'name']);
        return view('livewire.admin.blog.posts.create-blog-post', [
            'categories' => $categories
        ]);
    }
}
