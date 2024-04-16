<?php

/**
 * Flash Helper
 * @param  string|null  $title
 * @param  string|null  $text
 * @return void
 */
function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}

function checkSpam($string){
        $array  = array('tinyurl', 'exolferala', '????????????',' ? ? ? ? ','anteseeHep', 'AvatoDet','.de','.space','mailinator','.pl' ,'http','.ru','.xyz','.co', 'NikiasGomBL', 'KathrynRetlyQL','DavidtixPR','CharlestixZC','ofeliaya11');
   return strposa($string, $array);

}
function formatPrice($price, $discount_price, $discount_flag, $location="widget"){
$symbol=getSetting('currency_code','site_settings');
    if(session('currency_short')!='GBP'){
        $symbol='<i class="'.session('currency_symbol').'"></i>';
    }
    if($discount_flag){
        if($location=="course"){
            return '<span class="price-stripe"> '.$symbol.currencyPrice($price).'</span>'.$symbol.currencyPrice($discount_price);
        }else{
            return '<del>'.$symbol. currencyPrice($price) . '</del> '.$symbol. currencyPrice($discount_price);
        }

    }else{
        return $symbol.currencyPrice($price);
    }
}

function currencyPrice($price){
    if(session('currency_short')!='GBP'){
        return number_format((float)round($price*session('currency_rate'),2), 2, '.', '');
    }else{
        return number_format((float)round($price,2), 2, '.', '');
    }
}
function parsePrice($price){

        return number_format((float)round($price,2), 2, '.', '');

}
function get_browser_name($user_agent){
    $t = strtolower($user_agent);
    $t = " " . $t;
    if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera'            ;
    elseif (strpos($t, 'edge'      )                           ) return 'Edge'             ;
    elseif (strpos($t, 'chrome'    )                           ) return 'Chrome'           ;
    elseif (strpos($t, 'safari'    )                           ) return 'Safari'           ;
    elseif (strpos($t, 'firefox'   )                           ) return 'Firefox'          ;
    elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
    return 'Unkown';
}

if ( ! function_exists('color_avatar')) {
    function color_avatar($user_name)
    {

        $words = explode(" ",trim($user_name));
        $initials = null;
        if(count($words)>=2) {
            foreach ($words as $w) {
                //$initials .= $w[0];
                $initials .= substr($w,0,1);
            }
        }else{
            $initials= substr($user_name,0,1);

        }
        $background_colors = array('#a30bc1', '#0b60c1', '#0bc1b5', '#0b84c1', '#096796', '#064a6c', '#2570af', '#5aed86', '#19b530', '#0588bc', '#dbea7c', '#d642c0', '#812ec1', '#112187', '#25373A', '#164852', '#495E67', '#FF3838');
        $myColor = $background_colors[array_rand($background_colors)];
         ?>

        <div class="circle "  style = "background-color: <?=$myColor?>" >
            <span class="initials" > <?=$initials?></span>
        </div>
<?php
}
}

if ( ! function_exists('Select_All_Courses'))
{
    function Select_All_Courses($IDS = array()) {
        if(count($IDS) > 0)
            return App\LmsSeries::whereNotIn("id", $IDS)->orderBy("id", "desc")->get();
        else
            return App\LmsSeries::orderBy("id", "desc")->get();
    }
}

if ( ! function_exists('Time_Formates_Units'))
{
    function Time_Formates_Units($UnitType, $Time) {
        $respon = "";
        if($Time == "00:00") {
            return $respon;
        }

        if($UnitType == 'video' || $UnitType == 'iframe' || $UnitType == 'file') {
            $respon = '<span class="time-with-title">'.$Time.'</span>';
            return $respon;
        }

        return $respon;
    }
}

if ( ! function_exists('Total_Time_Calculated'))
{
    function Total_Time_Calculated($Total_Arr) {

        $respon = "";
        $Total_hours = 0;
        $Total_min = 0;
        $Total_sec = 0;

        foreach($Total_Arr as $Time) {
            $timeToarray = explode(":", $Time);

            if(count($timeToarray) != 3) {
                array_unshift($timeToarray,"00");
            }

            $Total_hours = $Total_hours + $timeToarray[0];
            $Total_min = $Total_min + $timeToarray[1];
            $Total_sec = $Total_sec + $timeToarray[2];
        }

        $Total_Time = $Total_hours . ":" . $Total_min . ":" . $Total_sec;

        if(explode(":", $Total_Time)[0] == 0) {
            $Total_Time = explode(":", $Total_Time)[1] . ":" . explode(":", $Total_Time)[2];
        }

        $respon = $Total_Time;

        return $respon;
    }
}

if ( ! function_exists('Section_Time'))
{
    function Section_Time($SectionOBJ) {

        $respon = "";
        $Total_hours = 0;
        $Total_min = 0;
        $Total_sec = 0;

        foreach($SectionOBJ->contents as $content) {
            if($content->content_type == 'video' || $content->content_type == 'iframe' || $content->content_type == 'file') {
                $timeToarray = explode(":", $content->video_length);

                if(count($timeToarray) != 3) {
                    array_unshift($timeToarray,"00");
                }

                $Total_hours = $Total_hours + $timeToarray[0];
                $Total_min = $Total_min + $timeToarray[1];
                if(count($timeToarray)>2){
                $Total_sec = $Total_sec + $timeToarray[2];
                }else{
                    $Total_sec=0;
                }
                if($Total_sec > 60) {
                    $Total_min++;
                    $Total_sec = $Total_sec - 60;
                    ($Total_sec > 30) ? $Total_min++ : "";
                }else{
                    $Total_sec=0;
                }

                if($Total_min > 60) {
                    $Total_hours++;
                    $Total_min = $Total_min - 60;
                }
            }
        }

        $Total_Time = str_pad($Total_hours, 2, '0', STR_PAD_LEFT) . "hr " . str_pad($Total_min, 2, '0', STR_PAD_LEFT);

        if(explode("hr ", $Total_Time)[0] == 00) {
            $Total_Time = str_pad(explode("hr ", $Total_Time)[1], 2, '0', STR_PAD_LEFT);
        }

        $respon = $Total_Time;

        return $respon;
    }
}

