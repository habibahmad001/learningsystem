<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css"> -->
<!-- <link href="//cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" type="text/css"> -->
<link href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" type="text/css">
<link href="//cdn.datatables.net/buttons/1.5.3/css/buttons.dataTables.min.css" type="text/css">



<!-- <script src="{{themes('js/bootstrap-toggle.min.js')}}"></script> -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- <script src="{{themes('js/jquery.dataTables.min.js')}}"></script> -->
<!-- <script src="{{themes('js/dataTables.bootstrap.min.js')}}"></script> -->
{{--https://code.jquery.com/jquery-3.5.1.js--}}
{{--https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js--}}
{{--<script src="//code.jquery.com/jquery-3.5.1.js"></script>--}}
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

<!-- <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script> -->
<script src="//cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>

<!-- <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script> -->

<script src="//cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.38/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.38/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>





<?php  $routeValue= $route; ?>

@if(!isset($route_as_url))
    {
    <?php  $routeValue =  route($route); ?>
    }
@endif

<?php

$setData = array();
$colnames=json_decode($colnames);
if(isset($colnames))
{
    foreach($colnames as $col) {
        //	$temp['data'] = $col;
        //$temp['name'] = $col;
        array_push($setData, $col);
    }
    $setData = json_encode($setData);
}



?>
<style>

    .print_btn{
        background-color: #438afe;
        color: #fff;
    }
    .delete_btn{
        color: #fff;
        background-color: #d9534f;
        border-color: #d43f3a;
    }
    .delete_btn:hover {
        color: #fff;
        background-color: #c9302c;
        border-color: #ac2925;
    }
    #delete_record{
        display: none;
    }
    /*.dataTables_scrollBody > table > thead > tr {
        visibility: collapse;
        height: 0 !important;
    }*/
</style>
<script>



    var tableObj;
    var tabcolumns = [];
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        tableObj =$('#table').DataTable({
            "columnDefs": [
                {
                    className: "my_class",
                    "targets": 'no-sort',
                    "orderDataType": "dom-checkbox",
                    'searchable':true,
                    'orderable':true
                }
            ],
            orderCellsTop: true,
            fixedHeader: true,
            lengthMenu: [[25, 50,100, 250,500, -1], [25, 50, 100, 250,500, "All"]],
            lengthChange: true,
            //scrollX: true,
            //scrollXInner: true,
            processing: true,
            serverSide: true,
            cache: true,
            responsive: true,
            type: 'GET',
            ajax: '{{ $routeValue }}',
            dom: 'Blfrtip',

            // lengthMenu: [[15, 50, 100, -1], ['15 rows', '50 rows','100 rows', "Show All"]],

            buttons: [
                {
                    text: '<i class="fa fa-trash"></i> Delete Selected',
                    action: function ( e, dt, node, config ) {
                        if ($('#delete_record').length) {
                            $("#delete_record").trigger("click");
                        }

                       // alert( 'Button activated' );
                    },
                    "className": 'btn text-right delete_btn  btn-sm btn-danger'
                },
                {
                    "extend": 'csv',
                    "text":'<i class="fas fa-file-csv"></i> Export as CSV',
                    "className": 'btn-outline-primary btn  btn-sm',
                    "action": newexportaction
                },
                {
                    extend: 'excel',
                    text:'<i class="far fa-file-excel"></i> Export as Excel',
                    className: 'btn-outline-primary btn btn-sm',
                    "action": newexportaction
                },
                {
                    extend: 'pdf',
                    text:'<i class="far fa-file-pdf"></i> Export as pdf',
                    className: 'btn-outline-primary btn btn-sm',
                    "action": newexportaction
                },
                {
                    extend: 'print',
                    text:'<i class="fa fa-print"></i> Print',
                    className: 'btn text-right print_btn  btn-sm  btn-primary',
                     "action": newexportaction
                    // autoPrint: true,
                    // exportOptions: {
                    //
                    //     columns: [ 1,3,4,5,6,7 ]
                    // }
                }

            ],


            columns:{!!$setData!!}
          /*  initComplete: function () {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;

                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            }*/
        });


        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function(e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if(this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    tableObj.search(this.value).draw();
                }
                // Ensure we clear the search if they backspace far enough
                if(this.value == "") {
                    tableObj.search("").draw();
                }
                return;
            });




        if ($('#delete_record').length==0) {
            $('.delete_btn').hide();
        }
    });

    function newexportaction(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        dt.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = 100;
            // data.length = 2147483647;
            dt.one('preDraw', function (e, settings) {
                // Call the original action function
                if (button[0].className.indexOf('buttons-copy') >= 0) {
                    $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                    $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                    $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-print') >= 0) {
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
                dt.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });
                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(dt.ajax.reload, 0);
                // Prevent rendering of the full data to the DOM
                return false;
            });
        });
        // Requery the server with the new one-time export settings
        dt.ajax.reload();
    }

function showmore(id) {
    $("#more_"+id).toggle("fast", function(){
        // check paragraph once toggle effect is completed
        if($("#more_"+id).is(":visible")){
            $("#more_"+id).show();
            $("#link_"+id).text('less');
        } else{
            $("#more_"+id).hide();
            $("#link_"+id).text('more');
        }
    });

    // var txt =$("#link_"+id).text();
    // //var txt =  $("#more_"+id).is(':visible') ? 'more' : 'less';
    // $(".show_hide_"+id).text(txt);
    // $(this).next('#more_'+id).slideToggle(200);
}


</script>