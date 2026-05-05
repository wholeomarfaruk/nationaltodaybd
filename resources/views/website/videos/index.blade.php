@extends('layouts.website')



@section('content')
    <div class="wrapper py-4 position-relative">
        <div class="flex justify-between items-center mb-4">
            <form method="GET" action="{{ route('video.post.list') }}" class="w-full">
                <input type="text" name="q" value="{{ $search }}" placeholder="Search videos..."
                    class="w-full border rounded-lg px-4 py-2">
            </form>
        </div>
        <style>
            .card {
                border: 1px solid #e2e8f0;
                border-radius: 0.5rem;
                overflow: hidden;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }

            .card-img-top {
                width: 100%;
                height: auto;
            }

            .card-body {
                padding: 1rem;
            }

            .card-title {
                font-size: 1.25rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .card-text {
                font-size: 1rem;
                color: #4a5568;
                margin-bottom: 1rem;
            }

            .grid-box {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }
        </style>
        <div class="grid-box">
            @foreach ($videos as $video)
                <div class="card">
                    <a href="{{ route('video.post.show', $video->slug) }}">
                        <img src="{{ $video->featured_image }}" class="card-img-top" alt="{{ $video->title }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->title }}</h5>
                        <p class="card-text">{{ Str::limit($video->excerpt, 40) }}</p>
                        <a href="{{ route('video.post.show', $video->slug) }}" class="btn btn-secondary w-full">Watch
                            Now</a>
                    </div>
                </div>
            @endforeach
        </div>



        <div class="mt-6">{{ $videos->links() }}</div>
          <!-- 🧭 Bottom navigation -->
    <div class="position-sticky bottom-0 start-0 end-0 bg-white border-top d-flex justify-content-center py-2 "
        style="z-index: 999;">
        <a href="{{ route('video.post.list') }}"
            class="btn btn-outline-primary w-100 text-primary fw-semibold rounded-0">Videos</a>
        <a href="{{ route('video.post.shorts') }}"
            class="btn btn-outline-secondary text-secondary fw-semibold w-100 rounded-0">Shorts</a>
    </div>
    </div>



@endsection
