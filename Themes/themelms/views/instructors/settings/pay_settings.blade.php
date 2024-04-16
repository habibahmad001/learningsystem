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
					</div>
					<h1>{{ $title }}</h1>
				</div>
	          	<div class="panel-body">
	          		<form action="{{ route('instructor.payout', $user->id) }}" method="POST">
		                {{ csrf_field() }}
		                {{ method_field('POST') }}


		            <div class="row">
	                  <div class="col-md-6">
	                    <label for="type">{{ getPhrase('Type') }}:<sup class="redstar">*</sup></label>
	                    <select name="type" id="paytype" class="form-control js-example-basic-single" required >
	                      <option value="none" selected disabled hidden >{{ getPhrase('Choose Payment Type') }}</option>

	                      @if($isetting['paytm_enable'] == 1)
	                      	<option {{ $user->prefer_pay_method == 'paytm' ? 'selected' : ''}} value="paytm">{{ getPhrase('Paytm') }}</option>
	                      @endif
	                      @if($isetting['paypal_enable'] == 1)
	                      <option {{ $user->prefer_pay_method == 'paypal' ? 'selected' : ''}} value="paypal">{{ getPhrase('Paypal') }}</option>
	                      @endif
	                      @if($isetting['bank_enable'] == 1)
	                      <option {{ $user->prefer_pay_method == 'banktransfer' ? 'selected' : ''}} value="bank">{{ getPhrase('Bank Transfer') }}</option>
	                      @endif
	                    </select>
	                  </div>
	              	</div>
	            	<br>
					
						
		              
		         
                        <div class="row">
			                <div class="col-md-6">

			                	<div id="paypalpayment"  >
			                	
{{--			                	<h5 class="box-title">{{ getPhrase('PAYPAL PAYMENT') }}</h5>--}}
			                    <label for="pay_cid">{{ getPhrase('Paypal Email') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user['paypal_email'] }}" autofocus name="paypal_email" type="text" class="form-control" placeholder="Enter Paypal Email"/>
			                    <br>
			                </div>
			                </div>

		              	</div>
		              	<br>
		             

						
		              
                        <div class="row ">
			                <div class="col-md-6">

			                	<div id="paytmpayment"  >
{{--			                	<h5 class="box-title">{{ getPhrase('PAYTM PAYMENT') }}</h5>--}}
			                    <label for="pay_cid">{{ getPhrase('Paytm Mobile No') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user['paytm_mobile'] }}" autofocus name="paytm_mobile" type="text" class="form-control" placeholder="Enter Paytm Mobile No"/>
			                    <br>
			                </div>
			                </div>

		              	</div>
		              	<br>
						
		           
		              
                        <div class="row">

                        	<div id="bankpayment" >



			                <div class="col-md-6">

			                    <label for="pay_cid">{{ getPhrase('Account Holder Name') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user->bank_acc_name }}" autofocus name="bank_acc_name" required type="text" class="form-control" placeholder="Enter Account Holder Name"/>
			                    <br>
			                </div>

			                <div class="col-md-6">
			                    <label for="pay_cid">{{ getPhrase('Bank Name') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user->bank_acc_no }}" autofocus name="bank_acc_no" required type="text" class="form-control" placeholder="Enter Bank Name"/>
			                    <br>
			                </div>

			                <div class="col-md-6">
			                    <label for="pay_cid">{{ getPhrase('IBAN Code') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user->iban_code }}" autofocus name="iban_code" required type="text" class="form-control" placeholder="Enter IBAN 24 Digits Code"/>
			                    <br>
			                </div>

			                <div class="col-md-6">
			                    <label for="pay_cid">{{ getPhrase('Account Number') }}<sup class="redstar">*</sup></label>
			                    <input value="{{ $user->bank_name }}" autofocus name="bank_name" required type="text" class="form-control" placeholder="Enter Account Number"/>
			                    <br>
			                </div>
			            </div>

		              	</div>
		              	<br>
		              	<br>

		                   

						
						<div class="box-footer">
		              		<button value="" type="submit"  class="btn btn-md col-md-3 btn-primary">{{ getPhrase('Save') }}</button>
		              	</div>

		          	</form>
	          	</div> </div>
		</div>
		<!-- /.container-fluid -->
	</div>

@endsection


@section('footer_scripts')

	<script type="text/javascript">
        $(document).ready(function(){

            if($('#paytype').val() == 'paytm')
            {
                $('#paytmpayment').show();
                $('#paypalpayment').hide();
                $('#bankpayment').hide();

            }
            else if($('#paytype').val() == 'paypal')
            {
                $('#paytmpayment').hide();
                $('#paypalpayment').show();
                $('#bankpayment').hide();

            }
            else if($('#paytype').val() == 'bank')
            {
                console.log("bank");
                $('#bankpayment').show();
                $('#paypalpayment').hide();
                $('#paytmpayment').hide();

            }

        });
        $('#paytype').change(function() {

            if($(this).val() == 'paytm')
            {
                $('#paytmpayment').show();
                $('#paypalpayment').hide();
                $('#bankpayment').hide();

            }
            else if($(this).val() == 'paypal')
            {
                $('#paytmpayment').hide();
                $('#paypalpayment').show();
                $('#bankpayment').hide();

            }
            else if($(this).val() == 'bank')
            {
                console.log("bank");
                $('#bankpayment').show();
                $('#paypalpayment').hide();
                $('#paytmpayment').hide();

            }
        });


	</script>


@stop


