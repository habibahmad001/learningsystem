
<script>



	function deleteRecord(slug) {
	Swal.fire({

		  title: "{{getPhrase('are_you_sure')}}?",

		  text: "{{getPhrase('you_will_not_be_able_to_recover_this_record')}}!",

		  icon: "warning",

		  showCancelButton: true,

		  // confirmButtonClass: "btn-danger",
          //
		  confirmButtonText: "{{getPhrase('yes').', '.getPhrase('delete_it')}}!",

		  cancelButtonText: "{{getPhrase('no').', '.getPhrase('cancel_please')}}!",

		  // closeOnConfirm: false,

		  // closeOnCancel: false

		}).then((result) => {
        if (result.isConfirmed) {

            var token = '{{ csrf_token()}}';

            route = '{{$route}}'+slug;
            $.ajax({
                url:route,
                type: 'post',
                data: {_method: 'delete', _token :token},
                success:function(msg){
                    console.log(msg)
                    result = $.parseJSON(msg);

                    if(typeof result == 'object'){
                        status_message = '{{getPhrase('deleted')}}';
                        status_symbox = 'success';
                        status_prefix_message = '';
                        if(!result.status) {
                            status_message = '{{getPhrase('sorry')}}';
                            status_prefix_message = '{{getPhrase("cannot_delete_this_record_as")}}\n';
                            status_symbox = 'info';
                        }
                        Swal.fire(
                            status_message+"!",
                            status_prefix_message+result.message,
                            status_symbox
                        )

                    }
                    else {
                        Swal.fire("{{getPhrase('deleted')}}!", "{{getPhrase('your_record_has_been_deleted')}}", "success");
                    }
                    tableObj.ajax.reload();

                }

            });
        }
    })


	}




    // Check all
    $('#checkall').click(function(){
        if($(this).is(':checked')){
            $('.delete_check').prop('checked', true);
        }else{
            $('.delete_check').prop('checked', false);
        }
    });

    // Delete record
    $('#delete_record').click(function(){
        var data_id=$(this).attr("data-id");


        var deleteids_arr = [];
        // Read all checked checkboxes
        $("input:checkbox[class=delete_check]:checked").each(function () {
            deleteids_arr.push($(this).val());
        });

        // Check checkbox checked or not
        if(deleteids_arr.length > 0){
            console.log(deleteids_arr);
            // Confirm alert
            Swal.fire({
                    title: "{{getPhrase('are_you_sure')}}?",
                    text: "{{getPhrase('you_will_not_be_able_to_recover_this_data')}}!",
                    icon: "warning",
                    showCancelButton: true,
                    //confirmButtonClass: "btn-danger",
                    confirmButtonText: "{{getPhrase('yes').', '.getPhrase('delete_it')}}!",
                    cancelButtonText: "{{getPhrase('no').', '.getPhrase('cancel_please')}}!",
                    //closeOnConfirm: false,
                    //closeOnCancel: false
                }).then((result) => {
                if (result.isConfirmed) {
                        var token = '{{ csrf_token()}}';

                        $.ajax({
                            url: data_id,
                            type: 'post',
                            data: {_token: token, request: 2, deleteids_arr: deleteids_arr},
                            success: function (msg) {
                                console.log(msg);
                                result = $.parseJSON(msg);
                                if (typeof result == 'object') {
                                    status_message = '{{getPhrase('deleted')}}';
                                    status_symbox = 'success';
                                    status_prefix_message = '';
                                    if (!result.status) {
                                        status_message = '{{getPhrase('sorry')}}';
                                        status_prefix_message = '{{getPhrase("cannot_delete_this_record_as")}}\n';
                                        status_symbox = 'info';
                                    }
                                    Swal.fire(status_message + "!", status_prefix_message + result.message, status_symbox);
                                }
                                else {
                                    Swal.fire("{{getPhrase('deleted')}}!", "{{getPhrase('your_data_has_been_deleted')}}", "success");
                                }
                                tableObj.ajax.reload();
                            }
                        });
                    }
                else
                    {
                        Swal.fire("{{getPhrase('cancelled')}}", "{{getPhrase('your_data_is_safe')}} :)", "error");
                    }

            });
        }
    });

    // Publish record
    $('#publish_record').click(function(){
        var data_id=$(this).attr("data-id");
        console.log(data_id);

        var deleteids_arr = [];
        // Read all checked checkboxes
        $("input:checkbox[class=delete_check]:checked").each(function () {
            deleteids_arr.push($(this).val());
        });

        // Check checkbox checked or not
        if(deleteids_arr.length > 0){
            console.log(deleteids_arr);
            // Confirm alert
            Swal.fire({
                    title: "{{getPhrase('are_you_sure')}}?",
                    text: "{{getPhrase('You_want_to_publish_it')}}!",
                    icon: "warning",
                    showCancelButton: true,
                    // confirmButtonClass: "btn-danger",
                    confirmButtonText: "{{getPhrase('yes').', '.getPhrase('do_it')}}!",
                    cancelButtonText: "{{getPhrase('no').', '.getPhrase('cancel_please')}}!"
                    // closeOnConfirm: false,
                    // closeOnCancel: false
                }).then((result) => {
                if (result.isConfirmed) {

                        var token = '{{ csrf_token()}}';

                        $.ajax({

                            url:data_id,
                            type: 'post',
                            data: {_token :token, request: 2, deleteids_arr: deleteids_arr},
                            success: function (msg) {
                                console.log(msg);
                                result = $.parseJSON(msg);

                                if(typeof result == 'object'){
                                    status_message = '{{getPhrase('updated')}}';
                                    status_symbox = 'success';
                                    status_prefix_message = '';
                                    if(!result.status) {
                                        status_message = '{{getPhrase('sorry')}}';
                                        status_prefix_message = '{{getPhrase("cannot_update_this_record_as")}}\n';
                                        status_symbox = 'info';
                                    }
                                    Swal.fire(status_message+"!", status_prefix_message+result.message, status_symbox);
                                }
                                else {
                                    Swal.fire("{{getPhrase('updated')}}!", "{{getPhrase('your_data_has_been_updated')}}", "success");
                                }
                                tableObj.ajax.reload();
                            }
                        });

                }else {

                Swal.fire("{{getPhrase('cancelled')}}", "{{getPhrase('your_data_is_safe')}} :)", "error");

            }
            });
        }
    });

    // Publish record
    $('#unpublish_record').click(function(){
        var data_id=$(this).attr("data-id");
        console.log(data_id);

        var deleteids_arr = [];
        // Read all checked checkboxes
        $("input:checkbox[class=delete_check]:checked").each(function () {
            deleteids_arr.push($(this).val());
        });

        // Check checkbox checked or not
        if(deleteids_arr.length > 0){

            // Confirm alert
            Swal.fire({
                    title: "{{getPhrase('are_you_sure')}}?",
                    text: "{{getPhrase('You_want_to_unpublish_it')}}!",
                    icon: "warning",
                    showCancelButton: true,
                    // confirmButtonClass: "btn-danger",
                    confirmButtonText: "{{getPhrase('yes').', '.getPhrase('do_it')}}!",
                    cancelButtonText: "{{getPhrase('no').', '.getPhrase('cancel_please')}}!"
                    // closeOnConfirm: false,
                    // closeOnCancel: false
            }).then((result) => {
                if (result.isConfirmed) {
                        var token = '{{ csrf_token()}}';

                        $.ajax({
                            url:data_id,
                            type: 'post',
                            data: {_token :token, request: 2, deleteids_arr: deleteids_arr},
                            success: function (msg) {
                                result = $.parseJSON(msg);
                                if(typeof result == 'object'){
                                    status_message = '{{getPhrase('updated')}}';
                                    status_symbox = 'success';
                                    status_prefix_message = '';
                                    if(!result.status) {
                                        status_message = '{{getPhrase('sorry')}}';
                                        status_prefix_message = '{{getPhrase("cannot_updated_this_record_as")}}\n';
                                        status_symbox = 'info';
                                    }
                                    Swal.fire(status_message+"!", status_prefix_message+result.message, status_symbox);
                                }
                                else {
                                    Swal.fire("{{getPhrase('updated')}}!", "{{getPhrase('your_data_has_been_updated')}}", "success");
                                }
                                tableObj.ajax.reload();
                            }
                        });
                }else {

                    Swal.fire("{{getPhrase('cancelled')}}", "{{getPhrase('your_data_is_safe')}} :)", "error");

                }
            });
        }
    });



    jQuery("input[name = 'checkbox_course[]']").change(function () {
        console.log("hello");
        // Total checkboxes
        var length = $('.delete_check').length;

        // Total checked checkboxes
        var totalchecked = 0;
        $('.delete_check').each(function(){
            if($(this).is(':checked')){
                totalchecked+=1;
            }
        });

        // Checked unchecked checkbox
        if(totalchecked == length){
            $("#checkall").prop('checked', true);
        }else{
            $('#checkall').prop('checked', false);
        }

    });


</script>