if ( ! function_exists('Course_Time'))
{
    function Course_Time($CourseOBJ) {

        $respon = [];
        $Course_hours = 0;
        $Course_min = 0;
        $Course_sec = 0;
        $Course_lec = 0;


        foreach($CourseOBJ as $SectionOBJ) {

            $Total_hours = 0;
            $Total_min = 0;
            $Total_sec = 0;

            foreach($SectionOBJ->contents as $content) {
                if($content->content_type == 'video' || $content->content_type == 'iframe' || $content->content_type == 'file') {

                    $timeToarray = explode(":", $content->video_length);

                    if(count($timeToarray) != 3) {
                        array_unshift($timeToarray,"00");
                    }

                    $Total_hours = $Total_hours + $timeToarray[0];
                    $Total_min = $Total_min + $timeToarray[1];
                    if(count($timeToarray)>2){
                        $Total_sec = $Total_sec + $timeToarray[2];
                    }else{
                        $Total_sec=0;
                    }
                    if($Total_sec > 60) {
                        $Total_min++;
                        $Total_sec = $Total_sec - 60;
                        ($Total_sec > 30) ? $Total_min++ : "";
                    }else{
                        $Total_sec=0;
                    }

                    if($Total_min > 60) {
                        $Total_hours++;
                        $Total_min = $Total_min - 60;
                    }

                }
            }

            $Course_hours = $Course_hours + $Total_hours;
            $Course_min = $Course_min + $Total_min;
            $Course_sec = $Course_sec + $Total_sec;

            if($Course_sec > 60) {
                $Course_min++;
                $Course_sec = $Course_sec - 60;
                ($Course_sec > 30) ? $Course_min++ : "";
            }else{
                $Course_sec=0;
            }

            if($Course_min > 60) {
                $Course_hours++;
                $Course_min = $Course_min - 60;
            }

            /******** total lec ********/
            $Course_lec = $Course_lec + count($SectionOBJ->contents);
            /******** total lec ********/
        }


        $Total_Time = str_pad($Course_hours, 2, '0', STR_PAD_LEFT) . "h " . str_pad($Course_min, 2, '0', STR_PAD_LEFT) . "m ";

        if(explode("h ", $Total_Time)[0] == 00) {
            $Total_Time = str_pad(explode("h ", $Total_Time)[1], 2, '0', STR_PAD_LEFT);
        }

        $respon["time"] =  $Total_Time;
        $respon["lec"] =  str_pad($Course_lec, 2, '0', STR_PAD_LEFT);

        return $respon;
    }
}

if ( ! function_exists('makeOrderID'))
{
    function makeOrderID($ID) {
        if($ID > 0 & $ID !=null)
            return str_pad($ID, 5, '0', STR_PAD_LEFT);
        else
            return false;
    }
}

if ( ! function_exists('makeCertificateCode'))
{
    function makeCertificateCode($user_id, $course_id, $quiz_id='') {
        if($quiz_id > 0 && $quiz_id !=null && $quiz_id !='') {
            $digits = 2;
            $randquizid= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
            $certificate_code = str_pad($user_id, 5, '0', STR_PAD_LEFT) . '-' . str_pad($course_id, 5, '0', STR_PAD_LEFT) . '-' . str_pad($quiz_id, 4, '0', STR_PAD_LEFT).$randquizid;
            return $certificate_code;
            // return str_pad($ID, 5, '0', STR_PAD_LEFT);
        }else if($quiz_id == 0 || $quiz_id ==null && $quiz_id =='') {
            $digits = 6;
            $randquizid= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
            $certificate_code = str_pad($user_id, 5, '0', STR_PAD_LEFT) . '-' . str_pad($course_id, 5, '0', STR_PAD_LEFT) . '-' . $randquizid;
            return $certificate_code;
        }else {
            return false;
        }
    }
}



if ( ! function_exists('Select_Paid_Courses'))
{
    function Select_Paid_Courses($IDS = array()) {
        if(count($IDS) > 0)
            return App\LmsSeries::whereNotIn("id", $IDS)->where("status", 1)->orderBy("id", "desc")->get();
        else
            return App\LmsSeries::where("is_paid", 1)->where("status", 1)->orderBy("id", "desc")->get();
    }
}

if ( ! function_exists('Courses_Exist'))
{
    function Courses_Exist($IDS = array(), $remveItem = false) {
        if(count($IDS) > 0)
            $outarr = [];
            foreach($IDS as $id) {
                if(!App\LmsSeries::where("id", $id)->first()) {
                    if($remveItem) {
                        if (($key = array_search($id, $IDS)) !== false) {
                            unset($IDS[$key]);
                        }
                    } else {
                        $outarr[] = $id;
                    }
                }
            }

        if($remveItem) {
            $output = "";
            foreach($IDS as $id) {
                $output .= $id;
                if($id != end($IDS)) {
                    $output .= ",";
                }
            }
            echo $output;
            exit();
        } else {
            print_r($outarr);
            exit();
        }

    }
}

if ( ! function_exists('Is_Paid_Course'))
{
    function Is_Paid_Course($ID = 0) {
        if(App\LmsSeries::where("id", $ID)->where("is_paid", 1)->first()) {
            return "yes";
        }
        return "no";
    }
}

if ( ! function_exists('Set_Text_Colour'))
{
    function Set_Text_Colour($colour = "#ffffff") {
        echo '<style>.content-set * {color: '.$colour.'}</style>';
    }
}

if ( ! function_exists('Select_All_Categories'))
{
    function Select_All_Categories($IDS = array()) {
            return App\LmsCategory::where("parent_id", 0)->orderBy("id", "asc")->get();
    }
}

if ( ! function_exists('Select_Courses_On_ID'))
{
    function Select_Courses_On_ID($ID = 0) {
        return App\LmsSeries::where("id", $ID)->first();
    }
}

function countDuration($duration,$idsArr){
    //$duration='0-3';
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
        ->toArray();
    return $vd0_3;
}

if ( ! function_exists('DiscountedCourses'))
{
    function DiscountedCourses() {
        return App\LmsSeries::where("is_paid",'=', 3)->get();
    }
}

if ( ! function_exists('Select_Courses_On_Cat_ID'))
{
    function Select_Courses_On_Cat_ID($ID = 0) {
        return App\LmsSeries::where("lms_category_id", $ID)->get();
    }
}

if ( ! function_exists('ip_info')) {
    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city" => @$ipdat->geoplugin_city,
                            "state" => @$ipdat->geoplugin_regionName,
                            "country" => @$ipdat->geoplugin_countryName,
                            "country_code" => @$ipdat->geoplugin_countryCode,
                            "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
}

if (!function_exists('ActiveOfferChk')) {
    function ActiveOfferChk($OfferID = 0){
        if($OfferID != 0) {
            $offerRes = App\Offers::find($OfferID);

            if($offerRes) {
                foreach(explode(",", json_decode($offerRes->offer_keys, true)) as $val) {
                    if(\Cart::get($val)) {
                        return true;
                    }
                }
            } else {
                return false;
            }
        }
        return false;
    }
}

if (!function_exists('CheckExtraAttempt')) {
    function CheckExtraAttempt($examType, $seriesid){
        if($examType == "Mock") {
            return  App\Payment::where("user_id", Auth::user()->id)->where("item_name", "Mock Exam Retake Fee")->where("item_id", $seriesid)->count();
        } else {
            return  App\Payment::where("user_id", Auth::user()->id)->where("item_name", "Final Exam Retake Fee")->where("item_id", $seriesid)->count();
        }
    }
}

if (!function_exists('GetActiveOfferData')) {
    function GetActiveOfferData($SettingID){
        if($SettingID != 0) {
            return App\PromoBanner::find($SettingID);
        }
        return false;
    }
}

if ( ! function_exists('rating_num')) {
    function rating_num($reviews)
    {
        if(count($reviews)>=1) {
            $halfstars = 0;
            $totalratings = $reviews->sum('rating');
            $avgstars = ceil($totalratings / count($reviews));
            $roundavgstars = round($totalratings / count($reviews), 1);
            $flooravgstars = floor($totalratings / count($reviews));
            if ($avgstars > $flooravgstars) {
                $fraction = $roundavgstars - $flooravgstars;
                if ($fraction < 0.9) {
                    $avgstars = $roundavgstars;
                }

            }
            return $avgstars;
        }else{
            return 0;
        }
    }
}



