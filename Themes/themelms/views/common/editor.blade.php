{{--<script src="https://cdn.ckeditor.com/4.14.1/standard-all/ckeditor.js"></script>--}}
<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>

<script>

    jQuery( document ).ready(function($) {
  //$(function() {

   $('.ckeditor').each(function(config){

       // Remove some buttons provided by the standard plugins, which are
       // not needed in the Standard(s) toolbar.


		CKEDITOR.replace($(this).attr('name'), {
		extraPlugins: 'sourcedialog,mathjax,justify,autogrow,embed,autoembed',
		mathJaxLib: 'http://cdn.mathjax.org/mathjax/2.6-latest/MathJax.js?config=TeX-AMS_HTML',
		autoGrow_minHeight:350,
       autoGrow_maxHeight:500,
       autoGrow_bottomSpace:100,
            removeButtons:'Underline,Subscript,Superscript',
       fullPage:true,
            ProtectedTags : 'html|head|body',
            // toolbar :
            //     [
            //         { name: 'basicstyles', items : [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
            //         { name: 'paragraph', items : [ 'Templates', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
            //                 '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
            //         { name: 'links', items : [ 'Link', 'Unlink', 'Anchor' ] },
            //         { name: 'insert', items : [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak' ] },
            //         { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            //         { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            //         '/',
            //         { name: 'document', items : [ 'Source', '-', 'Preview', 'Print' ] },
            //         { name: 'clipboard', items : [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            //         { name: 'editing', items : [ 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt' ] },
            //         { name: 'tools', items : [ 'Maximize', 'sourcedialog','ShowBlocks' ] }
            //     ],
            allowedContent:true,
       format_tags:'p;h1;h2;h3;h4;h5;pre',
       removePlugins:'sourcearea',
       removeDialogTabs:'image:advanced;link:advanced',
            contentsCss: [
                '//cdn.ckeditor.com/4.15.1/full-all/contents.css',
                '//ckeditor.com/docs/ckeditor4/4.15.1/examples/assets/stylesheetparser/stylesheetparser.css'
            ],
            // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
           // image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
            //image2_disableResizer: true
            disableAutoInline:true
		});

//       CKEDITOR.disableAutoInline = true;

	});



  });  


</script>
<script type="text/x-mathjax-config">
     MathJax.Hub.Config({tex2jax: {inlineMath: [['\\(','\\)']]}});
   </script>
   <script type="text/javascript" async
     src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
   </script>
<script type="text/x-mathjax-config">
MathJax.Hub.Register.StartupHook("End Jax",function () {
 var BROWSER = MathJax.Hub.Browser;
 var jax = "SVG";
 //var jax = "HTML-CSS";
 if (BROWSER.isMSIE && BROWSER.hasMathPlayer) jax = "NativeMML";
 if (BROWSER.isFirefox) jax = "SVG";
 if (BROWSER.isSafari && BROWSER.versionAtLeast("5.0")) jax = "NativeMML";
 return MathJax.Hub.setRenderer(jax);
});
</script>