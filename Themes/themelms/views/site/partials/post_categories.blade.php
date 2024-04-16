<div class="widget" >
    <h5 class="widget-title">Categories</h5>
    <div class="categories">
        <ul class="list list-border angle-double-right">
            @foreach($categories as $category)
                <li><a href="{{url('/blogs/'.$category->slug)}}">{{$category->category}}<span> ({{$category->getPosts->count()}})</span></a></li>
            @endforeach

        </ul>
    </div>
</div>