if ( ! function_exists('rating_stars')) {
    function rating_stars($reviews)
    {
        if(count($reviews)>=1) {
            $halfstars = 0;
            $totalratings = $reviews->sum('rating');
            $avgstars = ceil($totalratings / count($reviews));
            $roundavgstars = round($totalratings / count($reviews), 1);
            $flooravgstars = floor($totalratings / count($reviews));
            if ($avgstars > $flooravgstars) {
                $fraction = $roundavgstars - $flooravgstars;
                if ($fraction > 0.4) {
                    $halfstars = 1;
                } else {
                    $halfstars = 0;

                }

            }
            $totstars = array_fill(0, $flooravgstars, NULL);
            if ($halfstars) {
                $nilstars = 5 - ($flooravgstars + $halfstars);
            } else {
                $nilstars = 5 - ($flooravgstars);
            }

            $empstars = array_fill(0, $nilstars, NULL);

            foreach($totstars as $key=>$value ) { ?>
                <i class="fas fa-star filled" style = "color: #f5c85b;" ></i >
            <?php }
                                                if($halfstars){ ?>
                                                    <i class="fas fa-star-half-alt" style="color: #f5c85b;"></i>
            <?php }
                                            foreach($empstars as $key=>$value ){ ?>
                                                <i class="fas fa-star" style="color: #abb0bb;"></i>
            <?php }


        }else{
            ?>

                <i class="fas fa-star " style="color: #abb0bb;"></i>
                <i class="fas fa-star " style="color: #abb0bb;"></i>
                <i class="fas fa-star " style="color: #abb0bb;"></i>
                <i class="fas fa-star " style="color: #abb0bb;"></i>
                <i class="fas fa-star" style="color: #abb0bb;"></i>

<?php
        }
    }
}


if ( ! function_exists('Edit_Select_Courses'))
{
    function Edit_Select_Courses($CID = array()) {
        $res = "";
        $catids = [];
        if(count($CID) > 0) {
            foreach($CID as $catID) {
                $catres  =   App\LmsCategory::where("parent_id", $catID)->get();
                if(count($catres) > 0) {
                    foreach($catres as $cat) {
                        $catids[] = $cat->id;
                    }
                }
            }
        }

        $allCourse  =   App\LmsSeries::whereIn("lms_category_id", $catids)->get();
        foreach($allCourse as $course){
            $res    .=   "<option id='".$course->id."' value='".$course->id."'>".$course->title."</option>";
        }
        return $res;
    }
}

if ( ! function_exists('Select_Course_ID_Parent_Cat_ID'))
{
    function Select_Course_ID_Parent_Cat_ID($CID = 0) {
        $CourseIDS = [];
        $catids = [];
        $catres  =   App\LmsCategory::where("parent_id", $CID)->get();
        if(count($catres) > 0) {
            foreach($catres as $cat) {
                $catids[] = $cat->id;
            }
        }

        $allCourse  =   App\LmsSeries::whereIn("lms_category_id", $catids)->get();
        foreach($allCourse as $course){
            $CourseIDS[]    =   $course->id;
        }
        return json_encode($CourseIDS);
    }
}

if ( ! function_exists('Get_Popup_Data_On_ID'))
{
    function Get_Popup_Data_On_ID($ID = 1) {
        return App\PromoPopup::find($ID);
    }
}

if ( ! function_exists('Get_ID_On_Slug'))
{
    function Get_ID_On_Slug($Slug = "") {
        return App\LmsSeries::where("slug", $Slug)->first();
    }
}

if ( ! function_exists('Select_Category_On_ID'))
{
    function Select_Category_On_ID($ID = 0) {
        return App\LmsCategory::where("id", $ID)->first();
    }
}

if ( ! function_exists('lesson_progress'))
{
    function lesson_progress($lesson_id = "", $user_id = "") {

        $user= Auth::user();
        $watch_history_array = json_decode($user->watch_history, true);
        for ($i = 0; $i < count($watch_history_array); $i++) {
            $watch_history_for_each_lesson = $watch_history_array[$i];
            if ($watch_history_for_each_lesson['lesson_id'] == $lesson_id) {
                return $watch_history_for_each_lesson['progress'];
            }
        }
        return 0;
    }
}

if (!function_exists('GetMobileImg')) {
    function GetMobileImg($pslug){
        if($pslug == "offer-for-5") {
            return UPLOADS.'lms/series/offerbanner/buy5courses.jpg';
        } elseif($pslug == "metro-deals") {
            return UPLOADS.'lms/series/offerbanner/1544296245.jpg';
        } elseif($pslug == "vouchercodesuae") {
            return UPLOADS.'lms/series/offerbanner/2097110914.jpg';
        } elseif($pslug == "wowcher") {
            return UPLOADS.'lms/series/offerbanner/1719273710.jpg';
        } elseif($pslug == "1-to-1") {
            return UPLOADS.'lms/series/offerbanner/1702321524.jpg';
        } else {
            return UPLOADS.'lms/series/offerbanner/buy3courses.jpg';
        }

    }
}

if ( ! function_exists('course_progress'))
{
    function course_progress($course_id = "", $user_id = "") {

        $user=$user= Auth::user();
        // this array will contain all the completed lessons from different different courses by a user
        $completed_lessons_ids = array();

        // this variable will contain number of completed lessons for a certain course. Like for this one the course_id
        $lesson_completed = 0;

        // User's watch history
      //  echo "============================================================";
        if($user->watch_history!="" || $user->watch_history!=null) {
            $watch_history_array = json_decode($user->watch_history, true);
            // desired course's lessons
            $lmsseries = \App\LmsSeriesData::where('lmsseries_id', $course_id)->get();
            $lessons_for_that_course = $lmsseries;
//dd($lessons_for_that_course);
            //$query = DB::getQueryLog();
            //print_r($query);
            // dd($lessons_for_that_course);
            //$lessons_for_that_course=$lessons_for_that_course->toArray();
            // total number of lessons for that course
            // dd($lessons_for_that_course);
            $total_number_of_lessons = $lmsseries->count();
            // arranging completed lesson ids
            for ($i = 0; $i < count($watch_history_array); $i++) {
                $watch_history_for_each_lesson = $watch_history_array[$i];
                if ($watch_history_for_each_lesson['progress'] == 1) {
                    array_push($completed_lessons_ids, $watch_history_for_each_lesson['lesson_id']);
                }
            }
            // dd($lessons_for_that_course);
            foreach ($lessons_for_that_course as $row) {

                if (in_array($row['lmscontent_id'], $completed_lessons_ids)) {
                    $lesson_completed++;
                }
            }
            if ($lesson_completed > 0 && $total_number_of_lessons > 0) {
                // calculate the percantage of progress
                $course_progress = ($lesson_completed / $total_number_of_lessons) * 100;
                return $course_progress;
            } else {
                return 0;
            }
        }else{
            return 0;

        }

    }
}


if (!function_exists('array_has')) {
    function array_has($param1, $param2){
        return \Illuminate\Support\Arr::has($param1, $param2);
    }
}

if (!function_exists('array_pluck')) {
    function array_pluck($param1, $param2, $param3){
        return \Illuminate\Support\Arr::pluck($param1, $param2, $param3);
    }
}

