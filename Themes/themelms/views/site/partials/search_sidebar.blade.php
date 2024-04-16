<input type="hidden" id="search_term" name="search_term" value="">
<input type="hidden" id="last_filter" name="last_filter" value="">
<input type="hidden" id="sort" name="sort" value="{{(queryString('sort','popular'))?'popular':''}}">
@if($all_series->total()<6)
<script>

    jQuery(document).ready(function ($) {

        //FOR ALL CORUSES LEFT COLUMN FILTERS
        var windowWidth = $(window).width();
            $('.panel .collapse').removeClass('in');
            $('.maincat .collapse').addClass('in');
    });

</script>
@endif
<div class="panel-group" id="filter-accordion-7">
    <div class="panel panel-default maincat">
        <a href="#maincategory" data-toggle="collapse" data-parent="#filter-accordion-1" class="active">
            <div class="panel-heading"><h2>Main Categories<i class="fa fa-angle-down"></i></h2></div>
        </a>
        <div id="maincategory" class="collapse in">
            <div class="panel-body pb-0 post_wrap">

                @foreach ($menu_categories as $category)
                    @php
                      //  dd($category->childern);
                      // echo count($category->products);
                       //$maincats= \App\LmsSeries::where('lms_parent_category_id', $category->id)
                         //      ->where('status', 1)
                           //    ->get();
                        //dd($maincats);
                    @endphp
                    @if($category->slug!='other')
                        <div class="form-check">
                            <input class="form-check-input" onchange="browsData('{{$category->slug}}')" {{urlHasString($category->slug)?'checked':''}} data-url="{{URL_VIEW_ALL_LMS_CATEGORIES.'/'.$category->slug}}" type="radio" name="main-filter" id="{{$category->slug}}" value="{{$category->slug}}">
                            <label class="form-check-label" for="{{$category->slug}}">{{$category->category}} <small>({{count($category->products)}})</small></label>
                        </div>

                    @endif
                @endforeach
                    @php
                        $maincats= \App\LmsSeries::where('lms_parent_category_id', 43)
                                ->where('status', 1)
                                ->get();
                    @endphp
                <div class="form-check">
                    <input class="form-check-input"  onchange="browsData('other')" {{urlHasString('other')?'checked':''}}   type="radio" name="main-filter" id="mainCate2" value="option2">
                    <label class="form-check-label" for="mainCate2">Others <small>({{count($maincats)}})</small></label>
                </div>
                <span class="message more-times"></span>
            </div>
        </div>
    </div>

    @if(!urlHasString('all-courses') && !urlHasString('courses/search'))
        <?php
        $subcat= $menu_categories->where('slug', $plink)->first();
        $filteredcat= \App\LmsCategory::select(['category','icon','image','id','slug'])->with('products2')->where('parent_id', '=', $subcat->id)->orderBy('category','ASC')->get();
        ?>
    <div class="panel panel-default">
        <a href="#subcategory" data-toggle="collapse" data-parent="#filter-accordion-1" class="active">
            <div class="panel-heading">
                <h2>Sub Categories <i class="fa fa-angle-down"></i></h2>
                <small>{{$subcat->category}}</small>
            </div>
        </a>
        <div id="subcategory" class="collapse in">
            <div class="panel-body pb-0 post_wrap">
            @if($filteredcat->count()>0)
                    @foreach ($filteredcat as $subcat)
                         <div class="form-check"  >
                            <input class="form-check-input" name="subcategory" {{ (queryString('subcats',$subcat->id))?'checked':'' }}  onchange="browsData('{{$plink}}')" type="checkbox" value="{{$subcat->id}}" id="{{$subcat->slug}}">
                            <label class="form-check-label" for="{{$subcat->slug}}">{{$subcat->category}} <small>({{count($subcat->products2)}})</small></label>
                        </div>
                    @endforeach
                        <span class="message"></span>
                @endif

            </div>

        </div>
    </div>
@endif

    <div class="panel panel-default">
        <a href="#ratings_filter" data-toggle="collapse" data-parent="#filter-accordion-1" class="active">
            <div class="panel-heading"><h2>Ratings <i class="fa fa-angle-down"></i></h2></div>
        </a>
        <div id="ratings_filter" class="collapse in">
            <div class="panel-body">
                <div class="form-check">
                    <?php
                    $four55= $count_series->all();
                    $ids="";
                    foreach ($four55 as $crs){
                        $ids.=$crs->id.",";
                    }
                    $ids=rtrim($ids, ",");

                    $idsArr = explode(',',$ids);
