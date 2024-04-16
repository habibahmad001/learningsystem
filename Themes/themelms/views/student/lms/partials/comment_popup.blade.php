<style>
    form#enquiry-form label {
        color: black;
    }
    #myModalRequest .modal-content{
        padding: 20px;
    }
</style>
<!-- Contact Form -->
{{--{!! Form::open(array('url'=>URL_SEND_CONTACTUS, 'name'=>'user-contact' ,'id'=>'enquiry-form','class'=>'contact-form-transparent'))  !!}--}}
<form id="comment-form_{{$content->id}}" name="comment-form" class="contact-form-transparent" action="">


<div class="form-group">
    {{--<label>Message <small>*</small></label>--}}
    <textarea name="message" id="message_{{$content->id}}" class="form-control required" required="" rows="5" placeholder="Enter Comment"></textarea>
</div>
<div class="form-group">
    <input name="form_botcheck" class="form-control" type="hidden" value="" />
    {{--<button type="submit" class="btn btn-primary btn-shadow">{{getPhrase('send_message')}}</button>--}}
    <button type="submit" id="sendEnquiry_{{$content->id}}"  data-course="{{$lms_series->id}}"  data-section="{{$section->id}}"  data-content="{{$content->id}}"  data-title="{{$lms_series->title}}" data-slug="{{$lms_series->slug}}" class="sendComment btn btn-dark btn-theme-colored btn-flat btn-block" data-loading-text="Please wait...">POST YOUR COMMENT</button>
</div>
</form>
{{--{!! Form::close() !!}--}}