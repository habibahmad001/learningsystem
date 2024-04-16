@extends('layouts.sitelayout')

@section('content')

    <!-- Start main-content -->
    <div class="main-content" ng-click='containerClicked();'>
        <!-- Section: home -->

        <section id="home" class="all__coursesHeader overlay-dark-6" style="background-image: url('<?=UPLOADS?>images/all_courses.jpg'); "  >
            <div class="container-fluid pt-80 pb-80 pt-xs-50 pb-xs-50 position-relative text-center  ">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <a href="javascript:void(0);">
                        <img src="<?=UPLOADS?>images/80.png" />
                    </a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"></div>
            </div>
        </section>






    <!-- new page style  -->
    <section class="newCategories__style">
        <span id="loading" style="display: none;"  class="loader col-md-12 pt-30 pb-30 text-center">
            <img class="lazy" id="loading-image" src="<?=UPLOADS.'images/ajax-loader.gif'?>" height="90" title="working..." />
        </span>

        <div class="container">
            <div class="row filter_vewArea">
                <div class="col-lg-3 col-md-4">


                    @include('site.partials.search_sidebar')
                </div>
                <div class="col-lg-9 col-md-8">

                    @include('site.partials.featured_carousel')

                    @include('site.partials.search_body')

                    @include('site.partials.reviews_section')

                    @include('site.partials.top_companies')

                </div>
            </div>
        </div>
    </section>

    </div>
    <!-- end main-content -->

@stop

@section('footer_scripts')


    <script type="text/javascript">
        /*var path = "{{ route('autocomplete') }}";
     $('input.typeahead').typeahead({
         source:  function (query, process) {
             return $.get(path, { query: query }, function (data) {
                 return process(data);
             });
         }
     });*/

        $(".cs-nav-pills li").first().addClass("active");
        $(".lms-cats li").first().addClass("active");

    </script>


@stop
