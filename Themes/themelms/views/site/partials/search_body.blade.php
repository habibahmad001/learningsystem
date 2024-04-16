<ul class="nav nav-tabs new_tbs">

    <li class="{{ (queryString('sort','popular') || queryString('sort','new') || queryString('price','free') || queryString('price','discounted'))?'':'active' }}"><a href="{{url('all-courses')}}" class="courses_tab" >All Courses ({{$all_series->total()}})</a></li>
    <li class="{{ (queryString('price','free'))?'active':'' }}"><a href="{{url('/courses/search?subcats=&levels=&price=free&search_term=all')}}"  class="courses_tab">Free Courses ({{$free_series->total()}})</a></li>
    <li class="{{ (queryString('price','discounted'))?'active':'' }}"><a href="{{url('/courses/search?subcats=&levels=&price=discounted&last_filter=discounted&search_term=all')}}"   class="courses_tab">Discounted Courses ({{$disc_series->total()}})</a></li>
    <li class="{{ (queryString('sort','popular'))?'active':'' }}"><a href="{{url('/courses/search?subcats=&levels=&sort=popular&search_term=all')}}"   class="courses_tab">Popular Courses ({{$popular_series->total()}})</a></li>
    <li class="{{ (queryString('sort','new'))?'active':'' }}"><a href="{{url('/courses/search?subcats=&levels=&sort=new&search_term=all')}}"    class="courses_tab">New Courses ({{count($new_series)}})</a></li>

</ul>
<div class="tab-content clearfix pl-0 pr-0 pb-0">
    <div class="tab-pane active" id="all_tb">
        @if(count($all_series))

            <div class="row">
                @foreach($all_series as $series)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ss w-xxs-50">
                        @include('site.partials.course_widget')

                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="row text-center">
                <div class="col-sm-12">
                    <ul class="pagination cs-pagination mb-0">
                        {{ $all_series->links() }}
                    </ul>
                </div>
            </div>
            <!-- /Pagination -->

        @else
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 class="extr_space">{{getPhrase('no_courses_are_available')}}</h4>
                </div>
            </div>
            <script>

                jQuery(document).ready(function ($) {

                    //FOR ALL CORUSES LEFT COLUMN FILTERS
                    var windowWidth = $(window).width();
                    $('.panel .collapse').removeClass('in');
                    // $('.maincat .collapse').addClass('in');
                });

            </script>
        @endif
    </div>
    <div class="tab-pane" id="free_courses">
        @if($free_series->total())

            <div class="row">
                @foreach($free_series as $series)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ss w-xxs-100">
                        @include('site.partials.course_widget')

                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="row text-center">
                <div class="col-sm-12">
                    <ul class="pagination cs-pagination mb-0">
                        {{ $free_series->links() }}
                    </ul>
                </div>
            </div>
            <!-- /Pagination -->

        @else
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 class="extr_space">{{getPhrase('no_courses_are_available')}}</h4>
                </div>
            </div>
        @endif
    </div>
    <div class="tab-pane" id="disc_courses">
        @if($disc_series->total())

            <div class="row">
                @foreach($disc_series as $series)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ss w-xxs-100">
                        @include('site.partials.course_widget')

                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="row text-center">
                <div class="col-sm-12">
                    <ul class="pagination cs-pagination mb-0">
                        {{ $disc_series->links() }}
                    </ul>
                </div>
            </div>
            <!-- /Pagination -->

        @else
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 class="extr_space">{{getPhrase('no_courses_are_available')}}</h4>
                </div>
            </div>
        @endif
    </div>
    <div class="tab-pane" id="popular_courses">
        @if($popular_series->total())

            <div class="row">
                @foreach($popular_series as $series)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ss w-xxs-100">
                        @include('site.partials.course_widget')

                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="row text-center">
                <div class="col-sm-12">
                    <ul class="pagination cs-pagination mb-0">
                        {{ $popular_series->links() }}
                    </ul>
                </div>
            </div>
            <!-- /Pagination -->

        @else
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 class="extr_space">{{getPhrase('no_courses_are_available')}}</h4>
                </div>
            </div>
        @endif
    </div>
    <div class="tab-pane" id="new_courses">
        @if(count($new_series))

            <div class="row">
                @foreach($new_series as $series)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ss w-xxs-100">
                        @include('site.partials.course_widget')

                    </div>
                @endforeach
            </div>


        @else
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4 class="extr_space">{{getPhrase('no_courses_are_available')}}</h4>
                </div>
            </div>
        @endif
    </div>
</div>