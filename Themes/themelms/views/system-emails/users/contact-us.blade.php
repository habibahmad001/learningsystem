 @include('system-emails.header')
 
 <div class="row">
    <div class="col-lg-12" style="margin:65px 0px;">
	  <h5 class="text-center" style="font-size:20px;font-weight:600;">Contact Us Enquiry Details</h5>
	</div>
  </div>
   
   <div class="row">
    <div class="col-lg-12">
      <p style="font-size:20px;margin:11px 0;">Dear {{$user_name}}, </p>
      <p style="font-size:20px;margin:11px 0;">Greetings,</p>
  <p style="font-size:20px;margin:11px 0;">Below is detail of new contact us enquiry</p><br>
  <p style="font-size:20px;margin:11px 0;">User Details</p>
  
  <p style="font-size:20px;margin:11px 0;">Name : {{$name}}</p>
  <p style="font-size:20px;margin:11px 0;">Phone   : {{$number}}</p>
  <p style="font-size:20px;margin:11px 0;">Email    : {{$email}}</p>
  <p style="font-size:20px;margin:11px 0;">Subject  : {{$subject}}</p>
  <p style="font-size:20px;margin:11px 0;">Message  : {{$user_message}}</p>

<p style="font-size:20px;margin:11px 0;">Sincerely, </p>
<p style="font-size:20px;margin:11px 0;">Customer Support Services</p>

	</div>
   </div>

@include('system-emails.disclaimer')


