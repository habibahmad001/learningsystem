
<!DOCTYPE html>

<html lang="en">



<head>

    <link href="{{CSS}}bootstrap.min.css" rel="stylesheet">

    <meta charset="UTF-8">

    <title>{{getphrase('certificate_for').' '.$user->name}}</title>

</head>



<body>

<div style="width:1000px; margin: 30px auto; min-height:600px; padding:80px; text-align:center;  box-sizing:border-box; position:relative;" id='printarea'>

    <img src="{{IMAGE_PATH_SETTINGS.getSetting('watermark_image','certificate')}}" style="position: absolute;right: 0;top: 0;" width="100%" alt="">

    <!--border: 10px solid #787878;-->

    <div style=" padding:60px 60px 30px; text-align:center; color:#333; line-height:26px; font-family:calibari; position:relative;">



        {{--<span class="hide" ><img src="{{IMAGE_PATH_SETTINGS.getSetting('logo','certificate')}}" height="140" alt=""></span>--}}

        <div style="text-align: center;padding-bottom: 46px;padding-top: 150px;">
            {!!$content!!}
        </div>


        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-family:arial;">

            <tr>

                <td align="left"><b style="font-size:16px;">Awarded Date: {{$awarded_date}} </b></td>
                <td align="right"><b style="font-size:16px;">Certificate Code: {{$certificate_code}} </b></td>
            </tr>

        </table>

    </div>

</div>

{{--<div class="text-center">--}}
{{--<button class="btn btn-primary" onclick="printIt();">{{getPhrase('print')}}</button>--}}
{{--</div>--}}



</body>

<style>
    a.print-preview {
        /*display: none;*/
    }
    a.print-preview {
        background: url(/images/icon-print-preview.png) no-repeat 0 0;
        cursor: pointer;
        display: block;
        margin: 0px 0 20px;
        padding: 0 40%;
        line-height: 20px;
    }

    #aside {
        margin-top: 1em;
    }

    #aside h2 {
        font-size: 1.3em;
        margin: 0 0 0.25em;
    }

    #aside ul {
        margin: 0 0 2em;
    }
    #print-modal {
        background: #FFF;
        position: absolute;
        left: 50%;
        margin: 0 0 0 -465px;
        padding: 0 8px;
        width: 900px;
        box-shadow: 0 0 20px #000;
        -moz-box-shadow: 0 0 20px #000;
        -webkit-box-shadow: 0 0 10px #000;
    }

    #print-modal-content {
        margin: 68px 0;
        border: none;
        height: 100%;
        overflow: hidden;
        width: 100%;
    }

    #print-modal-controls {
        border: 1px solid #ccc;
        border-radius: 8px;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        top: 15px;
        left: 50%;
        margin: 0 0 0 -81px;
        position: fixed;
        padding: 5px 0;
        background: rgba(250, 250, 250, 0.75);
    }

    #print-modal-controls a {
        color: #FFF;
        display: block;
        float: left;
        height: 32px;
        text-decoration: none;
        text-indent: -999em;
        width: 80px;
    }

    #print-modal-controls a:hover {
        opacity: 0.75;
    }

    #print-modal-controls a.print {
        background: url(images/icon-print.png) no-repeat 50% 50%;
    }
    #print-modal-controls a.close {
        background: url(images/icon-close.png) no-repeat 50% 50%;
    }
</style>
<link rel="stylesheet" href="{{JS}}src/css/print-preview.css" type="text/css" media="screen">

<script src="{{JS}}jquery-1.12.1.min.js"></script>

<script src="{{JS}}src/jquery.print-preview.js"></script>

<script type="text/javascript">
    jQuery(function($) {


        /*
         * Initialise print preview plugin
         */
        // Add link for print preview and intialise
        $('#printarea').prepend('<a class="print-preview">Print this page</a>');
        $('a.print-preview').printPreview();

        // Add keybinding (not recommended for production use)
        $(document).bind('keydown', function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code == 80 && !$('#print-modal').length) {
                $.printPreview.loadPrintPreview();
                return false;
            }
        });
    });
</script>




</html>