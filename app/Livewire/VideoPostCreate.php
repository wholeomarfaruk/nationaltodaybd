<?php

namespace App\Livewire;

use App\Helpers\Uploader;
use App\Models\Author;
use App\Models\Media;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Category;
use App\Models\VideoPost as Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;


class VideoPostCreate extends Component
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
    public $author_id;
    public $yt_video_link;
    public $yt_video_id;
    public $type;

    public function mount($post = null)
    {
        if ($post) {
            $this->content = $post->content;
        }
    }
    public function generateSlug()
    {

        $this->validate([
            'slug' => 'required|min:3|unique:posts,slug'
        ]);

        $this->slug = Str::slug($this->slug);
        $this->url = url('/') . "/" . $this->slug;
    }
    public function extractYTVideoId()
    {
        $this->yt_video_id = \App\Helpers\YTHelper::extractVideoId($this->yt_video_link);
    }

    public function render()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $authors = Author::all();
        return view('livewire.video-post-create', [
            'categories' => $categories,
            'authors' => $authors
        ]);
    }
    public function createPost()
    {

        $this->validate([
            'title' => "string|min:3",
            'type' => 'required',
            'slug' => 'required|unique:posts,slug',
            'featured_image'=> 'required|mimes:jpg,png,webp,jpeg',

        ]);
        $uncategorized_id = Category::where('slug', 'uncategorized')->value('id');
        if (!$uncategorized_id) {
            $uncategorized = new Category();
            $uncategorized->name = 'Uncategorized';
            $uncategorized->slug = 'uncategorized';
            $uncategorized->save();
            $uncategorized_id = $uncategorized->id;
        }


        try {

            $post = new Post();
            $post->title = $this->title;
            $post->content = $this->content;
            $slug = Str::uuid();
            while (Post::where('slug', $slug)->exists()) {
                $slug = Str::uuid();
            }
            $post->slug = $slug;

            $post->video_url = $this->yt_video_link;
            $post->video_id = $this->yt_video_id;
            $post->is_featured = $this->isFeatured;
            // $post->category_id = $this->category_id ?? $uncategorized_id;
            $post->status = $this->status;
            $post->excerpt = $this->excerpt;
            $post->type = $this->type;
            $post->user_id = auth()->id();
            if ($this->author_id) {
                $post->author_id = $this->author_id;
            }
            $post->save();
            $img = Uploader::uploadImage($this->featured_image,$post);

            DB::commit(); // commit transaction
            return redirect()->route('admin.video.post.list')->with('success', 'Post Successfully Created.');
        } catch (\Throwable $th) {


            // Optionally delete the uploaded file if it exists
            if (isset($path) && file_exists(public_path($path))) {
                unlink(public_path($path));
            }


            $this->dispatch('error', $th->getMessage());
            DB::rollBack(); // rollback on any error

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
        $slug = Str::slug($this->name);
        if (Category::where('slug', $slug)->exists()) {
            $slug = $slug . "-";
        }
        $category->slug = $slug;

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
    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
        $this->generateSlug();
    }
    /**
     * Store uploaded file in public/media and return path
     *
     * @param \Livewire\TemporaryUploadedFile $file
     * @return string Path relative to public folder
     */
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

}