if (!function_exists('uploadToS3')) {
    function uploadToS3($image,$folder,$fileName){
        $image_normal = $image->stream();

        Storage::disk('s3')->put($folder.$fileName, $image_normal->__toString());

    }
}

if (!function_exists('uploadVideoToS3')) {
    function uploadVideoToS3($image,$folder,$fileName){
        $image_normal = $image->stream();

        Storage::disk('s3')->put($folder.$fileName, $image_normal->__toString());

    }
}

if (!function_exists('getBlogImgPath')) {

    function getBlogImgPath($image = '', $type = 'thumb')
    {
        $obj = app('App\ImageSettings');
        $path = '';
        if (env('FILESYSTEM_DRIVER') == "s3") {

            if ($image == '') {
                if ($type == 'blog')
                    return $obj->getDefaultBlogImgPath();
                return $obj->getDefaultBlogImgThumbpath();
            }
            if ($type == 'blog')
                $path = $obj->getBlogImgPath();
            else
                $path = $obj->getBlogImgThumbnailpath();
            //echo $path.$image;
            return $imageFile = $path . $image;
//            if (Storage::disk('s3')->exists('blogs/' . $image)) {
//                return $imageFile;
//            }
//            if ($type == 'blog')
//                return $obj->getDefaultBlogImgPath();
//            return $obj->getDefaultBlogImgThumbpath();

        } else {

            if ($image == '') {
                if ($type == 'blog')
                    return  $obj->getDefaultBlogImgPath();
                return  $obj->getDefaultBlogImgThumbpath();
            }
            if ($type == 'blog')
                $path = $obj->getBlogImgPath();
            else
                $path = $obj->getBlogImgThumbnailpath();
            $imageFile = $path . $image;
            if (File::exists($imageFile)) {
                return  $imageFile;
            }
            if ($type == 'blog')
                return  $obj->getDefaultBlogImgPath();
            return  $obj->getDefaultBlogImgThumbpath();

        }
    }
}


function showMessage($type,$title, $text, $useLanguage=TRUE) {
// console.log(u_title);
    if($useLanguage) {
        $title = getPhrase($title);
        $text = getPhrase($text);
    }
    toastr($text, strtolower($type), $title);
//        if ($type="Success"){
//            toastr()->success($msg);
//        }
//        if ($type="Sorry"){
//            toastr()->error($msg);
//        }
//        if ($type="OK"){
//            toastr()->info($msg);
//
//        }
}



function flash($title = null, $text = null, $type='info')
{
    $flash = app('App\Http\Flash');
    if (func_num_args() == 0) {
        return $flash;
    }

   // showMessage($type,$title, $text);
    return $flash->$type($title, $text);
}

/**
 * Language Helper
 * @param  string|null  $phrase
 * @return string
 */
function getPhrase($key = null)
{

    $phrase = app('App\Language');

    if (func_num_args() == 0) {
        return '';
    }

    return  $phrase::getPhrase($key);
}

/**
 * This method fetches the specified key in the type of setting
 * @param  [type] $key          [description]
 * @param  [type] $setting_type [description]
 * @return [type]               [description]
 */
function getSetting($key, $setting_type)
{

    return App\Settings::getSetting($key, $setting_type);
}

/**
 * This method fetches the specified key in the type of setting
 * @param  [type] $key          [description]
 * @param  [type] $setting_type [description]
 * @return [type]               [description]
 */
function getThemeSetting($key, $setting_type)
{
    return App\SiteTheme::getSetting($key, $setting_type);
}

/**
 * Language Helper
 * @param  string|null  $phrase
 * @return string
 */
function isActive($active_class = '', $value = '')
{
    $value = isset($active_class) ? ($active_class == $value) ? 'active' : '' : '';
    if($value)
        return "class = ".$value;
    return $value;
}

/**
 * This method returns the path of the user image based on the type
 * It verifies wether the image is exists or not,
 * if not available it returns the default image based on type
 * @param  string $image [Image name present in DB]
 * @param  string $type  [Type of the image, the type may be thumb or profile,
 *                       by default it is thumb]
 * @return [string]      [returns the full qualified path of the image]
 */
function getProfilePath($image = '', $type = 'thumb')
{
    $obj = app('App\ImageSettings');
    $path = '';

    if($image=='') {
        if($type=='profile')
            return $obj->getDefaultProfilePicPath();
        return $obj->getDefaultprofilePicsThumbnailpath();
    }


    if($type == 'profile')
        $path = $obj->getProfilePicsPath();
    else
        $path = $obj->getProfilePicsThumbnailpath();
    $imageFile = $path.$image;

    if (File::exists($imageFile)) {
        return $imageFile;
    }

    if($type=='profile')
        return $obj->getDefaultProfilePicPath();
    return $obj->getDefaultprofilePicsThumbnailpath();

}

function getPhotoPath($image = '', $type = 'thumb')
{
    $obj = app('App\ImageSettings');
    $path = '';

    if($image=='') {
        if($type=='photo')
            return $obj->getDefaultProfilePicPath();
        return $obj->getDefaultprofilePicsThumbnailpath();
    }


    if($type == 'photo')
        $path = $obj->getCardPhotoPath();
    else
        $path = $obj->getCardPhotoPathThumb();
    $imageFile = $path.$image;

    //if (File::exists($imageFile)) {
        return $imageFile;
    //}

//    if($type=='photo')
//        return $obj->getDefaultProfilePicPath();
//    return $obj->getDefaultprofilePicsThumbnailpath();

}

/**
 * This method returns the standard date format set by admin
 * @return [string] [description]
 */
function getDateFormat()
{
    $obj = app('App\GeneralSettings');
    return $obj->getDateFormat();
}

function getBloodGroups()
{
    return array(
            'A +ve'    => 'A +ve',
            'A -ve'    => 'A -ve',
            'B +ve'    => 'B +ve',
            'B -ve'    => 'B -ve',
            'O +ve'    => 'O +ve',
            'O -ve'    => 'O -ve',
            'AB +ve'   => 'AB +ve',
            'AB -ve'   => 'AB -ve',
        );
}

function getAge($date)
{


    // return Carbon::createFromDate(1984, 7, 17)->diff(Carbon::now())->format('%y years, %m months and %d days');
}

function getLibrarySettings()
{
    return json_decode((new App\LibrarySettings())->getSettings());
}

function getExamSettings()
{
    return json_decode((new App\ExamSettings())->getSettings());
}

function getPostSettings()
{
    return json_decode((new App\PostSettings())->getSettings());
}


/**
 * This method is used to generate the formatted number based
 * on requirement with the follwoing formatting options
 * @param  [type]  $sno    [description]
 * @param  integer $length [description]
 * @param  string  $token  [description]
 * @param  string  $type   [description]
 * @return [type]          [description]
 */
function makeNumber($sno, $length=2, $token = '0',$type='left')
{
    if($type=='right')
        return str_pad($sno, $length, $token, STR_PAD_RIGHT);

    return str_pad($sno, $length, $token, STR_PAD_LEFT);

}

/**
 * This method returns the settings for the selected key
 * @param  string $type [description]
 * @return [type]       [description]
 */
