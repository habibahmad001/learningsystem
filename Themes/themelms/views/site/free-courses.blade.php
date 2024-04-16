@extends('layouts.sitelayout')

@section('content')


    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider layer-overlay overlay-theme-colored-7">
            <div class="container pt-60 pb-60">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-theme-colored2 font-36">{{$title}} </h2>
                            <ol class="breadcrumb text-left mt-10 white">
                                <li><a href="<?=url('/')?>">Home</a></li>
                                <li><a href="{{url('/all-courses')}}">Categories</a></li>
                                @if($ptitle)
                                    <li><a href="{{url('/courses/'.$plink)}}">{{$ptitle}}</a></li>
                                @endif
                                <li class="active">{{$title}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Courses -->
        <section id="courses" class="bg-silver-light"  >
            <div class="container">
                <div class="row">
                    <div class="col-md-12 subcats">
                        <!-- Icon List  -->
                        @if(count($lms_cates))
                        <!--<h4>{{getPhrase($title.' Categories')}}</h4>-->
                        <div class="row">
                            @foreach($lms_cates as $category)
                                <a class="col-lg-3 col-md-4 col-sm-6 col-xs-6 w-xxs-100" href="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$category->slug}}">
                                    <div class="catboxes" id={{$category->slug}}>{{$category->category}}</div>
                                </a>
                            @endforeach
                        </div>
                        @else

{{--                            <h4>{{getPhrase('no_categories_are_available')}}</h4>--}}

                    @endif


                    <!-- /Icon List  -->
                    </div>
                </div>
                @if(count($all_series))
                <div class="section-content">
                    <div class="row">
                        @foreach($all_series as $series)
                            <div class="col-lg-15 col-md-3 col-sm-4 col-xs-6 ss w-xxs-100">
                                @include('site.partials.course_widget')
                            </div>

                        @endforeach

                    </div>
                    <!-- Pagination -->

                    <div class="row text-center">
                        <div class="col-sm-12">
                            <ul class="pagination cs-pagination mb-0 ">
                                 
                            </ul>
                        </div>
                    </div>
                    <!-- /Pagination -->

                </div>
                @else
                    <div class="section-content">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4>{{getPhrase('no_courses_are_available')}}</h4>
                            </div>
                        </div>
                    </div>


                @endif
            </div>
        </section>
        <section class="pt-50 pb-50 business__associates">
            <div class="container pt-0 pb-0 text-center">
                <div class="reviews__section pt-40">
                    <script src="https://widget.reviews.co.uk/rich-snippet-reviews-widgets/dist.js"></script>
                    <div id="carousel-inline-widget-1210" style="width:100%;margin:0 auto;"></div>
                    <script>
                        richSnippetReviewsWidgets('carousel-inline-widget-1210', {
                            store: 'nextlearnacademy.com',
                            widgetName: 'carousel-inline',
                            primaryClr: '#f47e27',
                            neutralClr: '#f4f4f4',
                            reviewTextClr:'#2f2f2f',
                            ratingTextClr:'#2f2f2f',
                            layout:'fullWidth',
                            numReviews: 21
                        });
                    </script>
                </div>
            </div>
        </section>
        <section class="pt-50 pb-50 business__associates">
            <div class="container pt-0 pb-0 text-center">
                <div class="section-title">
                    <h2 class="title text-uppercase">Top Business Associates choose Next Learn Academy</h2>
                </div>

                <div class="adv-companies">
                    <img src="<?=UPLOADS?>images/logo-businss/1salesforce-h.png" alt="" style="height:38px;">
                    <img src="<?=UPLOADS?>images/logo-businss/2ring central-h.png" alt="">
                    <img src="<?=UPLOADS?>images/logo-businss/3amazon-h.png" alt="">
                    <img src="<?=UPLOADS?>images/logo-businss/4cloudiq-h.png" alt="">
                    <img src="<?=UPLOADS?>images/logo-businss/5vertiv-h.png" alt="">
                    <img src="<?=UPLOADS?>images/logo-businss/6royalmail-h.png" alt="">
                </div>
            </div>
        </section>

    </div>
    <!-- end main-content -->






@stop

@section('footer_scripts')
<script>
	var my_slug  = "{{$lms_cat_slug}}";

	if(!my_slug){

        $(".cs-icon-list li").first().addClass("active");
    }
    else{

    	$("#"+my_slug).addClass("active");
    }




</script>



@stop
