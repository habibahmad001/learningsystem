@extends('layouts.sitelayout')
<style>
    .error_404{padding-top:90px;}
    .error_404 figure {
        width: 100%;
        height: 300px;
        background-repeat: no-repeat;
        background-position: -523px 0;
        background-size: cover;
    }
    .error_404 h3 {
        font-size:42px;
        font-weight:800; padding-top:70px;
    }
    .error_404 p {
        font-size:16px;
    }
    .error_404 .btn {
        margin-top:15px;
    }

    @media screen and (min-width:320px) and (max-width:768px) {
        .error_404{padding-top:70px;}
        .error_404 figure {background-position: -440px 0;}
        .error_404 h3 {padding-top: 10px;}
        .error_404 p {font-size: 15px;text-align: center;}
    }
    @media screen and (min-width:320px) and (max-width:425px) {
        .error_404{padding-top:60px;}
        .error_404 figure {background-position: 64%;}
    }
    @media screen and (min-width:320px) and (max-width:425px) {
        .error_404{padding-top:60px;}
        .error_404 figure{background-position: 64%;}
        .error_404 h3 {font-size:38px;padding-top:0;}
    }

</style>
@section('content')
    <div class="main-content inner_pages">

        <section class="error_404">
            <div class="container">
                <div class="row">
                    <div class="col-xl-1 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12"></div>
                    <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                        <figure style="background-image:url('<?=UPLOADS.'images/404.jpg'?>')"></figure>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 text-center">
                        {{--<h3>A Whole Bunch of Amazing benefits for your Student Card</h3>--}}
                        <h3>404 Page Not Found </h3>
                        {{--<p>We offer all our learners a Student ID card that offers amazing savings across the UK.</p>--}}
                        <p>your request page is missing or you tried invalid URL</p>
                        <a href="{{url('/all-courses')}}" class="btn btn-primary">Browse Courses</a>
                    </div>
                </div>
            </div>
        </section>



        <section class="pt-60 pb-60" id="card-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">



                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"></div>
                </div>
            </div>

        </section>



</div>

@stop
@section('footer_scripts')

@endsection