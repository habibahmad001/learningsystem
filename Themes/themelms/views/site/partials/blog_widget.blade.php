<article class="post blog_postColmn mb-30">
        <div class="post-thumb">
            @if($post->image)
                <a href="{{url('/blog/'.$post->slug)}}"><img src="{{ getBlogImgPath($post->image) }}" alt="{{$post->title}}" class="img-responsive"></a>
            @else
                <img src="https://picsum.photos/370/245/?random" class="img-responsive" alt="{{$post->title}}">
            @endif


        </div>
        <div class="post-description">
            <a href="{{url('/blog/'.$post->slug)}}"><h3 class="post-title">@if (strlen($post->title)>50) {{substr($post->title,0,50).'...'}}@else {{$post->title}} @endif</h3></a>
            <div class="post-meta">
                <span>  {{date('d/m/Y',strtotime($post->created_at))}}</span> <a href="javascript:void(0);">{{$post->category->category}}</a>
            </div>
            <div class="infodec">{!! strip_tags($post->description) !!}</div>
        </div>
        <div class="post-meta bottom__meta">

            <a href="{{url('/blog/'.$post->slug)}}" class="">Read More</a>
        </div>
    </article>