function getSettings($type='')
{
    if($type=='lms')
        return json_decode((new App\LmsSettings())->getSettings());

    if($type=='exams')
        return json_decode((new App\ExamSettings())->getSettings());

    if($type=='post')
        return json_decode((new App\PostSettings())->getSettings());

    if($type=='subscription')
        return json_decode((new App\SubscriptionSettings())->getSettings());

    if($type=='general')
        return json_decode((new App\GeneralSettings())->getSettings());

    if($type=='email'){

        $dta = json_decode((new App\EmailSettings())->getSettings());
        return $dta;
      }

   if($type=='attendance')
        return json_decode((new App\AttendanceSettings())->getSettings());

}

/**
 * This method returns the role of the currently logged in user
 * @return [type] [description]
 */
 function getRole($user_id = 0)
 {
     if($user_id)
        return (isset(getUserRecord($user_id)->roles()->first()->name)) ? getUserRecord($user_id)->roles()->first()->name : "";
     return (isset(Auth::user()->roles()->first()->name)) ? Auth::user()->roles()->first()->name : "";
 }
function getUserName($user_id = 0)
{
    if($user_id)
        return (isset(getUserRecord($user_id)->name)) ? getUserRecord($user_id)->name : "";
    return (isset(Auth::user()->name)) ? Auth::user()->name : "";
}
function getCourseId($user_id,$quizresultslug)
{
    $series = App\LmsSeriesExams::join('quizresults', 'lmsseries_exams.exam_quiz_id', '=', 'quizresults.quiz_id')
        ->select(['lmsseries_id'])
        ->where('quizresults.user_id', '=', $user_id)
        ->where('slug', '=', $quizresultslug)
        ->first();
   // dd($series);
   //   $series= App\LmsSeriesExams::where('exam_quiz_id','=',$quiz_id)->first();
      if($series)
        return $series->lmsseries_id;
    else
        return false;
}

function getCourseCategory($course_id)
{
    $course=App\LmsSeries::where("id", $course_id)->where("status", 1)->first();

    if($course) {
        $category=App\LmsCategory::where("id", $course->lms_category_id)->first();

        if($category)
            return $category->category;
        else
            return 'uncategorized';
    }

    return 'uncategorized';
}

function getCountryName($country_id)
{
    $country=App\Country::where("id", $country_id)->first();

    if($country) {

        return $country->nicename;
    }else{
        return false;
    }
}
function getStudentRecord($id)
{
    $record=App\StudentIdCard::where("id", $id)->first();

    if($record) {

        return $record;
    }else{
        return false;
    }
}
function split_name($name) {
    $name = trim($name);
    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
    return array($first_name, $last_name);
}
function getTagValue($json){
    $arr=json_decode($json,true);
    $request=(object)$arr;
    return $request->en;
}
function getAccreditedBy($course_id)
{
    $course=App\LmsSeries::where("id", $course_id)->where("status", 1)->first();
    $name=$course->accreditedby->name;

    if($name)
        return $name;
    else
        return 'CPD';
}

function generate(string $name) : string
{
    $words = explode(' ', $name);
    if (count($words) >= 2) {
        return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
    }
    return makeInitialsFromSingleWord($name);
}

/**
 * Make initials from a word with no spaces
 *
 * @param string $name
 * @return string
 */
function makeInitialsFromSingleWord(string $name) : string
{
    preg_match_all('#([A-Z]+)#', $name, $capitals);
    if (count($capitals[1]) >= 2) {
        return substr(implode('', $capitals[1]), 0, 2);
    }
    return strtoupper(substr($name, 0, 2));
}


/**
 * This is a common method to send emails based on the requirement
 * The template is the key for template which is available in db
 * The data part contains the key=>value pairs
 * That would be replaced in the extracted content from db
 * @param  [type] $template [description]
 * @param  [type] $data     [description]
 * @return [type]           [description]
 */
 function sendEmail($template, $data)
 {
    return (new App\EmailTemplate())->sendEmail($template, $data);
 }

/**
 * This method returns the formatted by appending the 0's
 * @param  [type] $number [description]
 * @return [type]         [description]
 */
 function formatPercentage($number)
 {
     return sprintf('%.2f',$number).' %';
 }
function createUsername($first_name,$last_name){
    // original username
    $user_name = $first_name[0].$last_name;
    // if you have  a username column
    $user_count = App\User::where('username', $user_name)->count();

    // append digit if exists
    if ($user_count > 0) {
        $user_name .= "_$user_count";
    }
    return strtolower($user_name);

}
function createUserRecord($request){

    $userexist=getUserWithEmail($request->email);
    if($userexist){
        return $userexist->id;
    }else {

        $role_id = STUDENT_ROLE_ID;
        $user = new App\User();
        $name = $request->first_name . " " . $request->last_name;
        $user->name = $name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->address = $request->address . ', ' . $request->city . ', ' . $request->zipcode . getCountryName($request->country);
        $username = createUsername($request->first_name, $request->last_name);
        $user->username = $username;
        $user->email = $request->email;
        $password = str_random(8);
        $user->password = bcrypt($password);
        $user->role_id = $role_id;
        $user->login_enabled = 1;
        $user->save();
        $user->roles()->attach($user->role_id);
        sendEmail('newuserregister_admin', array('user_name' => $username,
            'send_to' => 'admin',
            'to_email' => $request->email,
            'email' => $request->email,
            'name' => $name,
            'url' => url('/')));
        sendEmail('registration', array(
            'name' => $request->first_name,
            'to_email' => $request->email,
            'username' => $username,
            'password' => $password,
            'url' => url('/')));
        return $user->id;
    }

}
/**
 * This method returns the user based on the sent userId,
 * If no userId is passed returns the current logged in user
 * @param  [type] $user_id [description]
 * @return [type]          [description]
 */
 function getUserRecord($user_id = 0)
 {
    if($user_id) {
        // return App\User::where('id',$user_id)->get();
      return (new App\User())->where('id', '=', $user_id)->first();
    }
    return Auth::user();
 }

/**
 * Returns the user record with the matching slug.
 * If slug is empty, it will return the currently logged in user
 * @param  string $slug [description]
 * @return [type]       [description]
 */
function getUserWithSlug($slug='')
{
    if($slug)
     return App\User::where('slug', $slug)->get()->first();
    return Auth::user();
}
function getUserWithId($id='')
{
    if($id)
        return App\User::where('id', $id)->get()->first();
    return false;
}
function getUserWithEmail($email='')
{
    if($email){
        return App\User::where('email', $email)->get()->first();
    }else{
        return false;
    }

}
function getAdminWithSlug($slug="infinity-admin")
{
    if($slug)
        return App\User::where("slug", $slug)->first();
    return Auth::user();
}

