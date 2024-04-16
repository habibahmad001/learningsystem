
<script src="{{JS}}angular.js"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.5/angular.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.7.5/angular-messages.js"></script>--}}

<script src="{{JS}}ngStorage.js"></script>
<script src="{{JS}}angular-messages.js"></script>

<script src="{{JS}}xeditable.js"></script>


{{--
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="//rawgithub.com/angular-ui/ui-sortable/master/src/sortable.js"></script>--}}

<link href="{{CSS}}xeditable.css" rel="stylesheet">


<script >
    var app = angular.module('academia', ['ngMessages',"xeditable"]).constant("CSRF_TOKEN", '<?= csrf_token() ?>');;
</script>
@include('common.angular-factory',array('load_module'=> TRUE))

<script>



    /*app.controller('sortableController', function ($scope) {

        //sample data
        $scope.list = [
            {text: 'Item 1', value: 1},
            {text: 'Item 2', value: 2},
            {text: 'Item 3', value: 3},
            {text: 'Item 4', value: 4},
            {text: 'Item 5', value: 5}
        ];

        $scope.sortingLog = [];

        $scope.sortableOptions = {
            axis: 'y',
            update: function(e, ui) {
                var logEntry = $scope.list.map(function(i){
                    return i.value;
                }).join(', ');
                $scope.sortingLog.push('Update: ' + logEntry);
            },
            stop: function(e, ui) {
                // this callback has the changed model
                var logEntry = $scope.list.map(function(i){
                    return i.value;
                }).join(', ');
                $scope.sortingLog.push('Stop: ' + logEntry);
            }
        };

        var counter;
        $scope.addItem = function() {
            counter = $scope.list.length;
            $scope.list.push( { text:'Item ' + (counter+1), value: (counter+1) } );
        }
    });
*/
    app.run(function(editableOptions) {
        editableOptions.theme = 'bs3';
    });

    app.controller('EditableRowCtrl', function($scope, $filter, $http) {
        {{--@if ($sections)--}}
                @if(!empty($sections))
            $scope.sections = '{!! $sections !!}';
        console.log(JSON.parse($scope.sections));
        $scope.sections=JSON.parse($scope.sections);
        // $scope.sections = [
        //     {id: 1, section_name: 'awesome user1', status: 2, group: 4, groupName: 'admin'},
        //     {id: 2, section_name: 'awesome user2', status: undefined, group: 3, groupName: 'vip'},
        //     {id: 3, section_name: 'awesome user3', status: 2, group: null}
        // ];

        //
        $scope.edit_section=function(rowform,secid){
            rowform.$show();
            $scope.mode = secid

        }
        $scope.newSecFlag=false;
        $scope.addContents=function(rowform,secid){

            console.log($scope.lastSectionId);
            console.log(secid)
            if($scope.newSecFlag){
                secid=$scope.lastSectionId;
            }
            location.href='{{URL_LMS_SERIES_UPDATE_SERIES.$record->slug}}/'+secid
            {{--route = '{{URL_LMS_SERIES_UPDATE_SERIES.$record->slug}}/'+secid;--}}
            {{--console.log(secid);--}}
            {{--$http.get(route);--}}

        }
        $scope.saveSection = function(data, id) {
            //$scope.user not updated yet
            angular.extend(data, {id: id});
            //console.log($scope.mode);
            if($scope.mode=='edit')
                route = '{{URL_LMS_SERIES_UPDATESECTIONS.$record->slug}}';
            else
                route = '{{URL_LMS_SERIES_STORESECTIONS.$record->slug}}';
            //console.log($http.post(route, data));
            return $http.post(route, data).then(function(data){
                console.log(data.data);
                $scope.newSecFlag=true;
                $scope.lastSectionId=data.data;
                window.location.reload();
            });

        };

        // remove user
        $scope.removeSection = function(index,secid) {

            Swal.fire({

                title: "{{getPhrase('are_you_sure')}}?",

                text: "{{getPhrase('you_will_not_be_able_to_recover_this_record')}}!",

                icon: "warning",

                showCancelButton: true,

                confirmButtonClass: "btn-danger",
                //
                confirmButtonText: "{{getPhrase('yes').', '.getPhrase('delete_it')}}!",

                cancelButtonText: "{{getPhrase('no').', '.getPhrase('cancel_please')}}!",

                // closeOnConfirm: false,

                // closeOnCancel: false

            }).then((result) => {
                if (result.isConfirmed) {
                    var token = '{{ csrf_token()}}';
                    route = '{{URL_LMS_SERIES_DELETESECTIONS}}' + secid;
                    $.ajax({
                        url: route,
                        type: 'post',
                        data: {_method: 'delete', _token: token,secid:secid},
                        success: function (msg) {

                            console.log(msg);
                            result = $.parseJSON(msg);
                            //result = $.parseJSON(msg);
                            //console.log(result);
                            {{--result = $.parseJSON(msg);--}}

                                    {{--if(typeof result == 'object'){--}}
                                    {{--status_message = '{{getPhrase('deleted')}}';--}}
                                    {{--status_symbox = 'success';--}}
                                    {{--status_prefix_message = '';--}}
                                    {{--if(!result.status) {--}}
                                    {{--status_message = '{{getPhrase('sorry')}}';--}}
                                    {{--status_prefix_message = '{{getPhrase("cannot_delete_this_record_as")}}\n';--}}
                                    {{--status_symbox = 'info';--}}
                                    {{--}--}}
                                    {{--Swal.fire(--}}
                                    {{--status_message+"!",--}}
                                    {{--status_prefix_message+result.message,--}}
                                    {{--status_symbox--}}
                                    {{--)--}}

                                    {{--}--}}
                            if(result.status) {
                                Swal.fire("{{getPhrase('deleted')}}!", "{{getPhrase('your_record_has_been_deleted')}}", "success");

                                window.location.reload();
                            }else {
                                Swal.fire("{{getPhrase('error')}}!", result.message, "error");
                            }
                        }
                    });
                }
                ;
            });



        };

        // add section
        $scope.addSection = function() {
            $scope.inserted = {
                id: $scope.sections.length+1,
                section_name: '',
                status: null
            };
            $scope.sections.push($scope.inserted);
        };
        @endif
    });


    app.directive('validFile', function () {
        return {
            restrict: "A",
            require: "ngModel",
            link: function (scope,elem,attrs,ngModel) {

                elem.bind("change", function(e) {
                    console.log("change");
                    console.log(scope);
                    console.log(scope.formLms.image.$invalid);
                    console.log(scope.formLms.image.$valid);
                    scope.formLms.image.$invalid=false;
                    scope.formLms.image.$valid=true;
                    //scope.formLms.$valid=true;
                    console.log(scope.formLms.image.$invalid);
                    console.log(scope.formLms.image.$valid);
                    scope.$apply(function(){
                        ngModel.$valid=true;
                        ngModel.$invalid=false;

                    });
                });
            }
        };
    });
    /*app.controller('coursesController', function($scope) {



         $scope.initAngData = function(data) {

             if(data=='')
             {

                 return;
             }

             data=JSON.parse(data);


             $scope.sections = data.sections;




         }

         $scope.range = function(count) {
             var range = [];
             for (var i = 0; i < count; i++) {
                 range.push(i)
             }
             return range;
         }

         $scope.sectionsChanged = function(selected_number) {
             $scope.total_sections = selected_number;

         }

         $scope.getToken = function(){
             return  $('[name="_token"]').val();
         }

         //drag and drop section
         //sample data
         $scope.list = [
             {text: 'Item 1', value: 1},
             {text: 'Item 2', value: 2},
             {text: 'Item 3', value: 3},
             {text: 'Item 4', value: 4},
             {text: 'Item 5', value: 5}
         ];


         $scope.sortingLog = [];

         $scope.sortableOptions = {
             axis: 'y',
             update: function(e, ui) {
                 var logEntry = $scope.list.map(function(i){
                     return i.value;
                 }).join(', ');
                 $scope.sortingLog.push('Update: ' + logEntry);
             },
             stop: function(e, ui) {
                 // this callback has the changed model
                 var logEntry = $scope.list.map(function(i){
                     return i.value;
                 }).join(', ');
                 $scope.sortingLog.push('Stop: ' + logEntry);
             }
         };

         var counter;
         $scope.addItem = function() {
             counter = $scope.list.length;
             $scope.list.push( { text:'Item ' + (counter+1), value: (counter+1) } );
         }


     });*/
    app.controller('prepareQuestions', function( $scope, $http, httpPreConfig) {
        $scope.savedItems = [];
        $scope.savedSeries =  [];
        $scope.savedExams =[];
        $scope.total_items = 0;
        $scope.section_id = 0;

        $scope.initAngData = function(data) {
            //
            if(data === undefined)
                return;
            $scope.removeAll();

            if(data=='')
            {
                $scope.series   = [];
                return;
            }

            dta = data;
            $scope.savedSeries = dta.contents;
            $scope.setItem('saved_series', $scope.savedSeries);
            $scope.setItem('total_items', $scope.total_items);
        }

        $scope.categoryChanged = function(selected_number) {

            if(selected_number=='')
                selected_number = $scope.category_id;
            category_id = selected_number;
            if(category_id === undefined)
                return;
            route = '{{URL_LMS_SERIES_GET_SERIES}}';
            data= {_method: 'post', '_token':httpPreConfig.getToken(), 'category_id': category_id};

            httpPreConfig.webServiceCallPost(route, data).then(function(result){
                result = result.data;
                $scope.categoryItems = [];
                $scope.categoryItems = result.items;
                $scope.removeDuplicates();
            });
        }

        $scope.examCategoryChanged = function(selected_number) {

            if(selected_number=='')
                selected_number = $scope.exam_category_id;
            exam_category_id = selected_number;
            if(exam_category_id === undefined)
                return;
            route = '{{URL_LMS_SERIES_GET_EXAMS}}';
            data= {_method: 'post', '_token':httpPreConfig.getToken(), 'category_id': exam_category_id};

            httpPreConfig.webServiceCallPost(route, data).then(function(result){
                //console.log(result);
                result = result.data;
                $scope.categoryItems = [];
                $scope.categoryItems = result.items;
                $scope.seriesItems = [];
                console.log(result.exam_series);
                $scope.seriesItems = result.exam_series;
                $scope.removeDuplicates();
            });
        }


        $scope.examSeriesChanged = function(selected_number) {
            console.log('selected_number>>'+selected_number);
            if(selected_number=='')
                selected_number = $scope.exam_series_id;
            exam_series_id = selected_number;
            exam_category_id= $scope.exam_category_id;
            if(exam_series_id === undefined || exam_series_id == ""  )
                return;
            route = '{{URL_LMS_SERIES_GET_EXAMS}}';
            data= {_method: 'post', '_token':httpPreConfig.getToken(), 'category_id': exam_category_id, 'series_id': exam_series_id};
//console.log(data);
            //  console.log(selected_number.currentTarget.getAttribute("data-total_exams"));
            httpPreConfig.webServiceCallPost(route, data).then(function(result){

                result = result.data;
                $scope.categoryItems = [];
                $scope.categoryItems = result.items;
                //$scope.seriesItems = [];

                //  $scope.exam_series_id=result.exam_series_id;

                $scope.exam_series_type=result.exam_series_type;
                console.log(exam_series_id);
                //
                // if($scope.exam_series_type==true){
                //     console.log("checked>>"+$scope.exam_series_type);
                // }else{
                //     console.log("unchecked>>"+$scope.exam_series_type);
                // }


                // if($scope.exam_series_type=="Final")
                // if(!$scope.exam_series_type.target.checked){
                //     $scope.exam_series_type=true;
                // }


                //  $scope.seriesItems = result.exam_series;
                $scope.removeDuplicates();
            });
        }




        $scope.removeDuplicates = function(){

            if($scope.savedSeries.length<=0 )
                return;

            angular.forEach($scope.savedSeries,function(value,key){

                res = httpPreConfig.findIndexInData($scope.categoryItems, 'id', value.id);
                if(res >= 0)
                {
                    $scope.categoryItems.splice(res, 1);
                }

            });
        }


        {{--console.log('{{ Request::route('secid')}}');--}}
        if('{{ Request::route('secid') }}'!=''){
            $scope.section_id='{{ Request::route('secid') }}';

        }
        $scope.addToBag = function(item,section_id) {
            $scope.record2 = [];
            var record = item;


            if(section_id==""){
                section_id=$scope.section_id;

            }



            if(section_id === undefined || $("#lms_sections option:selected").html() === 'Select') {
                Swal.fire({
                    title: "Choose Section",
                    text: "First Choose the Section then add..",
                    type: "error",
                    confirmButtonText: "Ok"
                });
                return;
            }


            console.log(section_id);

            record['section_id']= section_id;
            record['section_name']= $("#lms_sections option:selected").html();
            record['content_type']=$scope.content_type;

            res = httpPreConfig.findIndexInData($scope.savedSeries, 'id', item.id);
            if(res == -1) {
                $scope.savedSeries.push(record);
                console.log(record);
                $scope.removeFromCategoryItems(item);
            }
            else
                return;

            console.log($scope.savedSeries);
            //Push record to storage
            $scope.setItem('saved_series', $scope.savedSeries);
        }

        var finalExamFlag=false;

        $scope.addToCourse = function(item,exam_series_type,exam_section_id) {
            var exam_type_txt="";
            console.log(item+'=='+exam_series_type+'==='+exam_section_id);
            var record = item;
            if(exam_series_type === undefined || exam_series_type === false){
                exam_type_txt='Other Exam';
            }else if(exam_series_type == "Mock"){
                exam_type_txt='Mock';
            }else{
                exam_type_txt='Final';
            }
            angular.forEach($scope.savedSeries,function(value,key){
                //console.log(value.exam_type);
                // if(value.exam_type=='Final' && exam_type!='0'){
                //     finalExamFlag=true;
                // }
            });

            // if(finalExamFlag && exam_type!='0'){
            //     swal({
            //         title: "Already Added Final Exam",
            //         text: "Only one Final Exam Allowed per course.",
            //         type: "error",
            //         confirmButtonText: "Ok"
            //     });
            //     return;
            // }
            // if(exam_type=='0'){
            //     record['exam_type']= 'Mock';
            // }else{
            //     record['exam_type']= 'Final';
            //     finalExamFlag=true;
            // }
            record['exam_type']= exam_type_txt;
            record['exam_series_id']= exam_series_id;
            if(exam_section_id === undefined || exam_section_id === ""){
                exam_section_id=0;
            }
            record['section_id']= exam_section_id;



            res = httpPreConfig.findIndexInData($scope.savedSeries, 'id', item.id);
            if(res == -1) {
                $scope.savedSeries.push(record);

                $scope.removeFromCategoryItems(item);
            }
            else
                return;
            console.log( $scope.savedSeries);
            //Push record to storage
            $scope.setItem('saved_series', $scope.savedSeries);
        }



        $scope.removeFromCategoryItems = function(item) {
            var index = $scope.categoryItems.indexOf(item);
            $scope.categoryItems.splice(index, 1);
        }

        $scope.addToCategoryItems = function(item) {

            if($scope.categoryItems.length) {

                if($scope.categoryItems[0].subject_id != item.subject_id)
                    return;

                res = httpPreConfig.findIndexInData($scope.savedSeries, 'id', item.id)

                if(res == -1)
                    $scope.categoryItems.push(item);
                return;
            }
            $scope.categoryChanged($scope.category_id);
        }


        /**
         * Set item to local storage with the sent key and value
         * @param {[type]} $key   [localstorage key]
         * @param {[type]} $value [value]
         */
        $scope.setItem = function($key, $value){
            localStorage.setItem($key, JSON.stringify($value));
        }

        /**
         * Get item from local storage with the specified key
         * @param  {[type]} $key [localstorage key]
         * @return {[type]}      [description]
         */
        $scope.getItem = function($key){
            return JSON.parse(localStorage.getItem($key));
        }

        /**
         * Remove question with the sent id
         * @param  {[type]} id [description]
         * @return {[type]}    [description]
         */


        $scope.removeItem = function(record){

            $scope.savedSeries = $scope.savedSeries.filter(function(element){
                if(element.id != record.id)
                    return element;
            });

            $scope.setItem('saved_series', $scope.savedSeries);
            $scope.addToCategoryItems(record);
        }

        $scope.removeAll = function(){
            $scope.savedSeries = [];
            $scope.totalQuestions       = 0;
            $scope.setItem('saved_questions', $scope.savedSeries);
            $scope.setItem('total_questions', $scope.totalQuestions);
            $scope.categoryChanged($scope.category_id);
        }



    }  );

    app.filter('cut', function () {
        return function (value, wordwise, max, tail) {
            if (!value) return '';

            max = parseInt(max, 10);
            if (!max) return value;
            if (value.length <= max) return value;

            value = value.substr(0, max);
            if (wordwise) {
                var lastspace = value.lastIndexOf(' ');
                if (lastspace != -1) {
                    //Also remove . and , so its gives a cleaner result.
                    if (value.charAt(lastspace-1) == '.' || value.charAt(lastspace-1) == ',') {
                        lastspace = lastspace - 1;
                    }
                    value = value.substr(0, lastspace);
                }
            }

            return value + (tail || ' …');
        };
    });




    app.controller('sortableController', function ($scope) {


    });



</script>
