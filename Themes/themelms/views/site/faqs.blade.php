@extends('layouts.sitelayout')

@section('home_css_scripts')
<link rel="stylesheet" href="{{themes('site/css/faqs/style.css')}}">
@endsection

@section('content')


<div class="main-content">

    <!-- =====Baner Content===== -->
    <section class="inner-header divider layer-overlay overlay-theme-colored-9">
        <div class="container pb-50">
            <!-- Section Content -->
            <div class="section-content text-left">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-theme-colored2 font-46">FAQs
                            {{--@if($display_edit)--}}
                            {{--<a href="{{$edit_url}}" class="btn btn-sm" target="_blank">Edit Page</a>--}}
                            {{--@endif--}}
                        </h2>
                        <ol class="breadcrumb text-left mt-10 white text-left">
                            <li><a href="{{url('/')}}">Home</a></li>
                            {{--<li><a href="#">Pages</a></li>--}}
                            <li class="active">FAQs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =====Baner Content END===== -->

    <!-- =====Title Section===== -->
    <section class="divider  mt-10 mb-0" id="Title">
        <div class="container pt-0 pb-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="call-to-action pb-0 text-center">
                        <h2 class="text-uppercasetext-theme-colored mt-0 mb-0 mt-sm-30">How may we <span
                                class="text-colored2">help you?</span></h2>
                        {{--<h5 class="text-white mb-25">For any other information, or more guidance, please contact our dedicated customer support team who will be happy to assist you further.</h5>--}}
                        {{--<a class="btn btn-default btn-lg mr-10" href="tel:00442081269090">Call Now  0208 126 9090</a>--}}
                        {{--<a class="btn btn-theme-colored btn-lg" href="{{url('/contact-us')}}">Contact us</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =====Title Section END===== -->

    <!-- =====Tab Nav Section===== -->

    <section class="faqs">
        @if ($categories)
        <div class="container pb-50">

            <div class="col-md-12 nav-wrapper">
                <ul class="list-group help-group">
                    <div class="faq-list list-group nav nav-tabs d-none">
                        @php $i=1;@endphp

                        @foreach ($categories as $category)

                        @php
                        $cls='';
                        if ($i==1)
                        $cls = 'active';
                        @endphp
                        <a href="#tab{{$category->id}}" class="list-group-item {{$cls}}" role="tab"
                            data-toggle="tab">{{$category->category}}</a>

                        @php $i++; @endphp
                        @endforeach
                    </div>
                </ul>
            </div>

            <!-- =====Tab Nav Section END===== -->

            <div class="col-md-12">
                <div class="tab-content panels-faq">


                    @php $k=1;@endphp
                    @foreach ($categories as $category)

                    @php
                    $cls='';
                    if ($k==1)
                    $cls = 'active';
                    @endphp

                    <?php $faqs=[];
        
                    $faqs = $category->getFaqs()->where('status', 1)->get(); ?>
                    <div class="tab-pane {{$cls}}" id="tab{{$category->id}}">
                        <div class="panel-group" id="help-accordion-{{$category->id}}">

                            @if ($faqs)

                            @foreach ($faqs as $faq)
                            <div class="panel panel-default panel-help">
                                <a href="#opret-{{$faq->id}}" data-toggle="collapse" data-parent="#help-accordion-1">
                                    <div class="panel-heading">
                                        <h2>{{$faq->question}}</h2>
                                    </div>
                                </a>
                                <div id="opret-{{$faq->id}}" class="collapse">
                                    <div class="panel-body">
                                        <p>{!! $faq->answer !!}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @endif

                        </div>
                    </div>

                    @php $k++; @endphp
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    @else
    <h2 class="text-center">No FAQs Available...</h2>
    @endif
    @stop

    @section('footer_scripts')
    <script>
        $(function () {
            // Since there's no list-group/tab integration in Bootstrap
            $('.list-group-item').on('click', function (e) {
                var previous = $(this).closest(".list-group").children(".active");
                previous.removeClass('active');// previous list-item
                console.log(e.target);
                $(e.target).addClass('active');// activated list-item
            });
        });
    </script>
    @endsection