<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Category;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use function PHPUnit\Framework\fileExists;

class PostEdit extends Component
{
    use WithFileUploads;

    public $createModal = false;
    public $name;
    public $parent_id;
    public $featured_image;
    public $fi_caption;
    public $title;
    public $slug;
    public $excerpt;
    public $status = 'draft'; // default status
    public $publish_date;
    public $category_id;
    public $content;
    public $url;
    public $isFeatured = false;
    public $postId;
    public $post;
    public $featured_image_url;
    public $author_id;
    // public $authors;
    public function mount($id)
    {
        $this->postId = $id;
        $post = Post::find($id);
        $this->post = $post;
        $this->title = $post->title;
        $this->category_id = $post->category_id;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->excerpt = $post->excerpt;
        $this->status = $post->status;
        $this->url = $this->url = url('/') . "/" . $post->slug;
        $this->isFeatured = $this->post->is_featured;
        $this->publish_date = $post->updated_at;
        $media = $post->media()->where('category', 'featured_image')->first();
        $this->featured_image_url = $media ? asset('uploads/' . $media->path) : null;
        $this->author_id = $post->author_id;
        $this->fi_caption = $media ? $media->caption : '';

    }
    public function generateSlug()
    {

        $this->validate([
            "slug" => "required|unique:posts,slug," . $this->postId,
        ]);

        $this->slug = Str::slug($this->slug);
        $this->url = url('/') . "/" . $this->slug;
    }
    public function render()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $authors = Author::all();

        return view('livewire.post-edit', [
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }
    public function updatePost()
    {
        // dd($this->fi_caption);

        $this->validate([
            'title' => "string|min:3",
            "content" => "required"

        ]);
        $post = Post::find($this->postId);
        if (!$post) {
            $this->dispatch('postUpdateStatus', ['error' => 'Post not found']);

        }

        try {




            $post->title = $this->title;
            $post->content = $this->content;
            $post->slug = $this->slug;
            $post->is_featured = $this->isFeatured;
            $post->category_id = $this->category_id;
            $post->status = $this->status;
            $post->excerpt = $this->excerpt;
            $post->user_id = auth()->id();
            if ($this->author_id) {
                $post->author_id = $this->author_id;
            }
            $post->save();
            if ($this->featured_image) {
                // Generate random filename
                $filename = Str::random(20) . '.' . $this->featured_image->getClientOriginalExtension();

                // Store file in 'public/media'

                $path = $path = $this->storeFeaturedImage($this->featured_image);


                // Save in media table
                $media = $post->media->where('category', 'featured_image')->first();
                if ($media) {
                    if (file_exists(public_path('uploads/' . $media->path))) {

                        unlink(public_path('uploads/' . $media->path));
                    }
                    $media->filename = $filename;
                    $media->original_name = $this->featured_image->getClientOriginalName();
                    $media->mime_type = $this->featured_image->getMimeType();
                    $media->extension = $this->featured_image->getClientOriginalExtension();
                    $media->size = $this->featured_image->getSize();
                    $media->type = 'image';
                    $media->category = 'featured_image';
                    $media->disk = 'public';
                    $media->path = $path;
                    $media->mediable_id = $post->id;
                    $media->mediable_type = Post::class;

                    $media->user_id = auth()->id();
                    $media->save();


                } else {

                    $media = new Media();
                    $media->filename = $filename;
                    $media->original_name = $this->featured_image->getClientOriginalName();
                    $media->mime_type = $this->featured_image->getMimeType();
                    $media->extension = $this->featured_image->getClientOriginalExtension();
                    $media->size = $this->featured_image->getSize();
                    $media->type = 'image';
                    $media->category = 'featured_image';
                    $media->disk = 'public';
                    $media->path = $path;
                    $media->mediable_id = $post->id;
                    $media->mediable_type = Post::class;
                    $media->user_id = auth()->id();
                    $media->save();

                }

            }
            $media2 = $post->media->where('category', 'featured_image')->first();
            if ($media2 && $this->fi_caption) {
                $media2->caption = $this->fi_caption;
                $media2->save();
            }
            return redirect()->route('admin.post.list')->with('success', 'Post Updated Successfully.');
        } catch (\Throwable $th) {
            $this->dispatch('postUpdateStatus', ['error' => $th->getMessage()]);
        }


    }
    public function createPost()
    {
        // dd($this->category_id);

        $this->validate([
            'title' => "string|min:3",
            "content" => "required"

        ]);
        try {
            Post::create([
                'title' => $this->title,
                'content' => $this->content,
                'slug' => $this->slug,
                'is_featured' => $this->isFeatured,
                'category_id' => $this->category_id,
                'status' => $this->status,
            ]);
            return redirect()->route('admin.post.list')->with('success', 'Post Successfully Created.');
        } catch (\Throwable $th) {
            $this->dispatch('postCreateStatus', ['error' => $th]);
        }


    }
    public function createCategory()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->parent_id = $this->parent_id;
        $category->save();
        $this->createModal = false;
        $this->dispatch('categoryCreated');
        $this->reset(['name', 'parent_id']);

    }
    public function openCreateModal()
    {
        $this->reset(['name', 'parent_id']);
        $this->createModal = true;
    }
    protected function storeFeaturedImage($file)
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/media');

        // Create directory if it doesn't exist
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true); // recursive
        }

        // Move uploaded file
        $file->storeAs('media', $filename);

        // Return relative path for database
        return 'media/' . $filename;
    }
    public function updatedIsFeatured($value)
    {
        if ($this->isFeatured) {
            // প্রথমে সব post থেকে featured=false set করুন
            Post::query()->update(['is_featured' => false]);

            // তারপর current post কে featured=true করুন
            $this->post->update([
                'is_featured' => true,
            ]);
            $this->isFeatured = true;
            $this->dispatch('banner_post', ['success' => 'Banner post successfully added']);

        } else {
            // যদি toggle off করা হয়, current post false করুন
            $this->post->update([
                'is_featured' => false,
            ]);
            $this->isFeatured = false;
            $this->dispatch('banner_post', ['success' => 'Banner post successfully removed']);
        }




    }

}
