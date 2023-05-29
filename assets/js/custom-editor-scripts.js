// jQuery(window).on('load', function ($) {
//     jQuery(document).ready(function ($) {
//         var maxWidth = 0;
//         var editorContainer = $('.is-root-container');

//         function updateMaxWidth() {
//             var widthField = $('#width');
//             var wpBlocks = editorContainer.find('> div.wp-block');

//             if (widthField.length && wpBlocks.length) {
//                 maxWidth = parseInt(widthField.val()) || 0;
//                 wpBlocks.css('max-width', maxWidth + 'px !important');
//             }
//         }

//         updateMaxWidth();

//         $('#width').on('input', function () {
//             updateMaxWidth();
//         });

//         wp.blocks.addAction(
//             'blocks.updateBlockAttributes',
//             'custom/update-max-width',
//             function (updatedAttributes, originalBlock) {
//                 updateMaxWidth();
//                 return updatedAttributes;
//             }
//         );
//     });
// });

document.addEventListener('DOMContentLoaded', function () {
    var widthInput = document.querySelector('#width');
    var wpBlocks = document.querySelectorAll('.is-root-container > .wp-block');

    function setWidth() {
        var widthValue = widthInput.value + 'px';
        wpBlocks.forEach(function (block) {
            block.style.width = widthValue;
        });
    }

    // Set initial width
    setWidth();

    // Update width when input changes
    widthInput.addEventListener('input', setWidth);

    // Promise to wait for .is-root-container
    new Promise(function (resolve) {
        var rootContainerObserver = new MutationObserver(function (
            mutations,
            observer
        ) {
            if (document.querySelector('.is-root-container')) {
                observer.disconnect();
                resolve();
            }
        });
        rootContainerObserver.observe(document.body, {
            childList: true,
            subtree: true,
        });
    }).then(function () {
        // Now that .is-root-container exists, start observing for .wp-block elements
        var wpBlockObserver = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.type === 'childList') {
                    wpBlocks = document.querySelectorAll(
                        '.is-root-container > .wp-block'
                    );
                    setWidth();
                }
            });
        });

        wpBlockObserver.observe(document.querySelector('.is-root-container'), {
            childList: true, // observe direct children
            subtree: true, // and lower descendants too
        });
    });
});
