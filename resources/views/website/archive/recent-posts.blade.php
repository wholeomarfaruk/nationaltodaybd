@extends('layouts.website')
@section('content')
    <section id="category">
        <div class="wrapper">


            <div class="row mt-4">
                <div class="col-md-9">
                     @livewire('recent-post')


                </div>
                <div class="col-md-3">
                      @livewire('latest-news-tab')
                </div>
            </div>
        </div>
    </section>
@endsection
