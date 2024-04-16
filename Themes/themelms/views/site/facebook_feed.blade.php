@extends('layouts.sitelayout')
@section('content')
    <div class="main-content inner_pages">

        <section class="thankyou_section pt-60 pb-60">
            <div class="container text-center">
                <img src="<?=UPLOADS?>images/thanksyou.png" class="">


                <?php


                $updated_date=date('l jS \of F Y h:i:s A');

                $sitemap = '<?xml version="1.0"?>';

                $sitemap .= '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">';
                $sitemap .= '<channel>';
                $sitemap .= '<title>Facebook Catalog Feed Updated: '.$updated_date.'</title>';
                $sitemap .= '<link>https://www.nextleanacademy.com/</link>';
                $sitemap .= '<description>facebook products feed</description>';

                // $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
                echo "<div class='row'>";
                foreach($allseries as $series) {


                    $cimage=$series->image;
                    if(strpos($cimage,'.jpeg')){
                        if (@getimagesize(IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage)){
                            $cimage=$series->image;

                        }else{
                            $cimage=str_replace('jpeg','jpg',$cimage);
                        }
                    }

                    // $product=wc_get_product($product_id);
                    $product_price=  $series->cost;
                    //$product->get_sale_price();
                    // $product_price=23;
                    if(!$product_price) continue;
                    echo "<div class='col-md-3 btn pb-5'>".$series->id.': '.$series->title." <i class='fas fa-check'></i></div>";

                    $sitemap .= '<item>'.

                        '<g:id>'. $series->id .'</g:id>'.
                        '<g:title>'. preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;',  $series->title) .'</g:title>'.
                        '<g:link>'. URL_VIEW_LMS_CONTENTS.$series->slug .'</g:link>'.
                        '<g:image_link><![CDATA[ '.IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage.' ]]></g:image_link>'.
                        '<additional_image_link>'.IMAGE_PATH_UPLOAD_LMS_SERIES_WIDGET.$cimage.'</additional_image_link>'.
                        '<g:description><![CDATA[ '.trim(strip_tags(preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $series->description))).' ]]></g:description>'.
                        '<g:price>'.$product_price.' GBP</g:price>'.
                        '<g:availability>in stock</g:availability>'.
                        '<g:condition><![CDATA[ New ]]></g:condition>'.
                        '<g:brand><![CDATA[ Next Learn Academy ]]></g:brand>'.
                        '<g:product_type><![CDATA[ '.getAccreditedBy($series->id).' ]]></g:product_type>'.
                        '<g:google_product_category>'. preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', getCourseCategory($series->id)).'</g:google_product_category>'.
                        '</item>';
                }
                echo "</div>";
                $sitemap .= '</channel>';
                $sitemap .= '</rss>';
                $filePath = env('FEED_URL');
                if (env('FILESYSTEM_DRIVER') == 's3') {

                    Storage::disk('s3')->put($filePath,  $sitemap,'public');
                }

               // file_put_contents($file, $sitemap);
                //$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/public/facebook_feed.xml", 'w');
                //fwrite($fp, $sitemap);
                //fclose($fp);
               ?>
                <h4>Your Facebook Data Feed is Complete!</h4>

               <h2>ALL DONE  <a href="{{UPLOADS.$filePath}}" target='_blank'>View Here</a> </h2>

                <p>If you have any further questions, feel free to contact us through <a href="mailto:info@nextlearnacademy.com">info@nextlearnacademy.com</a>
                    or use instant chat on our website for quick support. or else you can contact our hotline:<a href="tel:+442081269090">+44 208 126 9090</a>
                    Our support lines are available <u>Monday-Friday</u> between the hours of <u>8.00 – 17.00</u> in UK time.</p>


                <div class="text-center links-social">
                    <span>Follow us</span>
                    <a href="https://www.facebook.com/nextlearnacademy" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/NextLearnUK" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/nextlearnacademy/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/nextlearnacademy" target="_blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                </div>

            </div>
        </section>


    </div>
@stop
@section('footer_scripts')
    <script>

    </script>
@endsection