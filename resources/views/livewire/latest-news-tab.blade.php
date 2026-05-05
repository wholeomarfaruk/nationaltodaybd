<style>
    .latestPostShortList {
        max-height: 50rem;

    }

    .latestPostShortList .tab-area {}

    .latestPostShortList .tab-area .nav-tabs {}

    .latestPostShortList .tab-area button.nav-link {}

    .latestPostShortList .tab-area button.nav-link.active {}


    .latestPostShortList .tab-content {}

    .latestPostShortList .tab-content .tab-pane {}

    .latestPostShortList .tab-content .tab-pane.show {}

    .latestPostShortList .tab-content .tab-pane.active {}

    .latestPostShortList .tab-content .tab-pane>.all-news-btn {
        z-index: 1;
        font-weight: 600;
        color: rgb(48, 47, 47);

    }
     .latestPostShortList .tab-content .tab-pane>.all-news-btn:hover {

        color: rgb(0, 0, 0);
        background-color: gainsboro !important;
    }

    .latestPostShortList .tab-content .tab-pane .list {
        display: block;
        overflow-y: scroll;
        height: 300px;
        /* padding-left: 0; */
        width: 100%;
        overflow-x: hidden;
    }

    .latestPostShortList .tab-content .tab-pane .list .list-item {}

    .latestPostShortList .tab-content .tab-pane .list .list-item span {
        width: 30px;
        height: 30px;
        line-height: 30px;
        font-size: 12px;
        padding: 0;
    }

    .latestPostShortList .tab-content .tab-pane .list .list-item a {
        font-size:14px;
    }
</style>
<div class="latestPostShortList mb-3">

    <nav class="tab-area">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                role="tab" aria-controls="nav-home" aria-selected="true">সর্বশেষ খবর</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">জনপ্রিয় খবর</button>

        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
            tabindex="0">
            <ul class="list pt-2">
                @if ($LNPosts)
                    @foreach ($LNPosts as $index => $lnPost)
                        <li class="row align-items-center mb-3 list-item"> <span
                                class="col-2 bg-secondary bg-opacity-50  rounded-circle fw-semibold text-center"
                                style="">{{ $index + 1 }}</span>
                                <a class="col-10 fw-semibold d-block"
                                style="" href="{{route('post.show',['category'=>$lnPost,'slug'=>$lnPost->slug])}}">{{ $lnPost->title }}</a></li>
                    @endforeach

                @endif

            </ul>
            <a href="#" class="all-news-btn btn btn-outline-secondary w-100  bg-white sticky-bottom ">সর্বশেষ সব খবর</a>

        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            <ul class="list pt-2">
                @if ($PNPosts)
                    @foreach ($PNPosts as $index => $pnPost)
                        <li class="row align-items-center mb-3 list-item"> <span
                                class="col-2 bg-secondary bg-opacity-50  rounded-circle fw-semibold text-center"
                                style="width: 30px; height: 30px; line-height: 30px; font-size: 14px;">{{ $index + 1 }}</span>
                            <a class="col-10 fw-semibold d-block" style="font-size:14px;"
                                href="{{route('post.show',['category'=>$pnPost,'slug'=>$pnPost->slug])}}">{{ $pnPost->title }}</a>
                        </li>
                    @endforeach

                @endif

            </ul>
            <a href="#" class="all-news-btn btn btn-outline-secondary bg-white w-100 sticky-bottom ">জনপ্রিয় সব খবর</a>
        </div>

    </div>
</div>
