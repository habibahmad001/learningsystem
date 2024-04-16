@extends($layout)
@section('content')
	<style>
		li {
			display: block;
			line-height: 25px;
		}
	</style>
	<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<ol class="breadcrumb">
					<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
					@if(checkRole(getUserGrade(2)))
						<li><a href="{{URL_INSTRUCTORS}}">{{ getPhrase('users')}}</a> </li>
						<li class="active">{{isset($title) ? $title : ''}}</li>
					@else
						<li class="active">{{$title}}</li>
					@endif
				</ol>
			</div>
		</div>
	@include('errors.errors')
	<!-- /.row -->

		<div class="panel panel-custom col-lg-6  col-lg-offset-3">
			<div class="panel-heading">
				@if(checkRole(getUserGrade(2)))
					<div class="pull-right messages-buttons"><a href="{{URL_INSTRUCTORS_APPLICATIONS}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a></div>
				@endif
				<h1>{{ $title }}  </h1>
			</div>

			<div class="panel-body form-auth-style">
                
					<section class="content">
						@include('admin.message')
						<div class="row">
							<div class="col-md-12">
								<div class="box box-primary">
									<div class="box-header with-border">
										<h3 class="box-title">{{ getPhrase('Instructor Application Request') }}</h3>
									</div>
									<div class="panel-body">
										<div class="row">
										<div class="view-instructor col-md-8">
											<div class="instructor-detail">
												<ul>
													<li><img src="{{ IMAGE_PATH_INSTRUCTOR.$show->image }}" width="200" height="auto" class="img-circle"/></li>
													<li>{{ getPhrase('Name') }}: {{ $show->fname }} {{ $show['lname'] }}</li>
													<li>{{ getPhrase('Role') }}: {{ $show->role }}</li>
													<li>{{ getPhrase('Phone') }}: {{ $show->mobile }}</li>
													<li>{{ getPhrase('Email') }}: {{ $show->email }}</li>
													<li>{{ getPhrase('Subject') }}: {{ $show->subject }}</li>
													{{--<li>{{ getPhrase('DateofBirth') }}: {{ $show->dob }}</li>--}}
													{{--<li>{{ getPhrase('Gender') }}: {{ $show->gender }}</li>--}}
													<li>{{ getPhrase('Detail') }}: {{ $show->detail }}</li>
													<li>{{ getPhrase('Resume') }}: <a target="_blank" href="{{ RESUME_PATH_INSTRUCTOR.$show->file }}" download="{{$show->file}}">{{ getPhrase('Download & Review Resume') }} <i class="fa fa-download"></i></a></li>

												</ul>
											</div>
										</div>

											<div class="view-instructor col-md-4">
										<form action="{{route('requestinstructor.update',$show->id)}}" method="POST" enctype="multipart/form-data">
											{{ csrf_field() }}
											{{ method_field('PUT') }}

											<input type="hidden" value="{{ $show->user_id }}" name="user_id" class="form-control">
											<input type="hidden" value="{{ $show->fname }}" name="fname" class="form-control">
											<input type="hidden" value="{{ $show->lname }}" name="lname" class="form-control">
											<input type="hidden" value="{{ $show->id }}" name="ins_id" class="form-control">
											<input type="hidden" value="{{ $show->username }}" name="username" class="form-control">
											<input type="hidden" value="{{ $show->email }}" name="email" class="form-control">
											<input type="hidden" value="{{ $show->role }}" name="role" class="form-control">
											<input type="hidden" value="{{ $show->mobile }}" name="mobile" class="form-control">
											<input type="hidden" value="{{ $show->detail }}" name="detail" class="form-control">
											<input type="hidden" value="{{ $show->gender }}" name="gender" class="form-control">
											<input type="hidden" value="{{ $show->dob }}" name="dob" class="form-control">
											<input type="hidden" value="{{ $show->image }}" name="image" class="form-control">


											<div class="row">
												<fieldset class="form-group si setting-checkbox   mt-60 " style="margin-top: 100px;">
													<label  >Approve Instructor
														<input type="checkbox"
															   data-toggle="toggle"
															   data-onstyle="success"
															   data-offstyle="default"
															   name="approve_status"
															   id="approve_status"
															   class="toggle btn btn-success" {{$show->status==1?'checked':''}}
															   >
													</label>

												</fieldset>
											</div>

												{{--<div class="col-md-6">

													<label for="exampleInputTit1e">{{ getPhrase('Status') }}:</label>
													<br>
													<li class="tg-list-item">
														<input class="tgl tgl-skewed" id="cb333" type="checkbox" {{ $show->status==1 ? 'checked' : '' }}>
														<label class="tgl-btn" data-tg-off="Pending" data-tg-on="Approved" for="cb333"></label>
													</li>
													<input type="hidden" name="status" value="{{ $show->status }}" id="c33">
												</div>--}}
											<div class="row">
												<div class="buttons text-center">
											<button value="" type="submit"  class="btn btn-lg   btn-primary button">{{ getPhrase('Save') }}</button>
												</div>
											</div>
										</form>
											</div>
											</div>


									</div>
								</div>
							</div>
						</div>
					</section>


			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
@section('footer_scripts')
	@include('common.validations')
	@include('common.alertify')
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function() {
        $('#approve_status').bootstrapToggle({{$show->status==1?'on':'off'}});


    })
</script>
@stop


