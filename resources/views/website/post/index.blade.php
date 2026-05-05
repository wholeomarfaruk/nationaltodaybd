@extends('layouts.website')
@section('meta_title', $post->title)
@section('meta_description', Str::limit(strip_tags($post->excerpt), 160))
@section('meta_og_title', $post->title)
@section('meta_og_description', Str::limit(strip_tags($post->excerpt), 160))
@section('meta_og_image', $post->featured_image)
@section('meta_twitter_title', $post->title)
@section('meta_twitter_description', Str::limit(strip_tags($post->excerpt), 160))
@section('meta_twitter_image', $post->featured_image)
@section('meta_canonical', $post->PostUrl)

@section('content')

    @livewire('post-detail', ['id' => $post->id],key($post->id))
@endsection



@push('scripts')
    <script>
        moment.locale('bn');

        function date_init() {
            let postDates = document.querySelectorAll('.post_date');
            postDates.forEach(el => {
                let date = el.getAttribute('data-date');
                if (date) {
                    el.textContent = moment(date).format('LLLL');
                }
            });

        }

        // প্রথমবার কল হবে
        date_init();
    </script>
    <script>
        $(document).ready(function() {

            function isElementInViewport(el) {
                var rect = el.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.bottom <= (window.innerHeight || $(window).height())
                );
            }

            function updateVisiblePostUrl() {


                $('.post-wrapper').each(function() {
                    if (isElementInViewport(this)) {
                        var url = $(this).data('url');
                        history.replaceState(null, '', url);
                        return false; // Stop at the first visible post
                    }
                });
            }

            // On scroll
            $(window).on('scroll', function() {
                updateVisiblePostUrl();
            });

            // Initial check
            updateVisiblePostUrl();

            // If posts are loaded dynamically via Livewire, re-run after updates
            Livewire.on('post-loaded', function() {
                date_init();
            })
        });
    </script>
<script>
    document.addEventListener('fb-reinit', () => {
        // Function to attempt parsing
        const parseWidgets = function() {
            // Check if FB SDK is defined
            if (typeof FB !== 'undefined' && typeof FB.XFBML !== 'undefined') {
                console.log('FB.XFBML.parse() executed for new content.');
                // 🚀 This is the call that loads the comments for the new post
                FB.XFBML.parse();
            } else {
                // If the SDK hasn't finished loading, wait and try again
                console.warn('FB object not ready. Retrying parse in 100ms...');
                setTimeout(parseWidgets, 100);
            }
        };

        parseWidgets(); // Start the attempt
    });
</script>

@endpush
