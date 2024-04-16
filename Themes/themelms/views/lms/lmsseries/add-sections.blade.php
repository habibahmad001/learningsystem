@extends(getLayout())
<link href="{{CSS}}bootstrap-datepicker.css" rel="stylesheet">
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
					@include('errors.errors')
				<!-- /.row -->
                <?php $settings = ($record) ? $settings : ''; ?>
 <div class="panel panel-custom col-lg-8 col-lg-offset-2" ng-init="initAngData('{{ $settings }}');" >
 <div class="panel-heading">
     <div class="pull-right messages-buttons">
         <a href="{{URL_LMS_SERIES}}" class="btn btn-primary button">{{ getPhrase('list')}}</a>
     </div><h1>{{ $title }}  </h1></div>
 <div class="panel-body">


                        <div class="row">
                            <fieldset class="form-group col-md-6">



                                {{ Form::label('title', getphrase('course_title')) }}
                                {{isset($record) ? $record['title'] : ''}}





                            </fieldset>
                            <fieldset class="form-group col-md-6">

                                {{ Form::label('course_code', getphrase('course_code')) }}
                                {{isset($record) ? $record['course_code'] : ''}}




                            </fieldset>
                        </div>



                        <div ng-controller="EditableRowCtrl">
                            <table class="table table-striped table-bordered datatable r_s_h" >
                                <tr style="font-weight: bold">
                                    <td style="width:35%">Name</td>

                                    <td style="width:25%">Edit</td>
                                </tr>
                                <tr ng-repeat="section in sections  track by $index">
                                    <td>
                                        <!-- editable username (text with validation) -->
                                        <span editable-text="section.section_name" e-name="section_name" e-form="rowform">
          @{{ section.section_name || 'empty' }}
        </span>
                                    </td>


                                    <td style="white-space: nowrap">


                                        {{--{!! Form::open(array('url' => URL_LMS_SERIES_ADD, 'method' => 'POST',   'files' => true,   'name'=>'formLms ', 'class'=>"form-buttons form-inline" , 'novalidate'=>'','editable-form' )) !!}--}}


                                        <form editable-form name="rowform" onbeforesave="saveSection($data , section.id)" ng-show="rowform.$visible" class="form-buttons form-inline" shown="inserted == section">
                                            <button type="submit" ng-disabled="rowform.$waiting" class="btn btn-primary">Save</button>
                                            <button type="button" ng-disabled="rowform.$waiting" ng-click="rowform.$cancel()" class="btn btn-default">Cancel</button>
                                            {!! Form::close() !!}
                                        <div class="buttons" ng-show="!rowform.$visible">
                                            <button type="button" class="btn btn-primary" ng-click="edit_section(rowform,'edit')">Edit</button>
                                            <button type="button" class="btn btn-danger" ng-click="removeSection($index,section.id)">Delete</button>
                                            <button type="button" class="btn btn-primary" ng-click="addContents($index,section.id)">Assign Contents</button>

                                        </div>
                                        </form>
                                    </td>
                                </tr>
                            </table>

                            <button type="button" class="btn btn-primary" ng-click="addSection()">Add New Section</button>
                        </div>


					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
@stop
@section('footer_scripts')
    @include('lms.lmsseries.scripts.js-scripts')
    @include('common.validations', array('isLoaded'=>'1'));

    @include('common.alertify')

@stop