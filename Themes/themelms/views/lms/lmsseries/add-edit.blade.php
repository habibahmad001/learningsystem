@extends(getLayout())
<link href="{{CSS}}bootstrap-datepicker.css" rel="stylesheet">

<link href="{{themes('css/jquery.tagsinput-revisited.css')}}" rel="stylesheet">
<style>
    .table {width: 100% }
    form[editable-form] > div {margin: 10px 0;}

</style>
@section('content')
<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="/"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="{{URL_LMS_SERIES}}">LMS {{ getPhrase('series')}}</a></li>
							<li class="active">{{isset($title) ? $title : ''}}</li>
						</ol>
					</div>
				</div>
            @include('errors.errors', ["removeIT" => "removeDiv"])

				<!-- /.row -->
                <?php $settings = ($record) ? $settings : '';
                //$sections = ($record) ? $sections : '';
                ?>
 <div class="panel panel-custom col-lg-8 col-lg-offset-2" ng-init="initAngData('{{ $settings }}');"  >
 <div class="panel-heading">
     <div class="pull-right messages-buttons">
         @if ($record)
         <a href="{{URL_LMS_SERIES_ADDSECTIONS.$record->slug}}" class="btn  btn-info button" target="_blank">Edit Sections</a>
         <a href="{{URL_LMS_SERIES_UPDATE_SERIES.$record->slug}}" class="btn  btn-info button" target="_blank">Edit Units</a>
