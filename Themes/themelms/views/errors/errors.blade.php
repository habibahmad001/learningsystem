<?php //dd(Session::get('success')); ?>
@if(!empty($errors))
	@if($errors->any())

{{--@if(isset($errors))--}}
{{--@if(count($errors) > 0 )--}}
	<div class="alert alert-danger{!! (isset($removeIT)) ? " " . $removeIT : "" !!} msg_box">
		<span class="glyphicon glyphicon-remove" style="float: right; cursor: pointer;" onclick="javascript:$('.msg_box').slideUp(300)" aria-hidden="true"></span>
		@if(count($errors) == 1)
			<i class="fas fa-times-circle{!! (isset($removeIT)) ? " crossicon" : "" !!}" style="cursor: pointer;"></i> {{$errors->first()}}
		@else

			<ul>
				@foreach ($errors->all() as $error)
					<li><i class="fas fa-times-circle"></i> {{ $error }}</li>
				@endforeach
			</ul>
		@endif
	</div>
@endif
@endif

@if (Session::has('success'))
	<div class="alert alert-success">
		<i class="fas fa-check-circle"></i> {{ Session::get('success') }}
	</div>
@endif
 