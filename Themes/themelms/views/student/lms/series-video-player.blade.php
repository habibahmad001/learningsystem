 
<?php 

	$video_src = $content->file_path;

	if($content->content_type=='video')

    $video_src = IMAGE_PATH_UPLOAD_LMS_CONTENTS.$content->file_path;

?>

<div class="series-video mt-10">

@if($content->content_type=='video' || $content->content_type=='video_url' || $content->content_type=='audio')

        @if (strpos($video_src,'/player.vimeo.com/video/'))

            @if (strpos($video_src,'/player.vimeo.com/video/') && strpos($video_src,'iframe') )
                {!! str_replace('width="500" height="281"','width="100%" scrolling="yes" frameborder="0"',$video_src) !!}
            @else

                <iframe title="vimeo-player" src="{{$video_src}}" width="100%" scrolling="yes"  frameborder="0" allowfullscreen></iframe>
            @endif
        @else
     <video id="my-video" class="video-js vjs-big-play-centered" autoplay controls preload="auto" width="300" height="264"
          poster="" data-setup='{"aspectRatio":"640:267", "playbackRates": [1, 1.5, 2] }'>
            <source src="{{$video_src}}" type='video/mp4'>
            <p class="vjs-no-js">
              To view this video please enable JavaScript, and consider upgrading to a web browser that

              <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>

            </p>

    </video>
        @endif

@elseif($content->content_type=='iframe')

   @if (preg_match('/iframe/',$video_src))

      <?php
            $sources = get_iframe_src( $video_src );

            foreach( (array) $sources as $source ) {
                $video_url=$source . PHP_EOL;
            }

         ?>

          <iframe  width="100%" scrolling="yes" frameborder="0" src="{{$video_url}}" >
          </iframe>
   @else 

      <iframe   width="100%" scrolling="yes" frameborder="0" src="{{$video_src}}" >
      </iframe>

   @endif



@endif

<?php

    /**
     * Grab all iframe src from a string
     */
    function get_iframe_src( $input ) {
        preg_match_all("/<iframe[^>]*src=[\"|']([^'\"]+)[\"|'][^>]*>/i", $input, $output );
        $return = array();
        if( isset( $output[1][0] ) ) {
            $return = $output[1];
        }
        return $return;
    }

    ?>

</div>

<style>
    html, body, iframe { height: 100%; }
</style>