(function (wp, dom) {
    var maxWidth = 0;

    function updateMaxWidth() {
        var widthField = dom.document.getElementById('width');
        var editorContainer = dom.document.querySelector('.is-root-container');

        if (widthField && editorContainer) {
            maxWidth = parseInt(widthField.value) || 0;
            editorContainer.style.maxWidth = maxWidth + 'px';
        }
    }

    wp.domReady(updateMaxWidth);

    wp.blocks.addAction(
        'blocks.updateBlockAttributes',
        'custom/update-max-width',
        function (updatedAttributes, originalBlock) {
            updateMaxWidth();
            return updatedAttributes;
        }
    );
})(window.wp, window.wp.dom);