//                    if(env('APP_CACHE')){
//                        if(Cache::has('four5')){
//                            $four5=Cache::get( 'four5' );
//                        }else{
//                            $four5=App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
//                                ->having(DB::raw('AVG(rating)'), '>=', 4.5)->get()->toArray();
//                            Cache::put('four5', $four5, 30);
//                        }
//
//                        $four = Cache::rememberForever('four', function ($idsArr) {
//                            return App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
//                                ->having(DB::raw('AVG(rating)'), '>=', 4)
//                                ->having(DB::raw('AVG(rating)'), '<', 4.5)
//                                ->get()->toArray();
//                        });
//                        $three5 = Cache::rememberForever('three5', function ($idsArr) {
//                            return App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
//                                ->having(DB::raw('AVG(rating)'), '>=', 3.5)
//                                ->having(DB::raw('AVG(rating)'), '<', 4)
//                                ->get()->toArray();
//                        });
//                        $three = Cache::rememberForever('four5', function ($idsArr) {
//                            return App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
//                                ->having(DB::raw('AVG(rating)'), '>', 2.9)
//                                ->having(DB::raw('AVG(rating)'), '<', 3.5)
//                                ->get()->toArray();
//                        });
//                    }else{
                        if(Cache::has('four5')){
                            $four5=Cache::get( 'four5' );
                        }else{
                            $four5=App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
                                ->having(DB::raw('AVG(rating)'), '>=', 4.5)->get()->toArray();
                            Cache::put('four5', $four5, 30);
                        }

//
//                        $four5=App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
//                            ->having(DB::raw('AVG(rating)'), '>=', 4.5)->get()->toArray();

                    if(Cache::has('four')){
                        $four=Cache::get( 'four' );
                    }else{
                        $four=App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
                            ->having(DB::raw('AVG(rating)'), '>=', 4)
                            ->having(DB::raw('AVG(rating)'), '<', 4.5)
                            ->get()->toArray();
                        Cache::put('four', $four5, 30);
                    }

                    if(Cache::has('three5')){
                        $three5=Cache::get( 'three5' );
                    }else{
                        $three5=App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
                            ->having(DB::raw('AVG(rating)'), '>=', 3.5)
                            ->having(DB::raw('AVG(rating)'), '<', 4)
                            ->get()->toArray();
                        Cache::put('three5', $three5, 30);
                    }

                    if(Cache::has('three')){
                        $three=Cache::get( 'three' );
                    }else{
                        $three=App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
                            ->having(DB::raw('AVG(rating)'), '>=', 4)
                            ->having(DB::raw('AVG(rating)'), '<', 4.5)
                            ->get()->toArray();
                        Cache::put('three', $three, 30);
                    }
