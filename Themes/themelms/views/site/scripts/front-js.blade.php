<script>
    $( document ).ready(function() {
        $(".courses_tab").click(function() {
            $('#loading').css("display", "block");

        });

        setTimeout(function () {
            $(".currency-selector").attr("disabled",false);
        },3000);

        var options = {
            /*placement: function (context, source) {
                var position = $(source).position();

                if (position.left > 515) {
                    return "left";
                }

                if (position.left < 515) {
                    return "right";
                }

                if (position.right < 200) {
                    return "left";
                }

                if (position.top < 110){
                    return "bottom";
                }

                return "top";
            },*/
            placement:"auto right",
            trigger: "manual",
            html: true,
            animation:false,
            content: function() {
                var widget_id=$(this).data("id");
                return $('#'+widget_id).html();
            }
        };
        var windowWidth = $(window).width();
         if(windowWidth > 500){
        $("[data-toggle=popover]").popover(options)
            .on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide");
                }
            }, 300);
        });
        }


    });
</script>

<script src="{{JS}}angular.js"></script>

<script>



    var app = angular.module('academia', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }).constant("CSRF_TOKEN", '<?= csrf_token() ?>');
    app.controller('frontSite', ['$scope', '$http','$sce', '$compile','$window', function ($scope, $http, $sce,$compile,$window) {
        $scope.data = [];
        $scope.boldText = function (text,slug) {
            var htmlText;
            //text="<a href='{{URL_VIEW_LMS_CONTENTS}}"+slug+"'>"+text+"</a>";
            var regex = RegExp($scope[search_query], 'gi')
            var replacement = '<strong>$&</strong>';
            $scope.shtml = "<a href='{{URL_VIEW_LMS_CONTENTS}}"+slug+"'>"+text.replace(regex, replacement)+"</a>";
            htmlText = $sce.trustAsHtml($scope.shtml);


            return htmlText;
        };
        var search_query;

        var search_result_id;
        var courses;
        var catid;

        angular.element(document).ready(function() {
            var activetab = $.cookie("activetab");
            setTimeout(function(){
                angular.element("#"+activetab).trigger('click');
            }, 100);

        });

        // Fetch Users
        $scope.fetchUsers = function (val) {

            search_query='searchText_'+val;
            search_result_id='searchResult_'+val;
            if(val==1){
                $("#search-container-2").show();
            }
            if(val==2){
                $("#search-container-1").show();
            }
            var searchText_len = $scope[search_query].trim().length;
            url = '{{ url('/autocomplete') }}';
            // Check search text length
            console.log(url);
            data = {
                '_token': $scope.getToken(),
                _method: 'post',
                query: $scope[search_query]


            };
            if (searchText_len > 1) {
                $http.post(url, data).then(function successCallback(response) {


                    $scope[search_result_id]= response.data;
                    //console.log(response.data);

                });
            } else {
                $scope[search_result_id] = {};
            }

        }


        $scope.setValue = function (index, $event) {

            $scope[search_query] = $scope[search_result_id][index].title;

            $scope[search_result_id] = {};
            // window.location.href = '{{URL_VIEW_LMS_CONTENTS}}'+slug;
            $event.stopPropagation();
        }

        $scope.searchboxClicked = function ($event) {
            $event.stopPropagation();
        }

        $scope.containerClicked = function () {
            $scope[search_result_id] = {};
        }


        $scope.fetchCourses = function (val) {
            $("#load").show();
            catid=val;
            url = '{{ url('/fetchCourses') }}';
            // Check search text length
            // var tab_id=$(this).attr("id");
          console.log("ht"+val+"-tab");
            $.cookie("activetab", "ht"+val+"-tab", { expires:1});
            data = {
                '_token': $scope.getToken(),
                _method: 'post',
                query: catid


            };

            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: url,
                data: data,
                success: function (response) {
                    //console.log(response);
                    $("#content_"+catid).html(response);
                    //$scope.data= response.data;
                    //console.log(response.data);
                    $("#load").hide();
                },
                complete: function () {
                    var options = {
                        // placement: function (context, source) {
                        //     var position = $(source).position();
                        //
                        //     if (position.left > 515) {
                        //         return "left";
                        //     }
                        //
                        //     if (position.left < 515) {
                        //         return "right";
                        //     }
                        //
                        //     if (position.right < 200) {
                        //         return "left";
                        //     }
                        //
                        //     if (position.top < 110){
                        //         return "bottom";
                        //     }
                        //
                        //     return "top";
                        // },
                        placement:"auto right",
                        trigger: "manual",
                        html: true,
                        animation:false,
                        content: function() {
                            var widget_id=$(this).data("id");
                            return $('#'+widget_id).html();
                        }
                    };
                    $("[data-toggle=popover]").popover(options)
                        .on("mouseenter", function () {
                            var _this = this;
                            $(this).popover("show");
                            $(".popover").on("mouseleave", function () {
                                $(_this).popover('hide');
                            });
                        }).on("mouseleave", function () {
                        var _this = this;
                        setTimeout(function () {
                            if (!$(".popover:hover").length) {
                                $(_this).popover("hide");
                            }
                        }, 300);
                    });
                }
            });


        }



        $scope.clearCart = function () {

            url = '{{ URL_LMS_SERIES_ADD_TO_CART }}/clearCart';
            data = {
                '_token': $scope.getToken(),
                _method: 'post'


            };
            $.ajax({
                beforeSend: function () {
                    $("#emptycartbtn").html('<i class="fa fa-spinner fa-spin"></i>');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: url,
                data: data,
                success: function (response) {


                console.log(response.data.message);
                $(".cart_count").text('0');
                $(".cart_area").html(response.data.message);
                },
                complete: function () {
                    setTimeout(function() {

                        if (window.location.href.indexOf("cart") > -1) {
                            window.location.href= "<?=url('/cart')?>";
                        }
                        if (window.location.href.indexOf("checkout") > -1) {
                            window.location.href= "<?=url('/checkout')?>";
                        }

                    }, 2000);
                }
            });


        }

        $scope.updateQuantity = function () {
            var items=[];
            $('.qty').each(function(){

                items.push({
                    id : $(this).attr("data-id"),
                    qty: $(this).val()
                });
            });

             url = '{{ URL_LMS_SERIES_ADD_TO_CART }}/updatequantity';
            data = {
                '_token': $scope.getToken(),
                _method: 'post',
                items:items


            };
            $.ajax({
                beforeSend: function () {
                    $("#updatecartbtn").html('<i class="fa fa-spinner fa-spin"></i>');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: url,
                data: JSON.stringify(data),
                success: function (response) {

                    if(response.success)
                    toastr.success(response.message);

                },
                complete: function () {
                     // setTimeout(function() {

                        if (window.location.href.indexOf("cart") > -1) {
                            window.location.href= "<?=url('/cart')?>";
                        }


                    // }, 2000);
                }
            });


        }

        $scope.buyFreeCourseNow=function (id, title, slug,user) {


            if(user == "") {
                var coursecookie = [
                    { 'id' : id, 'name' : title, 'slug' : slug }
                ];
                Cookies.set('freecourse', JSON.stringify(coursecookie), { expires: 7 });
                window.location.href = "{!! PREFIX !!}login";
            }
            url = '{{route('user-assign-course')}}';
            data = {
                '_token': $scope.getToken(),
                _method: 'post',
                'course_id': id,
                'name': title,
                'slug': slug,
                'user_id': user

            };


           /* $http.post(url, data).then(function (result) {

                console.log(result.data);
                if(result.data.status=='success'){
                    window.location = '{{ url('/my-courses') }}/'+slug;
                }
                {{--$tot_items = response.data.data.total_items;--}}
                {{--$tot_amount = response.data.data.total_amount;--}}
                {{--$(".cart_count").text($tot_items);--}}
                {{--$(".cart_total").text($tot_amount);--}}
                {{--window.location = '{{ url('/checkout') }}'--}}
            });*/


            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: url,
                data: data,
                success: function (response) {

                    console.log(response);
                    if(response.status=='success'){
                        window.location = '{{ url('/my-courses') }}/'+slug;
                    }
                }
            });



        }
        $scope.getToken = function () {

            return $('[name="csrf_token"]').attr('content');
        }
    }]);
    app.controller('frontCourse', ['$scope', '$http', function ($scope, $http) {


        $scope.getToken = function () {

            return $('[name="csrf_token"]').attr('content');
        }
    }]);


    app.controller('categoryCourses', ['$scope', '$http', function ($scope, $http) {

        $scope.getToken = function () {

            return $('[name="csrf_token"]').attr('content');
        }
    }]);
    app.controller('siteCart', ['$scope', '$http', function ($scope, $http) {

        $scope.getToken = function () {

            return $('[name="csrf_token"]').attr('content');
        }
    }]);
    app.controller('frontVideo', function ($scope, $http, $sce) {

        // $scope.video_url  = '';

        $scope.getContents = function (id, type123) {
            if (!type123) type123 = 'no';
            // console.log(type);


            url = '{{ URL_GET_FRONT_END_SERIES_CONTENTS }}';
            data = {

                '_token': $scope.getToken(),
                _method: 'post',
                'lms_series_id': id,

            };

            $http.post(url, data).then(function (response) {

                if (type123 == 'yes') {
                    $scope.contents = response.data.contents;
                }
                else {

                    $scope.all_contents = response.data.contents;
                }

            });

        }


        $scope.showVideo = function (content_data) {
            // console.log(content_data.file_path);

            $scope.video_url = content_data.file_path;
            console.log($scope.video_url);
            $scope.trustAsHtml = $sce.trustAsHtml
            // console.log($scope.video_url);
            $scope.content_data = content_data;
            // console.log($scope.content_data);
        }

        $scope.getToken = function () {

            return $('[name="_token"]').val();
        }
    });

    function validate(type) {
        $(".error").each(function(){
            $(this).removeClass('error');
        });
        var errors = [];

        var f_name          = $("#"+ type +"f-name").val();
        var l_name          = $("#"+ type +"l-name").val();
        var c_name          = $("#"+ type +"c-name").val();
        var n_delegates     = $("#"+ type +"n-delegates").val();
        var c_address       = $("#"+ type +"c-address").val();
        var city            = $("#"+ type +"city").val();
        var cs_region       = $("#"+ type +"cs-region").val();
        var zip_code        = $("#"+ type +"zip-code").val();
        var country         = $("#"+ type +"country").val();
        var coremail        = $("#"+ type +"coremail").val();
        var contact         = $("#"+ type +"contact").val();
        var training        = $("#"+ type +"training").val();
        var expected        = $("#"+ type +"expected").val();
        var method          = $("#"+ type +"method").val();
        var message         = $("#"+ type +"message").val();


        if(f_name == '') {
            errors.push("#"+ type +"f-name");
        }

        if(l_name == '') {
            errors.push("#"+ type +"l-name");
        }

        if(c_name == '') {
            errors.push("#"+ type +"c-name");
        }

        if(n_delegates == '') {
            errors.push("#"+ type +"n-delegates");
        }

        if(c_address == '') {
            errors.push("#"+ type +"c-address");
        }

        if(city == '') {
            errors.push("#"+ type +"city");
        }

        if(cs_region == '') {
            errors.push("#"+ type +"cs-region");
        }

        if(zip_code == '') {
            errors.push("#"+ type +"zip-code");
        }

        if(country == '') {
            errors.push("#"+ type +"country");
        }

        if(coremail == '') {
            errors.push("#"+ type +"coremail");
        }

        if(contact == '') {
            errors.push("#"+ type +"contact");
        }

        if(training == '') {
            errors.push("#"+ type +"training");
        }

        if(expected == '') {
            errors.push("#"+ type +"expected");
        }

        if(method == '') {
            errors.push("#"+ type +"method");
        }

        if(message == '') {
            errors.push("#"+ type +"message");
        }

        if(errors.length>0){
            for(i=0; i < errors.length; i++){
                $(errors[i]).addClass('error');
            }
            return false;
        }

        return true;
    }

    function corporate(type) {
        $(".error").each(function(){
            $(this).removeClass('error');
        });
        var errors = [];
        var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var num = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

        var f_name          = $("#"+ type +"f-name").val();
        var l_name          = $("#"+ type +"l-name").val();
        var c_name          = $("#"+ type +"c-name").val();
        var j_title         = $("#"+ type +"j-title").val();
        var coremail        = $("#"+ type +"coremail").val();
        var contact         = $("#"+ type +"contact").val();
        var whatare         = $("#"+ type +"whatare").val();
        $('#CorporateSave-btn').prop('disabled', true);

        if(f_name == '') {
            errors.push("#"+ type +"f-name");
        }

        if(l_name == '') {
            errors.push("#"+ type +"l-name");
        }

        if(c_name == '') {
            errors.push("#"+ type +"c-name");
        }

        if(j_title == '') {
            errors.push("#"+ type +"j-title");
        }


        if(coremail == '') {
            errors.push("#"+ type +"coremail");
        }

        if(!email_rgx.test(coremail)) {
            errors.push("#"+ type +"coremail");
        }


        if(contact == '') {
            errors.push("#"+ type +"contact");
        } else if(!contact.match(num)) {
            errors.push("#"+ type +"contact");
            $("#contactmsg").show(400);
        }

        if(whatare == '') {
            errors.push("#"+ type +"whatare");
        }

        if(errors.length>0){
            for(i=0; i < errors.length; i++){
                $(errors[i]).addClass('error');
            }
            $('#CorporateSave-btn').prop('disabled', false);
            return false;
        }

        return true;
    }

    function contactUsvalidation(type) {
        $(".error").each(function(){
            $(this).removeClass('error');
        });

        /********* Captcha Validation *********/
        if(!$('#cfrm textarea[name="g-recaptcha-response"]').val()) {
            console.log("inside captcha condition");
            $("#captcha_msg_conc").show(400);
            return false;
        }
        /********* Captcha Validation *********/

        $(".valmsg").hide();
        var errors = [];

        var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var letters = /^[a-zA-Z\s]*$/
        var num = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

        var name            = $("#"+ type +"name").val();
        var email           = $("#"+ type +"email").val();
        var subject         = $("#"+ type +"subject").val();
        var phone           = $("#"+ type +"phone").val();
        var msg             = $("#"+ type +"cmsg").val();
        var agree           = $("#"+ type +"cdefaultCheck2").val();


        if(name == '') {
            errors.push("#"+ type +"name");
        } else if(!name.match(letters)) {
            errors.push("#"+ type +"name");
            $("#namemsg").show(400);
        }

        if(email == '') {
            errors.push("#"+ type +"email");
        }

        if(!email_rgx.test(email)) {
            errors.push("#"+ type +"email");
        }

        if(subject == '') {
            errors.push("#"+ type +"subject");
        }

        if($("#cdefaultCheck2").prop("checked") == false) {
            $(".ctermsclass").css({"border": "1px solid red", "color": "red"});
            return false;
        }

        // if(phone == '') {
        //     errors.push("#"+ type +"phone");
        // } else if(!phone.match(num)) {
        //     errors.push("#"+ type +"phone");
        //     $("#phonemsg").show(400);
        // }

        if(msg == '') {
            errors.push("#"+ type +"cmsg");
        }

        if(errors.length>0){
            for(i=0; i < errors.length; i++){
                $(errors[i]).addClass('error');
            }
            return false;
        }

        return true;
    }

    function multicoursevalidation(type) {
        $(".error").each(function(){
            $(this).removeClass('error');
        });

        $(".valmsg").hide();
        $("#purchaseattmsg").hide();
        $("#vouchercodemsg").hide();
        $("#purchasedcoursemsg").hide();

        var errors = [];

        var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var letters = /^[a-zA-Z\s]*$/
        var num = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

        var name                        = $("#"+ type +"name").val();
        var email                       = $("#"+ type +"email").val();
        var phone                       = $("#"+ type +"phone").val();
        var purchaseatt                 = $("#"+ type +"purchaseatt").val();
        var vouchercode                 = $("#"+ type +"vouchercode").val();
        var purchasedcourse             = $("#"+ type +"purchasedcourse").val();



        if(name == '') {
            errors.push("#"+ type +"name");
        } else if(!name.match(letters)) {
            errors.push("#"+ type +"name");
            $("#namemsg").show(400);
        }

        if(email == '') {
            errors.push("#"+ type +"email");
        }

        if(!email_rgx.test(email)) {
            errors.push("#"+ type +"email");
        }

        if(phone == '') {
            errors.push("#"+ type +"phone");
        }
        // else if(!phone.match(num)) {
        //     errors.push("#"+ type +"phone");
        //     $("#phonemsg").show(400);
        // }

        if(purchaseatt == '') {
            errors.push("#"+ type +"purchaseatt");
        }

        if(vouchercode == '') {
            errors.push("#"+ type +"vouchercode");
        }

        if(purchasedcourse == '') {
            errors.push("#"+ type +"purchasedcourse");
        }

        if(errors.length>0){
            for(i=0; i < errors.length; i++){
                $(errors[i]).addClass('error');
            }
            return false;
        }

        /********* Captcha Validation *********/
        if(!$('#cfrm textarea[name="g-recaptcha-response"]').val()) {
            console.log("inside captcha condition");
            $("#captcha_msg_conc").show(400);
            return false;
        }
        /********* Captcha Validation *********/

        return true;
    }

    function redeemvouchervalidation(type) {
        $(".error").each(function(){
            $(this).removeClass('error');
        });

        $(".valmsg").hide();
        $("#purchaseattmsg").hide();
        $("#vouchercodemsg").hide();
        $("#purchasedcoursemsg").hide();

        var errors = [];

        var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var letters = /^[a-zA-Z\s]*$/
        var num = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

        var name                        = $("#"+ type +"name").val();
        var vouchercode                 = $("#"+ type +"vouchercode").val();
        var purchasedcourse             = $("#"+ type +"purchasedcourse").val();
        var purchasefrom                = $("#"+ type +"purchasefrom").val();
        var email                       = $("#"+ type +"email").val();
        var cemail                      = $("#"+ type +"cemail").val();
        var phone                       = $("#"+ type +"phone").val();

        if(name == '') {
            errors.push("#"+ type +"name");
        } else if(!name.match(letters)) {
            errors.push("#"+ type +"name");
            $("#namemsg").show(400);
        }

        if(vouchercode == '') {
            errors.push("#"+ type +"vouchercode");
        }

        if(purchasedcourse == '') {
            errors.push("#"+ type +"purchasedcourse");
        }

        if(purchasefrom == '') {
            errors.push("#"+ type +"purchasefrom");
        }

        if(email == '') {
            errors.push("#"+ type +"email");
        }

        if(!email_rgx.test(email)) {
            errors.push("#"+ type +"email");
        }

        if(cemail == '') {
            errors.push("#"+ type +"cemail");
        }

        if(email != cemail) {
            errors.push("#"+ type +"cemail");
            errors.push("#"+ type +"email");
            $("#cemailmsg").show(400);
        }

        if(phone == '') {
            errors.push("#"+ type +"phone");
        } else if(phone.length < 10) {
            errors.push("#"+ type +"phone");
            $("#phonemsg").show(400);
        } else if(phone.length > 15) {
            errors.push("#"+ type +"phone");
            $("#phonemsg").show(400);
        }

        // if(phone.length > 15) {
        //     errors.push("#"+ type +"phone");
        //     $("#phonemsg").show(400);
        // }

        // if(!phone.match(num)) {
        //     errors.push("#"+ type +"phone");
        //     $("#phonemsg").show(400);
        // }

        if(errors.length>0){
            for(i=0; i < errors.length; i++){
                $(errors[i]).addClass('error');
            }
            return false;
        }

        /********* Captcha Validation *********/
        if(!$('#cfrm textarea[name="g-recaptcha-response"]').val()) {
            console.log("inside captcha condition");
            $("#captcha_msg_conc").show(400);
            return false;
        }
        /********* Captcha Validation *********/

        return true;
    }

    function Affiliatevalidation(type) {
        $(".error").each(function(){
            $(this).removeClass('error');
        });

        $(".valmsg").hide();

        var errors = [];

        var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var letters = /^[a-zA-Z\s]*$/;
        var num = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

        var f_name                                      = $("#"+ type +"f-name").val();
        var l_name                                      = $("#"+ type +"l-name").val();
        var contact                                     = $("#"+ type +"contact").val();
        var coremail                                    = $("#"+ type +"coremail").val();
        var c_name                                      = $("#"+ type +"c-name").val();
        var how_do_you_intend                           = $("#"+ type +"how_do_you_intend").val();
        var what_is_the_current_size                    = $("#"+ type +"what_is_the_current_size").val();
        var comments                                    = $("#"+ type +"comments").val();



        if(f_name == '') {
            errors.push("#"+ type +"f-name");
        } else if(!f_name.match(letters)) {
            errors.push("#"+ type +"f-name");
            $("#namemsg").show(400);
        }

        if(l_name == '') {
            errors.push("#"+ type +"l-name");
        } else if(!l_name.match(letters)) {
            errors.push("#"+ type +"l-name");
            $("#namemsg").show(400);
        }

        if(coremail == '') {
            errors.push("#"+ type +"coremail");
        }

        if(!email_rgx.test(coremail)) {
            errors.push("#"+ type +"coremail");
        }

        if(contact == '') {
            errors.push("#"+ type +"contact");
        }
        // else if(!phone.match(num)) {
        //     errors.push("#"+ type +"phone");
        //     $("#phonemsg").show(400);
        // }

        if(c_name == '') {
            errors.push("#"+ type +"c-name");
        }

        if(how_do_you_intend == null) {
            errors.push("#"+ type +"how_do_you_intend");
        }

        if(what_is_the_current_size == null) {
            errors.push("#"+ type +"what_is_the_current_size");
        }

        if(comments == '') {
            errors.push("#"+ type +"comments");
        }

        if(errors.length>0){
            for(i=0; i < errors.length; i++){
                $(errors[i]).addClass('error');
            }
            return false;
        }

        /********* Captcha Validation *********/
        if(!$('#affiliateT textarea[name="g-recaptcha-response"]').val()) {
            console.log("inside captcha condition");
            $("#captcha_msg_conc").show(400);
            return false;
        }
        /********* Captcha Validation *********/

        return true;
    }

    function affiliatesubscribevalidation(type) {
        $(".error").each(function(){
            $(this).removeClass('error');
        });

        $(".valmsg").hide();

        var errors = [];

        var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var letters = /^[a-zA-Z\s]*$/;
        var num = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

        var name                                      = $("#"+ type +"name").val();
        var email                                     = $("#"+ type +"email").val();



        if(name == '') {
            errors.push("#"+ type +"name");
        } else if(!name.match(letters)) {
            errors.push("#"+ type +"name");
            $("#namemsg").show(400);
        }

        if(email == '') {
            errors.push("#"+ type +"email");
        }

        if(!email_rgx.test(email)) {
            errors.push("#"+ type +"email");
        }

        if(errors.length>0){
            for(i=0; i < errors.length; i++){
                $(errors[i]).addClass('error');
            }
            return false;
        }

        return true;
    }

    function freelancervalidation(type) {
        $(".error").each(function(){
            $(this).removeClass('error');
        });

        $(".valmsg").hide();

        var errors = [];

        var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var letters = /^[a-zA-Z\s]*$/;
        var num = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

        var user_name                                      = $("#"+ type +"user_name").val();
        var user_email                                     = $("#"+ type +"user_email").val();
        var user_phone                                     = $("#"+ type +"user_phone").val();
        var course_title                                   = $("#"+ type +"course_title").val();



        if(user_name == '') {
            errors.push("#"+ type +"user_name");
        } else if(!user_name.match(letters)) {
            errors.push("#"+ type +"user_name");
            $("#namemsg").show(400);
        }

        if(user_email == '') {
            errors.push("#"+ type +"user_email");
        }

        if(!email_rgx.test(user_email)) {
            errors.push("#"+ type +"user_email");
        }

        if(user_phone == '') {
            errors.push("#"+ type +"user_phone");
        }

        if(course_title == '') {
            errors.push("#"+ type +"course_title");
        }

        if(errors.length>0){
            for(i=0; i < errors.length; i++){
                $(errors[i]).addClass('error');
            }
            return false;
        }

        return true;
    }


    function enquiryvalidation(type) {
        $(".errorimp").each(function(){
            $(this).removeClass('errorimp');
        });

        $(".valmsg").hide();
        var errors = [];
        var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var letters = /^[a-zA-Z\s]*$/
        var num = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;

        var first_name          = $("#"+ type +"first_name").val();
        var remail          = $("#"+ type +"remail").val();
        var phone          = $("#"+ type +"phone").val();
        var enquiry_type         = $("#"+ type +"enquiry_type").val();
        var msg        = $("#"+ type +"msg").val();


        if(first_name == '') {
            errors.push("#"+ type +"first_name");
        } else if(!first_name.match(letters)) {
            errors.push("#"+ type +"first_name");
            $("#namemsg").show(400);
        }

        if(remail == '') {
            errors.push("#"+ type +"remail");
        }

        if(!email_rgx.test(remail)) {
            errors.push("#"+ type +"remail");
        }

        // if(phone == '') {
        //     errors.push("#"+ type +"phone");
        // } else if(!phone.match(num)) {
        //     errors.push("#"+ type +"phone");
        //     $("#phonemsg").show(400);
        // }

        // if(enquiry_type == '') {
        //     errors.push("#"+ type +"enquiry_type");
        // }

        if(msg == '') {
            errors.push("#"+ type +"msg");
        }

        if(errors.length>0){
            for(i=0; i < errors.length; i++){
                $(errors[i]).addClass('errorimp');
            }
            return false;
        }

        return true;
    }

    function detailvideoplay() {
        $('.detailvideooverlay').show(300);
    }

    function validate_student(type) {

        $(".error").each(function(){
            $(this).removeClass('error');
        });
        var errors = [];

        var f_name          = $("#"+ type +"f-name").val();
        var std_email       = $("#"+ type +"std_email").val();
        var std_tel         = $("#"+ type +"std_tel").val();
        var std_dob         = $("#"+ type +"std_dob").val();
        var std_adInfo      = $("#"+ type +"std_adInfo").val();
        var std_address     = $("#"+ type +"std_address").val();
        var std_city        = $("#"+ type +"std_city").val();
        var std_zipcode     = $("#"+ type +"std_zipcode").val();
        var std_country     = $("#"+ type +"std_country").val();
        var i_agree         = $("#"+ type +"i_agree").val();


        if(f_name == '') {
            errors.push("#"+ type +"f-name");
        }

        if(std_email == '') {
            errors.push("#"+ type +"std_email");
        }

        if(std_tel == '') {
            errors.push("#"+ type +"std_tel");
        }

        if(std_dob == '') {
            errors.push("#"+ type +"std_dob");
        }

        if(std_adInfo == '') {
            errors.push("#"+ type +"std_adInfo");
        }

        if(std_address == '') {
            errors.push("#"+ type +"std_address");
        }

        if(std_city == '') {
            errors.push("#"+ type +"std_city");
        }

        if(std_zipcode == '') {
            errors.push("#"+ type +"std_zipcode");
        }

        if(std_country == '') {
            errors.push("#"+ type +"std_country");
        }

        if(i_agree == '') {
            errors.push("#"+ type +"i_agree");
        }

        if(errors.length>0){
            for(i=0; i < errors.length; i++){
                $(errors[i]).addClass('error');
            }
            return false;
        }

        return true;
    }

    function addToWishlist(user_id = 0, course_id) {

        {{--if(user_id == "") {--}}
            {{--window.location.href = "{!! PREFIX !!}login";--}}
        {{--}--}}
        $.ajax({
            beforeSend: function () {
                //$('#addToWishlist .loader').css("display", "block");
                //$('.wishlist_button').css("display", "none");
                $('[data-course="'+course_id+'"]').find("i").removeClass('fa-heart-o');
                $('[data-course="'+course_id+'"]').find("i").removeClass('fa-heart');
                $('[data-course="'+course_id+'"]').find("i").addClass('fa-spinner fa-spin');
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            type: 'POST',
            url: '{{ (Auth::check()) ? url('add/wishlist') : url('saveofflinewishlist') }}',
            data : { course_id: course_id },
            success : function (response) {
                var wishes=parseInt($('#wish_count').text());
                //console.log(wishes);

                if (response == 1) {
                    $('[data-course="'+course_id+'"]').find("i").removeClass('fa-spinner fa-spin');
                    $('[data-course="'+course_id+'"]').find("i").addClass('fa-heart');
                    $('#wish_count').text(wishes+1);
                    $('.mobile__nav .wish_count').text(wishes+1);
                    toastr.success('Course added in wishlist');
                } else {
                    $('[data-course="'+course_id+'"]').find("i").removeClass('fa-spinner fa-spin');
                    $('[data-course="'+course_id+'"]').find("i").addClass('fa-heart-o');
                    $('#wish_count').text(wishes-1);
                    $('.mobile__nav .wish_count').text(wishes-1);
                    (window.location.href.indexOf("wishlist") > -1) ? window.location.reload() : "";
                    toastr.info('Course removed from wishlist');
                }


            },
            complete: function () {
                $('#addToWishlist .loader').css("display", "none");
                $('.wishlist_button').css("display", "block");
            }
        });

    }


    function showSubscription(formid) {

        var input = $("#"+formid+" :input[id='email']");
        var button = $("#"+formid+" :button");
        var user_email =input.val();
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(user_email)) {
            toastr.error('Please enter a valid email');
            return;
        }
        else {


            $.ajax({
                beforeSend: function () {

                    button.prop('disabled', true);
                },


                url: '{{ URL_SAVE_SUBSCRIPTION_EMAIL }}',
                type: 'post',
                data: {

                    useremail: user_email,
                    '_token': $('[name="csrf_token"]').attr('content')

                },

                success: function (response) {
                    var email_staus = $.parseJSON(response);
                    if (email_staus.status == 'existed') {
                        toastr.info('You are already subscribed');
                    }
                    else {
                        toastr.success('You are subscribed successfully');
                    }

                    $("#"+formid)[0].reset();
                    button.prop('disabled', false);
                }


            });




        }

    }

    function closepopup() {
        var data = {};
        $.ajax({
            type: 'GET',
            url: '{!! URL::to('/setcook') !!}',
            data: data,
            success: function(result) {
            },
            async:false
        });
        $('.popupoverlay').hide();
    }
    function removeToCart(id) {

        url = '{{ URL_LMS_SERIES_ADD_TO_CART }}/removeToCart';
        data = {
            _method: 'post',
            'id': id,


        };
        console.log(data);

        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: url,
            data: data,
            success: function (response) {
                console.log(response.data);
                $tot_items = response.data.total_items;
                $tot_amount = response.data.total_amount;
                $is_empty = response.data.is_empty;
                $(".cart_count").text($tot_items);
                $(".cart_total").text($tot_amount);
                toastr.success('Course removed from the cart successfully');
                // $(".cart_item_" + id).hide();
                $(".cart_item_" + id).remove();
                if ($is_empty) {
                    $("#emptycart").show();
                    $(".emptycart").show();
                    $("#emptycart").html(response.data.message);
                }
            },
            complete: function () {
                setTimeout(function() {

                    if (window.location.href.indexOf("cart") > -1) {
                        window.location.href= "<?=url('/cart')?>";
                    }
                    if (window.location.href.indexOf("checkout") > -1) {
                        window.location.href= "<?=url('/checkout')?>";
                    }
                    if (window.location.href.indexOf("wishlist") > -1) {
                        window.location.href= "<?=url('/wishlist')?>";
                    }

                }, 4000);
            }
        });





    }
    function  addToCart(id, title, price, quantity,image,slug,divid) {
        console.log($("#"+divid).data('widget-id'));
        var widgetid=$("#"+divid).data('widget-id');
        if (!divid) divid = '';
        $("#"+divid).removeAttr("onclick");
        url = '{{ URL_LMS_SERIES_ADD_TO_CART }}/addtocart';
        data = {
            _method: 'post',
            'id': id,
            'name': title,
            'price': price,
            'image': image,
            'slug': slug,
            'qty': quantity


        };

        $.ajax({
            beforeSend: function () {
                $("#"+divid).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: url,
            data: data,
            success: function (response) {
                // if(response.data.already_purchased !== ''){
                //     $("#"+divid).removeAttr("onclick").attr("href", response.data.already_purchased).addClass( "gotocart" ).html('Go to Course');
                //     window.location = response.data.already_purchased
                // }
                $tot_items = response.data.total_items;
                $tot_amount = response.data.total_amount;
                $new_item = response.data.new_item;
                $slug = response.data.slug;
                $(".cart_count").text($tot_items);
                $(".cart_total").text($tot_amount);
                $(".cart_item_" + id).remove();

                $(".cart_area li.list_cart").prepend('<div class="clearfix cart_item_' + $new_item.id + '">\n' +
                    '                <span class="item-image"><a href="{{URL_VIEW_LMS_CONTENTS}}'+slug +'"><img   width="60" class="img-responsive" src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_THUMB}}'+image+'" alt="item1" /></a></span>\n' +
                    '                <span class="item-name"><a href="{{URL_VIEW_LMS_CONTENTS}}'+slug +'">' + $new_item.name + '</a></span>\n' +
                    '                <span class="item-price">{!! getCurrencyCode() !!}' + $new_item.price * $new_item.quantity + '</span>\n' +

                    '                <span onclick="removeToCart('+$new_item.id+')" class="item-remove"><i class="fa fa-trash"></i></span>\n' +
                    '            </div>');
                // '                <span class="item-quantity">Quantity: ' + $new_item.quantity + '</span>\n' +

                $("#addedToCartModal .modal-body").html('<div class="clearfix cart_item_' + $new_item.id + '">\n' +
                    '<span class="check_arrow"><i class="fa fa-check-circle" aria-hidden="true"></i></span>\n' +
                    '<span class="cart_image"><a href="{{URL_VIEW_LMS_CONTENTS}}'+slug +'"><img width="60"  src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_THUMB}}'+image+'" alt="item1"></a></span>\n' +
                    '<span class="item-name"  ><a href="{{URL_VIEW_LMS_CONTENTS}}'+slug +'">' + $new_item.name + '</a></span>\n' +
                    '                <span class="item-price">{!! getCurrencyCode() !!}' + $new_item.price * $new_item.quantity + '</span>\n' +
                    '<span class="buy-btns item_button"><a class="btn btn-add-cart" id="1" href="{{url('/cart')}}" >Go To Cart</a></span>'+
                    '            </div>');

                $("#"+divid).removeAttr("onclick").attr("href", '/cart').addClass( "gotocart" ).html('Go to Cart');
                $("#emptycart").hide();

                $(".emptycart").hide();
                $("#"+widgetid).hide();



                var _this = this;

                    if (!$(".popover:hover").length) {
                        $(_this).popover("hide");
                    }


                $('#addedToCartModal').modal('show');

                //$("#buy_"+divid).hide();
            },
            complete: function () {
                $("#emptycart").hide();
                $(".emptycart").hide();
            }
        });


    }

    function buyNow (id, title, price, quantity,image,slug,divid) {



        if (!divid) divid = '';
        //$("#buy_"+divid).removeAttr("onclick").attr("href", '/cart');
        // console.log(id+title+price+quantity+image);
        url = '{{ URL_LMS_SERIES_ADD_TO_CART }}/buynow';
        data = {
            _method: 'post',
            'id': id,
            'name': title,
            'price': price,
            'image': image,
            'slug': slug,
            'qty': quantity


        };

        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: url,
            data: data,
            success: function (response) {
                if(response.data.already==null)
                    toastr.success('Course added in the cart');

                $tot_items = response.data.total_items;
                $tot_amount = response.data.total_amount;
                $new_item = response.data.new_item;
                $slug = response.data.slug;
                $(".cart_count").text($tot_items);
                $(".cart_total").text($tot_amount);
                //console.log(window.location.pathname);
                $(".cart_item_" + id).remove();

                $(".cart_area li.list_cart").prepend('<div class="clearfix cart_item_' + $new_item.id + '">\n' +
                    '                <span class="item-image"><a href="{{URL_VIEW_LMS_CONTENTS}}'+slug +'"><img   width="60" class="img-responsive" src="{{IMAGE_PATH_UPLOAD_LMS_SERIES_THUMB}}'+image+'" alt="item1" /></a></span>\n' +
                    '                <span class="item-name"><a href="{{URL_VIEW_LMS_CONTENTS}}'+slug +'">' + $new_item.name + '</a></span>\n' +
                    '                <span class="item-price">{{getCurrencyCode()}}' + $new_item.price * $new_item.quantity + '</span>\n' +

                    '                <span onclick="removeToCart('+$new_item.id+')" class="item-remove"><i class="fa fa-trash"></i></span>\n' +
                    '            </div>');
                //$("#buy_"+divid).removeAttr("onclick").attr("href", '/checkout');
                $("#emptycart").hide();
                $(".emptycart").hide();

                window.location = '{{ url('/checkout') }}';

                //COMMETING DUE TO UPDATED CHECKOUT PROCESS
                {{--Cookies.set('preurl','/checkout');--}}
                {{--@if(Auth::check())--}}
                    {{--window.location = '{{ url('/checkout') }}'--}}
                {{--@else--}}
                {{--//window.location = '{{ url('/login') }}'--}}
                {{--$('#LoginModal').modal({show: 'true'});--}}
                {{--@endif--}}
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });



        // $.post(url, data).then(function (response) {
        //
        // }, function(response) {
        //     // Second function handles error
        //     console.log("Something went wrong");
        //     console.log(response);
        // });


    }


    function gotoLogin(){

        Cookies.set('preurl','/checkout');
        $('#LoginModal').modal({
            show: 'true'
        });
    }

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };
    $('#enquiry-form').on('submit', function(e) {
        //$("#enquiry-form").attr("action", "{{ URL::to( PREFIX . 'send/enquiry') }}")
        console.log("grecaptcha==="+grecaptcha.getResponse());
        if(!$('#enquiry-form textarea[name="g-recaptcha-response"]').val()) {
            e.preventDefault();
            $("#captcha_msg").show(400).fadeOut(30000);
            return false;
        } else {
            console.log("inside valid");
            // $('#lesson_list_area').hide();
            //$('#lesson_list_loader').show();
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var email = $("#remail").val();
            var phone = $("#phone").val();
            var country = $("#country").val();
            var enquiry_type = $("#enquiry_type").val();
            var message = $("#msg").val();
            var sub = $("#defaultCheck1").val();
            var subscribed = ($("#defaultCheck1").val() == 'Yes') ? '1' : '0';
            var course_id = $("#course_id").val();
            var course_title = $("#course_title").val();
            var course_slug = $("#course_slug").val();
            var loading = $(this).data("loading-text");
            $.ajax({
                beforeSend: function () {
                    $('#load').css("display", "block");
                    $('#sendEnquiry').text(loading).prop('disabled', true);
                    //$('#sendEnquiry').prop('disabled', true);
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '{{url('send/enquiry')}}',
                data: {
                    course_id: course_id,
                    course_title: course_title,
                    course_slug: course_slug,
                    first_name: first_name,
                    last_name: last_name,
                    country: country,
                    enquiry_type: enquiry_type,
                    email: email,
                    subscribed: subscribed,
                    phone: phone,
                    msg: message,
                    sub: sub
                },
                success: function (response) {
                    console.log(response.success);
                    console.log(response);
                    if (response.success) {
                        //$(".request_form").modal("hide");
                        $("form").trigger("reset");
                        // toastr["success"](response.message);
                        $('#form-section').hide();
                        $('#thankyou').show();
                        // $('#addToWishlist').find( "i" ).addClass('fa-heart');
                    } else {
                        $("form").trigger("reset");
                        // toastr["success"](response.message);
                        $('#form-section').hide();
                        $('#errormsg').show();
                        // $('#addToWishlist').find( "i" ).removeClass('fa-heart');
                        // $('#addToWishlist').find( "i" ).addClass('fa-heart-o');
                    }
                },
                complete: function () {
                    $('#load').css("display", "none");
                    $('#sendEnquiry').css("display", "block");
                }
            });
            e.preventDefault();
        }
    });
    var review_recaptcha_widget;
    var onloadCallback = function() {
        if($('#html_element').length) {
            review_recaptcha_widget = grecaptcha.render('html_element', {
                'sitekey' : '{{getSetting('nocaptcha_sitekey','recaptcha_settings')}}'
            });
        }
    };

    jQuery(document).ready(function ($) {




        // var onloadCallback = function() {
        //     grecaptcha.render('html_element', {
        //         'sitekey' : '6LdppeoUAAAAAKjV3dircJOkfXZCqKJc-JlHbw9c'
        //     });
        // };
        // onloadCallback();

        $(document).on('click','#sendEnquiry',function() {

            console.log("btn clicked");
            enquiryvalidation('');
            /********* Captcha Validation *********/
            // if(!$('#enquiry-form textarea[name="g-recaptcha-response"]').val()) {
            //     $("#captcha_msg").show(400);
            //     return false;
            // }
            /********* Captcha Validation *********/

            /**** phone valid ****/
            // var num = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;
            // if(!$("#phone").val().match(num)) {
            //     return false;
            // }
            /**** phone valid ****/

            /**** Email valid ****/
            var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!email_rgx.test($("#remail").val())) {
                return false;
            }
            /**** Email valid ****/
            console.log("after validation  area");
            var valid =$('#enquiry-form')[0].checkValidity();
            if (valid) {
                $("#enquiry-form").submit();

            }

        });


        $(".qty").change(function(){
            $("#updatecartbtn").attr('disabled', false);
        });


        //FOR ALL CORUSES LEFT COLUMN FILTERS
        var windowWidth = $(window).width();
        console.log(windowWidth);
        if(windowWidth <= 786){
            $('.panel .collapse').removeClass('in');
            $('.maincat .collapse').addClass('in');
            $(".search-form-wrappers").click(function() {
                $(".shopping-cart.mobile_dropdown.dropdown-cart.cart_area").hide();
            });
            $("#cart").click(function() {
                $(".search-form-wrappers").removeClass("open");
            });

        } //for iPad & smaller devices

        var term = getUrlParameter('search_term');
        if(term!="")
            $('#search_term').val(term);

        setTimeout(function(){
            $('.related_courses').css({ display: "block" });
        },5000);


        var perfEntries = performance.getEntriesByType("navigation");

        if (perfEntries[0].type === "back_forward") {
            location.reload(true);
        }


        /******* Signup Validation **********/
        $('#first_name').focusout(function(){
            var errmsg = "";
            if($(this).val() == "") {
                errmsg += "This Field Is Required";
            } else if($(this).val().length <= 2) {
                errmsg += "The Text is too short";
            } else {
                errmsg = "";
            }

            if(errmsg !== "") {
                $(".name").show(400);
                $(".error_msg_div").attr("data-chkval", 1);
                $(".name").html('<p class="signuperrorp">' + errmsg + '</p>');
            } else {
                $(".name").hide(400);
                $(".error_msg_div").attr("data-chkval", 0);
                $(".name").html('');
            }
        });

        $('#last_name').focusout(function(){
            var errmsg = "";
            if($(this).val() == "") {
                errmsg += "This Field Is Required";
            } else if($(this).val().length <= 2) {
                errmsg += "The Text is too short";
            } else {
                errmsg = "";
            }

            if(errmsg !== "") {
                $(".lname").show(400);
                $(".error_msg_div").attr("data-chkval", 1);
                $(".lname").html('<p class="signuperrorp">' + errmsg + '</p>');
            } else {
                $(".lname").hide(400);
                $(".error_msg_div").attr("data-chkval", 0);
                $(".lname").html('');
            }
        });

        $('#xemail').focusout(function(){
            var errmsg = "";
            var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if($(this).val() == "") {
                errmsg += "This Field Is Required";
            } else if($(this).val().length <= 2) {
                errmsg += "The Text is too short";
            } else if(!email_rgx.test($(this).val())) {
                errmsg += "This is not email address";
            } else {
                errmsg = "";
            }

            if(errmsg !== "") {
                $(".eemail").show(400);
                $(".error_msg_div").attr("data-chkval", 1);
                $(".eemail").html('<p class="signuperrorp">' + errmsg + '</p>');
            } else {
                $(".eemail").hide(400);
                $(".error_msg_div").attr("data-chkval", 0);
                $(".eemail").html('');
            }
        });

        $('#username').focusout(function(){
            var errmsg = "";
            if($(this).val() == "") {
                errmsg += "This Field Is Required";
            } else if($(this).val().length <= 2) {
                errmsg += "The Text is too short";
            } else {
                errmsg = "";
            }

            if(errmsg !== "") {
                $(".uname").show(400);
                $(".error_msg_div").attr("data-chkval", 1);
                $(".uname").html('<p class="signuperrorp">' + errmsg + '</p>');
            } else {
                $(".uname").hide(400);
                $(".error_msg_div").attr("data-chkval", 0);
                $(".uname").html('');
            }
        });

        $('#pass').focusout(function(){
            var errmsg = "";
            if($(this).val() == "") {
                errmsg += "This Field Is Required";
            } else if($(this).val().length <= 2) {
                errmsg += "The Text is too short";
            } else {
                errmsg = "";
            }

            if(errmsg !== "") {
                $(".epass").show(400);
                $(".error_msg_div").attr("data-chkval", 1);
                $(".epass").html('<p class="signuperrorp">' + errmsg + '</p>');
            } else {
                $(".epass").hide(400);
                $(".error_msg_div").attr("data-chkval", 0);
                $(".epass").html('');
            }
        });

        $('#password_confirmation').focusout(function(){
            var errmsg = "";
            if($(this).val() == "") {
                errmsg += "This Field Is Required";
            } else if($(this).val().length <= 2) {
                errmsg += "The Text is too short";
            } else if($(this).val() !== $('#pass').val()) {
                errmsg = "Please enter correct password";
            } else {
                errmsg = "";
            }

            if(errmsg !== "") {
                $(".cpass").show(400);
                $(".error_msg_div").attr("data-chkval", 1);
                $(".cpass").html('<p class="signuperrorp">' + errmsg + '</p>');
            } else {
                $(".cpass").hide(400);
                $(".error_msg_div").attr("data-chkval", 0);
                $(".cpass").html('');
            }
        });

        $("#savesignup").click(function() {
            var chksub = 0;
            $(".emsg").each(function(){
                if($(this).html() !== "") {
                    chksub = 1;
                }
            });
            if(chksub == 0) {
                if(chksignup()) {
                    $(".register-form").submit();
                }
            }
        });


        function chksignup() {
            var parama = 0;
            $(".register-form").find("input[type='text']").each(function(){
                if($(this).val() !== "") {
                    parama = 1;
                    return true;
                }
            });
            if(parama == 1) {
                return true;
            } else {
                return false;
            }
        }
        /******* Signup Validation **********/


        /******* Login Validation **********/
        $('#lemail').focusout(function(){
            var errmsg = "";
            if($(this).val() == "") {
                errmsg += "This Field Is Required";
            } else if($(this).val().length <= 2) {
                errmsg += "The Text is too short";
            } else {
                errmsg = "";
            }

            if(errmsg !== "") {
                $(".lemaildiv").show(400);
                $(".lemaildiv").html('<p class="signuperrorp">' + errmsg + '</p>');
            } else {
                $(".lemaildiv").hide(400);
                $(".lemaildiv").html('');
            }
        });

        $('#lpassword').focusout(function(){
            var errmsg = "";
            if($(this).val() == "") {
                errmsg += "please enter valid password";
            } else if($(this).val().length <= 2) {
                errmsg += "The Text is too short";
            } else {
                errmsg = "";
            }

            if(errmsg !== "") {
                $(".lpassdiv").show(400);
                $(".lpassdiv").html('<p class="signuperrorp">' + errmsg + '</p>');
            } else {
                $(".lpassdiv").hide(400);
                $(".lpassdiv").html('');
            }
        });

        $("#loginbtn").click(function() {
            var chksub = 0;
            $(".emsg").each(function(){
                if($(this).html() !== "") {
                    chksub = 1;
                }
            });
            if(chksub == 0) {
                if(chklogin()) {
                    $("#loginForm").submit();
                }
            }
        });

        function chklogin() {
            var parama = 0;
            $("#loginForm").find("input[type='text']").each(function(){
                if($(this).val() !== "") {
                    parama = 1;
                    return true;
                }
            });
            if(parama == 1) {
                return true;
            } else {
                return false;
            }
        }
        /******* Login Validation **********/

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        });



        $('.popupforall').show(300);
        $(".modal-backdrop").click(function(){
            $(this).css("display", "none");
            $(".popupforall").css("display", "none");
        });
        $('#close_ebtn').on('click', function(e){
            $(".request_form").modal("hide");
            $('#thankyou').hide();
        });

        $('.close_ebtn').on('click', function(e){
            $(".request_form").modal("hide");
            $('#thankyou').hide();
        });

        // $("#feedback").on('click', function(e) {
        //     $('#form-section').css("display", "block");
        //     $('#thankyou').css("display", "none");
        // });

       // $("#sendEnquiry").on('click', function(e){
       {{-- $(document).on("click","#sendEnquiry",function(e) {--}}
       {{--      console.log("btn clicked");--}}
       {{--     enquiryvalidation('');--}}
       {{--     /********* Captcha Validation *********/--}}
       {{--     if(!$('#enquiry-form textarea[name="g-recaptcha-response"]').val()) {--}}
       {{--         $("#captcha_msg").show(400);--}}
       {{--         return false;--}}
       {{--     }--}}
       {{--     /********* Captcha Validation *********/--}}

       {{--     /**** phone valid ****/--}}
       {{--     // var num = /^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/;--}}
       {{--     // if(!$("#phone").val().match(num)) {--}}
       {{--     //     return false;--}}
       {{--     // }--}}
       {{--     /**** phone valid ****/--}}

       {{--     /**** Email valid ****/--}}
       {{--     var email_rgx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;--}}
       {{--     if(!email_rgx.test($("#remail").val())) {--}}
       {{--         return false;--}}
       {{--     }--}}
       {{--     /**** Email valid ****/--}}
       {{--     console.log("after validation  area");--}}
       {{--     var valid = this.form.checkValidity();--}}
       {{--     if (valid) {--}}
       {{--         e.preventDefault();--}}
       {{--         console.log("inside valid");--}}
       {{--         // $('#lesson_list_area').hide();--}}
       {{--         //$('#lesson_list_loader').show();--}}
       {{--         var first_name = $("#first_name").val();--}}
       {{--         var last_name = $("#last_name").val();--}}
       {{--         var email = $("#remail").val();--}}
       {{--         var phone = $("#phone").val();--}}
       {{--         var country = $("#country").val();--}}
       {{--         var enquiry_type = $("#enquiry_type").val();--}}
       {{--         var message = $("#msg").val();--}}
       {{--         var sub = $("#defaultCheck1").val();--}}
       {{--         var subscribed =($("#defaultCheck1").val()=='Yes')?'1':'0';--}}
       {{--         var course_id = $("#course_id").val();--}}
       {{--         var course_title = $("#course_title").val();--}}
       {{--         var course_slug = $("#course_slug").val();--}}
       {{--         var loading = $(this).data("loading-text");--}}


       {{--         $.ajax({--}}
       {{--             beforeSend: function () {--}}
       {{--                 $('#load').css("display", "block");--}}

       {{--                 $('#sendEnquiry').text(loading);--}}
       {{--                 $('#sendEnquiry').prop('disabled', true);--}}
       {{--             },--}}
       {{--             headers: {--}}
       {{--                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
       {{--             },--}}
       {{--             type: 'POST',--}}
       {{--             url: '{{url('send/enquiry')}}',--}}
       {{--             data: {--}}
       {{--                 course_id: course_id,--}}
       {{--                 course_title: course_title,--}}
       {{--                 course_slug: course_slug,--}}
       {{--                 first_name: first_name,--}}
       {{--                 last_name: last_name,--}}
       {{--                 country: country,--}}
       {{--                 enquiry_type: enquiry_type,--}}
       {{--                 email: email,--}}
       {{--                 subscribed: subscribed,--}}
       {{--                 phone: phone,--}}
       {{--                 msg: message,--}}
       {{--                 sub: sub--}}
       {{--             },--}}
       {{--             success: function (response) {--}}
       {{--                 console.log(response);--}}
       {{--                 if (response.success) {--}}
       {{--                     //$(".request_form").modal("hide");--}}
       {{--                     $("form").trigger("reset");--}}
       {{--                     // toastr["success"](response.message);--}}

       {{--                     $('#form-section').hide();--}}
       {{--                     $('#thankyou').show();--}}
       {{--                     // $('#addToWishlist').find( "i" ).addClass('fa-heart');--}}
       {{--                 } else {--}}
       {{--                     // $('#addToWishlist').find( "i" ).removeClass('fa-heart');--}}
       {{--                     // $('#addToWishlist').find( "i" ).addClass('fa-heart-o');--}}
       {{--                 }--}}
       {{--             },--}}
       {{--             complete: function () {--}}
       {{--                 $('#load').css("display", "none");--}}
       {{--                 $('#sendEnquiry').css("display", "block");--}}
       {{--             }--}}
       {{--         });--}}
       {{--     }--}}
       {{-- });--}}

        {{--if(window.performance.navigation.type){--}}
        {{--if("{!! collect(request()->segments())->last() !!}" == "checkout" || "{!! collect(request()->segments())->last() !!}" == "cart") {--}}
        {{--location.reload(true);--}}
        {{--}--}}
        {{--}--}}

        $("#successrow").fadeOut(800);
        // $(".stu_msg").fadeOut(2000);

        $(".crossicon").click(function() {
            $(".removeDiv").fadeOut(800);
        });

        @if(isset($cartMSG))
        $(window).on('load', function(e){
            $('#alertMessageModal').modal('show');
        });
        @endif

         var carousel = $('#featured_courseSlider');
        carousel.on({
            'initialized.owl.carousel': function () {
                console.log("initialized");
                carousel.find('.item').show();
                $('#loadcarousel').hide();
                $('#featured_courseSlider').show();
            }
        }).owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            autoplay: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                1440: {
                    items: 1
                }
            }
        });

        jQuery('#most_popular').owlCarousel({
            loop: true,
            margin:20,
            nav: true,
            dots: false,
            autoplay: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                375: {
                    items: 2
                },
                640: {
                    items: 3
                },
                1024: {
                    items: 3
                },
                1280: {
                    items: 4
                },
                1440: {
                    items: 5
                }
            }
        });
        jQuery('#categories_popular').owlCarousel({
            loop: true,
            margin:20,
            nav: true,
            dots: false,
            autoplay: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                375: {
                    items: 2
                },
                640: {
                    items: 3
                },
                1024: {
                    items: 3
                },
                1280: {
                    items: 4
                },
                1440: {
                    items: 5
                }
            }
        });


        $(".form-check-input").click(function(evt){
             console.log($(this).attr("name"));
            $("#last_filter").val($(this).attr("name"));

        });
        $.each($(".post_wrap input[name='main-filter']:checked"), function(){
            console.log($(this).val());
            $("#last_filter").val($(this).attr("name"));

        });



        $(document).on('click touchstart', '.search-form-tigger', function() {
            $(".mobile_dropdown").css('display','none');
        });

        $(document).on('focus touchstart', 'input', function() {
            $(".mobile_dropdown").css('display','none');
            // $(".mobile_dropdown").hide();
            if ($(".open").length > 0) {

                $(".dropdown").removeClass("open");

                $(".mobile_dropdown").css('display','none');
                // $(".mobile_dropdown").hide();
            }
        });


    @if(queryString('price','free'))
        activaTab('free_courses');
    @elseif (queryString('price','discounted'))
        activaTab('disc_courses');
    @elseif (queryString('sort','popular'))
        activaTab('popular_courses');
    @elseif (queryString('sort','new'))
        activaTab('new_courses');
    @else
        activaTab('all_tb');
    @endif

        function activaTab(tab){
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        };



        // $(".currency-selector").on("change", function() {
        //
        //
        //
        //
        // });




    });




    jQuery(document.body).on('change','.currency-selector',function(){
        var currency_rate = $(this).val();
        var currency_short = $(this).find(':selected').data('short')
        var currency_id= $(this).find(':selected').data('id');
        var currency_symbol= $(this).find(':selected').data('symbol');
        var current_url="";
        if (window.location.href.indexOf("#") != -1) {
              current_url = window.location.href.split("#")[0];
        }else{
              current_url = $(location). attr("href");

        }
        $(".currency-selector").attr("disabled",true);

        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{url('switchcurrency')}}',
            data: {
                currency_id: currency_id,
                currency_rate: currency_rate,
                currency_short: currency_short,
                currency_symbol: currency_symbol,
                current_url: current_url
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    window.location.href = current_url;
                }
            },
            complete: function () {
                setTimeout(function () {
                    $(".currency-selector").attr("disabled",false);
                },3000);


            }
        });

    });


    /* Clicks within the dropdown won't make
           it past the dropdown itself */


    function showwishlist(){
        Cookies.set('preurl','{{ URL_STUDENT_LMS_WISHLIST }}');
        @if(Auth::check())
            window.location.href = '{{ URL_STUDENT_LMS_WISHLIST }}';
        @else
            window.location.href = '{{ url('/wishlist') }}';
        // $('#LoginModal').modal({show: 'true'});
        @endif
    }

    function switchCategory(slug){

        $('#load').css("display", "block");
        window.location.href='{{url('courses')}}/'+slug;

    }

    function browsData(slug){
//console.log($(this));

        $('#loading').css("display", "block");
        var slug = slug;
        var mainfilter = [];
        var subcats = [];
        var levels = [];
        var price = [];
        var materials = [];
        var rating = [];
        var duration = [];

        $.each($("input[name='main-filter']:checked"), function(){
            mainfilter.push($(this).val());
        });
        var catid=mainfilter.join(",");

        $.each($("input[name='subcategory']:checked"), function(){
            subcats.push($(this).val());
        });
        var catids=subcats.join(",");


        $.each($("input[name='levels']:checked"), function(){
            levels.push($(this).val());
        });
        var levelids=levels.join(",");

        $.each($("input[name='price']:checked"), function(){
            price.push($(this).val());
        });
        var priceids=price.join(",");

        $.each($("input[name='materials']:checked"), function(){
            materials.push($(this).val());
        });
        var materialids=materials.join(",");

        $.each($("input[name='materials']:checked"), function(){
            materials.push($(this).val());
        });
        $.each($("input[name='rating']:checked"), function(){
            rating.push($(this).val());
        });
        var ratingids=rating.join(",");

        $.each($("input[name='duration']:checked"), function(){
            duration.push($(this).val());
        });
        var durationids=duration.join(",");


        var qstr='?';
        qstr+='subcats='+catids+'&levels='+levelids+'&price='+priceids+'&materials='+materialids+'&rating='+ratingids+'&duration='+durationids;
        qstr+='&last_filter='+$('#last_filter').val();
        // console.log(slug);
        // console.log(catid);

        if(slug!=""){
            if (window.location.href.indexOf(catid) < 0){
                window.location.href='{{url('courses')}}/'+slug;
            }else{
                window.location.href='{{url('courses')}}/'+slug+qstr;
            }
        }else if ($('#search_term').val()!=""){
            qstr+='&search_term='+$('#search_term').val();
            window.location.href='{{url('courses/search')}}/'+qstr;
        }else{
            qstr+='&search_term=all';
            window.location.href='{{url('courses/search')}}/'+qstr;
        }


    }


    function ajaxcheckLogin(){

        $.ajax({
            beforeSend: function () {

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',

            url: '{{url('checklogin')}}',
            data: {
                uname : $("#loginForm #email").val(),
                upass : $("#loginForm #password").val(),
                url : $("#pageurl").val()
            },

            success: function (response) {
                if (response.success){
                    if(response.status == "valid") {
                        //window.location.href = response.url;
                        $("#loginForm").submit();
                    }
                    if(response.status == "login") {
                        $('#LoginModal').modal("hide");
                        $(".form_with_payment").submit();
                    }
                    if(response.status == "detail") {
                        $('#LoginModal').modal("hide");
                        window.location = '{{ url('/checkout') }}';
                    }
                    if(response.status == "gift") {
                        $('#LoginModal').modal("hide");
                        window.location = response.url;
                    }
                } else {
                    $(".ajaxloginmsg").show(300);
                }

            },
            complete: function () {

            }
        });

    }

    function resetenqform() {
        // $('#enquiry-form textarea[name="g-recaptcha-response"]').prop("checked", false);
        // $('#sendEnquiry').text('SEND YOUR ENQUIRY');
        // $('#sendEnquiry').prop('disabled', false);
        // $('#thankyou').hide();
        // $('#form-section').show();
        window.location.reload();
    }

    $('#mainVideoModal').on('hidden.bs.modal', function () {
        $("video").each(function(){
            $(this).get(0).pause();
        });
    })

    /********* Start Set Login empty *********/
    @if(urlHasString("login") || urlHasString("register"))
    $( window ).on( "load", function() {
        setTimeout(function() {
            $("#email").val("");
            $("input[name='password']").val("");
            if($("input[name='username']").length > 0) {
                $("input[name='username']").val("");
            }
        },1500);
    });
    @endif
    /********* End Set Login empty *********/
    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.reload()
        }
    };

    /********* login tabs on load *********/
    // $("#myTab").hide();
    // $("#myTabContent").hide();
    // $( window ).on( "load", function() {
    //     $("#myTab").show(300);
    //     $("#myTabContent").show(300);
    //     $(".login-loader").hide();
    // });
    /********* login tabs on load *********/

    var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
    function ValidateSingleInput(oInput) {
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                   var message="Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", ");

                    var bsAlert = function(message) {
                        if ($("#bs-alert").length == 0) {
                            $('body').append('<div class="modal tabindex="-1" id="bs-alert">'+
                                '<div class="modal-dialog">'+
                                '<div class="modal-content">'+
                                '<div class="modal-header">'+
                                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
                                '<h4 class="modal-title">Alert</h4>'+
                                '</div>'+
                                '<div class="modal-body">'+
                                message+
                                '</div>'+
                                '<div class="modal-footer">'+
                                '<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>'+
                                '</div>'+
                                '</div>'+
                                '</div>'+
                                '</div>')
                        } else {
                            $("#bs-alert .modal-body").text(message);
                        }
                        $("#bs-alert").modal();
                    }
                    bsAlert(message);
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }

    /*********** Timer ************/
        // Set the date we're counting down to
    var countDownDate = new Date("{!! isset($Promo->timmer) ? $Promo->timmer : "Jan 5, 2024 15:37:25" !!}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        // document.getElementById("topbartimer").innerHTML = days + "days " + hours + "hours " + minutes + "min " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            // document.getElementById("topbartimer").innerHTML = "EXPIRED";
        }
    }, 1000);
    /*********** Timer ************/

</script>


