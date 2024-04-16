@extends('layouts.sitelayout')
@section('content')
    <div class="main-content inner_pages">
        <section class="inner__header promotionExcel_Banner" style="background-image:url('<?=UPLOADS.'images/landingpages/excel-Banner.jpg'?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-xs-9 col-12">
                        <h3>Microsoft Excel 2016 - <span style="color: rgb(81, 172, 55);">FREE!</span></h3>
                        <p>Stay updated with the newest features of Microsoft Excel 2016. Explore the 2016 interface, learn to format paragraphs, edit documents, work with long documents and become skilled at functions and formulas.</p>
                        <h6><img src="<?=UPLOADS.'images/landingpages/assessments _icon.png'?>"> Assessments included *</h6>
                    </div>
                </div>
            </div>
        </section>

        <section class="promoExcel_inner">
            <div class="container">
                <h4>Why choose Next Learn Academy?</h4>
                <div class="row row-md-padding">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
                        <a href="#" class="whyChoose_box">
                            <figure><img src="<?=UPLOADS.'images/landingpages/choose_1.jpg'?>"></figure>
                            <h3>Affordable</h3>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
                        <a href="#" class="whyChoose_box">
                            <figure><img src="<?=UPLOADS.'images/landingpages/choose_2.jpg'?>"></figure>
                            <h3>Convenient</h3>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
                        <a href="#" class="whyChoose_box">
                            <figure><img src="<?=UPLOADS.'images/landingpages/choose_3.jpg'?>"></figure>
                            <h3>Online Learning</h3>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
                        <a href="#" class="whyChoose_box">
                            <figure><img src="<?=UPLOADS.'images/landingpages/choose_4.jpg'?>"></figure>
                            <h3>High Quality Study Material</h3>
                        </a>
                    </div>
                    <div class="col-md-12 text-center d-none"><a href="#" class="btn btn-primary">Learn more</a></div>
                </div>
            </div>
        </section>

        <section class="promoExcel_course" style="background-color:#F3F8F9;">
            <div class="container">
                <div  class="row row-md-padding d-flex">
                    @foreach($series_excel as $series)
                        <div class="col-lg-15 col-md-4 col-sm-6 col-xs-6 ss w-xxs-50 col-auto">
                            @include('site.partials.course_widget')
                        </div>
                    @endforeach
                    {{--<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 w-xxs-50">
                        <div class="dummyCoure_box course-box newCourse"></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 w-xxs-50">
                        <div class="dummyCoure_box course-box newCourse"></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 w-xxs-50">
                        <div class="dummyCoure_box course-box newCourse"></div>
                    </div>--}}
                </div>
            </div>
        </section>


        <section class="promoExcel_signUp">
            <div class="container">
                <div class="signUp_banner" style="background-image:url('<?=UPLOADS.'images/landingpages/promoExcel_signUp.jpg'?>') ">
                    <div class="right">
                        <p>Enrolling has never been Easier! ALL you’ve got to do is Sign up to follow this valuable FREE Course!</p>
                        <a href="{{url('/register')}}" class="btn btn-primary">Sign up</a>
                    </div>
                </div>
            </div>
        </section>


    </div>
@stop
@section('footer_scripts')
    <script>

    </script>
@stop