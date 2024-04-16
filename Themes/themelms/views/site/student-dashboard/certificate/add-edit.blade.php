@extends('layouts.sitelayout')
<style>
	.social-btns .btn .fa {line-height: 40px;}
</style>
@section('content')
	@include('site.partials.student_topBar')

	<div class="student__dashboard">
		<div class="container">
			<div class="row">
				@include('site.partials.student_nav')
				<div class="col-lg-9 col-md-8">
					<div class="extra-space-30"></div>

					<div class="panel panel-custom">
						<div class="panel-heading">
							<div class="right-buttons">{{--<a href="{{URL_PAGES}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a>--}}</div>
							<h3>{{ $title }}</h3>
						</div>
						<div class="panel-body" >
							<?php $button_name = getPhrase('create'); ?>
								@if ($record)
									<?php $button_name = getPhrase('update'); ?>
										{!! Form::open(array('url' => URL_CERTIFICATES_VIEW . collect(request()->segments())->last(), 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id'=>'frmmark', 'name'=>'frmmark', 'novalidate'=>'')) !!}
								@else
									{!! Form::open(array('url' => URL_CERTIFICATES_ADD, 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id'=>'frmmark', 'name'=>'frmmark', 'novalidate'=>'')) !!}
								@endif
								@include('certificate.form_elements',
								array('button_name'=> $button_name),
								array('record'=> $record))
								{!! Form::close() !!}
						</div>
					</div>

					<div class="extra-space-30"></div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('footer_scripts')
@include('common.validations')
@include('common.editor')
@include('common.alertify')
	<script language="javascript">
		$(function () {
			opts = $('#optlist option').map(function () {
				return [[this.value, $(this).text()]];
			});
			opts1 = $('#optlist1 option').map(function () {
				return [[this.value, $(this).text()]];
			});

			/***** Script for course on cat **********/
			$(".catField").click(function(){
				var catID	=	$(this).data("cid");
				if($("#" + catID + ":checkbox:checked").length > 0) {
					$.get("<?php echo URL::to('/offer/courseonid'); ?>/" + catID, function(data){

						if(typeof data != 'undefined'){
							$("#optlist").append(data);
						}
					});
				} else {
					$.get("<?php echo URL::to('/offer/removecourse'); ?>/" + catID, function(data){

						if(typeof data != 'undefined'){
							for(var i=0; i<=JSON.parse(data).length; i++) {
								$("#optlist option#" + JSON.parse(data)[i]).remove();
							}
						}
					});
				}

			});
			/***** Script for course on cat **********/

			$('#someinput').keyup(function () {

				var rxp = new RegExp($('#someinput').val(), 'i');
				var optlist = $('#optlist').empty();
				opts.each(function () {
					if (rxp.test(this[1])) {
						optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
					} else{
						optlist.append($('<option/>').attr('value', this[0]).text(this[1]).addClass("hidden"));
					}
				});
				$(".hidden").toggleOption(false);

			});
			$('#someinput1').keyup(function () {

				var rxp = new RegExp($('#someinput1').val(), 'i');
				var optlist = $('#optlist1').empty();
				opts1.each(function () {
					if (rxp.test(this[1])) {
						optlist.append($('<option/>').attr('value', this[0]).text(this[1]));
					} else{
						optlist.append($('<option/>').attr('value', this[0]).text(this[1]).addClass("hidden"));
					}
				});
				$(".hidden").toggleOption(false);

			});
			$('.select-cities').click(function () {
				$('.select-cities option:selected').remove().appendTo('.chosen-cities');
				opts = $('#optlist option').map(function () {
					return [[this.value, $(this).text()]];
				});
				opts1 = $('#optlist1 option').map(function () {
					return [[this.value, $(this).text()]];
				});
			});

			$('.chosen-cities').click(function () {
				$('.chosen-cities option:selected').remove().appendTo('.select-cities');
				opts = $('#optlist option').map(function () {
					return [[this.value, $(this).text()]];
				});
				opts1 = $('#optlist1 option').map(function () {
					return [[this.value, $(this).text()]];
				});
			});


		});

		jQuery.fn.toggleOption = function( show ) {
			jQuery( this ).toggle( show );
			if( show ) {
				if( jQuery( this ).parent( 'span.toggleOption' ).length )
					jQuery( this ).unwrap( );
			} else {
				if( jQuery( this ).parent( 'span.toggleOption' ).length == 0 )
					jQuery( this ).wrap( '<span class="toggleOption" style="display: none;" />' );
			}
		};
	</script>
@stop
 
 