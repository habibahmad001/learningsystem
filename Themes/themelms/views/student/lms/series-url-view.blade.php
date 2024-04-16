 
<?php 

 	$file_src = $content->file_path;

	if($content->content_type=='url')

//        $file_src = IMAGE_PATH_UPLOAD_LMS_CONTENTS.$content->file_path;


?>

<div class="series-video mt-10 text-center">

@if($content->content_type=='url')

    <?php if(strpos($file_src,'drive')) { ?>
    <a target="_blank" href="{{$file_src}}" class="btn btn-success btn-lg">Open Drive Folder</a>
    <?php }else{ ?>
        <iframe src="{{$file_src . "/" . collect(request()->segments())->pull(1)}}" name="iframe_a" height="1000px" width="100%" title=""></iframe>
<?php } ?>
@elseif($content->content_type=='iframe')

   @if (preg_match('/iframe/',$file_src))

      <?php echo $file_src; ?>

   @else 

      <iframe width="100%" height="560" src="{{$file_src}}" frameborder="0" allowfullscreen>
      </iframe>

   @endif



@endif



</div>

                            

 