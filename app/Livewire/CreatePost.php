<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Media;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;


class CreatePost extends Component
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
    public function render()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $authors = Author::all();
        return view('livewire.create-post', [
            'categories' => $categories,
            'authors' => $authors
        ]);
    }
    public function createPost()
    {

        $this->validate([
            'title' => "string|min:3",

        ]);


        try {
            $uncategorized_id = Category::where('slug', 'uncategorized')->value('id');
            if (!$uncategorized_id) {
                $uncategorized = new Category();
                $uncategorized->name = 'Uncategorized';
                $uncategorized->slug = 'uncategorized';
                $uncategorized->save();
                $uncategorized_id = $uncategorized->id;
            }
            $post = new Post();
            $post->title = $this->title;
            $post->content = $this->content;
            if (!$this->slug) {

                $this->slug = Str::slug($this->title);
                if (Post::where('slug', $this->slug)->exists()) {
                    $this->slug = $this->slug . "-";
                    ;
                }
            } else {
                if (Post::where('slug', $this->slug)->exists()) {
                    $this->slug = $this->slug . "-";
                    ;
                }

            }
            $post->slug = $this->slug;
            $post->is_featured = $this->isFeatured;
            $post->category_id = $this->category_id ?? $uncategorized_id;
            $post->status = $this->status;
            $post->excerpt = $this->excerpt;
            $post->user_id = auth()->id();
            if ($this->author_id) {
                $post->author_id = $this->author_id;
            }
            $post->save();

            if ($this->featured_image) {

                // Store file in 'public/media'
                $path = $this->storeFeaturedImage($this->featured_image);

                // Save in media table
                $media = new Media();
                $media->filename = basename($path);
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
                if ($this->fi_caption) {
                    $media->caption = $this->fi_caption;
                }

                $media->user_id = auth()->id();
                $media->save();
            } else {
                abort(403);
            }

            DB::commit(); // commit transaction
            return redirect()->route('admin.post.list')->with('success', 'Post Successfully Created.');
        } catch (\Throwable $th) {
            DB::rollBack(); // rollback on any error

            // Optionally delete the uploaded file if it exists
            if (isset($path) && file_exists(public_path($path))) {
                unlink(public_path($path));
            }
            $this->dispatch('postCreateStatus', ['error' => $th->getMessage()]);


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
        // $file->storeAs('media', $filename);
        copy($file->getRealPath(), $destinationPath . '/' . $filename);

        // Return relative path for database
        return 'media/' . $filename;
    }

}
