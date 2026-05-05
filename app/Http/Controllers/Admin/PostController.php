<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function postList()
    {
        if (!auth()->user()->can('post.view')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        // Logic to retrieve and return the list of posts

        return view('admin.post-list');
    }


    public function createPostForm()
    {
        if (!auth()->user()->can('post.create')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        // Logic to show the form for creating a new post
        return view('admin.post-create');
    }

    public function createPost(Request $request)
    {
        if (!auth()->user()->can('post.create')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        // Logic to handle creating a new post
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
        ]);
        $posts = Post::all();
        $post = new Post();
        $post->title = $request->input('title');
        $slug = Str::slug($request->input('slug'));
        if (Post::where('slug', $request->input('slug'))->exists()) {
            $slug = $request->input('slug') . '-' . count($posts) + 1;
        }
        $post->slug = $slug;
        $post->content = $request->input('content');
        $post->save();

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

            // if ($this->featured_image) {

            //     // Store file in 'public/media'
            //     $path = $this->storeFeaturedImage($this->featured_image);

            //     // Save in media table
            //     $media = new Media();
            //     $media->filename = basename($path);
            //     $media->original_name = $this->featured_image->getClientOriginalName();
            //     $media->mime_type = $this->featured_image->getMimeType();
            //     $media->extension = $this->featured_image->getClientOriginalExtension();
            //     $media->size = $this->featured_image->getSize();
            //     $media->type = 'image';
            //     $media->category = 'featured_image';
            //     $media->disk = 'public';
            //     $media->path = $path;
            //     $media->mediable_id = $post->id;
            //     $media->mediable_type = Post::class;
            //     if ($this->fi_caption) {
            //         $media->caption = $this->fi_caption;
            //     }

            //     $media->user_id = auth()->id();
            //     $media->save();
            // } else {
            //     abort(403);
            // }

            DB::commit(); // commit transaction
            return redirect()->route('admin.post.list')->with('success', 'Post Successfully Created.');
        } catch (\Throwable $th) {
            DB::rollBack(); // rollback on any error

            // Optionally delete the uploaded file if it exists
            if (isset($path) && file_exists(public_path($path))) {
                unlink(public_path($path));
            }

            return redirect()->back()->with('error', $th->getMessage())->withInput($request->all());
        }
    }

    public function editPost($id)
    {
        if (!auth()->user()->can('post.edit')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }
        // Logic to show the form for editing an existing post
        return view('admin.post-edit', compact('id'));
    }

    public function updatePost(Request $request, $id)
    {
        // Logic to handle updating an existing post
        // Validate and update the post data
    }

    public function deletePost($id)
    {
        // Logic to handle deleting a post
    }
    public function videoPostList()
    {
        if (!auth()->user()->can('post.view')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        // Logic to retrieve and return the list of video posts

        return view('admin.video-post-list');
    }
    public function videoPostCreate(){
        if (!auth()->user()->can('post.create')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        // Logic to show the form for creating a new video post
        return view('admin.video-post-create');
    }
    public function videoPostEdit($id)
    {
        if (!auth()->user()->can('post.edit')) {
            return abort(403, 'You don’t have permission to access this page.');
        }
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }
        // Logic to show the form for editing an existing video post
        return view('admin.video-post-edit', compact('id'));
    }

}
