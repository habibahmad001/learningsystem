<div class="main_cateTitle">
    <h3>{{$title}}</h3>
    <ul class="subcats breadcrumb" data-overflow="right">
    @if(count($lms_cates))
        <!--<h4>{{getPhrase($title.' Categories')}}</h4>-->
            @foreach($lms_cates as $category)
                <li>
                    <a class="" href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$category->slug}}">
                        <div class="" id={{$category->slug}}>{{$category->category}}</div> <span>(0)</span>
                    </a>
                </li>
            @endforeach
        @else
            {{--<h4>{{getPhrase('no_categories_are_available')}}</h4>--}}
        @endif
    </ul>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>


<div class="div-content section-content clearfix pt-10 pl-0 pr-0">

    @if(count($all_series))

        <div class="row">
            @foreach($all_series as $series)
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ss w-xxs-100">
                    @include('site.partials.course_widget')

                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-sm-12">
                <ul class="pagination cs-pagination ">
                    {{ $all_series->links() }}
                </ul>
            </div>
        </div>
        <!-- /Pagination -->

    @else
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>{{getPhrase('no_courses_are_available')}}</h4>
            </div>
        </div>
    @endif


</div>