/**
 * This method identifies if the url contains the specific string
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
 function urlHasString($str)
 {
    $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
     if (strpos($url, $str))
        return TRUE;
    return FALSE;

 }
function queryString($param,$str)
{
    $subcats=app('request')->input($param);
    $HiddenProducts = explode(',',$subcats);
    if (in_array($str, $HiddenProducts)) {
        return TRUE;
    } else {
        return FALSE;
    }

}


 function checkRole($roles)
 {
     if(Entrust::hasRole($roles))
        return TRUE;
    return FALSE;
 }

 function getUserGrade($grade = 5)
 {
     switch ($grade) {
         case 1:
             return ['owner'];
             break;
        case 2:
             return ['owner', 'admin','instructor'];
             break;
        case 3:
             return ['owner', 'admin', 'staff'];
             break;
        case 4:
             return ['owner', 'admin', 'parent'];
             break;
        case 5:
             return ['student'];
             break;
        case 6:
             return ['admin'];
             break;
        case 7:
             return ['parent'];
             break;
         case 8:
             return ['instructor'];
             break;

     }
 }
 /**
  * Returns the appropriate layout based on the user logged in
  * @return [type] [description]
  */
 function getLayout()
 {
    $layout = 'layouts.student.studentlayout';
    if(checkRole(getUserGrade(2)))
        $layout             = 'layouts.admin.adminlayout';
     if(checkRole(['instructor']))
         $layout             = 'layouts.instructor.instructorlayout';
    if(checkRole(['parent']))
        $layout             = 'layouts.parent.parentlayout';

    return $layout;
 }

 function validateUser($slug)
 {
    if($slug == Auth::user()->slug)
        return TRUE;
    return FALSE;
 }

 /**
  * Common method to send user restriction message for invalid attempt
  * @return [type] [description]
  */
 function prepareBlockUserMessage()
 {
    flash('Ooops..!', 'you_have_no_permission_to_access', 'error');
     return '';
 }

 /**
  * Common method to send user restriction message for invalid attempt
  * @return [type] [description]
  */
 function pageNotFound()
 {
    flash('Ooops..!', 'page_not_found', 'error');
     return '';
 }


 function isEligible($slug)
 {
     if(!checkRole(getUserGrade(2)))
     {
        if(!validateUser($slug))
        {
            if(!checkRole(['parent']) || !isActualParent($slug))
            {
               prepareBlockUserMessage();
               return FALSE;
            }
        }
     }
     return TRUE;
 }

 /**
  * This method checks wether the student belongs to the currently loggedin parent or not
  * And returns the boolean value
  * @param  [type]  $slug [description]
  * @return boolean       [description]
  */
 function isActualParent($slug)
 {
     return (new App\User())
              ->isChildBelongsToThisParent(
                                    getUserWithSlug($slug)->id,
                                    Auth::user()->id
                                    );

 }

/**
 * This method returns the role name or role ID based on the type of parameter passed
 * It returns ID if role name is supplied
 * It returns Name if ID is passed
 * @param  [type] $type [description]
 * @return [type]       [description]
 */

function getRoleData($type)
{

    if(is_numeric($type))
    {
        /**
         * Return the Role Name as the type is numeric
         */
        $record= App\Role::where('id','=',$type)->first();
        return $record->name;
    }

    //Return Role Id as the type is role name
    $record=App\Role::where('name','=',$type)->first();
    return $record->id;
}


 function getRoleData__($type)
 {
     if(is_numeric($type))
     {
        /**
         * Return the Role Name as the type is numeric
         */

            $record=App\Role::where('id','=',$type)->first();
            return $record->name;
     }

     $record=App\Role::where('name','=',$type)->first();
     return $record->id;


//
//     //Return Role Id as the type is role name
//     $record=App\Role::where('name','=',$type)->first();
//     return $record->id;
 }

 /**
  * Checks the subscription details and returns the boolean value
  * @param  string  $type [this is the of package]
  * @return boolean       [description]
  */
 function isSubscribed($type = 'main',$user_slug='')
 {
    $user = getUserWithSlug();
    if($user_slug)
        $user = getUserWithSlug($user_slug);

    if($user->subscribed($type))
      return TRUE;
    return FALSE;
 }

/**
 * This method will send the random color to use in graph
 * The random color generation is based on the number parameter
 * As the border and bgcolor need to be same,
 * We are maintainig number parameter to send the same value for bgcolor and background color
 * @param  string  $type   [description]
 * @param  integer $number [description]
 * @return [type]          [description]
 */
 function getColor($type = 'background',$number = 777) {

    $hash = md5('color'.$number); // modify 'color' to get a different palette
    $color = array(
        hexdec(substr($hash, 0, 2)), // r
        hexdec(substr($hash, 2, 2)), // g
        hexdec(substr($hash, 4, 2))); //b
    if($type=='border')
    return 'rgba('.$color[0].','.$color[1].','.$color[2].',1)';
    return 'rgba('.$color[0].','.$color[1].','.$color[2].',0.2)';
}


function pushNotification($channels = ['owner','admin'], $event = 'newUser',  $options="")
{

     $pusher = \Illuminate\Support\Facades\App::make('pusher');

         $pusher->trigger( $channels,
                      $event,
                      $options
                     );



}

/**
 * This method is used to return the default validation messages
 * @param  string $key [description]
 * @return [type]      [description]
 */
function getValidationMessage($key='required')
{
    $message = '<p ng-message="required">'.getPhrase('this_field_is_required').'</p>';

    if($key === 'required')
        return $message;

        switch($key)
        {
          case 'minlength' : $message = '<p ng-message="minlength">'
                                        .getPhrase('the_text_is_too_short')
                                        .'</p>';
                                        break;
          case 'maxlength' : $message = '<p ng-message="maxlength">'
                                        .getPhrase('the_text_is_too_long')
                                        .'</p>';
                                        break;
          case 'pattern' : $message   = '<p ng-message="pattern">'
                                        .getPhrase('invalid_input')
                                        .'</p>';
                                        break;
            case 'image' : $message   = '<p ng-message="validImage">'
                                        .getPhrase('please_upload_valid_image_type')
                                        .'</p>';
                                        break;
          case 'email' : $message   = '<p ng-message="email">'
                                        .getPhrase('please_enter_valid_email')
                                        .'</p>';
                                        break;

          case 'number' : $message   = '<p ng-message="number">'
                                        .getPhrase('please_enter_valid_number')
                                        .'</p>';
                                        break;

          case 'confirmPassword' : $message   = '<p ng-message="compareTo">'
                                        .getPhrase('password_and_confirm_password_does_not_match')
                                        .'</p>';
                                        break;
           case 'password' : $message   = '<p ng-message="minlength">'
                                        .getPhrase('the_password_is_too_short')
                                        .'</p>';
                                        break;
            case 'phone' : $message   = '<p ng-message="minlength">'
                .getPhrase('please_enter_valid_phone_number')
                .'</p>';
                break;
            case 'date' : $message   = '<p ng-message="date">'
                .getPhrase('please_enter_valid_date')
                .'</p>';
                break;
            case 'float' : $message   = '<p ng-message="float">'
                .getPhrase('please_enter_valid_number')
                .'</p>';
                break;

        }
    return $message;
}

/**
 * Returns the predefined Regular Expressions for validation purpose
 * @param  string $key [description]
 * @return [type]      [description]
 */
function getRegexPattern($key='name')
{
    $phone_regx = getSetting('phone_number_expression', 'site_settings');
    $pattern = array(

        'course' => "/(^[-©®™&#';:\-_ A-Za-z0-9 ]+$)+/",
        'slug' => '/(^[A-Za-z0-9-_\- ]+$)+/',
        'title' => '/(^[-©®™&#;\-_–  A-Za-z0-9. -_-]+$)+/',
        'name' => '/(^[A-Za-z ]+$)+/',
        'first_name' => '/(^[A-Za-z]+$)+/',
        'email' => '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        'phone'=>$phone_regx,
        'duration'=>'/(?<![\d:])(?:(?:(\d\d?):([0-5]\d))|([0-5]?\d)):([0-5]\d)(?![\d:])/',
        'date'=>'^\d{4}\/(0?[1-9]|1[012])\/(0?[1-9]|[12][0-9]|3[01])$',
        'float'=>'^[-+][0-9]+\.[0-9]+[eE][-+]?[0-9]+$'
    );
    return $pattern[$key];
}


