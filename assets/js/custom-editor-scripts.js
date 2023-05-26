jQuery(window).on('load', function () {
    jQuery(document).ready(function ($) {
        var maxWidth = 0;
        var editorContainer = $('.is-root-container');

        function updateMaxWidth() {
            var widthField = $('#width');
            var wpBlocks = editorContainer.find('> div.wp-block');

            if (widthField.length && wpBlocks.length) {
                maxWidth = parseInt(widthField.val()) || 0;
                wpBlocks.css('max-width', maxWidth + 'px !important');
            }
        }

        updateMaxWidth();

        $('#width').on('input', function () {
            updateMaxWidth();
        });

        wp.blocks.addAction(
            'blocks.updateBlockAttributes',
            'custom/update-max-width',
            function (updatedAttributes, originalBlock) {
                updateMaxWidth();
                return updatedAttributes;
            }
        );
    });
});
