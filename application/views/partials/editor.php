<link href="<?php echo assets('plugins/editor/trumbowyg.min.css'); ?>" rel="stylesheet"  media="all">
<script src="<?php echo assets('plugins/editor/trumbowyg.min.js'); ?>" type="text/javascript"></script>
<script>
    $('.editor').trumbowyg({
        autogrow: true,
        imageWidthModalEdit: true
    });
    $('.editor-full').trumbowyg();
    $('.editor-mini').trumbowyg(
        {
            btns: [
                ['viewHTML'],
                ['undo', 'redo'], // Only supported in Blink browsers
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                ['link'],
                ['insertImage'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ]
        }
    );
</script>