//
//                        $four=App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
//                            ->having(DB::raw('AVG(rating)'), '>=', 4)
//                            ->having(DB::raw('AVG(rating)'), '<', 4.5)
//                            ->get()->toArray();
//
//                        $three5=App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
//                            ->having(DB::raw('AVG(rating)'), '>=', 3.5)
//                            ->having(DB::raw('AVG(rating)'), '<', 4)
//                            ->get()->toArray();
//
//                        $three=App\Review::select('course_id')->whereIn('course_id', $idsArr)->groupBy('course_id')
//                            ->having(DB::raw('AVG(rating)'), '>', 2.9)
//                            ->having(DB::raw('AVG(rating)'), '<', 3.5)
//                            ->get()->toArray();


                   // }


                    ?>
                    <input class="form-check-input" type="radio" name="rating" id="rating5" {{ (queryString('rating','4.5'))?'checked':'' }}  onchange="browsData('{{$plink}}')" value="4.5">
                    <label class="form-check-label" for="rating5">
                        <div class="rating">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star-half-alt filled"></i>
                        </div>
                        4.5 & up <small>({{count($four5)}})</small>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rating" id="rating4" {{ (queryString('rating','4'))?'checked':'' }}  onchange="browsData('{{$plink}}')" value="4">
                    <label class="form-check-label" for="rating4">
                        <div class="rating">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star empty"></i>
                        </div>
                        4 & up <small>({{count($four)}})</small>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rating" id="rating3" {{ (queryString('rating','3.5'))?'checked':'' }}  onchange="browsData('{{$plink}}')" value="3.5">
                    <label class="form-check-label" for="rating3">
                        <div class="rating">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star-half-alt filled"></i>
                            <i class="fas fa-star empty"></i>
                        </div>
                        3.5 & up <small>({{count($three5)}})</small>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rating" id="rating2" {{ (queryString('rating','3'))?'checked':'' }}  onchange="browsData('{{$plink}}')" value="3">
                    <label class="form-check-label" for="rating2">
                        <div class="rating">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star empty"></i>
                            <i class="fas fa-star empty"></i>
                        </div>
                        3 & up <small>({{count($three)}})</small>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <a href="#level" data-toggle="collapse" data-parent="#filter-accordion-1" class="active">
            <div class="panel-heading"><h2>Level <i class="fa fa-angle-down"></i></h2></div>
        </a>
        <div id="level" class="collapse in">
            <div class="panel-body post_wrap">
                <?php
                $lcounts=0;
                $levels      = \App\LmsLevel::with('courses')->select(['name','id','slug','count'])->orderBy('name','ASC')->get();

               // dd($levels);
                ?>
                    @foreach ($levels as $level)

                    <?php
                  $lcounts= $count_series->where('level_id', $level->id)->all();
                if(count($level->courses)>0){

                ?>
                        <div class="form-check">
                    <input class="form-check-input" name="levels" {{ (queryString('levels',$level->id))?'checked':'' }}  onchange="browsData('{{$plink}}')" type="checkbox" value="{{$level->id}}" id="{{$level->slug}}">
                    <label class="form-check-label" for="{{$level->slug}}">{{$level->name}} <small>({{count($lcounts)}})</small></label>
                </div>
                        <?php  } ?>
                    @endforeach
                    <span class="message"></span>

            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <a href="#price_courses" data-toggle="collapse" data-parent="#filter-accordion-1" class="active">
            <div class="panel-heading"><h2>Price <i class="fa fa-angle-down"></i></h2></div>
        </a>
        <div id="price_courses" class="collapse in">
            <div class="panel-body">
                <?php
                $paid= $count_series->where('is_paid', '1')->all();
                $free= $count_series->where('is_paid', '0')->all();
                $discounted= $count_series->where('is_paid','>', '1')->all();

                $c_videos= $count_series->where('course_tags', 'LIKE', "videos")->all();
                $c_texts= $count_series->where('course_tags','like', 'texts')->all();
                $c_both= $count_series->where('course_tags','like', 'both_videos_and_texts')->all();
                ?>
               {{-- <div class="form-check">
                    <input class="form-check-input" type="checkbox"  {{ (queryString('levels',$level->id))?'checked':'' }}  onchange="browsData('{{$plink}}')"  value="" id="all">
                    <label class="form-check-label" for="all">All <small>({{count($all_series)}})</small></label>
                </div>--}}
                <div class="form-check">
                    <input class="form-check-input" name="price" type="checkbox" value="1" {{ (queryString('price',1))?'checked':'' }}  onchange="browsData('{{$plink}}')"  id="paid">
                    <label class="form-check-label" for="paid">Paid <small>({{count($paid)}})</small></label>
                </div>



                <div class="form-check">
                    <input class="form-check-input" name="price" type="checkbox" value="discounted" {{ (queryString('price','discounted'))?'checked':'' }}  onchange="browsData('{{$plink}}')"  id="discounted">
                    <label class="form-check-label" for="discounted">Discounted <small>({{count($discounted)}})</small></label>
                </div>
                    <div class="form-check">
                        <input class="form-check-input" name="price" type="checkbox" value="free" {{ (queryString('price','free'))?'checked':'' }}  onchange="browsData('{{$plink}}')"  id="free">
                        <label class="form-check-label" for="free">Free <small>({{count($free)}})</small></label>
                    </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <a href="#materials_filter" data-toggle="collapse" data-parent="#filter-accordion-1" class="active">
            <div class="panel-heading"><h2>Materials <i class="fa fa-angle-down"></i></h2></div>
        </a>
        <div id="materials_filter" class="collapse in">
            <div class="panel-body">
                <div class="form-check">
                    <input class="form-check-input" name="materials" type="checkbox" value="videos" {{ (queryString('materials','videos'))?'checked':'' }}  onchange="browsData('{{$plink}}')" id="videos">
                    <label class="form-check-label" for="videos">Video <small>({{count($c_videos)}})</small></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="materials" type="checkbox" value="texts" {{ (queryString('materials','texts'))?'checked':'' }}  onchange="browsData('{{$plink}}')" id="texts">
                    <label class="form-check-label" for="texts">Texts <small>({{count($c_texts)}})</small></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="materials" type="checkbox" value="both_videos_and_texts" {{ (queryString('materials','both_videos_and_texts'))?'checked':'' }}  onchange="browsData('{{$plink}}')" id="both_videos_texts">
                    <label class="form-check-label" for="both_videos_texts">Both Videos & Texts <small>({{count($c_both)}})</small></label>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <a href="#learning-hours" data-toggle="collapse" data-parent="#filter-accordion-1" class="active">
            <div class="panel-heading"><h2>Video Duration <i class="fa fa-angle-down"></i></h2></div>
        </a>
        <?php
        /*$duration='0-3';
        $arr=explode('-',$duration);
        $start=(int)$arr[0]*60;
        $end=(int)$arr[1]*60;

         //dd($idsArr);
        $vd0_3 = DB::table('lmscontents')
            ->join('lmsseries_data', 'lmscontents.id', '=', 'lmsseries_data.lmscontent_id')
            ->select('lmsseries_data.lmsseries_id as lmsid')
            ->whereIn('lmsseries_data.lmsseries_id', $idsArr)
            ->groupBy('lmsseries_data.lmsseries_id')
            ->having(DB::raw('SUM(lmscontents.video_length)'), '>', $start )
            ->having(DB::raw('SUM(lmscontents.video_length)'), '<=', $end)
            ->get()
             ->toArray();*/
        /*$ids="";
        dd($vid_duration);
        foreach ($vid_duration as $crs){
            $ids.=$crs->lmsid.",";
        }
        $ids=rtrim($ids, ",");

        $idsArr2 = explode(',',$ids);
        $vid_duration2= $count_series->whereIn('id', $idsArr2)->all();
         dd($vid_duration2)*/
        ?>
        <div id="learning-hours" class="collapse in">
            <div class="panel-body">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="duration" value="0-3" {{ (queryString('duration','0-3'))?'checked':'' }}  onchange="browsData('{{$plink}}')" id="learningHours1">
                    <label class="form-check-label" for="learningHours1">0-3 Hours <small>({{count(countDuration('0-3',$idsArr))}})</small></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="duration" value="3-6" {{ (queryString('duration','3-6'))?'checked':'' }}  onchange="browsData('{{$plink}}')" id="learningHours2">
                    <label class="form-check-label" for="learningHours2">3-6 Hours <small>({{count(countDuration('3-6',$idsArr))}})</small></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="duration" value="6-16" {{ (queryString('duration','6-16'))?'checked':'' }}  onchange="browsData('{{$plink}}')" id="learningHours3">
                    <label class="form-check-label" for="learningHours3">6-16 Hours <small>({{count(countDuration('6-16',$idsArr))}})</small></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="duration" value="16-500" {{ (queryString('duration','16-500'))?'checked':'' }}  onchange="browsData('{{$plink}}')" id="learningHours4">
                    <label class="form-check-label" for="learningHours4">16+ Hours <small>({{count(countDuration('16-100',$idsArr))}})</small></label>
                </div>
            </div>
        </div>
    </div>



