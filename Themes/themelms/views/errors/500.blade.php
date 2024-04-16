@extends('layouts.sitelayout')
<style>

</style>
@section('content')
    <div class="main-content inner_pages">
        <section class="corporate_section" style="background-image:url('<?=UPLOADS.'images/404.jpg'?>');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-8 col-xs-9 col-12">
                        {{--<h3>A Whole Bunch of Amazing benefits for your Student Card</h3>--}}
                        <h3>500 Server Error</h3>
                        {{--<p>We offer all our learners a Student ID card that offers amazing savings across the UK.</p>--}}
                        <p>your request page is producing server error, contact with technical support </p>
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