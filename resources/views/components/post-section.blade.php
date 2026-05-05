@if ($newsPosts && $newsPosts->count() > 0)
    @switch($style)
        @case(1)
            <section class="mb-3">
                <div class="wrapper">

                    <div class=" border p-3 rounded ">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="header"><i class="fa-solid fa-newspaper"></i> {{ $newsPosts->first()->category->name }}
                            </div>
                            <a href="{{ route('category', $newsPosts->first()->category->slug) }}"
                                class="text-decoration-none fw-bold">
                                {{ $newsPosts->first()->category->name }} সব নিউজ <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                        <div class="entertainment-box">

                            <div class="row ">
                                <div class="col-md-3">
                                    @foreach ($newsPosts->slice(1, 2) as $post)
                                        <div class="item py-3 border-bottom border-light-subtle ">
                                            <a
                                                href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">


                                                <img class=" w-100" src="{{ $post->featured_image }}" alt="">


                                                <div class="">
                                                    <h3 class=" secondpost-title">{{ $post->title }}
                                                    </h3>

                                                </div>
                                            </a>



                                        </div>
                                    @endforeach

                                </div>
                                <div class="col-md-6">
                                    <div class="item  py-3 border-bottom border-light-subtle">
                                        <a
                                            href="{{ route('post.show', ['category' => $newsPosts->first()->category->slug, 'slug' => $newsPosts->first()->slug]) }}">

                                            <img class="rounded" src="{{ $newsPosts->first()->featured_image }}" alt="">
                                            <div class="p-2">
                                                <h3 class=" secondpost-title">{{ $newsPosts->first()->title }}</h3>
                                                <div class="hotnews-short-description">
                                                    {{ $newsPosts->first()->excerpt }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    @foreach ($newsPosts->slice(3, 2) as $post)
                                        <div class="item py-3 border-bottom border-light-subtle ">
                                            <a
                                                href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">


                                                <img class=" w-100" src="{{ $post->featured_image }}" alt="">


                                                <div class="">
                                                    <h3 class="secondpost-title">{{ $post->title }}
                                                    </h3>

                                                </div>
                                            </a>



                                        </div>
                                    @endforeach


                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        @foreach ($newsPosts->slice(5, 4) as $post)
                                            <div class="col-6 col-lg-3 item py-3 border-bottom border-light-subtle ">
                                                <a
                                                    href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">


                                                    <img class=" w-100" src="{{ $post->featured_image }}" alt="">


                                                    <div class="">
                                                        <h3 class="secondpost-title">{{ $post->title }}
                                                        </h3>

                                                    </div>
                                                </a>


                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @break

        @case(2)
            <section class="pss-two mb-3">
                <div class="wrapper">
                    <div class="pss-two-container  border p-3 rounded ">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="header"><i class="fa-solid fa-newspaper"></i> {{ $newsPosts->first()->category->name }}
                            </div>
                            <a href="{{ route('category', $newsPosts->first()->category->slug) }}"
                                class="text-decoration-none fw-bold">
                                {{ $newsPosts->first()->category->name }} সব নিউজ <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                        <div class="grid-box">


                            <div class="item">
                                <a
                                    href="{{ route('post.show', ['category' => $newsPosts->first()->category->slug, 'slug' => $newsPosts->first()->slug]) }}">
                                    <img class="rounded" src="{{ $newsPosts->first()->featured_image }}" alt="">
                                    <div class="p-2">
                                        <h3 class=" topnews-title">{{ $newsPosts->first()->title }}</h3>
                                        <p class="hotnews-short-text ">{{ $newsPosts->first()->excerpt }}
                                        </p>
                                    </div>
                                </a>
                            </div>


                            @foreach ($newsPosts->take(8) as $post)
                                <div class="item">
                                    <a
                                        href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">

                                        <img class="rounded" src="{{ $post->featured_image }}" alt="">
                                        <div class="p-2">
                                            <h3 class=" secondpost-title">{{ $post->title }}</h3>

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @break

        @case(3)
            <section id="national_area" class="mb-3">
                <div class="wrapper">



                    <div class="national_container border p-3 rounded ">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="header"><i class="fa-solid fa-newspaper"></i> {{ $newsPosts->first()->category->name }}
                            </div>
                            <a href="{{ route('category', $newsPosts->first()->category->slug) }}"
                                class="text-decoration-none fw-bold">
                                {{ $newsPosts->first()->category->name }} সব নিউজ <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>

                        <div class="national-box">
                            <div class="row">


                                <div class="col-md-4">
                                    <div class="item mb-2 ">
                                        <a
                                            href="{{ route('post.show', ['category' => $newsPosts->first()->category->slug, 'slug' => $newsPosts->first()->slug]) }}">

                                            <img class="rounded" src="{{ $newsPosts->first()->featured_image }}"
                                                alt="">
                                            <div class="p-2">
                                                <h3 class="topnews-title">{{ $newsPosts->first()->title }}
                                                </h3>
                                                <div class="hotnews-short-text">
                                                    {{ $newsPosts->first()->excerpt }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    @foreach ($newsPosts->slice(1, 4) as $post)
                                        <div class="item mb-2">
                                            <a
                                                href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">

                                                <div class="row">
                                                    <div class="col-4">
                                                        <img class="rounded" src="{{ $post->featured_image }}" lazy
                                                            alt="">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="">
                                                            <div class="secondpost-title">{{ $post->title }}</div>
                                                            <div class="text-muted" style="font-size: 13px;">
                                                                <i class="fa-regular fa-clock"></i> Last updated
                                                                {{ $post->updated_at->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>


                                        </div>
                                    @endforeach


                                </div>
                                <div class="col-md-4">
                                    @foreach ($newsPosts->slice(4, 4) as $post)
                                        <div class="item mb-2">
                                            <a
                                                href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">

                                                <div class="row">
                                                    <div class="col-4">
                                                        <img class="rounded" src="{{ $post->featured_image }}" lazy
                                                            alt="">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="">
                                                            <div class="secondpost-title">{{ $post->title }}</div>
                                                            <div class="text-muted" style="font-size: 13px;">
                                                                <i class="fa-regular fa-clock"></i> Last updated
                                                                {{ $post->updated_at->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    @endforeach


                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                </div>
            </section>
        @break

        @case(4)
            <section id="video_area" class="mb-3">
                <div class="wrapper">
                    <div class="video-container border p-3 rounded ">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="header"><i class="fa-solid fa-newspaper"></i>
                                {{ $newsPosts->first()->category->name }}
                            </div>
                            <a href="{{ route('category', $newsPosts->first()->category->slug) }}"
                                class="text-decoration-none fw-bold">
                                {{ $newsPosts->first()->category->name }} সব নিউজ <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach ($newsPosts->take(10) as $post)
                                <div class="item">
                                    <a
                                        href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}"></a>
                                    <img src="{{ $post->featured_image }}" alt="">
                                    <div class="p-2">
                                        <h3 class="fw-bold">{{ $post->title }}</h3>
                                        <div class="text-muted" style="font-size: 13px;">
                                            <i class="fa-regular fa-clock"></i> Last updated
                                            {{ $post->updated_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @break

        @case(5)
            <section class="mb-3">
                <div class="wrapper">
                    <div class="border p-3 rounded ">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="header"><i class="fa-solid fa-newspaper"></i>
                                {{ $newsPosts->first()->category->name }}
                            </div>
                            <a href="{{ route('category', $newsPosts->first()->category->slug) }}"
                                class="text-decoration-none fw-bold">
                                {{ $newsPosts->first()->category->name }} সব নিউজ <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                        <div class="international-box">

                            <div class="row">

                                <div class="col-md-4">
                                    @foreach ($newsPosts->slice(1, 4) as $post)
                                        <div class="item mb-3">
                                            <a
                                                href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">

                                                <div class="row">
                                                    <div class="col-4">
                                                        <img class="rounded" src="{{ $post->featured_image }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="">
                                                            <h3 class="secondpost-title">{{ $post->title }}
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    @endforeach





                                </div>
                                <div class="col-md-4">
                                    <div class="item">
                                        <a
                                            href="{{ route('post.show', ['category' => $newsPosts->first()->category->slug, 'slug' => $newsPosts->first()->slug]) }}">

                                            <img class="rounded" src="{{ $newsPosts->first()->featured_image }}"
                                                alt="">
                                            <div class="p-2">
                                                <h3 class="secondpost-title">{{ $newsPosts->first()->title }}</h3>
                                                <div class="hotnews-short-text">{{ $newsPosts->first()->excerpt }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    @foreach ($newsPosts->slice(4, 4) as $post)
                                        <div class="item mb-3">
                                            <a
                                                href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">

                                                <div class="row">
                                                    <div class="col-4">
                                                        <img class="rounded" src="{{ $post->featured_image }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="">
                                                            <h3 class="secondpost-title">{{ $post->title }}
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    @endforeach


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @break

        @default
            <section class="mb-3">
                <div class="wrapper">
                    <div class="border p-3 rounded ">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="header"><i class="fa-solid fa-newspaper"></i>
                                {{ $newsPosts->first()->category->name }}
                            </div>
                            <a href="{{ route('category', $newsPosts->first()->category->slug) }}"
                                class="text-decoration-none fw-bold">
                                {{ $newsPosts->first()->category->name }} সব নিউজ <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                        <div class="international-box">

                            <div class="row">

                                <div class="col-md-4">
                                    @foreach ($newsPosts->slice(1, 4) as $post)
                                        <div class="item mb-3">
                                            <a
                                                href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">

                                                <div class="row">
                                                    <div class="col-4">
                                                        <img class="rounded" src="{{ $post->featured_image }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="">
                                                            <h3 class="secondpost-title">{{ $post->title }}
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    @endforeach





                                </div>
                                <div class="col-md-4">
                                    <div class="item">
                                        <a
                                            href="{{ route('post.show', ['category' => $newsPosts->first()->category->slug, 'slug' => $newsPosts->first()->slug]) }}">

                                            <img class="rounded" src="{{ $newsPosts->first()->featured_image }}"
                                                alt="">
                                            <div class="p-2">
                                                <h3 class="secondpost-title">{{ $newsPosts->first()->title }}</h3>
                                                <div class="hotnews-short-text">{{ $newsPosts->first()->excerpt }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    @foreach ($newsPosts->slice(4, 4) as $post)
                                        <div class="item mb-3">
                                            <a
                                                href="{{ route('post.show', ['category' => $post->category->slug, 'slug' => $post->slug]) }}">

                                                <div class="row">
                                                    <div class="col-4">
                                                        <img class="rounded" src="{{ $post->featured_image }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="">
                                                            <h3 class="secondpost-title">{{ $post->title }}
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    @endforeach


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
    @endswitch
@endif