@endif
         <a href="{{URL_LMS_SERIES}}" class="btn btn-primary button">{{ getPhrase('list')}}</a>
     </div><h1>{{ $title }}  </h1></div>
 <div class="panel-body">
					<?php $button_name = getPhrase('create'); ?>
					@if ($record)
					 <?php $button_name = getPhrase('update'); ?>
						{{ Form::model($record, 
						array('url' => URL_LMS_SERIES_EDIT.$record->slug, 
						'method'=>'patch', 'files' => true, 'name'=>'formLms ','novalidate'=>'')) }}
					@else
						{!! Form::open(array('url' => URL_LMS_SERIES_ADD, 'method' => 'POST',  'files' => true, 'enctype' => 'multipart/form-data', 'name'=>'formLms ', 'novalidate'=>'')) !!}
					@endif
					

					 @include('lms.lmsseries.form_elements', 
					 array('button_name'=> $button_name),
					 array('record'=>$record,
					 'categories' => $categories,
					 'instructors' => $instructors,
					 'accredited_bodies' => $accredited_bodies,
					 'levels' => $levels))
					 		
					{!! Form::close() !!}




					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')
    @if($record)

    <script>
      var  video_file = '{{$record->video}}'
        $("#my-awesome-dropzone").dropzone({
            url : '{{route('upload-video',$record->id)}}',
            uploadMultiple: false,
            maxFilesize:50000,//mb
            maxFiles: 1,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            paramName: "video",
            addRemoveLinks: true,
            autoProcessQueue: true,
            acceptedFiles: ".mp4,.m4p,.m4v,.mkv,.avi,.webm,.mov,.flv",
            init: function() {
                myDropzone_video = this;

              if(video_file) {

                  var mockFile = {name: '{{$record->video}}', size:1};
                  myDropzone_video.options.addedfile.call(myDropzone_video, mockFile);
                  var src = '{{VIDEO_PATH_UPLOAD_LMS_SERIES.$record->video}}';

                  var videos = document.createElement('video');
                  videos.src = src;
                  videos.addEventListener('loadeddata', function () {
                      var canvas = document.createElement('canvas');
                      canvas.width = videos.videoWidth;
                      canvas.height = videos.videoHeight;
                      canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                      var dataURI = canvas.toDataURL('image/png');

                      myDropzone_video.emit("thumbnail", mockFile, dataURI);
                  });
                  myDropzone_video.emit("complete", mockFile);
                  myDropzone_video.disable();
              }
            },
            removedfile: function(file)
            {
                if (this.options.dictRemoveFile) {
                    return Dropzone.confirm("Are You Sure to "+this.options.dictRemoveFile, function() {
                        if(file.previewElement.id != ""){
                            var name = file.previewElement.id;
                        }else{
                            var name = file.name;
                        }
                        //console.log(name);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                            },
                            type: 'POST',
                            url: '{{route('delete-video',$record->id)}}',
                            data: {filename: name},
                            success: function (data){
                                alert(data.success +" File has been successfully removed!");
                                $('video').remove();
                                myDropzone_video.enable();
                            },
                            error: function(e) {
                                console.log(e);
                            }});
                        var fileRef;
                        return (fileRef = file.previewElement) != null ?
                            fileRef.parentNode.removeChild(file.previewElement) : void 0;
                    });
                }
            },
            success: function(file, response)
            {
                $('.lms_video').html('<video   width="320" height="240" controls autoplay src="{{VIDEO_PATH_UPLOAD_LMS_SERIES}}'+response.success+'"></video>')
            }

        });
        </script>
        @else
        <script>
        $("#my-awesome-dropzone").dropzone({
            url : '{{route('new-upload-video')}}',
            uploadMultiple: false,
            maxFilesize:50000,//mb
            maxFiles: 1,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            paramName: "video",
            addRemoveLinks: true,
            autoProcessQueue: true,
            acceptedFiles: ".mp4,.m4p,.m4v,.mkv,.avi,.webm,.mov,.flv",
            removedfile: function(file)

            {
                if (this.options.dictRemoveFile) {
                    return Dropzone.confirm("Are You Sure to "+this.options.dictRemoveFile, function() {
                        if(file.previewElement.id != ""){
                            var name = file.previewElement.id;
                        }else{
                            var name = file.name;
                        }
                        //console.log(name);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                            },
                            type: 'POST',
                            url: '{{url('lms/series/video/new/delete')}}'+'/'+name,
                            data: {filename: name},
                            success: function (data){
                                alert(data.success +" File has been successfully removed!");
                                $('video').remove();
                                $('input[name="new_vide0"]').val('');
                                myDropzone_video.enable();
                            },
                            error: function(e) {
                                console.log(e);
                            }});
                        var fileRef;
                        return (fileRef = file.previewElement) != null ?
                            fileRef.parentNode.removeChild(file.previewElement) : void 0;
                    });
                }
            },
            success: function(file, response)
            {
                //console.log(response);

                $('.lms_video').html('<input type="hidden" name="new_video" value="'+response.success+'"><video   width="320" height="240" autoplay src="{{VIDEO_PATH_UPLOAD_LMS_SERIES}}'+response.success+'"></video>')
            }
        });

              </script>
    @endif
        <script>

        $(document).on('change','.lms_parent_category_id',function (e) {
            e.preventDefault();
            var id = $(this).val();
            var token = '{{@csrf_token()}}';
            $.ajax({
                type: 'POST',
                url: '{{route('get-admin-sub-category')}}',
                data: {
                    '_token': token,
                    'id' : id,
                },
                success: function (data) {
                    $('.lms_sub_categories').html(data);

                },
            });
        });
    </script>
    @include('lms.lmsseries.scripts.js-scripts')
    @include('common.validations', array('isLoaded'=>'1'));
    @include('common.editor');
    @include('common.alertify')
    <!-- include summernote css/js -->
    {{--<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">--}}
    {{--<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>--}}


    <script src="{{JS}}datepicker.min.js"></script>
    <script>

        var file = document.getElementById('image_input');

        file.onchange = function(e){
            var ext = this.value.match(/\.([^\.]+)$/)[1];
            switch(ext)
            {
                case 'jpg':
                case 'jpeg':
                case 'png':


                    break;
                default:
                    alertify.error("{{getPhrase('file_type_not_allowed')}}");
                    this.value='';
            }
        };
        $('.input-daterange').datepicker({
            autoclose: true,
            startDate: "0d",
            format: '{{getDateFormat()}}',
        });
        var tagsArr = [];
        function loadTags() {
            $.ajax({
                url: "{{route('get-course-tags')}}",
                success: function(data) {
                    console.log(data);
                    tagsArr = data.split(',');
                    // console.log(tagsArr);
                    // testt=nameArr;
                    $('#course_tags').tagsInput({

                        'autocomplete': {
                            source: tagsArr
                        }

                    });
                }
            });
        }

        function removefaqs(itemID) {
            $("#faq_sec_item" + itemID).remove();
        }
        $(document).ready(function() {
            loadTags();

            $("#faqaddit").click(function() {
                var countval = $("#faqcount").val()+1;
                $("#faqcount").val(countval);
                $("#faq_sec").append('<div id="faq_sec_item'+countval+'">\n' +
                    '\t\t\t\t\t\t\t<fieldset class="form-group col-md-12 text-right">\n' +
                    '\t\t\t\t\t\t\t\t<button type="button" name="faqremoveit" id="faqremoveit" onclick="javascript:removefaqs('+countval+');" class="btn btn-xs btn-danger button">-</button>\n' +
                    '\t\t\t\t\t\t\t</fieldset>\n' +
                    '\t\t\t\t\t\t\t<fieldset class="form-group col-md-12" >\n' +
                    '\t\t\t\t\t\t\t\t<input type="text" name="question[]" id="question" class="form-control" placeholder="Question" />\n' +
                    '\t\t\t\t\t\t\t</fieldset>\n' +
                    '\t\t\t\t\t\t\t<fieldset class="form-group col-md-12">\n' +
                    '\t\t\t\t\t\t\t\t<textarea name="answer[]" id="answer" class="form-control" rows="5" placeholder="Answer"></textarea>\n' +
                    '\t\t\t\t\t\t\t</fieldset>\n' +
                    '\t\t\t\t\t\t</div>');
            });

        });

    </script>

    <script src="{{themes('js/jquery.tagsinput-revisited.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@stop