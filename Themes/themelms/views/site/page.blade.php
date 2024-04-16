@extends('layouts.sitelayout')

@section('content')
    <?php

    $current_theme = getDefaultTheme();

    ?>
 <!-- Page Banner -->
 <div class="main-content">
 <section class="inner-header divider layer-overlay overlay-theme-colored-9"  data-bg-img="<?=url('/images/bgx.jpg')?>">
     <div class="container pt-140 pb-50">
         <!-- Section Content -->
         <div class="section-content text-left">
             <div class="row">
                 <div class="col-md-12">
                     <h2 class="text-theme-colored2 font-46">{{ ucfirst($title) }}
                         {{--@if($display_edit)--}}
                             {{--<a href="{{$edit_url}}" class="btn btn-sm" target="_blank">Edit Page</a>--}}
                         {{--@endif--}}
                     </h2>
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
    <!-- /Page Banner -->
     {!! $page->content !!}
</div>
@stop