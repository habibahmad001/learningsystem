@extends('layouts.sitelayout')

@section('content')

    <?php

    $current_theme = getDefaultTheme();
    // dd($current_theme);
    $page_content  = getThemeSetting($key,$current_theme);
 //dd($page_content);
    ?>
    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider layer-overlay overlay-theme-colored-9"  data-bg-img="<?=url('/images/bgx.jpg')?>">
            <div class="container pt-140 pb-140">
                <!-- Section Content -->
                <div class="section-content text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-theme-colored2 font-46">{{ ucfirst($title) }}
                                @if($display_edit)
                                    {{--<a href="{{$edit_url}}" class="btn btn-sm" target="_blank">Edit Page</a>--}}
                                @endif</h2>
                            <ol class="breadcrumb text-left mt-10 white text-left">
                                <li><a href="{{url('/')}}">Home</a></li>
                                {{--<li><a href="#">Pages</a></li>--}}
                                <li class="active">{{ ucfirst($title) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section About -->
        <section>
            <div class="container">
                <div class="section-content">


                            {!! $page_content !!}



                </div>
            </div>
        </section>

        <!-- Section mission -->
        {{--<section>
            <div class="container pt-20">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-6">
                            <img class="img-fullwidth hidden-md" src="http://placehold.it/560x370" alt="">
                            <img class="img-fullwidth hidden-xs hidden-sm hidden-lg" src="http://placehold.it/420x345" alt="">
                        </div>
                        <div class="col-md-6">
                            <h2 class="text-uppercasetext-theme-colored mt-0 mt-sm-30">Our <span class="text-theme-colored2">Misson</span></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis omnis, repellendus ipsa aperiam, laudantium voluptatum nulla?.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ipsum voluptate numquam, iure odio commodi rerum quasi distinctio qui eligendi similique eius consequatur modi! Voluptas quam consequatur, debitis recusandae facilis, autem in! Enim laudantium rem, placeat odit esse numquam facere ut. Quae, minus dolorum corrupti!</p>
                            <a href="#" class="btn btn-colored btn-theme-colored2 text-white btn-lg pl-40 pr-40 mt-15">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>--}}

        <!-- Divider: Funfact -->
        <section style="display: none" class="layer-overlay overlay-theme-colored-9 parallax" data-bg-img="http://placehold.it/1920x1280">
            <div class="container pt-80 pb-90 pt-md-70 pb-md-50 pb-sm-50">
                <div class="row mt-30 text-center">
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-smile mb-20 text-white"></i>
                            <h2 data-animation-duration="2000" data-value="754" class="animate-number text-theme-colored2 font-42 font-weight-600 mt-0 mb-15">0</h2>
                            <h5 class="text-white text-uppercase">Happy Clients</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-notebook mb-20 text-white"></i>
                            <h2 data-animation-duration="2000" data-value="675" class="animate-number text-theme-colored2 font-42 font-weight-600 mt-0 mb-15">0</h2>
                            <h5 class="text-white text-uppercase">Years of Experience</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-users mb-20 text-white"></i>
                            <h2 data-animation-duration="2000" data-value="675" class="animate-number text-theme-colored2 font-42 font-weight-600 mt-0 mb-15">0</h2>
                            <h5 class="text-white text-uppercase">Cases completed</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                        <div class="funfact">
                            <i class="pe-7s-study mb-20 text-white"></i>
                            <h2 data-animation-duration="2000" data-value="1248" class="animate-number text-theme-colored2 font-42 font-weight-600 mt-0 mb-15">0</h2>
                            <h5 class="text-white text-uppercase">Awards winning</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
    <!-- end main-content -->


@stop