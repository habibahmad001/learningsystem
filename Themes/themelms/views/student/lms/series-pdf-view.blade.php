
<?php

$file_src = $content->file_path;

if($content->content_type=='file')

    $file_src = IMAGE_PATH_UPLOAD_LMS_CONTENTS.$content->file_path;


?>


<div class="series-video mt-10 text-center" >

@if($content->content_type=='file')
@php if($content->download_allowed=="0"){ $restrict="#toolbar=0&navpanes=0&scrollbar=1"; } else {$restrict="";}


        @endphp
        <div id="pdf1"></div>

        <script src="https://unpkg.com/pdfobject@2.2.6/pdfobject.min.js"></script>
        <script>

            var options = {
                page: 1,
                pdfOpenParams: {
                    view: "FitV"
                },
                height: "1000px"
            };

            PDFObject.embed("{{$file_src.$restrict}}", "#pdf1",options);
        </script>



       {{-- <object data="{{$file_src.$restrict}}" type="application/pdf" width="100%" height="1000px">
            <embed src="{{$file_src.$restrict}}" type="application/pdf" />
        </object>--}}


        {{--<iframe src="https://docs.google.com/viewer?url={{$file_src}}&embedded=true" width="800px" height="600px"></iframe>--}}


    @elseif($content->content_type=='iframe')

        @if (preg_match('/iframe/',$file_src))

            <?php echo $file_src; ?>

        @else

            <iframe width="100%" height="560" src="{{$file_src}}" frameborder="0" allowfullscreen>
            </iframe>

        @endif



    @endif



</div>

                            

 