<div class="widget lstPost-widget">
    <h5 class="widget-title">Popular Blogs</h5>
    <div class="latest-posts">
        @foreach($latest_posts as $post)
            <article class="post media-post clearfix pb-0 mb-10">
                @if($post->image)
                    <a class="post-thumb" href="{{url('/blog/'.$post->slug)}}"><img width="75" src="{{ getBlogImgPath($post->image) }}" alt="{{$post->title}}" class="img-responsive"></a>
                @else
                    <img src="https://picsum.photos/75/75/?random" class="img-fullwidth" alt="">
                @endif
                {{--<a class="post-thumb" href="#"><img src="https://placehold.it/75x75" alt=""></a>--}}
                <div class="post-right">
                    <h5 class="post-title"><a href="{{url('/blog/'.$post->slug)}}">{{$post->title}}</a></h5>
                    <p>Post by <a href="#">Admin</a> <span><i class="fas fa-clock-o"></i> 11/4 /2020</span></p>
                </div>
            </article>
        @endforeach

    </div>
</div>