function getRegexPatternwithspace($key='name')
{
    $phone_regx = getSetting('phone_number_expression', 'site_settings');
    $pattern = array(

        'course' => '/(^[A-Za-z0-9 -©®™&#;-_]+$)+/',
        'slug' => '/(^[A-Za-z0-9-_]+$)+/',
        'title' => '/(^[A-Za-z0-9. -_]+$)+/',
        'name' => '/(^[A-Za-z ]+$)+/',
        'first_name' => '/^[a-zA-Z\s]*$/',
        'last_name' => '/^[a-zA-Z\s]*$/',
        'email' => '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        'phone'=>$phone_regx,
        'duration'=>'/(?<![\d:])(?:(?:(\d\d?):([0-5]\d))|([0-5]?\d)):([0-5]\d)(?![\d:])/'
    );
    return $pattern[$key];
}

function getPhoneNumberLength()
{
  return getSetting('site_favicon', 'site_settings');
}


function getArrayFromJson($jsonData)
{
    $result = array();
    if($jsonData)
    {
        foreach(json_decode($jsonData) as $key=>$value)
            $result[$key] = $value;
    }
    return $result;
}


function prepareArrayFromString($string='', $delimeter = '|')
{

    return explode($delimeter, $string);
}

/**
 * Returns the random hash unique code
 * @return [type] [description]
 */


function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}

function timeago__($date) {
    $timestamp = strtotime($date);

    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60","60","24","30","12","10");

    $currentTime = time();
    if($currentTime >= $timestamp) {
        $diff     = time()- $timestamp;
        for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
         if($strTime[$i]=="hour" || $strTime[$i]=="minute"  || $strTime[$i]=="second" ){
            return $diff . " " . $strTime[$i] . "(s) ago ";
        }else{
            return date("j M Y", $timestamp);
        }

    }
}
function getHashCode()
{
  return bin2hex(openssl_random_pseudo_bytes(20));
}

/**
 * Sends the default Currency set for the project
 * @return [type] [description]
 */
function getCurrencyCode($manual="")
{
    if($manual=="") {
        $symbol = getSetting('currency_code', 'site_settings');
        if (session('currency_short') != '') {
            $symbol = '<i class="' . session('currency_symbol') . '"></i>';
        }
    }else{
        if(strpos($manual,'dollar',0)){
            $symbol="$";
        }else if (strpos($manual,'euro',0)){
            $symbol="€";
        }else{
            $symbol="£";
        }
        //$symbol = '<i class="' . $manual . '"></i>';
    }
  return $symbol;
}

/**
 * Returns the max records per page
 * @return [type] [description]
 */
function getRecordsPerPage()
{
  return RECORDS_PER_PAGE;
}

/**
 * Checks wether the user is eligible to use the current item
 * @param  [type]  $item_id   [description]
 * @param  [type]  $item_type [description]
 * @return boolean            [description]
 */
function isItemPurchased($item_id, $item_type, $user_id = '')
{
  return App\Payment::isItemPurchased($item_id, $item_type, $user_id);
}

function humanizeDate($target_date)
{
   $created = new \Carbon\Carbon($target_date);
   $now = \Carbon\Carbon::now();
   $difference = ($created->diff($now)->days < 1) ? getPhrase('today')
                                : $created->diffForHumans($now);
    return $difference;
}


function getTimeFromSeconds($seconds)
{
    return gmdate("H:i:s",$seconds);
}

function getRazorKey()
{
return env('RAZORPAY_APIKEY', 'rzp_test_A7YYdxPOae6Dpn');
}

function getRazorSecret()
{
return env('RAZORPAY_SECRET','j1ikm980d6Lxs4ZNceOv44Sz');
}

function getTheme()
{

  $theme_name  = 'default';

  $current_theme  = App\SiteTheme::where('is_active',1)->first();

  if($current_theme){
    $theme_name = $current_theme->theme_title_key;
  }
  //dd($theme_name);

  Theme::set($theme_name);
  return Theme::current();
}

function getDefaultTheme()
{
    $current_theme  = App\SiteTheme::where('is_active',1)->first();

    if($current_theme){

       $theme_name = $current_theme->theme_title_key;
       return $theme_name;
    }
    return FALSE;
}


function getThemeColor(){

  $current_theme  = App\SiteTheme::where('is_active',1)->first();

  return $current_theme->theme_color;

}

function getLangugesOptions(){

  $languages_data = array();
  $languages_data['Afrikanns'] = 'Afrikanns';
  $languages_data['Albanian'] = 'Albanian';
  $languages_data['Arabic'] = 'Arabic';
  $languages_data['Armenian'] = 'Armenian';
  $languages_data['Basque'] = 'Basque';
  $languages_data['Bengali'] = 'Bengali';
  $languages_data['Bulgarian'] = 'Bulgarian';
  $languages_data['Catalan'] = 'Catalan';
  $languages_data['Cambodian'] = 'Cambodian';
  $languages_data['Chinese'] = 'Chinese';
  $languages_data['Croation'] = 'Croation';
  $languages_data['Czech'] = 'Czech';
  $languages_data['Danish'] = 'Danish';
  $languages_data['Dutch'] = 'Dutch';
  $languages_data['Estonian'] = 'Estonian';
  $languages_data['French'] = 'French';
  $languages_data['German'] = 'German';
  $languages_data['Greek'] = 'Greek';
  $languages_data['Gujarati'] = 'Gujarati';
  $languages_data['Hebrew'] = 'Hebrew';
  $languages_data['Hindi'] = 'Hindi';
  $languages_data['Hungarian'] = 'Hungarian';
  $languages_data['Italian'] = 'Italian';
  $languages_data['Japanese'] = 'Japanese';
  $languages_data['Malayalam'] = 'Malayalam';
  $languages_data['Marathi'] = 'Marathi';
  $languages_data['Nepali'] = 'Nepali';
  $languages_data['Romanian'] = 'Romanian';
  $languages_data['Russian'] = 'Russian';
  $languages_data['Spanish'] = 'Spanish';
  $languages_data['Tamil'] = 'Tamil';
  $languages_data['Telugu'] = 'Telugu';
  $languages_data['Turkish'] = 'Turkish';
  $languages_data['Urdu'] = 'Urdu';
  $languages_data['Vietnamese'] = 'Vietnamese';

    return $languages_data;
}
function getAddress($transaction){
    $arr=json_decode($transaction,true);
    $msg='';
    $msg.='<address style="padding:12px;color:rgb(115,115,115);">';
    $msg.=$arr['first_name'].' '.$arr['last_name'].'<br>'.$arr['address'].' City<br>'.$arr['city'].'<br>'.$arr['zipcode'];
    $msg.='<br><a href="mailto:'.$arr['email'].'" target="_blank" data-mt-detrack-inspected="true" data-mt-detrack-attachment-inspected="true">';
    $msg.=$arr['email'].'</a>';
    $msg.='<br><a href="tel:'.$arr['phone'].'" target="_blank" data-mt-detrack-inspected="true" data-mt-detrack-attachment-inspected="true">';
    $msg.=$arr['phone'].'</a></address>';
    return $msg;
}

