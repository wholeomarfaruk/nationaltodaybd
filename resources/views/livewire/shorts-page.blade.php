<div class="relative ">



    <!-- 🎥 Shorts videos -->
    <div id="shortsContainer" class="h-full overflow-y-scroll scrollbar-none">

        <div class="wrapper">
            <div class="video-container border p-3 rounded mx-auto" style="width: 360px">
                <style>
                    .owl-theme .owl-nav {
                        margin-top: 10px;
                        text-align: center;
                        -webkit-tap-highlight-color: transparent;
                        position: absolute;
                        left: 0;
                        right: 0;
                        top: 42%;
                        display: flex;
                        justify-content: space-between;
                    }

                    .owl-carousel .owl-nav button.owl-prev {
                        margin-left: -26px;
                        font-size: 36px;
                        padding: 10px !important;
                        background: rgb(41, 41, 41);
                        color: #fff;

                    }

                    .owl-carousel .owl-nav button.owl-next {
                        margin-right: -30px;
                        font-size: 36px;
                        padding: 10px !important;
                        color: #fff;
                        background: rgb(41, 41, 41);
                    }
                </style>
                <div class="owlcarousel owl-carousel owl-theme" width="360">
                    @foreach ($videos as $video)
                        <div class="item">
                            <div class="video-card">
                                <iframe width="100%" height="460"
                                    src="https://www.youtube.com/embed/{{ $video->video_id }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    @endforeach

                </div>


            </div>
        </div>
    </div>

    <!-- 🧭 Bottom navigation -->
    <div  class="position-sticky bottom-0 start-0 end-0 bg-white border-top d-flex justify-content-center py-2 " style="z-index: 999;">
        <a href="{{ route('video.post.list') }}" class="btn btn-outline-primary w-100 text-primary fw-semibold rounded-0">Videos</a>
        <a href="{{ route('video.post.shorts') }}"
            class="btn btn-outline-secondary text-secondary fw-semibold w-100 rounded-0">Shorts</a>
    </div>
</div>

<!-- 🧠 Handle scroll/swipe with JS -->
<script>
    document.addEventListener('livewire:load', () => {
        const container = document.getElementById('shortsContainer');
        let lastIndex = 0;

        container.addEventListener('scroll', () => {
            const videos = document.querySelectorAll('#shortsContainer > div');
            let index = Math.round(container.scrollTop / window.innerHeight);

            if (index !== lastIndex) {
                lastIndex = index;
                Livewire.dispatch('update-url', videos[index]?.dataset?.slug);
            }
        });

        Livewire.on('update-url', slug => {
            if (slug) history.replaceState(null, '', `/shorts/${slug}`);
        });
    });
</script>
@push('scripts')
    <script>
        // 1. Initialize Owl Carousel
        $('.owlcarousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
            }
        });

        // --- Video Playback Logic ---

        // Function to play the video in the active item
        function playActiveVideo() {
            var $currentItem = $(".owl-carousel .owl-item.active");

            // Stop all other videos first (optional, but good practice for shorts)
            $(".owl-carousel iframe").each(function() {
                var $this = $(this);
                // Pause all videos
                $this[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
            });

            // Play the active video
            $currentItem.find("iframe").each(function() {
                var $this = $(this);
                $this[0].contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
            });
        }

        // 2. Play video when a slide changes
        $(".owl-carousel").on("changed.owl.carousel", function(event) {
            playActiveVideo();
        });

        // 3. Play video when the carousel is initialized (first time load)
        // 'initialized.owl.carousel' event ensures the active item is ready
        $(".owl-carousel").on("initialized.owl.carousel", function(event) {
            // Delay slightly to ensure YouTube iframe API is ready (though often not needed)
            setTimeout(playActiveVideo, 100);
        });
    </script>
@endpush
