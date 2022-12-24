@extends('frontend.eventlayout.app')


@section('meta_title'){{ $event->meta_title }}@stop

@section('meta_description'){{ $event->meta_description }}@stop

@section('meta_keywords'){{ $event->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $event->meta_title }}">
    <meta itemprop="description" content="{{ $event->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($event->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $event->meta_title }}">
    <meta name="twitter:description" content="{{ $event->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($event->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $event->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('event.details', $event->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($event->meta_img) }}" />
    <meta property="og:description" content="{{ $event->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')

<style>
.col-md-6.event_img_wrap img {
    width: 85%;
    margin: 0 auto;
}
.col-md-6.event_desc_wrap {
    padding-top: 13px;
}
section#event_details {
    margin-top: 5rem;
}

h2.event_title {
    text-transform: capitalize;
    padding-bottom: 10px;
    color: var(--primary-color);
    padding-top: 14px;
}

span.event_cetagory {
    background: #ecececc9;
    padding: 3px 10px 5px 10px;
    line-height: 0;
    border-radius: 5px;
    margin-right: 1rem;
}

.upper_event {
}

h3.event_price {
    padding-bottom: 1.6rem;
    font-size: 27px;
}
.event_buy_button a {
    text-transform: uppercase;
    text-decoration: none;
    background: var(--primary-color);
    color: white;
    font-size: 14px;
    padding: 12px 30px 15px 30px;
    border-radius: 6px;
}
.col-md-6.event_img_wrap {
    display: flex;
    justify-content: center;
}
</style>




<!--event details section start-->
  <section id="event_details">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 event_img_wrap">
                        <img src="{{ uploaded_asset($event->banner) }}" class="img-fluid">
                    </div> 
                    <div class="col-md-6 event_desc_wrap">
                      <div class="upper_event">
                            @if($event->category != null)
                           <span class="event_cetagory">
                               <i>{{ $event->category->category_name }}</i>
                               </span> 
                           @endif
                           <small>Release Date:30 Jun 2022</small> 
                      </div>
                     <div class="lower_event">
                        <h2 class="event_title">{{ $event->title }}</h2>
                        <p>{!! $event->description !!}</p>
                    <h3 class="event_price">Price: ${!! $event->price !!}</h3>
               <div class="event_buy_button">
                <a href="{{ url("bookevent").'/'. $event->id }}">Book now</a>
               </div>
                     </div>
                    </div>
                    
                </div>
            </div>
        </section>


<!--event details section end-->


<!--<section class="py-4">-->
<!--    <div class="container">-->
<!--        <div class="mb-4">-->
<!--            <img-->
<!--                src="{{ uploaded_asset($event->banner) }}"-->
<!--                data-src="{{ uploaded_asset($event->banner) }}"-->
<!--                alt="{{ $event->title }}"-->
<!--                class="img-fluid lazyload w-100"-->
<!--            >-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="col-xl-8 mx-auto">-->
<!--                <div class="bg-white rounded shadow-sm p-4"> -->
<!--                    <div class="border-bottom">-->
<!--                        <h1 class="h4">-->
<!--                            {{ $event->title }}-->
<!--                        </h1>-->
                        <!--@if($event->category != null)-->
                        <!--<div class="mb-2 opacity-50">-->
                        <!--    <i>{{ $event->category->category_name }}</i>-->
                        <!--</div>-->
                        <!--@endif-->
<!--                    </div>-->
<!--                    <div class="mb-4 overflow-hidden">-->
<!--                        {!! $event->description !!}-->
<!--                    </div>-->
                    
<!--                          <br>-->
<!--                          <br>-->
<!--                          <br>-->
<!--                          <a class="article-tag article-tag-absolute rounded" href="{{ url("bookevent").'/'. $event->id }}" style="top: unset;text-decoration: none;display: unset;position: relative;">Book Now</a>-->
<!--                    @if (get_setting('facebook_comment') == 1)-->
<!--                    <div>-->
<!--                        <div class="fb-comments" data-href="{{ route("event",$event->slug) }}" data-width="" data-numposts="5"></div>-->
<!--                    </div>-->
<!--                    @endif-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

@endsection


@section('script')
    @if (get_setting('facebook_comment') == 1)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId={{ env('FACEBOOK_APP_ID') }}&autoLogAppEvents=1" nonce="ji6tXwgZ"></script>
    @endif
@endsection