</div>

<style>
    .message{
        position: relative;
        cursor: pointer;
    }
</style>

<script>

    $(document).ready(function() {
        var main_filter_value="";

        $ShowHideMore = $('.post_wrap');
        $ShowHideMore.each(function () {
            //console.log($('input[name="main-filter"]'));
            $.each($(".post_wrap input[name='main-filter']:checked"), function(){
                console.log($(this).val());
                main_filter_value=$(this).val();
            });
            var $times = $(this).children('.form-check');
            if(window.location.href.indexOf(main_filter_value) > -1 && $times.length < 5) {
                 $(this).find('span.message').hide();
                 $ShowHideMore.children(':nth-of-type(n+5)').addClass('moreShown').show();
             }else{


                if ($times.length > 5) {
                    $ShowHideMore.children(':nth-of-type(n+5)').addClass('moreShown').hide();
                    $(this).find('span.message').addClass('more-times').html('+ Show more <i class="far fa-angle-down"></i>');
                } else {
                    $(this).find('span.message').removeClass('more-times')
                }


            }
            if(window.location.href.indexOf(main_filter_value) > -1  && $times.length > 5) {
                $(this).find('span.message').hide();
                $ShowHideMore.children(':nth-of-type(n+5)').addClass('moreShown').show();
            }
            if(window.location.href.indexOf("all-courses") > -1) {
                $(this).find('span.message').show();
                $ShowHideMore.children(':nth-of-type(n+5)').addClass('moreShown').hide();
            }

            //main_filter_value="";
        });
        $(document).on('click', '.post_wrap > span', function () {
            var that = $(this);
            var thisParent = that.closest('.post_wrap');
            if (that.hasClass('more-times')) {
                thisParent.find('.moreShown').show();
                that.addClass('less-times');
                that.removeClass('more-times');
                that.html('- Show less <i class="far fa-angle-up"></i>');
            } else {
                thisParent.find('.moreShown').hide();
                that.addClass('more-times');
                that.removeClass('less-times');
                that.html('+ Show more <i class="far fa-angle-down"></i>');
            }
        });
    });
</script>