@extends(getLayout())
@section('header_scripts')
	<link href="{{CSS}}ajax-datatables.css" rel="stylesheet">
@stop
@section('content')

	<div id="page-wrapper">
		<div class="container-fluid">
			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li><a href="{{url('/')}}"><i class="mdi mdi-home"></i></a> </li>
						<li>{{ $title }}</li>
					</ol>
				</div>
			</div>

			<!-- /.row -->
			<div class="panel panel-custom">
				<div class="panel-heading">

					<div class="pull-right messages-buttons">
						<a href="{{URL_REVIEWS_ADD}}" class="btn  btn-primary button" >{{ getPhrase('create')}}</a>
					</div>
					<h1>{{ $title }}</h1>
				</div>
				<div class="panel-body packages">
					<div>
						@include('admin.message')


						<div class="view-instructor">
                    <div class="instructor-detail">
                    	<ul>
                    		<li><img src="{{ asset('images/instructor/'.$show->image) }}" class="img-circle"/></li>
                    		<li>{{ __('adminstaticword.Name') }}: {{ $show->fname }} {{ $show['lname'] }}</li>
                    		<li>{{ __('adminstaticword.Role') }}: {{ $show->role }}</li>
                    		<li>{{ __('adminstaticword.Phone') }}: {{ $show->mobile }}</li>
                    		<li>{{ __('adminstaticword.Email') }}: {{ $show->email }}</li>
                    		<li>{{ __('adminstaticword.DateofBirth') }}: {{ $show->dob }}</li>
                    		<li>{{ __('adminstaticword.Gender') }}: {{ $show->gender }}</li>
                    		<li>{{ __('adminstaticword.Detail') }}: {{ $show->detail }}</li>
                    		<li>{{ __('adminstaticword.Resume') }}: <a href="{{ asset('files/instructor/'.$show->file) }}" download="{{$show->file}}">{{ __('adminstaticword.Download') }} <i class="fa fa-download"></i></a></li>

                    	</ul>
                    </div>
          		</div>
	              

	            <form action="{{route('requestinstructor.update',$show->id)}}" method="POST" enctype="multipart/form-data">
	                {{ csrf_field() }}
	                {{ method_field('PUT') }}

	                <input type="hidden" value="{{ $show->user_id }}" name="user_id" class="form-control">
					        <input type="hidden" value="{{ $show->role }}" name="role" class="form-control">
                  <input type="hidden" value="{{ $show->mobile }}" name="mobile" class="form-control">
                  <input type="hidden" value="{{ $show->detail }}" name="detail" class="form-control">
                  <input type="hidden" value="{{ $show->gender }}" name="gender" class="form-control">
                  <input type="hidden" value="{{ $show->dob }}" name="dob" class="form-control">
                  <input type="hidden" value="{{ $show->image }}" name="image" class="form-control">

	              	<div class="row">
	                  <div class="col-md-6">
	                    
	                    <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
	                    <br>
	                    <li class="tg-list-item">
	                    <input class="tgl tgl-skewed" id="cb333" type="checkbox" {{ $show->status==1 ? 'checked' : '' }}>
	                    <label class="tgl-btn" data-tg-off="Pending" data-tg-on="Approved" for="cb333"></label>
	                    </li>
	                    <input type="hidden" name="status" value="{{ $show->status }}" id="c33">
		              </div>
	                  
	              	</div>
	              	<br>
	              	<button value="" type="submit"  class="btn btn-lg col-md-4 btn-primary">{{ __('adminstaticword.Save') }}</button>

	          	</form>
					</div>

				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>

@endsection


@section('footer_scripts')


@stop