function RemoveDeletedItem() {
    $items = \Cart::getContent();
    foreach($items as $item) {
        $CourseObj  =  \App\LmsSeries::where("id", $item->id)->where("status", 1)->first();
        if($CourseObj) {

        } else {
            \Cart::remove($item->id);
        }

    }

    return true;
}

function RemoveCartItemFree() {
    $items = \Cart::getContent();
    foreach($items as $item) {
        $CourseObj  =  \App\LmsSeries::where("id", $item->id)->where("is_paid", 0)->first();
        if($CourseObj) {
            \Cart::remove($item->id);
        }

    }

    return true;
}

function getOrderTable($token,$transaction,$other_details,$cid=0){
    $discount=0;
    $arr=json_decode($transaction,true);
    $request=(object)$arr;
    $gateway=($request->gateway == "paypalpro") ? "PayPal Pro" : $request->gateway;
    $discount=$request->discount_availed;
    $subtotal=$request->actual_cost;

    $od_arr=json_decode($other_details,true);
    $od_request=(object)$od_arr;
    $currency_icon=$od_request->currency_icon;


    $ordercourses= App\UserCourses::select(['item_id','item_name','item_price','item_quantity','user_id'])
        ->where('payment_slug',$token)
        ->get();

    $msg='';
    //$subtotal=0;
    $total=0;
    //$discount='15';
    $msg.='<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:0;background-color:#fff;border:1px solid #E8E8E8;border-bottom:none;text-align:left;"><thead><tr>';
    $msg.='<th style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:8px 10px;color:#000;border-bottom:1px solid #E8E8E8;" >Course Name</th>';
    $msg.='<th style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:8px 10px;color:#000;border-bottom:1px solid #E8E8E8;">Quantity</th>';
    $msg.='<th style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:8px 10px;color:#000;border-bottom:1px solid #E8E8E8;">Price</th>';
    $msg.='</tr></thead><tbody>';

    foreach($ordercourses as $order){
        $msg.= '<tr><td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">Course :'.$order->item_name.'</td>';
        $msg.= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">'.$order->item_quantity.'</td>';
        $msg.= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">'.getCurrencyCode($currency_icon) . number_format((float)round($order->item_price,2), 2, '.', '').'</td>';
        $msg.= '</tr>';
        //$subtotal=(int)$subtotal+$order->item_price;


    }

    /************* if retake exam *************/
    if($cid != 0) {
        $coursesinfo= App\LmsSeries::where('id',$cid)->first();
        $msg.= '<tr><td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">Course :'.$coursesinfo->title.'</td>';
        $msg.= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">1</td>';
        $msg.= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">'.getCurrencyCode($currency_icon) . " " . ($subtotal-$discount).'</td>';
        $msg.= '</tr>';
    }
    /************* if retake exam *************/
    $total=$subtotal-$discount;
    $msg.= '<tr><td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">Subtotal :</td>';
    $msg.= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;"></td>';
    $msg.= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">'.getCurrencyCode($currency_icon) .number_format((float)round($subtotal,2), 2, '.', '').'</td>';
    $msg.= '</tr>';

    $msg.= '<tr><td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">Payment Gateway :</td>';
    $msg.= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;"></td>';
    $msg.= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">'.str_replace('p','P',$gateway).'</td>';
    $msg.= '</tr>';

    if($discount!=0) {
        $msg .= '<tr><td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">Discount : </td>';
        $msg .= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;"></td>';
        $msg .= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">' . getCurrencyCode($currency_icon) . number_format((float)round($discount,2), 2, '.', '') . '</td>';
        $msg .= '</tr>';
    }

    $msg .= '<tr><td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">Total : </td>';
    $msg .= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;"></td>';
    $msg .= '<td  style="font-family:\'Heebo\', sans-serif;font-size:16px;box-sizing:border-box;margin:0;padding:5px 10px;color:#3B3B3B;border-bottom:1px solid #E8E8E8;">' . getCurrencyCode($currency_icon) . number_format((float)round($total,2), 2, '.', '') . '</td>';
    $msg .= '</tr>';
    $msg.=  '</tbody></table>';


    return  $msg;
}

if ( ! function_exists('getInstructor')) {
    function getInstructor($uemail) {
        return App\Instructor::where("email", $uemail)->first();
    }
}

if ( ! function_exists('GetUserOnID')) {
    function GetUserOnID($id) {
        return App\User::find($id);
    }
}

if ( ! function_exists('GetRoleOnID')) {
    function GetRoleOnID($id) {
        return App\Role::find($id);
    }
}

if ( ! function_exists('CheckPermission')) {
    function CheckPermission($Role_id, $firstPart) {

        $resData = \App\Role::find($Role_id);

        if($resData->role_permission !== NULL) {
            if (strpos($resData->role_permission, $firstPart) === FALSE) {
                return true;
            }
        }
        return false;
    }
}

if ( ! function_exists('GetPromoBanner')) {
    function GetPromoBanner($BannerID = 1)
    {
        return \App\PromoBanner::find($BannerID);
    }
}


function getBrowserInfo(){
    $browserInfo = array('user_agent'=>'','browser'=>'','browser_version'=>'','os_platform'=>'','pattern'=>'', 'device'=>'');

    $u_agent = !isset($_SERVER['HTTP_USER_AGENT'])?'':$_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $ub = 'Unknown';
    $version = "";
    $platform = 'Unknown';

    $deviceType='Desktop';

    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$u_agent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($u_agent,0,4))){

        $deviceType='Mobile';

    }

    if($u_agent == 'Mozilla/5.0(iPad; U; CPU iPhone OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B314 Safari/531.21.10') {
        $deviceType='Tablet';
    }

    if(stristr($u_agent, 'Mozilla/5.0(iPad;')) {
        $deviceType='Tablet';
    }

    //$detect = new Mobile_Detect();

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';

    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';

    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the user agent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'IE';
        $ub = "MSIE";

    } else if(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";

    } else if(preg_match('/Chrome/i',$u_agent) && (!preg_match('/Opera/i',$u_agent) && !preg_match('/OPR/i',$u_agent)))
    {
        $bname = 'Chrome';
        $ub = "Chrome";

    } else if(preg_match('/Safari/i',$u_agent) && (!preg_match('/Opera/i',$u_agent) && !preg_match('/OPR/i',$u_agent)))
    {
        $bname = 'Safari';
        $ub = "Safari";

    } else if(preg_match('/Opera/i',$u_agent) || preg_match('/OPR/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";

    } else if(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";

    } else if((isset($u_agent) && (strpos($u_agent, 'Trident') !== false || strpos($u_agent, 'MSIE') !== false)))
    {
        $bname = 'Internet Explorer';
        $ub = 'Internet Explorer';
    }


    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];

        } else {
            $version= @$matches['version'][1];
        }

    } else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'user_agent' => $u_agent,
        'browser'      => $bname,
        'browser_version'   => $version,
        'os_platform'  => $platform,
        'pattern'   => $pattern,
        'device'    => $deviceType
    );
}