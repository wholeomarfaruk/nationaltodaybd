@extends('layouts.website')



@section('content')
    <section>
        <div class="wrapper my-3">
            <div class="row">
                <div class="col-md-8">
                    <div class="aspect-video bg-gray-800 rounded-lg overflow-hidden mb-3">
                        <iframe height="460" width="100%" class="w-full h-full"
                            src="https://www.youtube.com/embed/{{ $video->video_id }}" allowfullscreen></iframe>
                    </div>
                    <div class="flex items-center justify-between">
                        <h1 class="topnews-title mb-2">{{ $video->title }}</h1>
                        <p class="text-gray-600 flex items-center">
                            <i class="fa-solid fa-user me-2"></i>
                            {{ $video->author->name }}
                            <i class="fa-solid fa-eye me-2"></i>
                            ({{ $video->views }} Views)
                            <i class="fa-solid fa-calendar me-2 ms-2"></i>
                            <span class="text-gray-600">{{ \Carbon\Carbon::parse($video->created_at)->format('d M, Y') }}</span>
                        </p>
                    </div>
                    <div class="prose max-w-none text-center">
                        <button class="btn btn-outline-primary mb-2 toggledescription" onclick="toggleContent()">
                            <i class="fa-solid fa-arrow-down"></i>
                        </button>
                        <div id="content" style="display: none">
                            {!! $video->content !!}
                        </div>
                        <script>
                            function toggleContent() {
                                var content = document.getElementById('content');
                                var icon = document.querySelector('.toggledescription i');

                                if (content.style.display === "none") {
                                    content.style.display = "block";
                                    icon.classList.remove('fa-arrow-down');
                                    icon.classList.add('fa-arrow-up');
                                } else {
                                    content.style.display = "none";
                                    icon.classList.remove('fa-arrow-up');
                                    icon.classList.add('fa-arrow-down');
                                }
                            }
                        </script>
                    </div>
                </div>
                <div class="col-md-4 rounded border p-3">
                    @foreach ($videos as $vitem)
                        <div class="card mb-4">
                            <div class="">
                                <a href="{{ route('video.post.show', $vitem->slug) }}">
                                    <img src="{{ $vitem->featured_image }}" alt="{{ $vitem->title }}"
                                        class="img-fluid rounded" >
                                </a>
                            </div>
                            <div class="p-2">
                                  <p class="card-text text-gray-600 d-flex align-items-center mt-1" style="font-size: 0.8rem">
                                    <i class="fa-solid fa-circle-user me-2"></i>
                                    {{ $vitem->author->name }}
                                    <i class="fa-solid fa-eye ms-3 me-2"></i>
                                    ({{ $vitem->views }} Views)
                                </p>
                                <a href="{{ route('video.post.show', $vitem->slug) }}">
                                <h3 class="card-title fw-bold py-3 pt-2" >
                                    {{ Str::limit($vitem->title, 62) }}</h3>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
  <!-- 🧭 Bottom navigation -->
    <div class="position-sticky bottom-0 start-0 end-0 bg-white border-top d-flex justify-content-center py-2 "
        style="z-index: 999;">
        <a href="{{ route('video.post.list') }}"
            class="btn btn-outline-primary w-100 text-primary fw-semibold rounded-0">Videos</a>
        <a href="{{ route('video.post.shorts') }}"
            class="btn btn-outline-secondary text-secondary fw-semibold w-100 rounded-0">Shorts</a>
    </div>
    </section>
@endsection
