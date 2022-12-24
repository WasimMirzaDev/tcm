@extends('frontend.eventlayout.app')

@section('content')




<style>
    /*event css*/
    h2.article-card-heading a {
    text-decoration: none;
    text-transform: capitalize;
}
.article-tag-absolute {
    color: #fff;
    background-color: var(--primary-color);
    position: absolute;
    z-index: 2;
    right: 10px;
    bottom: -9px;
    padding: 12px 13px 16px 13px;
    display: inline-block;
    font-size: 13px;
    line-height: 0;
}
    


a.article-tag.article-tag-absolute:hover {
    color: white;
}
a.article-tag.article-tag-absolute {
    font-size: 14px;
    padding: 6px 13px 6px 13px;
    text-transform: uppercase;
    font-weight: 500;
    line-height: 24px;
    display: inline-block;
    text-decoration: none;
        position: inherit;
}
.article-card-heading{
    margin-top: 10px;
}
    
p.atricle_heading_sub_title {
    line-height: 19px;
    font-size: 14px;
    margin-bottom: 26px;
}


h2.article-card-heading.heading_18.price:hover {
    color: black;
}

.price_book_now_button {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.events_article_wrapper {
    padding: 0 1rem 2rem;
}
.article-card-heading {
    margin-top: 1px;
}
h2.article-card-heading.heading_18 {
    margin: 10px 0 1px;
}

a.article-card-img-wrapper img{
    width: 100%;
    height: 300px;
    display: grid;
    align-items: center;
}
span.article-tag.article-tag-absolute.rounded {
    background: #ffe5e5;
    color: black;
}
</style>
        <div class="breadcrumb">
            <div class="container">
                <ul class="list-unstyled d-flex align-items-center m-0">
                    <li><a href="/">Home</a></li>
                    <li>
                        <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.4">
                                <path
                                    d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                                    fill="#000" />
                            </g>
                        </svg>
                    </li>
                    <li>Blog</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
             <div class="container">
                   <div class="row trusted-row mt-4 mb-4">

            @foreach($events as $blog)
                            <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-duration="700">
                                <div class="article-card bg-transparent p-0">
                            <a class="article-card-img-wrapper" href="{{ url("event").'/'. $blog->slug }}">
                                        <img   src="{{ uploaded_asset($blog->banner) }}"
                            data-src="{{ uploaded_asset($blog->banner) }}"
                            alt="{{ $blog->title }}"
                                            class="article-card-img rounded">

                        @if($blog->category != null)
                                        <span class="article-tag article-tag-absolute rounded">{{ $blog->category->category_name }}</span>

                        @endif
                                    </a>
                                    <div class="events_article_wrapper">
                                        <p class="article-card-published text_12 d-flex align-items-center">
                                        <span class="article-date d-flex align-items-center">
                                            <span class="icon-publish">
                                                <svg width="17" height="18" viewBox="0 0 17 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"
                                                        fill="#00234D" />
                                                </svg>
                                            </span>
                                            <span class="ms-2">{{date('d-m-Y', strtotime($blog->created_at));}}</span>
                                        </span>
                                        <span class="article-author d-flex align-items-center ms-4">
                                           
                                            <!-- <span class="ms-2">Lara Joe</span> -->
                                        </span>
                                    </p>
                                    <h2 class="article-card-heading heading_18">
                                        <a class="heading_18" href="{{ url("event").'/'. $blog->slug }}">
                                           {{ $blog->title }}
                                        </a>
                                      
                                      </h2>
                                      <p class="atricle_heading_sub_title">Lorem Ipsum is simply dummy text of the printing and typesetting industry he printing and typesetti. </p>
                                    <div class="price_book_now_button">
                                        <h2 class="article-card-heading heading_18 price">
                                           ${{ $blog->price }}
                                    </h2>
                                    <a class="article-tag article-tag-absolute rounded"  href="@if (!Auth::guest())
{{ url("bookevent").'/'. $blog->id }} @else  {{ url("bookevent").'/'. $blog->id }} @endif">Book Now</a>
                                    </div>
                                    </div>
                                  
                                </div>
                            </div>@endforeach      
                        </div>
             </div>
            
            
            <!--<div class="blog-page mt-100">-->
            <!--    <div class="blog-page-wrapper">-->
            <!--        <div class="container">-->
            <!--            <div class="row">-->

            <!--@foreach($events as $blog)-->
            <!--                <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-duration="700">-->
            <!--                    <div class="article-card bg-transparent p-0 shadow-none">-->
            <!--                <a class="article-card-img-wrapper" href="{{ url("event").'/'. $blog->slug }}">-->
            <!--                            <img   src="{{ uploaded_asset($blog->banner) }}"-->
            <!--                data-src="{{ uploaded_asset($blog->banner) }}"-->
            <!--                alt="{{ $blog->title }}"-->
            <!--                                class="article-card-img rounded">-->

            <!--            @if($blog->category != null)-->
            <!--                            <span class="article-tag article-tag-absolute rounded">{{ $blog->category->category_name }}</span>-->

            <!--            @endif-->
            <!--                        </a>-->
            <!--                        <p class="article-card-published text_12 d-flex align-items-center">-->
            <!--                            <span class="article-date d-flex align-items-center">-->
            <!--                                <span class="icon-publish">-->
            <!--                                    <svg width="17" height="18" viewBox="0 0 17 18" fill="none"-->
            <!--                                        xmlns="http://www.w3.org/2000/svg">-->
            <!--                                        <path-->
            <!--                                            d="M3.46875 0.875V1.59375H0.59375V17.4063H16.4063V1.59375H13.5313V0.875H12.0938V1.59375H4.90625V0.875H3.46875ZM2.03125 3.03125H3.46875V3.75H4.90625V3.03125H12.0938V3.75H13.5313V3.03125H14.9688V4.46875H2.03125V3.03125ZM2.03125 5.90625H14.9688V15.9688H2.03125V5.90625ZM6.34375 7.34375V8.78125H7.78125V7.34375H6.34375ZM9.21875 7.34375V8.78125H10.6563V7.34375H9.21875ZM12.0938 7.34375V8.78125H13.5313V7.34375H12.0938ZM3.46875 10.2188V11.6563H4.90625V10.2188H3.46875ZM6.34375 10.2188V11.6563H7.78125V10.2188H6.34375ZM9.21875 10.2188V11.6563H10.6563V10.2188H9.21875ZM12.0938 10.2188V11.6563H13.5313V10.2188H12.0938ZM3.46875 13.0938V14.5313H4.90625V13.0938H3.46875ZM6.34375 13.0938V14.5313H7.78125V13.0938H6.34375ZM9.21875 13.0938V14.5313H10.6563V13.0938H9.21875Z"-->
            <!--                                            fill="#00234D" />-->
            <!--                                    </svg>-->
            <!--                                </span>-->
            <!--                                <span class="ms-2">{{date('d-m-Y', strtotime($blog->created_at));}}</span>-->
            <!--                            </span>-->
            <!--                            <span class="article-author d-flex align-items-center ms-4">-->
                                           
            <!--                                 <span class="ms-2">Lara Joe</span> -->
            <!--                            </span>-->
            <!--                        </p>-->
            <!--                        <h2 class="article-card-heading heading_18">-->
            <!--                            <a class="heading_18" href="article.html">-->
            <!--                               {{ $blog->title }}-->
            <!--                            </a>-->
            <!--                            <br>-->
            <!--                        <a class="article-tag article-tag-absolute rounded" href="{{ url("bookevent").'/'. $blog->id }}" style="top: unset;text-decoration: none;display: unset;position: relative;">Book Now</a>-->
            <!--                        </h2>-->
            <!--                    </div>-->
            <!--                </div>-->
                      
            <!--@endforeach      -->
            <!--            </div>-->

            <!--            <div class="pagination justify-content-center mt-100">-->
            <!--                 {{ $events->links() }}-->
            <!--                 <nav>-->
            <!--                    <ul class="pagination m-0 d-flex align-items-center">-->
            <!--                        <li class="item disabled">-->
            <!--                            <a class="link">-->
            <!--                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"-->
            <!--                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"-->
            <!--                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"-->
            <!--                                    class="icon icon-left">-->
            <!--                                    <polyline points="15 18 9 12 15 6"></polyline>-->
            <!--                                </svg>-->
            <!--                            </a>-->
            <!--                        </li>-->
            <!--                        <li class="item"><a class="link" href="#">1</a></li>-->
            <!--                        <li class="item active"><a class="link" href="#">2</a></li>-->
            <!--                        <li class="item"><a class="link" href="#">3</a></li>-->
            <!--                        <li class="item"><a class="link" href="#">4</a></li>-->
            <!--                        <li class="item">-->
            <!--                            <a class="link" href="#">-->
            <!--                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"-->
            <!--                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"-->
            <!--                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"-->
            <!--                                    class="icon icon-right">-->
            <!--                                    <polyline points="9 18 15 12 9 6"></polyline>-->
            <!--                                </svg>-->
            <!--                            </a>-->
            <!--                        </li>-->
            <!--                    </ul>-->
            <!--                </nav> -->-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>            -->
            <!--</div>            -->
        </main>
@endsection
