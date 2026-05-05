<div>
    <form wire:submit.prevent="createPost">

        <div class="flex items-center justify-between">
            <div>

                <!-- Modal -->
                <a href="{{ route('admin.video.post.list') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                    Back
                </a>


                <!-- End Modal -->
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" wire:click="$set('status', 'draft')"
                    class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                    Draft
                </button>
                <button type="submit" wire:click="$set('status', 'published')"
                    class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                    Publish
                </button>
            </div>
        </div>

        <div class="border-t border-gray-100 mt-4  dark:border-gray-800">
            <!-- ====== Table Six Start -->

            <div class="flex h-full flex-col gap-6 sm:gap-5 xl:flex-row">
                <div
                    class="p-4 flex h-screen flex-col overflow-hidden rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] xl:h-full xl:w-4/5">
                    <div class="mt-2">
                        <label for="title" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Title
                        </label>
                        <input id="title" wire:model.blur="title" type="text" placeholder="Enter post title"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Select Type
                        </label>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                            <select name="type" wire:model="type"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                              :class="isOptionSelected ? 'text-gray-800 dark:text-white/90' : ''"
                                @change="isOptionSelected = true">
                                <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Select Option
                                </option>
                                <option value="landscape_video" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Landscape Video
                                </option>
                                <option value="shorts" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Shorts
                                </option>

                            </select>
                            <span
                                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                          @error('type')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="mt-2">
                        <label for="yt_video_link" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Youtube Video Link
                        </label>
                        <input id="yt_video_link" wire:model.blur="yt_video_link" wire:input.debounce.500ms="extractYTVideoId" type="text" placeholder="Enter YT video Link"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                            <p class="text-gray-500">Note: Please use <span class="text-red-500">https://www.youtube.com/watch?v=</span></p>
                        @error('yt_video_link')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="mt-2">
                        <label for="yt_video_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Youtube Video ID
                        </label>
                        <input id="yt_video_id" wire:model.blur="yt_video_id" type="text" placeholder="Enter YT video ID" disabled
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 disabled:bg-gray-100" />
                        @error('yt_video_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div wire:ignore class="mt-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Description
                        </label>
                        <textarea id="editor_data" name="content" placeholder="Write your content here" type="text" rows="6"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">

                        </textarea>
                        @error('content')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="mt-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Short Description
                        </label>
                        <textarea wire:model="excerpt" name="excerpt" placeholder="Write your content here" type="text" rows="6"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                    </div>
                </div>
                <div
                    class="flex flex-col rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03] xl:w-1/5">
                    {{-- <div x-data="{ switcherToggle: false }">
                        <label for="slug" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Is Featured?
                        </label>
                        <label for="toggle1"
                            class="flex cursor-pointer items-center gap-3 text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                            <div class="relative">
                                <input wire:model="isFeatured" type="checkbox" id="toggle1" class="sr-only"
                                    @change="switcherToggle = !switcherToggle">
                                <div :class="switcherToggle ? 'bg-brand-500 dark:bg-brand-500' : 'bg-gray-200 dark:bg-white/10'"
                                    class="block h-6 w-11 rounded-full transition-colors duration-300">
                                </div>
                                <div :class="switcherToggle ? 'translate-x-full' : 'translate-x-0'"
                                    class="shadow-theme-sm absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white duration-300 ease-linear translate-x-0">
                                </div>
                            </div>

                            Yes
                        </label>
                    </div> --}}

                    
                    {{-- @can('category.create')
                        <div class="mt-2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Select Category
                            </label>
                            <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                <select wire:model="category_id" name="category_id"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true">

                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Select a category
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            {{ $category->name }}
                                        </option>
                                        @if ($category->children->count() > 0)
                                            @foreach ($category->children as $child)
                                                <option value="{{ $child->id }}"
                                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400 pl-4">
                                                    &#8195;{{ $child->name }}
                                                </option>
                                                @if ($child->children->count() > 0)
                                                    @foreach ($child->children as $child2)
                                                        <option value="{{ $child2->id }}"
                                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400 pl-6">
                                                            &#8195; &#8195;{{ $child2->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                </select>
                                <span
                                    class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                            @error('parent_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            <div class="align-right mt-2">
                                <a class="text-sm text-blue-600 hover:underline" href="javascript:void(0)"
                                    wire:click="openCreateModal">
                                    Add New Category
                                </a>
                            </div>
                        </div>
                        <div x-data="{ open: @entangle('createModal') }" x-show="open"
                            class="fixed inset-0 z-99999 flex items-center justify-center bg-black/50" x-transition>
                            <div @click.away="open = false"
                                class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg transition dark:bg-gray-700"
                                x-show="open" x-transition>
                                <h2 class="text-lg font-semibold mb-4">Create New Category</h2>


                                <form wire:submit.prevent="createCategory">

                                    <div class="mt-2">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Category Name
                                        </label>
                                        <input wire:model="name" type="text" placeholder="Enter full name"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                        @error('name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Select Parent Category
                                        </label>
                                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                            <select wire:model="parent_id"
                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                                :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                                @change="isOptionSelected = true">

                                                <option value=""
                                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                    No Parent Category
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                        {{ $category->name }}
                                                    </option>
                                                    @if ($category->children->count() > 0)
                                                        @foreach ($category->children as $child)
                                                            <option value="{{ $child->id }}"
                                                                class="text-gray-700 dark:bg-gray-900 dark:text-gray-400 pl-4">
                                                                &emsp;{{ $child->name }}
                                                            </option>
                                                            @if ($child->children->count() > 0)
                                                                @foreach ($child->children as $child2)
                                                                    <option value="{{ $child2->id }}"
                                                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400 pl-6">
                                                                        &#8195; &#8195;{{ $child2->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach

                                            </select>
                                            <span
                                                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                <svg class="stroke-current" width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('parent_id')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </form>

                                <!-- Modal footer -->
                                <div class="mt-4 flex justify-end gap-2">
                                    <button @click="open = false"
                                        class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">Cancel</button>
                                    <button wire:click="createCategory"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Save</button>
                                </div>
                            </div>
                        </div>
                    @endcan() --}}
                    <div class="mt-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Video thumbnail
                        </label>
                        <input wire:model="featured_image" type="file"
                            class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
                        @error('featured_image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        @if ($featured_image)
                            <div class="mt-2">
                                <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Preview:</label>
                                <img src="{{ $featured_image->temporaryUrl() }}" alt="Image Preview"
                                    class="rounded-lg max-h-40 border border-gray-200 dark:border-gray-700">
                            </div>
                        @endif
                    </div>
                    <div class="mt-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Video caption
                        </label>
                        <input wire:model="fi_caption" type="text" name="fi_caption"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('fi_caption')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Author
                        </label>
                        <select wire:model="author_id" name="author_id"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">

                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                Select an author
                            </option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ $author->id == $author_id ? 'selected' : '' }}>
                                    {{ $author->title }}<br>
                                    <span class="text-xs text-gray-400"> - {{ $author->name }}</span>
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- ====== Table Six End -->
            </div>

        </div>
    </form>

    @push('scripts')
        <script>
            // When Livewire updates, re-init editor if needed

            Livewire.on('error', (data) => {
                console.log(data)
                $toaster.fire({
                    icon: 'error',
                    title:data.error
                });
            });
            Livewire.on('loaded', () => {
                console.log('Loaded')
            });
        </script>
        {{-- <script src="https://cdn.tiny.cloud/1/6fc0o57nwmnuyujo3x2t2m7qttqr09s74djxb47lnzygcixp/tinymce/8/tinymce.min.js"
            referrerpolicy="origin" crossorigin="anonymous"></script>

        <script>
            tinymce.init({
                selector: '#editor',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',

                setup: function(editor) {
                    editor.on('change keyup', function() {
                        @this.set('content', editor.getContent()); // update Livewire property
                    });
                },

                init_instance_callback: function(editor) {
                    editor.setContent(@this.get('content') || ''); // load existing content when editing
                }
            });
        </script> --}}

        <script>
            document.addEventListener('livewire:load', function() {
                alert('test')
                console.log('Livewire is ready!');
                Livewire.on('slug', () => {
                    var title = $('#title').val();
                    var slug = title.toLowerCase() // Lowercase
                        .trim() // Remove leading/trailing spaces
                        .replace(/[^\w\s-]/g, '') // Remove special chars
                        .replace(/\s+/g, '-') // Replace spaces with dash
                        .replace(/--+/g, '-'); // Replace multiple dashes
                    $('#slug').val(slug);
                });

            });
        </script>
        {{-- <script>
            console.log("test")
            $('#title').on('input', function() {
                var title = $(this).val();
                console.log(title)

                // Slug generation
                var slug = title.toLowerCase() // Lowercase
                    .trim() // Remove leading/trailing spaces
                    .replace(/[^\w\s-]/g, '') // Remove special chars
                    .replace(/\s+/g, '-') // Replace spaces with dash
                    .replace(/--+/g, '-'); // Replace multiple dashes

                $('#slug').val(slug);
            });
        </script> --}}
        <script>
            document.addEventListener('livewire:initialized', () => {
                // Your JavaScript code that depends on Livewire being ready goes here.
                // For example:
                console.log('Livewire has finished initializing!');
                // You can now safely interact with Livewire's global object (window.Livewire)
                // or perform actions related to Livewire components.
            });
            document.addEventListener('livewire:initialized', function() {

                var editor = new RichTextEditor("#editor_data", {
                    contentCssUrl: "/plugins/richtexteditor/runtime/richtexteditor_content.css",
                    callbacks: {
                        onchange: function(contents) {
                            console.log("Editor content:", contents); // debug
                            @this.set('content', contents); // update Livewire property
                        }
                    }
                });
                editor.attachEvent("change", function() {
                    @this.set('content', editor.getHTML());
                });
                // Load existing content from Livewire if editing
                @this.on('content', content => {
                    editor.setContent(content || '');
                });

            });
        </script>
    @endpush
