<div class="row">

    @if($posts && $posts->count() > 0)
        @php $bigPost = $posts->first(); @endphp

        {{-- Big Post --}}
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-12 col-md-8">
<a href="{{ route('post.show', ['category' => $bigPost->category->slug, 'slug' => $bigPost->slug]) }}">
                <div class="post-item position-relative rounded overflow-hidden ">
                    <img src="{{ $bigPost->featured_image }}" loading="lazy" alt="" class="hero-section-post-img">
                    <div class="details d-flex align-items-start justify-content-end position-absolute z-index-1 bottom-0 start-0 end-0 top-0 flex-column"
                         style="background: linear-gradient(180deg, rgba(42,123,155,0) 70%, rgba(0,0,0,1) 100%);">
                        <h2 class="title pb-2 px-3 text-white fs-1 fw-bolder">{{ $bigPost->title }}</h2>
                        <p class="card-text fs-6 px-3 p-3 text-white">{{ $bigPost->excerpt }}</p>
                    </div>
                </div>
            </a>
                </div>
                <div class="col-12 col-md-4 ">
                    <div class="row  mt-2">
                        @foreach ($posts->skip(1)->take(2) as $post)
                            <div class="col-md-12 col-6 mb-3">
                                <a href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">
                                <div class="post-item position-relative rounded overflow-hidden">
                                    <img src="{{ $post->featured_image }}" loading="lazy" alt="">
                                    <div class="details d-flex align-items-start justify-content-end position-absolute z-index-1 bottom-0 start-0 end-0 top-0 flex-column"
                                         style="background: linear-gradient(180deg, rgba(42,123,155,0) 70%, rgba(0,0,0,1) 100%);">
                                        <h2 class="title pb-2 px-3 text-white fs-6 fw-bolder">{{ Str::limit($post->title, 50) }}</h2>
                                        {{-- <p class="card-text fs-6 px-3 p-3 text-white">{{ Str::limit($post->excerpt, 50) }}</p> --}}
                                    </div>
                                </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        {{-- Other posts --}}
        @foreach ($posts->skip(3) as $post)
            <div class="col-md-4 col-6">
                <a href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">
                <div class="card mb-3">
                    <img src="{{ $post->featured_image }}" class="img-fluid rounded-start" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                        <p class="card-text fs-6">{{ Str::limit($post->excerpt, 50) }}</p>
                        <p class="card-text"><small class="text-body-secondary">Last updated {{ $post->updated_at->diffForHumans() }}</small></p>
                    </div>
                </div>
                </a>
            </div>
        @endforeach
    @endif

    {{-- Load More Button --}}
           @if($loaded < $total)


        <div class="col-12 text-center py-3">
            <button wire:click="loadMore" type="button" class="btn btn-outline-secondary rounded-0">Load More</button>
        </div>
   @endif
</div>
